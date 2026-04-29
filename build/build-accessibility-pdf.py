#!/usr/bin/env python3
"""
Build a polished PDF from accessibility-fix.md.

- Renders the markdown with python-markdown (tables, fenced code, TOC, attr_list).
- Wraps in a Piedmont-branded HTML template:
    * DM Sans via Google Fonts (preloaded + @font-face fallbacks).
    * Brand accent palette matching the theme (teal + lime + coral).
    * Color-coded status pills for "Fixed", "Partial", "Fail", "Pass", "Open".
    * Audit-result cells ("Fail" / "Partial" / "Pass (N/A)") highlighted in table.
    * Print-ready page layout with page numbers and running title.
- Prints to PDF via headless Google Chrome (no Puppeteer / wkhtmltopdf needed).

Usage:
    python3 build/build-accessibility-pdf.py

Output:
    build/accessibility-fix.pdf
"""

from __future__ import annotations

import html
import os
import re
import shutil
import subprocess
import sys
from pathlib import Path

try:
    import markdown
except ImportError:
    sys.exit("Missing dependency: python3 -m pip install --user markdown pygments")

ROOT = Path(__file__).resolve().parent.parent
SRC_MD = ROOT / "accessibility-fix.md"
BUILD = ROOT / "build"
OUT_HTML = BUILD / "accessibility-fix.html"
OUT_PDF = BUILD / "accessibility-fix.pdf"

CHROME = "/Applications/Google Chrome.app/Contents/MacOS/Google Chrome"

# ---------------------------------------------------------------------------
# Status / audit-result word lists used for color coding in tables.
# Regex is run against the already-escaped HTML table cell content, so we
# don't have to worry about nested tags.
# ---------------------------------------------------------------------------

STATUS_PATTERNS = [
    # (regex, css class)
    (re.compile(r"\bFixed(?:\s*\(global\))?\b", re.I), "pg-pill pg-pill--fixed"),
    (re.compile(r"\bPatched\b", re.I), "pg-pill pg-pill--fixed"),
    (re.compile(r"\bNot applicable on this page\b", re.I), "pg-pill pg-pill--na"),
    (re.compile(r"\bPartially mitigated[^<|]*", re.I), "pg-pill pg-pill--partial"),
    (re.compile(r"\bOpen[^<|]*", re.I), "pg-pill pg-pill--open"),
    (re.compile(r"\bPass \(N/A\)\b", re.I), "pg-pill pg-pill--pass-na"),
    (re.compile(r"\bPass with suggestion\b", re.I), "pg-pill pg-pill--partial"),
    (re.compile(r"\bPass\b", re.I), "pg-pill pg-pill--pass"),
    (re.compile(r"\bPartial[^<|]*", re.I), "pg-pill pg-pill--partial"),
    (re.compile(r"\bFail[^<|]*", re.I), "pg-pill pg-pill--fail"),
]


def render_markdown(text: str) -> str:
    md = markdown.Markdown(
        extensions=[
            "extra",           # tables, fenced_code, attr_list, def_list, footnotes, abbr
            "admonition",
            "sane_lists",
            "toc",
            "codehilite",
        ],
        extension_configs={
            "codehilite": {
                "guess_lang": False,
                "noclasses": False,
                "pygments_style": "default",
            },
            "toc": {
                "permalink": False,
            },
        },
        output_format="html5",
    )
    return md.convert(text)


def colorize_table_cells(html_body: str) -> str:
    """Wrap status / audit-result words inside <td> cells with colored pills."""

    def pillify_cell(match: re.Match) -> str:
        open_tag, inner, close_tag = match.group(1), match.group(2), match.group(3)

        # Skip cells that clearly contain links / code blocks / multiple children
        # (we only want to colorize short status cells).
        if re.search(r"<(a|code|pre|img)\b", inner):
            return match.group(0)

        stripped = inner.strip()
        # Any bold around the whole cell ("**Fixed**") is kept intact; we just
        # swap the visible text for a pill.
        for pattern, cls in STATUS_PATTERNS:
            m = pattern.search(stripped)
            if not m:
                continue
            label = html.escape(m.group(0))
            pill = f'<span class="{cls}">{label}</span>'
            new_inner = pattern.sub(pill, stripped, count=1)
            # Keep any surrounding ** markers that python-markdown already
            # replaced with <strong>; nothing to do.
            return f"{open_tag}{new_inner}{close_tag}"

        return match.group(0)

    return re.sub(
        r"(<td[^>]*>)(.*?)(</td>)",
        pillify_cell,
        html_body,
        flags=re.DOTALL,
    )


def wrap_html(body: str, title: str) -> str:
    css = r"""
    :root {
        --pg-ink: #1F3131;
        --pg-ink-soft: #2a4040;
        --pg-lime: #98C441;
        --pg-lime-soft: #e6f3cc;
        --pg-coral: #D16555;
        --pg-coral-soft: #fbe4de;
        --pg-cream: #F9F8F6;
        --pg-cream-deep: #EFEAE1;
        --pg-border: #e3e0d9;
        --pg-text: #1F3131;
        --pg-muted: #4b5563;
        --pg-link: #8a3b2a;

        --pg-pass: #1e7a4a;
        --pg-pass-bg: #dff3e4;
        --pg-pass-border: #a3d8b4;

        --pg-partial: #a65e00;
        --pg-partial-bg: #fcecd0;
        --pg-partial-border: #f1c779;

        --pg-fail: #9b1c1c;
        --pg-fail-bg: #fbe0e0;
        --pg-fail-border: #eeaeae;

        --pg-fixed: #0b5c52;
        --pg-fixed-bg: #d4efe9;
        --pg-fixed-border: #8bcec2;

        --pg-open: #6b4f00;
        --pg-open-bg: #fff4c7;
        --pg-open-border: #f0d884;

        --pg-na: #475569;
        --pg-na-bg: #e6eaef;
        --pg-na-border: #c5cdd7;
    }

    @page {
        size: Letter;
        margin: 0.75in 0.7in 0.85in 0.7in;
        @bottom-right {
            content: "Page " counter(page) " of " counter(pages);
            font-family: "DM Sans", system-ui, sans-serif;
            font-size: 9pt;
            color: #6b7280;
        }
        @bottom-left {
            content: "Piedmont Global — Accessibility Remediation Report";
            font-family: "DM Sans", system-ui, sans-serif;
            font-size: 9pt;
            color: #6b7280;
        }
    }

    * { box-sizing: border-box; }

    html {
        font-family: "DM Sans", system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        font-size: 10.5pt;
        line-height: 1.55;
        color: var(--pg-text);
        background: #fff;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    body {
        margin: 0;
        padding: 0;
    }

    /* --------- Cover page --------- */
    .pg-cover {
        page-break-after: always;
        min-height: 9.2in;
        padding: 0.7in 0.1in 0.1in;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background:
            radial-gradient(1200px 520px at 90% -10%, rgba(152,196,65,0.25), transparent 65%),
            radial-gradient(1000px 480px at -10% 120%, rgba(209,101,85,0.22), transparent 60%),
            linear-gradient(180deg, #fbfaf7 0%, #f2ede3 100%);
        border-radius: 18px;
    }

    .pg-cover__eyebrow {
        font-size: 10pt;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: var(--pg-coral);
        font-weight: 700;
    }

    .pg-cover__title {
        font-family: "DM Sans", system-ui, sans-serif;
        font-weight: 700;
        font-size: 38pt;
        line-height: 1.05;
        color: var(--pg-ink);
        margin: 14pt 0 14pt;
        letter-spacing: -0.01em;
    }

    .pg-cover__sub {
        font-size: 13pt;
        color: var(--pg-ink-soft);
        line-height: 1.5;
        max-width: 5.2in;
        margin-bottom: 24pt;
    }

    .pg-cover__meta {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14pt 28pt;
        font-size: 10.5pt;
        max-width: 5.2in;
    }

    .pg-cover__meta dt {
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        font-size: 8.5pt;
        color: var(--pg-ink);
        margin-bottom: 2pt;
    }

    .pg-cover__meta dd {
        margin: 0;
        color: var(--pg-ink-soft);
    }

    .pg-cover__footer {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        margin-top: 18pt;
        border-top: 2px solid var(--pg-ink);
        padding-top: 10pt;
        font-size: 9pt;
        color: var(--pg-ink);
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }

    .pg-cover__accent {
        display: inline-block;
        width: 72pt;
        height: 6pt;
        background: linear-gradient(90deg, var(--pg-lime) 0%, var(--pg-coral) 100%);
        border-radius: 999px;
    }

    /* --------- Body --------- */
    .pg-doc {
        max-width: 100%;
    }

    h1, h2, h3, h4, h5, h6 {
        font-family: "DM Sans", system-ui, sans-serif;
        color: var(--pg-ink);
        line-height: 1.2;
        margin: 22pt 0 8pt;
        letter-spacing: -0.005em;
    }

    h1 {
        font-size: 22pt;
        font-weight: 700;
        padding-bottom: 6pt;
        border-bottom: 3px solid var(--pg-ink);
        margin-top: 0;
        page-break-before: always;
    }
    .pg-cover + h1,
    .pg-doc > h1:first-of-type { page-break-before: auto; }

    h2 {
        font-size: 16pt;
        font-weight: 700;
        padding-left: 10pt;
        border-left: 4px solid var(--pg-lime);
    }

    h3 {
        font-size: 12.5pt;
        font-weight: 700;
        color: var(--pg-ink);
    }
    h3::before {
        content: "";
        display: inline-block;
        width: 6pt;
        height: 6pt;
        border-radius: 2px;
        background: var(--pg-coral);
        margin-right: 7pt;
        vertical-align: middle;
        transform: translateY(-1pt);
    }

    h4 {
        font-size: 11pt;
        font-weight: 700;
        color: var(--pg-ink-soft);
    }

    p {
        margin: 7pt 0;
    }

    a {
        color: var(--pg-link);
        text-decoration: underline;
        text-decoration-color: var(--pg-lime);
        text-underline-offset: 2px;
    }

    strong { color: var(--pg-ink); }

    hr {
        border: none;
        border-top: 1px dashed var(--pg-border);
        margin: 18pt 0;
    }

    ul, ol {
        margin: 6pt 0 6pt 18pt;
        padding: 0;
    }

    li {
        margin: 3pt 0;
    }

    blockquote {
        margin: 10pt 0;
        padding: 8pt 12pt;
        background: var(--pg-cream);
        border-left: 4px solid var(--pg-coral);
        color: var(--pg-ink-soft);
        border-radius: 4px;
    }

    /* --------- Code --------- */
    code {
        font-family: "JetBrains Mono", "SF Mono", Menlo, Consolas, monospace;
        font-size: 9pt;
        background: #f4f1ea;
        color: var(--pg-ink);
        padding: 1px 5px;
        border-radius: 3px;
        border: 1px solid #e7e1d3;
    }

    pre {
        font-family: "JetBrains Mono", "SF Mono", Menlo, Consolas, monospace;
        background: #1F3131;
        color: #f4f1ea;
        padding: 10pt 12pt;
        border-radius: 6px;
        overflow-x: auto;
        font-size: 8.5pt;
        line-height: 1.45;
        page-break-inside: avoid;
        white-space: pre-wrap;
        word-break: break-word;
    }

    pre code {
        background: transparent;
        color: inherit;
        border: none;
        padding: 0;
        font-size: inherit;
    }

    .codehilite {
        background: #1F3131;
        border-radius: 6px;
        padding: 2pt 4pt;
        margin: 10pt 0;
        page-break-inside: avoid;
    }

    .codehilite pre {
        margin: 0;
        padding: 8pt 10pt;
    }

    /* Pygments color tweaks on dark background */
    .codehilite .k  { color: #98C441; font-weight: 600; }
    .codehilite .kn { color: #98C441; font-weight: 600; }
    .codehilite .s, .codehilite .s1, .codehilite .s2 { color: #f0d67a; }
    .codehilite .c, .codehilite .c1 { color: #9aa8a8; font-style: italic; }
    .codehilite .nt { color: #f2a68d; }
    .codehilite .na { color: #eac67a; }
    .codehilite .nf, .codehilite .nb { color: #9cd8c6; }
    .codehilite .m, .codehilite .mi { color: #d7a3ff; }
    .codehilite .o { color: #f2a68d; }

    /* --------- Tables --------- */
    table {
        border-collapse: collapse;
        width: 100%;
        margin: 10pt 0;
        font-size: 9.5pt;
        page-break-inside: avoid;
    }

    thead {
        background: var(--pg-ink);
        color: #fff;
    }

    thead th {
        text-align: left;
        padding: 7pt 9pt;
        font-weight: 600;
        font-size: 9pt;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        border-bottom: 3px solid var(--pg-lime);
    }

    tbody td {
        padding: 6pt 9pt;
        border-bottom: 1px solid var(--pg-border);
        vertical-align: top;
    }

    tbody tr:nth-child(odd) { background: #faf8f3; }
    tbody tr:hover          { background: var(--pg-cream-deep); }

    /* --------- Status pills --------- */
    .pg-pill {
        display: inline-block;
        padding: 1.5pt 7pt;
        border-radius: 999px;
        font-size: 8.5pt;
        font-weight: 600;
        letter-spacing: 0.02em;
        white-space: nowrap;
        border: 1px solid transparent;
        line-height: 1.3;
    }
    .pg-pill--pass     { background: var(--pg-pass-bg);    color: var(--pg-pass);    border-color: var(--pg-pass-border); }
    .pg-pill--partial  { background: var(--pg-partial-bg); color: var(--pg-partial); border-color: var(--pg-partial-border); }
    .pg-pill--fail     { background: var(--pg-fail-bg);    color: var(--pg-fail);    border-color: var(--pg-fail-border); }
    .pg-pill--fixed    { background: var(--pg-fixed-bg);   color: var(--pg-fixed);   border-color: var(--pg-fixed-border); }
    .pg-pill--open     { background: var(--pg-open-bg);    color: var(--pg-open);    border-color: var(--pg-open-border); }
    .pg-pill--pass-na  { background: var(--pg-na-bg);      color: var(--pg-na);      border-color: var(--pg-na-border); }
    .pg-pill--na       { background: var(--pg-na-bg);      color: var(--pg-na);      border-color: var(--pg-na-border); }

    /* --------- Callouts --------- */
    .admonition {
        margin: 12pt 0;
        padding: 10pt 12pt;
        border-radius: 8px;
        background: var(--pg-cream);
        border: 1px solid var(--pg-border);
        border-left: 4px solid var(--pg-lime);
    }
    .admonition-title {
        font-weight: 700;
        margin: 0 0 4pt;
        color: var(--pg-ink);
        letter-spacing: 0.02em;
    }

    /* --------- Anchors / misc --------- */
    .toc {
        background: var(--pg-cream);
        border: 1px solid var(--pg-border);
        border-radius: 8px;
        padding: 12pt 16pt;
        margin: 12pt 0 18pt;
    }

    .toc ul {
        margin: 0 0 0 12pt;
        padding: 0;
    }

    .pg-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 6pt;
        margin: 6pt 0 18pt;
        font-size: 9pt;
    }
    """

    return f"""<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>{html.escape(title)}</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
<style>{css}</style>
</head>
<body>

<section class="pg-cover">
    <div>
        <div class="pg-cover__eyebrow">Piedmont Global</div>
        <h1 class="pg-cover__title">Accessibility<br>Remediation Report</h1>
        <p class="pg-cover__sub">
            Response to the WCAG 2.1 AA audits commissioned for
            piedmontglobal.com — root cause, remediation, verification,
            and outstanding asks for every page.
        </p>
        <span class="pg-cover__accent"></span>
    </div>

    <dl class="pg-cover__meta">
        <div>
            <dt>Scope</dt>
            <dd>Home, Solutions, Solution Taxonomy / Single Solution,<br>
                Single Industry, About, Case Studies, Contact,<br>
                Blog, Careers, Language Access Symposium</dd>
        </div>
        <div>
            <dt>Standard</dt>
            <dd>WCAG 2.1 Level AA (with selected 2.2 AA items)</dd>
        </div>
        <div>
            <dt>Legend</dt>
            <dd class="pg-legend">
                <span class="pg-pill pg-pill--fixed">Fixed</span>
                <span class="pg-pill pg-pill--partial">Partial</span>
                <span class="pg-pill pg-pill--fail">Fail</span>
                <span class="pg-pill pg-pill--pass">Pass</span>
                <span class="pg-pill pg-pill--open">Open</span>
                <span class="pg-pill pg-pill--pass-na">Pass (N/A)</span>
            </dd>
        </div>
        <div>
            <dt>Prepared by</dt>
            <dd>Piedmont Global engineering<br>godwillcodes / reimagined-train</dd>
        </div>
    </dl>

    <div class="pg-cover__footer">
        <span>Confidential — Internal audit response</span>
        <span>WCAG 2.1 AA</span>
    </div>
</section>

<main class="pg-doc">
{body}
</main>

</body>
</html>
"""


def main() -> int:
    if not SRC_MD.exists():
        print(f"Not found: {SRC_MD}", file=sys.stderr)
        return 1
    if not Path(CHROME).exists():
        print(f"Google Chrome not found at {CHROME}", file=sys.stderr)
        return 1

    text = SRC_MD.read_text(encoding="utf-8")

    # --- drop the first H1 from body (we already render a cover) ---
    text = re.sub(
        r"^# Accessibility Fixes — Audit Response\s*\n",
        "",
        text,
        count=1,
    )

    body = render_markdown(text)
    body = colorize_table_cells(body)
    doc = wrap_html(body, "Piedmont Global — Accessibility Remediation Report")

    BUILD.mkdir(exist_ok=True)
    OUT_HTML.write_text(doc, encoding="utf-8")
    print(f"Wrote HTML: {OUT_HTML}  ({OUT_HTML.stat().st_size / 1024:.1f} KB)")

    # --- Render to PDF via headless Chrome ---
    if OUT_PDF.exists():
        OUT_PDF.unlink()

    cmd = [
        CHROME,
        "--headless=new",
        "--disable-gpu",
        "--no-pdf-header-footer",
        "--no-sandbox",
        "--hide-scrollbars",
        "--virtual-time-budget=10000",  # let Google Fonts load
        f"--print-to-pdf={OUT_PDF}",
        OUT_HTML.as_uri(),
    ]

    print("Rendering PDF via headless Chrome…")
    proc = subprocess.run(cmd, capture_output=True, text=True, timeout=180)
    if proc.returncode != 0 or not OUT_PDF.exists():
        print(proc.stdout)
        print(proc.stderr, file=sys.stderr)
        return proc.returncode or 1

    size_kb = OUT_PDF.stat().st_size / 1024
    print(f"Wrote PDF:  {OUT_PDF}  ({size_kb:.1f} KB)")
    return 0


if __name__ == "__main__":
    sys.exit(main())
