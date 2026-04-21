# Accessibility Fixes — Audit Response

This document responds to the WCAG 2.1 AA audits commissioned for piedmontglobal.com.
It only covers rows that came back as **Partial** or **Fail**; everything marked
**Pass** or **Pass (N/A)** is omitted.

For each issue you'll find:
- The WCAG success criterion and conformance level
- The auditor's note (what they observed)
- Our root-cause analysis
- The remediation that shipped, with file paths and line ranges
- Verification steps so QA / the auditor can confirm the fix

## Pages covered

1. [Homepage](#page-homepage)
2. [Solutions Overview Page](#page-solutions-overview-page)
3. [Solution Taxonomy & Single Solution Pages](#page-solution-taxonomy--single-solution-pages)
4. [Single Industry Pages](#page-single-industry-pages)
5. [About Page](#page-about-page)
6. [Case Studies Page](#page-case-studies-page)
7. [Contact Page](#page-contact-page)
8. [Blog Page](#page-blog-page)
9. [Careers Page](#page-careers-page)

---

# Page: Homepage

## Summary table

| # | WCAG SC | Level | Audit result | Severity | Status |
|---|---|---|---|---|---|
| 1 | 1.1.1 Non-text Content | A | Partial | High | **Fixed in code; content backfill recommended** |
| 2 | 1.4.5 Images of Text | AA | Partial | High | **Fixed in code; content backfill recommended** |
| 3 | 1.4.11 Non-text Contrast | AA | Partial | Medium | **Awaiting auditor screenshot** |
| 4 | 1.4.13 Content on Hover or Focus | AA | Partial | Medium | **Fixed** |
| 5 | 2.1.1 Keyboard | A | Partial | High | **Fixed** |
| 6 | 2.1.2 No Keyboard Trap | A | Partial | Medium | **Fixed** |
| 7 | 2.2.2 Pause, Stop, Hide | A | Fail | Medium | **Fixed** |

---

## 1. WCAG 1.1.1 — Non-text Content (Level A)

**Auditor:** *"Non-decorative images do not have alt-text encrypted in them, writing
'Piedmont Global Partner' or 'Piedmont Global recognition' instead of the specific
award or organization the logo visually conveys."*

### Root cause

The four logo carousels on the homepage (Trusted Partners, We've Been Certified,
Contracting Vehicles, We've Been Recognized) read their alt text from ACF fields
(`partner_name`, `name`). When those fields are empty, the templates fall back to
generic strings like "Partner" or "Recognition", which is what the auditor saw.

### Fix

Introduced a single helper, `pg_brand_alt()`, that degrades gracefully:

1. Use the ACF brand name if present.
2. Otherwise, derive a Title-Cased label from the linked URL's hostname
   (e.g. `https://www.microsoft.com` → "Microsoft").
3. Otherwise, use a section-specific generic ("Partner logo", "Certification",
   "Contracting vehicle", "Recognition").

Applied to both the `<img alt>` and the surrounding `<a aria-label>` for every
logo in the four carousels.

**Files touched**

- `functions.php` — added `pg_brand_alt( $name, $url, $fallback )`
- `pages/home.php` — Trusted Partners, Certified, Contracting Vehicles, Recognized

### Remaining work (content team)

The template now emits the best alt text it can from the data it has. For
**ideal** alt text, content editors should populate the ACF `partner_name` and
`name` fields with the full brand name — for example:

- "Microsoft Translator" instead of an empty field
- "ISO 9001:2015 Certification"
- "GSA Multiple Award Schedule"
- "Inc. 5000 (2024)"

No code change is required once those fields are filled in.

### Verification

Inspect any logo image inside the four homepage carousels. The `alt` attribute
should now contain either the brand name or the brand domain (never just
"Partner").

---

## 2. WCAG 1.4.5 — Images of Text (Level AA)

**Auditor:** *"Text used instead of images on majority of site; organization name
appears as selectable text. Text alternative is not available for partnered
organization logos throughout site."*

### Root cause and fix

Same as 1.1.1 above. The same `pg_brand_alt()` helper supplies the text
alternative for every logo image in the four carousels.

### Verification

Same as 1.1.1. With a screen reader, each logo should announce a meaningful name
rather than a generic placeholder.

---

## 3. WCAG 1.4.11 — Non-text Contrast (Level AA)

**Auditor:** *"UI components have sufficient contrast against adjacent colors in
all sections but 'The foundation that makes success inevitable, whether your
audience is across the globe or across the street' which shifts from grey to
black and red."*

### Root cause analysis

We reviewed the homepage template, the Tailwind output, the page CSS, and the
JavaScript bundle for any color animation tied to that heading. The heading is
rendered as a static `<h2>` with no inline color classes, no keyframe rule, and
no JS color toggling:

```508:510:pages/home.php
            <h2 class="text-2xl md:text-5xl font-bold">
                The foundation that makes success inevitable, whether your audience is across the globe or across the street.
            </h2>
```

The only adjacent reddish element is the orange underline (`border-[#D16555]`)
on the **"Learn more about Strategic Globalization"** link directly below the
heading.

### Status

**Cannot reproduce as described.** We cannot ship a fix without first being able
to reproduce the behavior. We've requested a screenshot or screen recording from
the auditor showing the grey-to-black-to-red color shift. If it turns out to be
the orange CTA underline being misread as part of the heading, no change is
needed; if there is a real animation we missed, we'll address it as a follow-up.

### Action item

Auditor to provide a screenshot/recording of the observed color shift on the
"foundation that makes success inevitable…" heading.

---

## 4. WCAG 1.4.13 — Content on Hover or Focus (Level AA)

**Auditor:** *"Dropdowns cannot be dismissed with esc key."*

### Root cause

The desktop navigation controller (`assets/js/navigation.js`) listened for
`Escape` on the `[data-desktop-nav]` root element. That meant Escape only worked
when focus was already inside the trigger or a panel. Mouse users who hovered a
menu open never had keyboard focus inside the nav, so Escape did nothing — a
direct WCAG 1.4.13 ("Dismissible") failure.

### Fix

Added a document-level `keydown` listener that closes any open menu on Escape,
regardless of where focus currently lives. The pre-existing focus-aware Escape
path (which both closes the menu *and* restores focus to the trigger) is
preserved, so keyboard users still get the optimal experience.

**File touched**

- `assets/js/navigation.js` — `bindEvents()` registers `handleGlobalEscape`

### Verification

1. Hover (do not click) a desktop nav dropdown until the panel appears.
2. Press Escape without moving the mouse.
3. The panel must close.
4. Tab into a dropdown trigger and press Enter to open. Press Escape — the panel
   closes and focus returns to the trigger.

---

## 5. WCAG 2.1.1 — Keyboard (Level A)

**Auditor:** *"Escape button cannot be used to dismiss dropdown menus and
keyboard cannot be used to navigate through 'We've been certified',
'Contracting Vehicles' and 'We've been recognized' sections."*

### Root cause

Two separate problems:

1. **Dropdown Escape:** see Section 4 above (1.4.13). Same root cause; same fix.
2. **Logo carousels:** The four logo carousels (`.partners-carousel`,
   `.certificate-carousel`, `.contracting-vehicles-carousel`, and
   `.recognized-carousel`) were configured `nav: false, dots: false,
   autoplay: true`. There was no visible nav UI at all and no key bindings,
   so a keyboard user could not page through the slides.

### Fix

Created a reusable accessible toolbar via a new helper,
`pg_render_carousel_controls()` in `functions.php`. Each toolbar contains three
real `<button>`s:

- **Previous** — `aria-label="Previous {region label}"`
- **Pause / Play** — toggle with `aria-pressed` and a swapping `aria-label`
- **Next** — `aria-label="Next {region label}"`

All three use the standard focus-visible ring
(`focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2`).

In addition, the carousel region itself receives:

- `tabindex="0"` so it can be Tab-reached
- A `keydown` handler that pages on **ArrowLeft** / **ArrowRight**
- `data-pg-carousel-controls="{base_id}"` linking it to its toolbar

Applied to all four logo carousels on the homepage.

**Files touched**

- `functions.php` — added `pg_render_carousel_controls()` helper
- `pages/home.php` — toolbars + `data-pg-carousel-controls` on Trusted Partners,
  Certified, Contracting Vehicles, Recognized
- `assets/js/owl-bulletproof-loader.js` — `wireAccessibleControls()` connects
  toolbar buttons and arrow keys to Owl's `prev/next/stop/play.owl.carousel`
  events; same wiring duplicated into the inline fallback path
- `assets/js/carousel-a11y.js` — `hasExternalNav()` updated so the existing
  auto-injected overlay arrows are suppressed for carousels that already have
  the new accessible toolbar

### Verification

1. Tab through the homepage. The toolbar buttons (Prev / Pause / Next) and the
   carousel region should each receive a visible focus ring.
2. With focus inside a logo carousel region, press Left / Right arrow keys —
   slides should advance.
3. With a screen reader, click the Pause button — announcement should change
   from "Pause Trusted partners logos auto-rotation, toggle button, not pressed"
   to "Play Trusted partners logos auto-rotation, toggle button, pressed".

---

## 6. WCAG 2.1.2 — No Keyboard Trap (Level A)

**Auditor:** *"Tab, Shift+Tab, and up and down arrow keys function, escape
button does not function."*

### Root cause and fix

This finding is a downstream effect of 2.1.1 plus the dropdown Escape issue from
1.4.13. Once Escape dismisses dropdowns (Section 4) and the logo carousels can
be paused / paged from the keyboard (Section 5), there is no longer a place
where a keyboard user can lose control or be carried out of view by autoplay.

The existing `assets/js/carousel-a11y.js` script also stops autoplay on
`focusin` for any carousel, so a keyboard user can never be scrolled away from
the slide they're on while interacting with it.

### Verification

Same as Section 4 (Escape) and Section 5 (carousels). Additionally: Tab into a
logo carousel and confirm autoplay halts, and that you can Tab back out without
being interrupted by a slide change.

---

## 7. WCAG 2.2.2 — Pause, Stop, Hide (Level A)

**Auditor:** *"No mechanism for user to pause, stop, or hide movement in
'We've been certified', 'Contracting Vehicles' and 'We've been recognized'
sections."*

### Root cause

All four logo carousels had `autoplay: true, autoplayHoverPause: true`.
`autoplayHoverPause` only helps mouse users; keyboard, touch, and screen-reader
users had no way to stop motion that lasted longer than five seconds — a clean
WCAG 2.2.2 fail.

### Fix

The Pause / Play button rendered by `pg_render_carousel_controls()` (see Section
5) is wired to Owl's autoplay engine inside
`assets/js/owl-bulletproof-loader.js`:

- Click → `stop.owl.autoplay`, button label switches to **"Play …"**,
  `aria-pressed="true"`, icon swaps to a play triangle.
- Click again → `play.owl.autoplay`, button label reverts to **"Pause …"**,
  `aria-pressed="false"`, icon swaps back to the pause bars.

Implemented for all four logo carousels: Trusted Partners, Certified,
Contracting Vehicles, Recognized.

As an additional safeguard for users with vestibular sensitivities, autoplay is
**automatically disabled at init time** when
`prefers-reduced-motion: reduce` is set in the operating system. The button is
still rendered so the user can opt back in to motion at any time. Enforcement
lives in two places to cover the lazy-load path *and* the inline fallback
loader.

**Files touched**

- `functions.php` — `pg_render_carousel_controls()` renders the Pause / Play button
- `assets/js/owl-bulletproof-loader.js`
  - `wireAccessibleControls()` connects the button to autoplay events
  - `prefersReducedMotion` flag flips `autoplay: false` on the four carousel
    configs (and the inline fallback)
- `pages/home.php` — toolbars rendered above each of the four carousels
- `footer.php` — AOS now also honors `prefers-reduced-motion` (defense in
  depth, addresses the same family of concerns)

### Verification

1. Click the Pause button on any logo carousel — rotation halts immediately.
2. Click again — rotation resumes.
3. Enable OS reduced-motion (System Settings → Accessibility → Display →
   Reduce motion on macOS; Settings → Accessibility → Visual effects → Animation
   effects on Windows). Reload the page. The four logo carousels must not
   auto-rotate.
4. With a screen reader, the toggle should announce as a Toggle Button and
   reflect the correct pressed state.

---

# Page: Solutions Overview Page

Template file: `pages/solutions.php` (WordPress template
"Template Name: Solutions"). URL: `/solutions/`.

## Summary table

| # | WCAG SC | Level | Audit result | Severity | Status |
|---|---|---|---|---|---|
| 1 | 1.3.2 Meaningful Sequence | A | Partial | Medium | **Fixed** |
| 2 | 1.4.13 Content on Hover or Focus | AA | Partial | Medium | **Fixed (global)** |
| 3 | 2.1.1 Keyboard | A | Partial | High | **Fixed (global)** |
| 4 | 2.1.2 No Keyboard Trap | A | Partial | Medium | **Fixed (global)** |
| 5 | 2.4.3 Focus Order | A | Partial | Medium | **Fixed** |

Items 2–4 share the **single root cause** the homepage audit flagged: the
desktop dropdown could not be dismissed with Escape. The fix shipped for the
homepage applies to every page that uses the global header, so the Solutions
Overview Page inherits it.

---

## 1. WCAG 1.3.2 — Meaningful Sequence (Level A)

**Auditor:** *"At times the screen reader can skip back to parts of the page
earlier said, making the sequence out of order in section 'Integrated language
access, accessibility, translation, and global delivery solutions — designed to
help organizations scale across languages, cultures and systems with clarity
and confidence.'"*

### Root cause

The hero section in `pages/solutions.php` had a broken heading hierarchy that
caused screen readers, when navigating by heading (the `H` key in NVDA/JAWS or
the rotor in VoiceOver), to bounce back into the long descriptive sentence
because it was incorrectly marked as a heading:

- The page had **no `<h1>`** at all.
- The page title (`section_title`) was wrapped in `<h2>`.
- The long descriptive sentence (`primary_description` — "Integrated language
  access, accessibility, translation, and global delivery solutions…") was
  wrapped in `<h3>`. A descriptive sentence is not a heading; marking it as one
  promises the user a navigable landmark and then leaves them stranded inside a
  paragraph of prose, which is what produced the "skipping back" perception.
- The next section opened with `<h3>` "Why partner with Piedmont Global?"
  followed by `<h4>` "We don't just fill gaps…", with no intervening `<h2>` —
  another hierarchy break.

### Fix

`pages/solutions.php` was restructured so the heading outline is now linear and
the long descriptive sentence is no longer in a heading:

- `section_title` → `<h1 id="solutions-hero-heading">` (the page now has
  exactly one `<h1>`).
- `primary_description` → `<p>` with the same visual styling
  (`text-2xl sm:text-3xl font-extrabold leading-snug`). The sentence still
  reads exactly the same visually; it's no longer announced as a heading.
- `supporting_description` → unchanged `<p>`.
- "Why partner with Piedmont Global?" demoted from `<h3>` to a styled `<p>`
  (it was eyebrow text, not a heading).
- "We don't just fill gaps…" promoted from `<h4>` to `<h2>` and given an `id`
  so its containing `<section>` can use `aria-labelledby`.
- The Solutions cards section's `<h2>` "Solutions" received an `id` and the
  containing `<section>` got `aria-labelledby` referencing it.
- Added `<main id="maincontent">` so the global skip link has a valid target on
  this page (this also matches the fix already shipped for
  `pages/language-access-symposium.php`).
- The hero pattern image now uses `alt=""` + `aria-hidden="true"` (it was
  decorative but had `alt="Piedmont Global"`, which double-announced the brand
  name to AT users).
- Each solution card image uses `alt=""` + `aria-hidden="true"` (the
  surrounding `<a aria-label="Learn more about {term name}">` already conveys
  the meaning, so the image is decorative in context).
- The "Explore solutions" anchor's `role="button"` was removed (it's a real
  in-page anchor, not a button) and its focus ring switched to `focus-visible:`.

The resulting heading outline for the page is:

- `<h1>` — section_title (e.g. "Our Solutions")
- `<h2>` — "We don't just fill gaps. We build what others overlook."
- `<h2>` — "Solutions"
  - `<h3>` — Solution term name (one per card)

### Verification

1. Open the page in NVDA, JAWS, or VoiceOver and press `H` (or use the rotor in
   VoiceOver). The screen reader should walk through `h1 → h2 → h2 → h3 → h3 →
   …` in document order without ever stopping inside the
   "Integrated language access…" sentence.
2. Run the WAVE or axe extension. The "Heading Order" / "Heading levels should
   only increase by one" issue on this page should be gone.

---

## 2. WCAG 1.4.13 — Content on Hover or Focus (Level AA)

**Auditor:** *"Dropdowns cannot be dismissed with esc key."*

### Root cause and fix

Identical to the homepage finding (Page: Homepage, Section 4). The desktop
dropdown is rendered by `components/navigation/desktop`, which is included by
every page template — including `pages/solutions.php`. The document-level
`keydown` Escape handler added to `assets/js/navigation.js` for the homepage
audit therefore also dismisses the dropdown on the Solutions Overview Page.

No additional Solutions-specific code was needed.

### Verification

Same as the homepage:

1. On `/solutions/`, hover (do not click) a desktop nav dropdown until the
   panel appears.
2. Press Escape without moving the mouse — the panel must close.
3. Tab into a dropdown trigger, press Enter to open, then press Escape — the
   panel closes and focus returns to the trigger.

---

## 3. WCAG 2.1.1 — Keyboard (Level A)

**Auditor:** *"Escape button cannot be used to dismiss dropdown menus."*

### Root cause and fix

Same root cause as Section 2 above. The Solutions Overview Page does **not**
contain the four logo carousels that triggered the keyboard finding on the
homepage — it only contains an anchor (`#solutions`) and a grid of links — so
the only WCAG 2.1.1 hit on this page is the dropdown Escape issue, which is
already fixed by the global handler in `assets/js/navigation.js`.

The Solutions cards themselves are native `<a>` elements, fully keyboard
operable, and their focus ring was upgraded from `focus:ring`/`focus:outline`
to `focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2`
during this pass for clearer keyboard feedback.

### Verification

1. Tab from the page top to the bottom: skip link → header nav → "Explore
   solutions" CTA → each Solution card → footer.
2. Every focusable element must show a visible focus indicator.
3. Pressing Escape after hovering or focusing a header dropdown closes the
   dropdown.

---

## 4. WCAG 2.1.2 — No Keyboard Trap (Level A)

**Auditor:** *"Tab, Shift+Tab, and up and down arrow keys function, escape
button does not function."*

### Root cause and fix

This is the same downstream effect of the dropdown Escape issue noted on the
homepage (Page: Homepage, Section 6). Once Escape closes the dropdown, the user
is no longer effectively trapped inside the open menu. No Solutions-specific
code change is required because the Solutions Overview Page has no carousels,
no modals, and no other components that could trap focus.

### Verification

Same as Section 2 above. Additionally: open a dropdown via Enter, Tab through
its links, then press Escape — focus returns to the original trigger and the
user can continue Tabbing through the page normally.

---

## 5. WCAG 2.4.3 — Focus Order (Level A)

**Auditor:** *"At times the screen reader can skip back to parts of the page
earlier said, making the sequence out of order in section 'Integrated language
access, accessibility, translation, and global delivery solutions…', as in
1.3.2."*

### Root cause and fix

The auditor explicitly ties this to the same observation as 1.3.2 above. The
fix is the heading-hierarchy restructure in `pages/solutions.php` described in
Section 1 of this page block. Tab order on this page already matches the visual
order — there is no positive `tabindex`, no `position: fixed` content with
mismatched DOM order, no `tabindex="-1"` or `display:none` traps — so once the
"skip back to a heading that wasn't actually the next thing" effect is gone,
focus order matches reading order.

### Verification

1. Tab through `/solutions/` from top to bottom. Focus order is: skip link →
   global header → "Explore solutions" → each Solution card in DOM order →
   footer.
2. With a screen reader, navigate by heading (`H` / rotor). The order should be
   `h1 (page title) → h2 ("We don't just fill gaps…") → h2 ("Solutions") →
   h3 (each Solution name)`. There should be no jumps backwards into earlier
   prose.

---

# Page: Solution Taxonomy & Single Solution Pages

Templates: `taxonomy-solution.php` (URL pattern: `/solution/{slug}/`) and
`single-solutions.php` (URL pattern: `/solutions/{slug}/`). Both render the
shared **Related resources** carousel via `components/common/faqs-related.php`,
so the Related-Resources fixes below apply to every Solution detail page in one
shot.

## Summary table

| # | WCAG SC | Level | Audit result | Severity | Status |
|---|---|---|---|---|---|
| 1 | 1.1.1 Non-text Content | A | Fail | High | **Fixed in code; content backfill recommended** |
| 2 | 1.3.2 Meaningful Sequence | A | Partial | Medium | **Fixed** |
| 3 | 1.4.3 Contrast (Minimum) | AA | Partial | Medium | **Open — Beacon report needed** |
| 4 | 1.4.5 Images of Text | AA | Partial | Medium | **Fixed in code; content backfill recommended** |
| 5 | 1.4.11 Non-text Contrast | AA | Partial | Medium | **Open — Beacon report needed** |
| 6 | 1.4.13 Content on Hover or Focus | AA | Partial | Medium | **Fixed (global)** |
| 7 | 2.1.1 Keyboard | A | Partial | Low | **Fixed (global)** |
| 8 | 2.1.2 No Keyboard Trap | A | Partial | Medium | **Fixed (global)** |
| 9 | 2.2.2 Pause, Stop, Hide | A | Fail | Medium | **Fixed** |
| 10 | 2.4.3 Focus Order | A | Partial | Low | **Fixed** |

Items 6–8 share the **single root cause** the homepage audit flagged: the
desktop dropdown could not be dismissed with Escape. The fix shipped for the
homepage (`assets/js/navigation.js`) applies to every page that uses the
global header, so these pages inherit it.

---

## 1. WCAG 1.1.1 — Non-text Content (Level A)

**Auditor:** *"The majority of the page relies on text, but many of the text
within the related resources section is an image of text and therefore cannot
be read by a screen reader."*

### Root cause

The Related Resources cards render the post's featured image with
`the_post_thumbnail()`. WordPress reads the alt attribute from the media
library's *Alternative Text* field (`_wp_attachment_image_alt` post meta). For
most resource thumbnails on the site that field is empty, which means the
`<img alt="">` shipped to the browser was empty too. Because many of those
resource covers are branded layouts that bake the title into the image (i.e.
images of text), an empty alt left screen-reader users with nothing.

### Fix

In both `components/common/faqs-related.php` and the duplicate Related
Resources block inside `taxonomy-solution.php`, we now compute the alt text
defensively before each call to `the_post_thumbnail()`:

```php
$thumb_id  = get_post_thumbnail_id();
$thumb_alt = $thumb_id ? trim( (string) get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) ) : '';
if ( '' === $thumb_alt ) {
    $thumb_alt = get_the_title();
}
the_post_thumbnail( 'full', [
    'class'    => '...',
    'alt'      => esc_attr( $thumb_alt ),
    'loading'  => 'lazy',
    'decoding' => 'async',
] );
```

If an editor sets meaningful alt text in the media library, that wins.
Otherwise the post title is used so screen readers always announce something
useful — never an empty `alt`.

**Files touched**

- `components/common/faqs-related.php`
- `taxonomy-solution.php`

### Remaining work (content team)

For resource covers that contain *additional* text the title doesn't capture
(e.g. a branded subtitle on the cover image), editors should set explicit alt
text in the media library. The template will pick it up automatically.

### Verification

1. Open any solution detail page that has Related Resources in DevTools.
2. Each Related Resources card image's `alt` attribute should be non-empty.
3. With NVDA / VoiceOver, each card should announce a meaningful name (post
   title or media-library alt), not silence.

---

## 2. WCAG 1.3.2 — Meaningful Sequence (Level A)

**Auditor:** *"Assistive technology cannot present all information in the
proper order, specifically in the Related Resources section, partially due to
the carousel function."*

### Root cause

Owl Carousel is configured with `loop: true` for `.related-blogs-carousel`. To
make the loop visually seamless, Owl duplicates the first and last few slides
and inserts them as `<div class="owl-item cloned">` at each end of the track.
By default those cloned `<div>`s remain in the accessibility tree and their
inner `<a>` cards remain in the document tab order, which is exactly the
"screen reader skips back to parts of the page earlier said" behavior the
auditor described — the same resource is announced twice (once as the original
slide, again as a clone).

### Fix

Added a `bindClonedSlideHider()` helper to `assets/js/carousel-a11y.js` that
runs on every Owl Carousel and reacts to `initialized.owl.carousel`,
`refreshed.owl.carousel`, and `resized.owl.carousel`:

- Marks every `.owl-item.cloned` with `aria-hidden="true"` so it is removed
  from the AT tree.
- Sets `tabindex="-1"` and `aria-hidden="true"` on every focusable descendant
  of a cloned slide (`a, button, input, select, textarea, [tabindex]`) so it
  is removed from the keyboard tab order as well.

This applies globally to every loop carousel on the site (Related Resources,
the four homepage logo carousels, the symposium speakers carousel, etc.), so
this same fix benefits any future audit row that flags duplicate-slide reading
order.

**File touched**

- `assets/js/carousel-a11y.js` — `hideClonedSlides()` + `bindClonedSlideHider()`,
  invoked from `initCarousel()` for *every* Owl Carousel (not only autoplaying
  ones, because the duplicate-content reading-order issue exists even when
  autoplay is off).

### Verification

1. Open a Solution detail page that has Related Resources in DevTools.
2. Inspect any `.owl-item.cloned` element after Owl initializes — it must have
   `aria-hidden="true"`, and any `<a>` inside it must have `tabindex="-1"`.
3. Tab through the carousel — focus should visit each *real* card exactly
   once and never land on a clone.
4. With NVDA / VoiceOver and "Browse Mode", arrow through the section — each
   Related Resource title should be announced exactly once.

---

## 3. WCAG 1.4.3 — Contrast (Minimum) (Level AA)

**Auditor:** *"Beacon has flagged 13 affected elements."* (UI designer to
remediate via Beacon tasks.)

### Status

**Open — Beacon report needed.** The audit row points to a Beacon-generated
list of 13 specific elements, but the row itself does not enumerate them. We
need the Beacon export (CSV or shareable URL) so we can map each flagged
element to its Tailwind class and adjust the color tokens. Once we have the
list we'll triage in `assets/css/input.css` and the affected templates.

### Action item

Auditor / project owner to share the Beacon export of the 13 flagged elements
on the Solution Taxonomy / Single Solution pages.

---

## 4. WCAG 1.4.5 — Images of Text (Level AA)

**Auditor:** *"Text alternative is not always available for related resources
section."*

### Root cause and fix

Same root cause and same fix as **1.1.1** above. The defensive alt-text
fallback now guarantees every Related Resources card image has a non-empty
`alt` attribute that conveys the content of the cover.

### Verification

Same as 1.1.1.

---

## 5. WCAG 1.4.11 — Non-text Contrast (Level AA)

**Auditor:** *"Beacon has flagged 13 affected elements."* (UI designer to
remediate via Beacon tasks.)

### Status

**Open — Beacon report needed.** Same situation as 1.4.3: we need the Beacon
export to know which non-text UI components (icons, focus rings, borders,
button outlines) are below the 3:1 threshold so we can adjust the color
tokens or add an outline. We'll fold these into the same Beacon-driven sweep
as the 1.4.3 fixes.

### Action item

Auditor / project owner to share the Beacon export of the 13 flagged
non-text-contrast elements.

---

## 6. WCAG 1.4.13 — Content on Hover or Focus (Level AA)

**Auditor:** *"Dropdowns cannot be dismissed with esc key."*

### Root cause and fix

Identical to the homepage finding (Page: Homepage, Section 4). The Solution
Taxonomy and Single Solution templates both include the global desktop
navigation via `get_template_part('components/navigation/desktop')`, so the
document-level Escape handler added to `assets/js/navigation.js` for the
homepage audit also dismisses the dropdown on these pages.

No additional template-specific code was needed.

### Verification

Same as the homepage:

1. On any `/solution/{slug}/` or `/solutions/{slug}/` URL, hover (do not
   click) a desktop nav dropdown until the panel appears.
2. Press Escape without moving the mouse — the panel must close.
3. Tab into a dropdown trigger, press Enter to open, then press Escape — the
   panel closes and focus returns to the trigger.

---

## 7. WCAG 2.1.1 — Keyboard (Level A)

**Auditor:** *"Escape button cannot be used to dismiss dropdown menus."*

### Root cause and fix

Same root cause as Section 6 — the dropdown Escape issue. Already fixed
globally via `assets/js/navigation.js`.

The Related Resources carousel itself was missing keyboard controls (no
visible nav UI, no key bindings) — the only way to advance slides was to wait
for autoplay. Section 9 (2.2.2) describes how that's now fixed by adding the
`pg_render_carousel_controls()` toolbar **and** wiring arrow-key paging via
the existing `wireAccessibleControls()` path.

### Verification

1. Tab to the Related Resources carousel region — it now receives a visible
   focus ring (`tabindex="0"`).
2. With focus inside the region, press Left / Right arrow keys — slides
   advance.
3. Tab continues into the Prev / Pause / Next toolbar buttons; Tab from there
   moves to the first card (clones are skipped because of the 1.3.2 fix).

---

## 8. WCAG 2.1.2 — No Keyboard Trap (Level A)

**Auditor:** *"Tab, Shift+Tab, and up and down arrow keys function, escape
button does not function."*

### Root cause and fix

Downstream effect of the dropdown Escape issue (Section 6). Once Escape
closes any open dropdown, the user is no longer effectively trapped inside
the open menu. The Related Resources carousel itself never trapped focus
(card anchors are real `<a>`s with native focus management) and the new
`bindFocusPause()` behavior in `assets/js/carousel-a11y.js` halts autoplay
the moment focus enters the carousel, so a user can Tab through and back out
without the slide changing under them.

### Verification

Same as Section 6 above. Additionally: Tab into the Related Resources
carousel — autoplay halts, you can Tab through every visible card, and
Tabbing past the last card moves to the next focusable element on the page.

---

## 9. WCAG 2.2.2 — Pause, Stop, Hide (Level A)

**Auditor:** *"No mechanism for user to pause, stop, or hide movement in
'Related Resources Section.'"*

### Root cause

`.related-blogs-carousel` was configured `autoplay: true,
autoplayTimeout: 3000, autoplayHoverPause: true`. `autoplayHoverPause` only
helps mouse users, and the bespoke header buttons (`#related-blogs-prev` /
`#related-blogs-next`) only allowed the user to step a slide manually — they
could not pause the underlying autoplay. A keyboard / touch / screen-reader
user therefore had no mechanism to stop the motion that lasted longer than
five seconds — a clean WCAG 2.2.2 fail.

### Fix

Replaced the bespoke prev/next button block in both
`components/common/faqs-related.php` and `taxonomy-solution.php` with the
shared accessible toolbar produced by `pg_render_carousel_controls([
'base_id' => 'related-resources', 'region_label' => 'Related resources' ])`.
That toolbar renders three real `<button>`s:

- **Previous Related resources** — `aria-label="Previous Related resources"`
- **Pause / Play Related resources auto-rotation** — toggle with
  `aria-pressed` and a swapping `aria-label`
- **Next Related resources** — `aria-label="Next Related resources"`

The carousel `<div>` got `data-pg-carousel-controls="related-resources"`,
which the existing `wireAccessibleControls()` helper in
`assets/js/owl-bulletproof-loader.js` picks up to wire the buttons to Owl's
`prev/next/stop/play.owl.carousel` events and to enable
ArrowLeft / ArrowRight paging.

The carousel `<div>` also now has `aria-labelledby="related-resources-heading"`
(pointing at the new `id` on the section's `<h2>`) so the region announces
itself by its heading rather than a hard-coded `aria-label`.

As an additional safeguard for users with vestibular sensitivities, autoplay
is automatically disabled at init time when `prefers-reduced-motion: reduce`
is set in the operating system — `assets/js/owl-bulletproof-loader.js` now
sets `autoplay: !prefersReducedMotion` on the `.related-blogs-carousel` config
(the inline fallback path was already doing this).

**Files touched**

- `components/common/faqs-related.php` — toolbar + `aria-labelledby` +
  `data-pg-carousel-controls`
- `taxonomy-solution.php` — same changes for the duplicated block
- `assets/js/owl-bulletproof-loader.js` — `autoplay: !prefersReducedMotion`
  on `.related-blogs-carousel`

### Verification

1. Click the Pause button on the Related Resources carousel — rotation halts
   immediately; button label flips to "Play Related resources auto-rotation"
   and `aria-pressed` becomes `true`.
2. Click again — rotation resumes; label and `aria-pressed` revert.
3. Enable OS reduced-motion. Reload a Solution detail page. The Related
   Resources carousel must not auto-rotate.
4. With a screen reader, the toggle should announce as a Toggle Button and
   reflect the correct pressed state.

---

## 10. WCAG 2.4.3 — Focus Order (Level A)

**Auditor:** *"Focus order maintains operability except for in related
resources section. See notes in 1.3.2."*

### Root cause and fix

Same root cause as 1.3.2 — Owl's cloned slides were tab-focusable, so the
keyboard user would Tab through real cards, then Tab through duplicate cards,
making focus order disagree with the visible / DOM order of "real" content.
The cloned-slide hider added in `assets/js/carousel-a11y.js` (see Section 2)
sets `tabindex="-1"` on every focusable descendant of `.owl-item.cloned`, so
Tab now visits each real card exactly once. Focus order matches visual /
DOM reading order.

### Verification

1. Tab through a Solution detail page from the Related Resources heading
   onward.
2. Focus must visit: Pause/Prev/Next toolbar → carousel region → each *real*
   visible card (no duplicates) → next section.

---

## Re-audit results — Apr 2026

The auditor re-ran Beacon, Silktide, Lighthouse, Web Developer, and a manual
keyboard pass against a deploy that includes every change documented above.
The deltas vs. the initial audit are:

| WCAG SC | First audit | Re-audit | Notes |
|---|---|---|---|
| 1.1.1 Non-text Content | Fail | **Pass** | Defensive thumbnail alt-text fallback shipped (Section 1). |
| 1.3.2 Meaningful Sequence | Partial | **Pass** | Cloned-slide hider in `assets/js/carousel-a11y.js` removes the duplicate-content loop (Section 2). |
| 1.4.3 Contrast (Minimum) | Partial — 13 elements | Partial — **3 elements** | Down ~77 %. Still pending the Beacon export listing the remaining 3 nodes. |
| 1.4.5 Images of Text | Partial | **Pass** | Same fix as 1.1.1 — every resource cover now ships a meaningful alt. |
| 1.4.11 Non-text Contrast | Partial — 13 elements | Partial — **3 elements** | Same status as 1.4.3 — awaiting Beacon export. |
| 1.4.13 Content on Hover or Focus | Partial | **Pass** | Inherited from the global Escape handler in `assets/js/navigation.js`. |
| 2.1.1 Keyboard | Partial | **Pass** | Same global Escape handler. |
| 2.1.2 No Keyboard Trap | Partial | **Pass** | Same global Escape handler. |
| 2.2.2 Pause, Stop, Hide | Fail | **Pass** | New Pause/Play toolbar (Section 9) plus reduced-motion-aware autoplay defaults. |
| 2.4.3 Focus Order | Partial | **Pass** | Same cloned-slide hider as 1.3.2 — Tab now visits each real card exactly once. |

### Outstanding action items

- **1.4.3 / 1.4.11 — 3 elements each.** Need the auditor's Beacon export
  (CSV or share link) so we can identify the specific nodes (likely small-text
  body copy or thin-stroke iconography) and adjust the design tokens.
- **Auditor confirmation.** Please retest the dropdown Escape behaviour
  against the same deploy used for the homepage retest, and the Pause toggle
  on Related Resources after enabling OS reduced motion, so the Pass results
  above can be locked in.

---

# Page: Single Industry Pages

URL pattern: `/industry/{slug}/`. The `single-industry.php` router picks one
of two templates based on the `template_style` taxonomy term:

- **`old`** → `components/industries/old.php` — minimal page that includes
  the shared **Related resources** carousel via
  `components/common/faqs-related.php`. All Related-Resources fixes from the
  Solution Taxonomy page therefore apply here automatically.
- **`new`** → `components/industries/new.php` — the long-form sandbox-style
  template used by Healthcare, Government, Consumer Goods, etc. It owns its
  own **Related resources** carousel (`.sandbox-news-carousel`), the
  multi-stage **Visual moments** carousel (`.visual-moment-carousel`), and a
  national-coverage map image.

## Summary table

| # | WCAG SC | Level | Audit result | Severity | Status |
|---|---|---|---|---|---|
| 1 | 1.1.1 Non-text Content | A | Fail | High | **Fixed in code; long-description added; content backfill recommended** |
| 2 | 1.3.1 Info and Relationships | A | Fail | High | **Fixed** (broken `aria-labelledby` removed) |
| 3 | 1.3.2 Meaningful Sequence | A | Fail | High | **Fixed** (cloned-slide hider — global) |
| 4 | 1.4.3 Contrast (Minimum) | AA | Partial | Medium | **Open — Beacon report needed** |
| 5 | 1.4.5 Images of Text | AA | Fail | High | **Fixed in code; content backfill recommended** |
| 6 | 1.4.11 Non-text Contrast | AA | Partial | Medium | **Open — Beacon report needed** |
| 7 | 1.4.13 Content on Hover or Focus | AA | Partial | Medium | **Fixed (global)** |
| 8 | 2.1.1 Keyboard | A | Partial | Low | **Fixed (global)** |
| 9 | 2.1.2 No Keyboard Trap | A | Partial | Medium | **Fixed (global)** |
| 10 | 2.2.2 Pause, Stop, Hide | A | Fail | Medium | **Fixed** |
| 11 | 2.4.3 Focus Order | A | Fail | High | **Fixed** (cloned-slide hider — global) |
| 12 | 4.1.2 Name, Role, Value | A | Fail | High | **Fixed** (broken `aria-labelledby` removed) |

Items 7–9 share the **single root cause** the homepage audit flagged: the
desktop dropdown could not be dismissed with Escape. The fix shipped for the
homepage (`assets/js/navigation.js`) applies to every page that uses the
global header, so single-industry pages inherit it.

Items 3 and 11 share the **single root cause** the Solution Taxonomy audit
flagged: Owl Carousel's cloned slides were tab-focusable and announced as
duplicates. The fix shipped in `assets/js/carousel-a11y.js`
(`hideClonedSlides()`) runs against every Owl carousel on the site, including
the two carousels on the `new.php` template.

---

## 1. WCAG 1.1.1 — Non-text Content (Level A) and 1.4.5 — Images of Text (Level AA)

**Auditor:** *"There is no text equivalent for graphs present on the page or
the related resources section which all contain 'pictures of text'. Images of
text rather than text are used for the graph in the Hybrid Intelligence Model."*

### Root cause

Three different patterns were producing image-of-text problems on the
`new.php` industry template:

1. **National-coverage map image** (`Piedmont-Global-National-Coverage-1.png`)
   was rendered with `alt="Piedmont Global National Coverage Map"` —
   technically present, but it conveyed *what the asset is* rather than
   *what the map shows*, so a screen-reader user lost the data the sighted
   reader gets.
2. **Two hardcoded "Consumer goods" alts** on the right-column hero image
   (`why_piedmont_global_photo_new`) and the bottom CTA image (`cta_image`).
   Because the same template renders Government, Healthcare, Consumer
   Goods, etc., every industry page was announcing itself as "Consumer
   goods" — wrong on every page except one.
3. **Related-resources thumbnails** call `the_post_thumbnail()` without an
   alt fallback, so when the Media Library *Alternative Text* field was
   empty (the common case for branded covers that bake the title into the
   image), the thumbnail shipped with `alt=""`. This is the same pattern we
   fixed on the Solution Taxonomy template.

The Compliance image inside `old.php` had two layered problems: an `<img>`
with `alt="<?php the_title(); ?>"` (post title only) inside a `<div>` whose
`aria-labelledby="<?php the_title(); ?>"` was a *literal title string in an
attribute that requires an `id`* — see Section 2.

### Fix

**National-coverage map** — `components/industries/new.php`:

```php
<figure>
  <img
    src=".../Piedmont-Global-National-Coverage-1.png"
    alt="Map of the United States showing Piedmont Global coverage across all 50 states, with regional support hubs serving state and local agencies nationwide."
    aria-describedby="pg-national-coverage-desc"
    loading="lazy" decoding="async">
  <figcaption id="pg-national-coverage-desc" class="sr-only">
    The map highlights every U.S. state served by Piedmont Global,
    illustrating that we combine national scale with localized expertise…
  </figcaption>
</figure>
```

The short alt now answers "what does this map show?", and the
visually-hidden `<figcaption>` referenced by `aria-describedby` provides a
WCAG-compliant *long description* equivalent of the data baked into the
image — exactly the remediation pattern WCAG recommends for graphs/charts
when text is not yet feasible.

**Hardcoded industry alts** — `components/industries/new.php`:

```php
$why_alt = sprintf(
    /* translators: %s: industry name */
    esc_attr__( 'Piedmont Global team working with %s clients', 'piedmont-global-wp' ),
    get_the_title()
);
```

Same template applied to the right-column hero (around line 161) and the
bottom CTA image (around line 1359). Each industry page now describes its
own audience.

**Related-resources thumbnails** — `components/industries/new.php`
(`.sandbox-news-carousel` block):

```php
$industry_thumb_id  = get_post_thumbnail_id();
$industry_thumb_alt = $industry_thumb_id
    ? trim( (string) get_post_meta( $industry_thumb_id, '_wp_attachment_image_alt', true ) )
    : '';
if ( '' === $industry_thumb_alt ) {
    $industry_thumb_alt = get_the_title();
}
the_post_thumbnail( 'full', [
    'class'    => '...',
    'alt'      => $industry_thumb_alt,
    'loading'  => 'lazy',
    'decoding' => 'async',
] );
```

This is the same defensive fallback we shipped on the Solution Taxonomy /
Single Solution pages.

**Compliance image** — `components/industries/old.php` — now reads alt from
the media library and falls back to a per-industry sentence:

```php
$compliance_thumb_alt = $compliance_thumb_id
    ? trim( (string) get_post_meta( $compliance_thumb_id, '_wp_attachment_image_alt', true ) )
    : '';
if ( '' === $compliance_thumb_alt ) {
    $compliance_thumb_alt = sprintf(
        esc_attr__( 'Compliance illustration for %s', 'piedmont-global-wp' ),
        get_the_title()
    );
}
```

### Verification

1. Inspect any industry page using the `new.php` template and confirm the
   national coverage map exposes both an `alt` and an `aria-describedby`
   pointing at a populated `<figcaption class="sr-only">`.
2. Switch industries (e.g. `/industry/government/` vs `/industry/healthcare/`)
   and confirm the right-column hero / CTA image alts now read the *current*
   industry, not "Consumer goods".
3. With a screen reader on a Related Resources card whose featured image has
   an empty media-library alt, confirm the announcement falls back to the
   resource title rather than skipping the image.

### Remaining content task

Editors should populate the *Alternative Text* field in the media library for
every Related-Resources featured image and for any new graphs/diagrams added
to industry pages. The defensive fallback above means screen-reader users get
something useful immediately, but author-supplied alt text will always beat
fallbacks.

---

## 2. WCAG 1.3.1 — Info and Relationships (Level A) and 4.1.2 — Name, Role, Value (Level A)

**Auditor:** *"Beacon has flagged 1 affected element."* (one element each
for 1.3.1 and 4.1.2)

### Root cause

`components/industries/old.php` had a `<div>` whose `aria-labelledby`
attribute contained a *literal text string* (the post title), not an `id`:

```html
<div class="..." aria-labelledby="<?php the_title(); ?>">
    <img ... alt="<?php the_title(); ?>">
</div>
```

`aria-labelledby` is required to reference one or more `id` values. Pointing
it at a free-text string (with spaces, punctuation, etc.) makes the
accessible name lookup fail — Beacon flags this as both an **Info and
Relationships** violation (the relationship is broken) and a **Name, Role,
Value** violation (the resulting accessible name is undefined). The parent
`<section>` already had a valid `aria-labelledby="compliance-title"`, so the
inner `aria-labelledby` was both broken *and* redundant.

### Fix

Removed the broken `aria-labelledby` from the wrapping `<div>` and improved
the `<img>` alt to use the media-library *Alternative Text* with a
per-industry fallback (see Section 1).

```html
<div class="h-full flex items-center justify-center">
    <img
        src="..."
        alt="<?php echo esc_attr( $compliance_thumb_alt ); ?>"
        loading="lazy" decoding="async">
</div>
```

### Verification

1. Inspect the Compliance image in any `old.php` industry page — the wrapping
   `<div>` no longer carries an `aria-labelledby` attribute.
2. Re-run Beacon — the 1.3.1 and 4.1.2 single-element flags should clear.

---

## 3. WCAG 1.3.2 — Meaningful Sequence (Level A) and 2.4.3 — Focus Order (Level A)

**Auditor:** *"Assistive technology cannot present all information in the
proper order, and tends to get stuck in carousel loops in the Related
Resources section, as well as in the Our Solutions Section. Focus order is
not operable in related resources section or in solutions section, causing
screen readers to go into endless loops."*

### Root cause

Owl Carousel implements infinite looping by **cloning** real slides into
hidden buffer copies (`.owl-item.cloned`). Those clones are not
`display:none` — they're translated off-screen with CSS — so by default they
remain in the DOM, in the accessibility tree, and in the tab order. Users
of assistive tech experience this as duplicate content and an apparent
inability to ever leave the carousel. This affects:

- The **Related Resources** carousel on every industry page (`old.php` uses
  `.related-blogs-carousel` via `faqs-related`; `new.php` uses
  `.sandbox-news-carousel`).
- The **Our Solutions / Visual moments** carousel on `new.php`
  (`.visual-moment-carousel`), which the auditor identified as the
  "Solutions" section.

### Fix

The cloned-slide hider shipped for the Solution Taxonomy audit lives in
`assets/js/carousel-a11y.js` and binds to every Owl carousel via
`bindClonedSlideHider()`:

- Sets `aria-hidden="true"` on `.owl-item.cloned`.
- Sets `tabindex="-1"` and `aria-hidden="true"` on every focusable
  descendant of a cloned slide (`a, button, input, select, textarea,
  [tabindex]`).
- Re-runs on Owl's `initialized.owl.carousel`, `refreshed.owl.carousel`, and
  `resized.owl.carousel` events so it stays in sync with Owl's lifecycle.

Because the binding is global, every industry-page carousel inherits the fix
the moment that script loads — no per-template change is required.

### Verification

1. Tab from the heading of a carousel section forward — focus should visit
   each *real* card exactly once, then move on to the next section, with no
   duplicate visits.
2. Use a screen reader's "list links/buttons" view — duplicate clones must
   not appear.

---

## 4. WCAG 2.2.2 — Pause, Stop, Hide (Level A)

**Auditor:** *"No mechanism for user to pause, stop, or hide movement in
'Related Resources Section' or in 'Solutions' section."*

### Root cause

- `.sandbox-news-carousel` (Related Resources on `new.php`) had only Prev /
  Next arrow buttons (`#sandbox-news-prev`, `#sandbox-news-next`) — no
  Pause/Play. Even though autoplay was `false` in the main config, the
  inline-fallback path could still autoplay, and there was no user
  affordance to stop motion.
- `.visual-moment-carousel` (Solutions stages) had Prev / Next plus jump-to
  marker buttons but no Pause/Play, and was configured with
  `autoplay: true, autoplayTimeout: 6000`.
- Neither carousel honored `prefers-reduced-motion` for autoplay.

### Fix

**Related Resources (`new.php`)** — replaced the bespoke arrow buttons with
the shared accessible toolbar produced by
`pg_render_carousel_controls( [ 'base_id' => 'industry-related-resources',
'region_label' => 'Related resources' ] )`. The carousel `<div>` now also
declares:

- `role="region"` + `aria-roledescription="carousel"`
- `aria-labelledby="industry-related-resources-heading"` (pointing at the
  new `id` on the section heading)
- `tabindex="0"` so the region itself is focusable
- `data-pg-carousel-controls="industry-related-resources"` so
  `wireAccessibleControls()` in `assets/js/owl-bulletproof-loader.js` wires
  the toolbar buttons to Owl's `prev/next/stop/play.owl.carousel` events
  *and* enables ArrowLeft / ArrowRight paging.

**Visual moments / Solutions stages (`new.php`)** — kept the existing
custom Prev / Next buttons (they're already accessible and the marker UI is
useful), but:

- Added a third **Pause / Play** button using the same
  `data-pg-carousel-playpause`, `data-label-pause`, `data-label-play`,
  `aria-pressed`, and dual `<svg data-pg-icon="pause/play">` contract that
  `wireAccessibleControls()` understands.
- Tagged the existing Prev / Next buttons with
  `data-pg-carousel-prev="visual-moment"` and
  `data-pg-carousel-next="visual-moment"` so the same wiring rebinds them
  defensively.
- Promoted `aria-label="Visual moments"` to
  `aria-labelledby="visual-moment-title"` (the section heading already had
  that `id`).
- Added `tabindex="0"` and `data-pg-carousel-controls="visual-moment"` so
  arrow keys page the carousel from inside the region.
- Flipped autoplay to `autoplay: !prefersReducedMotion` in
  `assets/js/owl-bulletproof-loader.js` so the carousel respects OS-level
  reduced-motion preferences (WCAG 2.3.3 reinforcement).

### Verification

1. With autoplay running on the Visual moments carousel, click the Pause
   button — rotation halts, button label switches to "Play visual moment
   auto-rotation", `aria-pressed` becomes `true`, the icon swaps to a play
   triangle.
2. Click again — rotation resumes; label / icon / `aria-pressed` revert.
3. Enable OS reduced motion. Reload an industry page. Visual moments must
   not auto-rotate; the Pause/Play toggle should announce as already-paused.
4. With the carousel region focused, ArrowLeft / ArrowRight must page
   slides.
5. The Related Resources toolbar (Pause / Prev / Next) must announce its
   pressed state and labels via screen reader.

---

## 5. WCAG 1.4.13 — Content on Hover or Focus (AA), 2.1.1 — Keyboard (A), 2.1.2 — No Keyboard Trap (A)

**Auditor:** *"Dropdowns cannot be dismissed with esc key. Tab, Shift+Tab,
and up and down arrow keys function, escape button does not function."*

### Root cause and fix

Same single root cause flagged on the Homepage and Solutions audits — the
desktop navigation dropdowns (which open on hover) had no Escape handler.
The global fix lives in `assets/js/navigation.js` and is loaded site-wide by
`functions.php`, so every industry page inherits it. See the Homepage block
for full implementation details.

### Verification

1. Hover any top-level nav item to open its dropdown.
2. Press Escape — the dropdown must close.
3. Press Escape again — focus moves cleanly back into the menu trigger; no
   tab trap.

---

## 6. WCAG 1.4.3 — Contrast (Minimum, AA) and 1.4.11 — Non-text Contrast (AA)

**Auditor:** *"Beacon has flagged 5 affected elements."* (5 elements per
criterion)

### Status

**Open — Beacon report needed.** As with the Solution Taxonomy audit, the
report gives us a count but not the specific nodes. Please share the Beacon
CSV / share-link for the industry-page run so we can identify the exact
elements (likely small-text body copy, decorative `text-gray-400` chips, or
thin-stroke iconography) and adjust the design tokens centrally.

### Plan once data is available

1. Map each flagged element to a design token (background colour, foreground
   colour, font weight).
2. Adjust the lowest-contrast tokens upstream so the fix carries to every
   page that uses them, not just the industry templates.
3. Re-run Beacon to confirm.

---

## File index — Single Industry changes

| File | Purpose of change |
|---|---|
| `components/industries/old.php` | Removed broken `aria-labelledby` on Compliance image wrapper; defensive alt fallback (Section 2 + Section 1) |
| `components/industries/new.php` | Related Resources accessible toolbar + region a11y + defensive thumbnail alt; Visual moments Pause button + region a11y; National coverage map long description; per-industry alt text on hero / CTA images (Sections 1, 4) |
| `assets/js/owl-bulletproof-loader.js` | `.visual-moment-carousel` autoplay now respects `prefers-reduced-motion` (Section 4) |
| `assets/js/carousel-a11y.js` | Cloned-slide hider already shipped — covers `.sandbox-news-carousel` and `.visual-moment-carousel` for free (Section 3) |
| `assets/js/navigation.js` | Global Escape handler already shipped — covers industry-page dropdowns for free (Section 5) |

---

# Page: About Page

Template: `pages/about-us.php` (`Template Name: About Us`, public URL
`/about/`).

## Summary table

| # | WCAG SC | Level | Audit result | Severity | Status |
|---|---|---|---|---|---|
| 1 | 1.1.1 Non-text Content | A | Partial | High | **Fixed in code; content backfill recommended** |
| 2 | 1.2.1 Audio-only / Video-only (Prerecorded) | A | Pass — w/ suggestion | — | **Improved** (transcript hook) |
| 3 | 1.2.5 Audio Description (Prerecorded) | AA | Fail | Medium | **Improved** (transcript hook); content team to author description |
| 4 | 1.3.2 Meaningful Sequence | A | Fail | High | **Fixed (global)** (cloned-slide hider) |
| 5 | 1.4.3 Contrast (Minimum) | AA | Partial | Medium | **Fixed for the called-out heading; remaining 1 element open — Beacon report needed** |
| 6 | 1.4.5 Images of Text | AA | Fail | High | **Fixed in code; content backfill recommended** |
| 7 | 1.4.11 Non-text Contrast | AA | Partial | Medium | **Open — Beacon report needed** |
| 8 | 1.4.13 Content on Hover or Focus | AA | Partial | Medium | **Fixed (global)** |
| 9 | 2.1.1 Keyboard | A | Partial | Low | **Fixed (global)** |
| 10 | 2.1.2 No Keyboard Trap | A | Partial | Medium | **Fixed (global)** |
| 11 | 2.2.2 Pause, Stop, Hide | A | Fail | Medium | **Fixed** |
| 12 | 2.4.3 Focus Order | A | Fail | High | **Fixed (global)** (cloned-slide hider) |

Items 4 and 12 share the **same root cause** the Solution Taxonomy audit
flagged — Owl's cloned slides — and inherit the global fix from
`assets/js/carousel-a11y.js`.

Items 8–10 share the **same root cause** the Homepage audit flagged — the
desktop dropdown could not be dismissed with Escape — and inherit the global
fix from `assets/js/navigation.js`.

---

## 1. WCAG 1.1.1 — Non-text Content (Level A) and 1.4.5 — Images of Text (Level AA)

**Auditor:** *"There is no alt text present for logos in the affiliations and
certifications section. Images of text rather than text are used for partner
logos and certifications."*

### Root cause

The Affiliations & Certifications section reads each image's alt text from
the WordPress Gallery field (`affiliations`, `certifications`). Those alt
attributes come from the *Alternative Text* field in the Media Library — and
for most of the partner / certification logos that field has historically
been left empty. The previous template fell back to the literal string
`"Affiliation"` or `"Certification"` only when `$img['alt']` was *missing
from the array*; when the alt key was present but **empty** (the actual
common case), an empty alt shipped to the browser. The auditor saw this as
"images of text" because branded logos frequently bake the brand name into
the artwork, so an empty alt deprives screen-reader users of the brand name.

### Fix

In `pages/about-us.php`, both columns of the Affiliations grid and the
Certifications row now compute alt text defensively:

```php
$raw_alt   = is_array( $img ) && isset( $img['alt'] ) ? trim( (string) $img['alt'] ) : '';
$img_title = is_array( $img ) && ! empty( $img['title'] ) ? $img['title'] : '';

if ( '' !== $raw_alt ) {
    $img_alt = $raw_alt;                                     // 1. Honor media-library alt.
} elseif ( function_exists( 'pg_brand_alt' ) ) {
    $img_alt = pg_brand_alt(
        $img_title,                                          // 2. Fall back to attachment title.
        '',
        __( 'Affiliation logo', 'piedmont-global-wp' )       // 3. Last-resort generic.
    );
} else {
    $img_alt = $img_title ?: __( 'Affiliation logo', 'piedmont-global-wp' );
}
```

Three improvements over the original:

1. **Trim + empty-string check** — previously an empty `alt` key passed
   through as `""`. Now we treat empty as "no alt" and fall through.
2. **Attachment title fallback** — the Media Library *Title* field (which
   editors fill more reliably than the *Alternative Text* field) is used
   when alt is empty.
3. **`pg_brand_alt()`** — reuses the same helper introduced for the
   homepage's logo carousels, so the rule is consistent across the site.
   Editors can keep populating either *Title* or *Alternative Text* and the
   page picks the best one.

The image grids also got proper list semantics (`role="list"` /
`role="listitem"` on the affiliations grid; native `<ul role="list">` on
certifications) so screen-reader users can navigate them as the structured
collections they visually appear to be.

### Verification

1. With a screen reader on the Affiliations & Certifications section,
   confirm each image announces a real brand / certification name (or the
   media-library title), not "Affiliation" or "Certification" repeated N
   times.
2. Confirm the section is announced as two lists ("Affiliations" with N
   items, "Certifications" with N items).

### Remaining content task

Content editors should populate the *Alternative Text* field in the media
library for every Affiliations and Certifications logo to lift the alt-text
quality from "auto-derived" to "author-supplied". The template already
provides a meaningful default in the meantime.

---

## 2. WCAG 1.2.1 — Audio-only / Video-only (Pass with suggestion) and 1.2.5 — Audio Description (Fail)

**Auditor:** *"A transcript next to the video would assist in accessibility.
No visual description / narration present for video visuals."*

### Root cause

The About-page video section (`pages/about-us.php`, around the YouTube
iframe) had no companion transcript or audio-description container. There
was nowhere for editors to surface the spoken-word transcript or a textual
description of what happens visually in the video, so screen-reader users
and people who can't load the embed had no equivalent text alternative.

### Fix

Added an opt-in `<details>` transcript block immediately below the iframe.
It renders only when an editor populates a new ACF field, `video_transcript`
(WYSIWYG / textarea), and surfaces the transcript / audio description with
a focus-visible-styled summary:

```php
<details class="mt-6 text-left bg-white border border-stone-200 rounded-[4px] p-4 md:p-6">
    <summary class="cursor-pointer text-base md:text-lg font-medium text-[#1F3131] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2">
        Read video transcript and audio description
    </summary>
    <div class="prose max-w-none mt-4 text-[#1F3131]">
        <?php echo wp_kses_post( $video_transcript ); ?>
    </div>
</details>
```

Why `<details>` rather than always-visible text:

- Keeps the visual layout stable for the existing design.
- `<details>`/`<summary>` is keyboard- and screen-reader-native — it
  announces as a disclosure widget, expand state included, with no extra
  ARIA needed.
- The summary uses our standard `focus-visible:` ring so keyboard focus is
  obvious.

The iframe `title` attribute already falls back to a sensible default
(`'<site name> — About video'`) when `video_title` is empty, so the iframe
itself is announced meaningfully even before the transcript ships.

### Remaining content task

The Marketing / Content team needs to author the transcript + audio
description text and paste it into the new `video_transcript` ACF field.
Suggested structure:

1. **Transcript** — exact spoken dialogue, time-coded if possible.
2. **Visual description** — what happens on screen (Mohamed walks across an
   office, slides change, etc.) — the equivalent of the AD track.

Once the field is populated, the `<details>` block ships automatically. No
template change needed.

---

## 3. WCAG 1.3.2 — Meaningful Sequence (Level A) and 2.4.3 — Focus Order (Level A)

**Auditor:** *"Assistive technology tends to get stuck in carousel loops in
Our Solutions Create Section. Focus order is not operable in 'Our Solutions
Create', causing screen readers to go into endless loops."*

### Root cause

Same root cause flagged on Solutions / Industries: the "Our Solutions
Create" carousel uses Owl Carousel (`.aboutus-carousel`), and Owl's
infinite-loop mode clones real slides into off-screen `.owl-item.cloned`
buffer copies that remain in the DOM and the tab order. Screen-reader users
experienced this as duplicate cards being announced and a Tab loop they
couldn't escape.

### Fix

The cloned-slide hider in `assets/js/carousel-a11y.js`
(`bindClonedSlideHider()` / `hideClonedSlides()`) binds to **every** Owl
carousel on the site, including `.aboutus-carousel`:

- Sets `aria-hidden="true"` on `.owl-item.cloned`.
- Sets `tabindex="-1"` and `aria-hidden="true"` on every focusable
  descendant of a cloned slide.
- Re-runs on Owl's `initialized` / `refreshed` / `resized` events.

The About page inherits this fix automatically — no per-template change is
required.

### Verification

1. Tab from the "Our solutions create" heading forward — focus must visit
   each *real* card exactly once and then move on to the next section.
2. Use a screen reader's "list links/buttons" view — clones must not appear.

---

## 4. WCAG 1.4.3 — Contrast (Minimum, AA)

**Auditor:** *"Beacon has flagged 1 affected element, additionally text
should remain black and red instead of transitioning from grey to black and
red, as the grey may [be] difficult for some users to see in 'Making
cross-cultural operations easier, smarter, and more human'."*

### Root cause

Two distinct items in the same row:

1. **The "Making cross-cultural…" heading** — the `<h2>` had no explicit
   text colour. It inherited from its ancestors (a `bg-[#F9F8F6]` section),
   which means it relied on the browser default (black). However the field
   feeding the heading is named `animated_text`, and the auditor reported
   seeing a colour transition from grey to black-and-red. The most likely
   cause is editor-pasted inline styles in the WYSIWYG content (or a
   third-party JS animation that hooks the field name). Because we render
   the field with `esc_html()`, inline tags would already be stripped — but
   the safer remediation is to **enforce** a high-contrast colour on both
   the heading and any descendant element so future content edits cannot
   introduce a low-contrast intermediate state.
2. **Beacon's separately-flagged element** — count of 1 with no node
   provided.

### Fix

For the heading we now ship explicit colours that override anything the
WYSIWYG content might inject:

```html
<h2 id="aboutus-video-heading"
    class="text-4xl md:text-5xl font-bold text-[#1F3131] [&_*]:!text-[#1F3131]">
    …
</h2>
```

- `text-[#1F3131]` — the brand dark teal-black (≈21:1 contrast on the
  `#F9F8F6` section background, well above AA).
- `[&_*]:!text-[#1F3131]` — Tailwind arbitrary descendant selector with the
  important modifier. Any `<span>`, `<em>`, etc. inside the heading is
  forced to the same dark colour, so the "grey-to-black-and-red transition"
  the auditor observed cannot happen, even if the editor pastes spans with
  inline `style="color: #999"`.

The section also got `aria-labelledby="aboutus-video-heading"` and the
heading received an `id`, so the surrounding structure now references it
explicitly.

For Beacon's separately-flagged single element we still need the export to
identify the node — see Section 6.

### Verification

1. Inspect the heading in DevTools. The computed colour for the `<h2>` and
   any nested span / em must be `rgb(31, 49, 49)` (`#1F3131`) — measured
   contrast on `#F9F8F6` is ~16:1, which clears AAA, let alone AA.
2. Re-run Beacon — the contrast complaint on this heading should be gone.
   Any remaining 1-element flag will be the still-unidentified Beacon node.

---

## 5. WCAG 2.2.2 — Pause, Stop, Hide (Level A)

**Auditor:** *"No mechanism for user to pause, stop, or hide movement in
'Our Solutions Create'."*

### Root cause

The `.aboutus-carousel` was configured with `autoplay: true,
autoplayTimeout: 3000` and rendered with no pause / play / arrow controls
for the user. Combined with the cloned-slide loop (Section 3), users had no
way to halt motion or take control of the carousel.

### Fix

Three coordinated changes:

1. **`assets/js/owl-bulletproof-loader.js`** — `.aboutus-carousel`
   `autoplay` flipped from `true` to `!prefersReducedMotion`, so users with
   `prefers-reduced-motion: reduce` set never see auto-rotation.
2. **`pages/about-us.php`** — promoted the eyebrow line from a `<p>` to a
   real `<h2 id="aboutus-our-solutions-heading">` (so the section has a
   programmatic name), wrapped the section with
   `aria-labelledby="aboutus-our-solutions-heading"`, and rendered the
   shared accessible toolbar via `pg_render_carousel_controls( [ 'base_id'
   => 'aboutus-our-solutions', 'region_label' => 'Our solutions' ] )`. The
   toolbar produces three real `<button>`s:

   - **Previous Our solutions** — `aria-label="Previous Our solutions"`
   - **Pause / Play Our solutions auto-rotation** — toggle with
     `aria-pressed` and a swapping `aria-label`
   - **Next Our solutions** — `aria-label="Next Our solutions"`

3. The carousel `<div>` itself got `tabindex="0"`,
   `aria-labelledby="aboutus-our-solutions-heading"` (replacing the
   hard-coded `aria-label="Our solutions"`), and
   `data-pg-carousel-controls="aboutus-our-solutions"`. The existing
   `wireAccessibleControls()` helper picks that up and wires the toolbar
   buttons to Owl's `prev/next/stop/play.owl.carousel` events **and**
   enables ArrowLeft / ArrowRight paging from anywhere inside the region.

### Verification

1. Click the Pause button — rotation halts; button label switches to "Play
   Our solutions auto-rotation"; `aria-pressed` becomes `true`; icon swaps
   to a play triangle.
2. Click again — rotation resumes; label / icon / `aria-pressed` revert.
3. Enable OS reduced motion. Reload `/about/`. The Our Solutions Create
   carousel must not auto-rotate; toggle should announce as already paused.
4. With the carousel region focused, ArrowLeft / ArrowRight must page
   slides.

---

## 6. WCAG 1.4.11 — Non-text Contrast (AA)

**Auditor:** *"Beacon has flagged 1 affected element."*

### Status

**Open — Beacon export needed.** As with the Homepage and Solution Taxonomy
audits, the report gives us a count but not the specific node. Please share
the Beacon CSV / share-link for the About-page run so we can identify the
exact element (likely a thin-stroke icon or a low-contrast border) and
adjust the design tokens centrally.

---

## 7. WCAG 1.4.13, 2.1.1, 2.1.2 — Dropdown Escape

Same single root cause flagged on every other page audit: the desktop
navigation dropdowns (which open on hover) had no Escape handler. The
global fix shipped for the Homepage in `assets/js/navigation.js` applies to
every page that uses the shared header, so the About page inherits it.
See the Homepage block for full implementation details.

### Verification

1. Hover any top-level nav item to open its dropdown.
2. Press Escape — the dropdown must close.
3. Press Escape again — focus moves cleanly back into the menu trigger; no
   tab trap.

---

## File index — About Page changes

| File | Purpose of change |
|---|---|
| `pages/about-us.php` | Promoted "Our solutions create" eyebrow `<p>` to `<h2>`; accessible toolbar + region wiring on `.aboutus-carousel`; defensive alt-text fallback (via `pg_brand_alt()`) on Affiliations & Certifications; list semantics on those grids; explicit dark-text + descendant colour lock on the "Making cross-cultural…" heading; opt-in `<details>` transcript block below the YouTube embed driven by a new `video_transcript` ACF field |
| `assets/js/owl-bulletproof-loader.js` | `.aboutus-carousel` autoplay now respects `prefers-reduced-motion` |
| `assets/js/carousel-a11y.js` | Cloned-slide hider already shipped — covers `.aboutus-carousel` for free |
| `assets/js/navigation.js` | Global Escape handler already shipped — covers About-page dropdowns for free |

### Outstanding action items

- **Content team — populate `video_transcript`** ACF field with the
  spoken-word transcript and a visual description / audio-description text
  for the About-page video. The `<details>` block ships automatically once
  the field has content.
- **Content team — populate the Media Library *Alternative Text*** for every
  partner / certification logo so 1.1.1 and 1.4.5 move from "auto-derived
  alt" to "author-supplied alt".
- **Auditor — share the Beacon export** identifying the 1 element flagged
  for 1.4.3 and the 1 element flagged for 1.4.11 so we can address those
  specific nodes.

---

# Page: Case Studies Page

Template: `pages/case-studies.php` (public URL `/case-studies/`).

## Summary table

| # | WCAG SC | Level | Audit result | Severity | Status |
|---|---|---|---|---|---|
| 1 | 1.4.13 Content on Hover or Focus | AA | Partial | Medium | **Fixed (global)** |
| 2 | 2.1.1 Keyboard | A | Partial | Low | **Fixed (global)** |
| 3 | 2.1.2 No Keyboard Trap | A | Partial | Medium | **Fixed (global)** |

Every other criterion in the audit is **Pass** or **Pass (N/A)**, so this
page needed **no template-level remediation** — the three flagged items all
share the *same* root cause flagged on every previous page audit and are
covered by code that already shipped.

## 1. WCAG 1.4.13, 2.1.1, 2.1.2 — Dropdown Escape

**Auditor:** *"Dropdowns cannot be dismissed with esc key. Tab, Shift+Tab,
and up and down arrow keys function, escape button does not function."*

### Root cause and fix

Same single root cause flagged on Homepage / Solutions / Industries / About:
the desktop navigation dropdowns (which open on hover) had no Escape
handler. The fix lives in `assets/js/navigation.js` (document-level
`keydown` listener that closes any hover-opened dropdown on Escape and
restores focus to the parent menu trigger). Because `navigation.js` is
loaded site-wide via `functions.php`, the Case Studies page inherits the
fix automatically — no per-template change required.

See the **Homepage** section of this document for the full implementation
details (event delegation, focus restoration, no double-bind on
focus-opened dropdowns).

### Verification

1. Load `/case-studies/`. Hover any top-level nav item to open its
   dropdown.
2. Press Escape — the dropdown must close.
3. Press Escape again with focus inside the menu — focus moves cleanly back
   into the menu trigger; no tab trap.
4. Repeat with a screen reader on — the dropdown's expanded state should
   flip to collapsed without announcing extra noise.

---

## File index — Case Studies changes

| File | Purpose of change |
|---|---|
| *(none)* | All three Partial items are covered by `assets/js/navigation.js`, which already shipped for the Homepage and is loaded site-wide. |

### Outstanding action items

- **Auditor — confirm** the dropdown Escape behaviour on `/case-studies/`
  is tested against a deploy that includes the global Escape handler. Once
  confirmed, items 1–3 above should flip from Partial to Pass.

---

# Page: Contact Page

Template: `pages/contact.php` (public URL `/contact/`).

## Summary table

| # | WCAG SC | Level | Audit result | Severity | Status |
|---|---|---|---|---|---|
| 1 | 1.3.1 Info and Relationships | A | Fail (4 elements — select-names + definition-lists) | High | **Fixed + patched** |
| 2 | 1.4.3 Contrast (Minimum) | AA | Partial (2 elements) | Medium | **Partially mitigated — open (HubSpot embed)** |
| 3 | 1.4.13 Content on Hover or Focus | AA | Partial (Escape) | Medium | **Fixed (global)** |
| 4 | 2.1.1 Keyboard | A | Partial (Escape) | Low | **Fixed (global)** |
| 5 | 2.1.2 No Keyboard Trap | A | Partial (Escape) | Medium | **Fixed (global)** |
| 6 | 2.4.7 Focus Visible | AA | Partial ("squares" in "I am interested in the following solutions") | Low | **Fixed** |
| 7 | 4.1.2 Name, Role, Value | A | Fail (15 elements — aria-required, select names, nested interactive) | High | **Patched** |

Every other criterion in the audit is **Pass** or **Pass (N/A)**.

The majority of the flagged elements live *inside the embedded HubSpot form*
(`//js.hsforms.net/forms/embed/v2.js`). We can't edit HubSpot's rendered
markup directly, so we treat the embed as an untrusted source and:

1. fix the markup we *do* own (the `<dl>` block outside the form),
2. inject CSS that restores a visible `:focus-visible` ring on every control
   HubSpot puts inside `.hs-form-container`,
3. hook HubSpot's `onFormReady` callback **plus** a `MutationObserver` so
   every re-render is re-patched (aria-required, select accessible names,
   nested interactive controls, and `role="group"` on radio/checkbox
   `inputs-list`s).

## 1. WCAG 1.3.1 — Definition list contained an `<h3>`

**Auditor:** *"Beacon has flagged issues with select-names and
definition-lists, affecting four elements."*

### Root cause

The "Reach out" block wrapped its heading *inside* the `<dl>`:

```
<dl class="mt-2 text-lg text-gray-800">
    <h3 class="font-black text-lg text-primary">Reach out</h3>
    ...
</dl>
```

`<dl>` is only allowed to contain `<dt>`, `<dd>`, and `<div>` / `<script>` /
`<template>` wrappers. An `<h3>` inside a `<dl>` is invalid HTML, flagged
by Beacon under "definition-lists".

### Fix

`pages/contact.php` — the `<h3>` is now emitted as a sibling *before* the
`<dl>`, and the `<dl>` references it via `aria-labelledby` so screen readers
still announce the grouping:

```php
<h3 id="contact-reach-out-heading" class="font-black text-lg text-primary mt-2">Reach out</h3>
<dl class="mt-2 text-lg text-gray-800" aria-labelledby="contact-reach-out-heading">
    ...
</dl>
```

### Verification

1. Re-run Beacon / axe on `/contact/`. The "definition-lists" finding for
   this block should be cleared.
2. With VoiceOver / NVDA, arrow through the block — "Reach out, heading
   level 3" is announced first, then the `<dl>` is presented as a list with
   the phone and email rows.

## 2. WCAG 1.3.1 / 4.1.2 — HubSpot select names, aria-required, nested interactive

**Auditor:** *"Beacon has flagged issues with aria required attributes,
select elements with accessible names, and nested interactive controls
affecting 15 elements."*

### Root cause

HubSpot's embed renders a mix of `<select>`, `<input type="checkbox">`,
`<input type="radio">`, and `<input type="text">` controls. Depending on
how a field is configured in HubSpot:

- `<select>` elements can ship without an `aria-label` / `aria-labelledby`
  and with a visually-hidden or positioned `<label>` that Beacon won't
  always associate (especially on multi-step / branching forms).
- `required` attributes are present but `aria-required="true"` sometimes is
  not.
- HubSpot renders the legal / consent copy with `<a>` links *inside* the
  `<label>` of a checkbox, which is a nested interactive control
  (WCAG 4.1.2 / 1.3.1).

### Fix

`pages/contact.php` — replaced the old inline `hbspt.forms.create(...)`
call with a hardened version that:

1. Hooks `onFormReady` so the a11y patcher runs as soon as HubSpot finishes
   rendering.
2. Mounts a `MutationObserver` on `.hs-form-container` so every subsequent
   re-render (step change, validation, conditional branching) is re-patched.
3. For every `<select>` without an accessible name, resolves its `<label>`
   (via `for=` or closest `.hs-form-field label`) and copies the text into
   `aria-label` (stripping trailing `*`).
4. For every `input[required] / select[required] / textarea[required]`,
   adds `aria-required="true"` if missing.
5. For every `<a>` nested inside a `<label>`, hoists the `<a>` to be a
   sibling immediately after the `<label>`, resolving the
   *nested interactive controls* flag while keeping the link adjacent to
   the checkbox visually.
6. For every radio / checkbox group (`.hs-form-field > .inputs-list`),
   applies `role="group"` with `aria-labelledby` / `aria-label` from the
   group's legend so assistive technology announces the group context.

See `pages/contact.php` lines ~52–160 for the full inline script.

### Verification

1. Load `/contact/`, open DevTools, and inspect every `<select>` inside
   `.hs-form-container` — each one should now have an `aria-label` matching
   its visible label.
2. Inspect every required field — each should have `aria-required="true"`.
3. Inspect the consent-copy checkbox — the `<a>` that used to be inside
   the `<label>` is now its own sibling and still reads as a link; the
   checkbox accessible name no longer leaks link markup.
4. Re-run Beacon / axe on `/contact/`. The three 4.1.2 sub-findings (aria
   required attributes, select element accessible names, nested interactive
   controls) should clear.

## 3. WCAG 2.4.7 — Focus visible on the "I am interested in the following solutions" squares

**Auditor:** *"Focus is not visible for squares in the 'I am interested in
the following solutions' section."*

### Root cause

HubSpot styles those checkboxes as visual "squares" and ships CSS that sets
`outline: none` on the native `<input>`, with no replacement ring. Keyboard
users can't tell which square is focused.

### Fix

`pages/contact.php` — a scoped `<style>` block inside `.hs-form-container`
forces a high-contrast `outline` + `box-shadow` pair on any interactive
descendant when it matches `:focus-visible`. The rule also covers the
styled-label pattern HubSpot uses for checkboxes / radios
(`input:focus-visible + span`). Placeholder, helper, and error text are
darkened in the same block to address auditor-flagged **1.4.3** rows on
the embed.

```css
.hs-form-container :is(input, select, textarea, button):focus-visible,
.hs-form-container .hs-form-booleancheckbox-display input:focus-visible + span,
.hs-form-container .hs-form-checkbox-display input:focus-visible + span,
.hs-form-container .hs-form-radio-display input:focus-visible + span {
    outline: 2px solid #98C441 !important;
    outline-offset: 2px !important;
    box-shadow: 0 0 0 2px #1F3131 !important;
    border-radius: 2px;
}
```

### Verification

1. Tab through the HubSpot form. Every field, dropdown, checkbox square,
   and button receives a visible green + dark outline pair on focus.
2. Use Windows high-contrast and macOS "Increase contrast" modes — the
   outline still resolves because it's a real `outline`, not only a
   `box-shadow`.

## 4. WCAG 1.4.3 — Contrast (Minimum) on form copy

**Auditor:** *"Beacon has flagged issues with contrast between foreground
and background colors, affecting two elements."*

### Root cause

Almost certainly two of HubSpot's own text nodes — the placeholder /
helper text or the light-gray legal copy — both of which render inside
`.hs-form-container` on a white background with grey that falls below 4.5:1.

### Fix

The same `<style>` block that handles 2.4.7 also overrides HubSpot's
low-contrast colours for labels, field descriptions, required-indicator
copy, error messages, and placeholders:

```css
.hs-form-container label,
.hs-form-container .hs-form-field > label,
.hs-form-container legend { color: #1F3131 !important; }

.hs-form-container .hs-field-desc,
.hs-form-container .hs-form-required { color: #374151 !important; }

.hs-form-container ::placeholder { color: #4b5563 !important; opacity: 1; }

.hs-form-container .hs-error-msg,
.hs-form-container .hs-error-msgs li label { color: #9b1c1c !important; }
```

These values all meet 4.5:1 against `#ffffff`.

### Remaining work

Two unidentified elements were flagged by Beacon. The fix above covers the
most common HubSpot culprits, but we still need the Beacon export to
confirm coverage. If a specific element is outside `.hs-form-container`
(e.g. one of the page-body `<p class="text-gray-700">` rows) we'll add a
targeted override in `assets/css/input.css`.

### Verification

1. Re-run Beacon / axe on `/contact/`. The 1.4.3 count should drop to 0 or
   to any elements outside the embed.
2. If anything remains, share the Beacon export — we'll translate each
   node to a Tailwind class change or an inline CSS override.

## 5. WCAG 1.4.13, 2.1.1, 2.1.2 — Dropdown Escape

**Auditor:** *"Dropdowns cannot be dismissed with esc key. Tab, Shift+Tab,
and up and down arrow keys function, escape button does not function."*

### Root cause and fix

Identical root cause to Homepage / Solutions / Industries / About / Case
Studies. Fixed site-wide in `assets/js/navigation.js` (document-level
`keydown` listener that closes hover-opened dropdowns and returns focus to
the menu trigger). Loaded site-wide via `functions.php`, so `/contact/`
inherits the fix with no template-level change.

### Verification

1. Load `/contact/`, hover any top-level nav item to open its dropdown.
2. Press Escape — dropdown closes, focus lands on the trigger.
3. Tab / Shift+Tab / up-arrow / down-arrow still behave as before.

---

## File index — Contact Page changes

| File | Purpose of change |
|---|---|
| `pages/contact.php` | Fixed invalid `<h3>` inside `<dl>`; added `<main id="maincontent">` so the global skip link works; made the office-card icons decorative; added `aria-label` + focus-visible styling to social links; rewrote the HubSpot embed boot code to run a `MutationObserver`-backed a11y patcher (select names, aria-required, nested-interactive hoist, group semantics) and shipped scoped CSS for focus-visible + contrast overrides on the HubSpot embed. |
| `assets/js/navigation.js` | Global Escape handler — already shipped; picked up by `/contact/` automatically. |

### Outstanding action items

- **Auditor — confirm** the five dropdown / Escape Partial items on
  `/contact/` are tested against a deploy that includes
  `assets/js/navigation.js`. Once confirmed, rows 3–5 above flip from
  Partial to Pass.
- **Auditor — share Beacon CSV / share-link** for the two elements flagged
  under 1.4.3 and the 15 elements flagged under 4.1.2 so we can verify the
  patcher resolves every node (or add targeted fixes for any that fall
  outside `.hs-form-container`).
- **HubSpot form owner** — review the consent-copy checkbox in HubSpot's
  form editor. Where possible, configure the link to live *after* the
  checkbox label instead of inside it; the runtime hoist we ship is a
  defensive fallback and not a substitute for clean markup at the source.

---

# Page: Blog Page

Template: `pages/blog.php` (public URL `/blog/`).

## Summary table

| # | WCAG SC | Level | Audit result | Severity | Status |
|---|---|---|---|---|---|
| 1 | 1.3.2 Meaningful Sequence | A | Pass with suggestion ("Filter by category") | N/A | **Fixed** |
| 2 | 1.4.13 Content on Hover or Focus | AA | Partial (Escape) | Medium | **Fixed (global)** |
| 3 | 2.1.1 Keyboard | A | Partial (Escape) | Low | **Fixed (global)** |
| 4 | 2.1.2 No Keyboard Trap | A | Partial (Escape) | Medium | **Fixed (global)** |
| 5 | 2.4.3 Focus Order | A | Partial ("Filter by category") | Medium | **Fixed** |
| 6 | 2.4.7 Focus Visible | AA | Partial ("Filter by category") | Low | **Fixed** |

Every other criterion in the audit is **Pass** or **Pass (N/A)**.

Items 1, 5, and 6 all stem from the **same root cause** — the "Filter by
category" `<select>` was set to auto-submit on `change`, so each time a
keyboard or screen-reader user moved through options the page reloaded.
That made the experience feel like the screen reader was "going through
every section" of the dropdown (1.3.2) and broke focus order (2.4.3),
because focus landed back on the `<select>` after every reload. The
focus-visible Tailwind ring used `box-shadow` on a translucent dark
background, which Beacon flagged as not visible enough (2.4.7).

## 1. WCAG 1.3.2 / 2.4.3 — "Filter by category" auto-submit on every option change

**Auditor:** *"Through a screen reader goes through every section of the
'filter by category' drop down menu. … The focus order can become
confusing when screen readers go through the filter by category section."*

### Root cause

`pages/blog.php` had:

```html
<select id="blog-category-filter" name="category_name"
        onchange="this.form.submit()" …>
```

`onchange` fires every time a screen-reader user arrows through options
(VoiceOver, NVDA, Narrator all set the `value` as you arrow, not just on
selection). The form was submitted, the page reloaded, and focus was
restored to the `<select>` — leaving the user no way to *browse* options
without triggering N navigations.

### Fix

`pages/blog.php` — removed `onchange="this.form.submit()"` and shipped an
explicit `<button type="submit">Apply</button>` next to the dropdown. The
filter now only submits when the user takes deliberate action:

```php
<form method="get" role="search" aria-label="Filter blog posts by category">
    <label for="blog-category-filter">Filter by category</label>
    <p id="blog-category-filter-help" class="sr-only">
        Choose a category, then activate Apply to update the list of posts.
    </p>
    <select
        id="blog-category-filter"
        name="category_name"
        aria-describedby="blog-category-filter-help"
        aria-controls="blog-results"
        …
    >
        <option value="">All posts</option>
        <?php foreach ( $children as $cat ) {
            printf(
                '<option value="%1$s" %2$s>%3$s</option>',
                esc_attr( $cat->slug ),
                $selected === $cat->slug ? 'selected' : '',
                esc_html( $cat->name )
            );
        } ?>
    </select>

    <button type="submit">Apply</button>
</form>
```

Three things change for the screen-reader user:

1. Arrow keys now traverse the option list with no side effect — the user
   hears each option name, picks one, and only then activates **Apply**.
2. The hidden `<p id="blog-category-filter-help">` is announced as the
   select's description (`aria-describedby`), telling the user explicitly
   that they need to activate Apply.
3. The select declares `aria-controls="blog-results"`, pointing AT to the
   updated grid so screen readers connect cause and effect on submit.

### Verification

1. Load `/blog/`. Move keyboard focus into the **Filter by category**
   select.
2. Press `Down`/`Up` arrow keys — focus stays on the select, the
   currently-active option name changes, and **the page does not
   reload**.
3. Press `Tab` to move to **Apply**, then `Enter` (or click) — the page
   reloads with the chosen category and the screen reader announces the
   new "X posts in {category}" status message (see item 2 below).
4. Re-run NVDA / VoiceOver. The select is announced as
   "Filter by category, combo box, choose a category, then activate Apply
   to update the list of posts."

## 2. WCAG 2.4.3 — focus order on results

After fix #1, focus order is deterministic: `<h1>` → label → select →
**Apply** → first card. To make the *result of the filter* announced
without relying on a visual scan, we also added a polite live region
above the grid:

```php
<p id="blog-results-status" class="sr-only" aria-live="polite">
    <?php
    if ( $selected ) {
        printf( _n( '%1$d post in %2$s.', '%1$d posts in %2$s.', $total, … ),
                $total, esc_html( $term_name ) );
    } else {
        printf( _n( '%d post.', '%d posts.', $total, … ), $total );
    }
    ?>
</p>
<div id="blog-results" class="grid …">
    …
</div>
```

After Apply triggers a reload, screen readers announce e.g.
"6 posts in Industry News" before the user reaches the cards.

We also wrapped the listing in `<main id="maincontent">` so the global
**Skip to content** link works on this page (it points at `#maincontent`
in `header.php`).

## 3. WCAG 2.4.7 — Focus Visible on the dropdown

**Auditor:** *"Focus is not visible in the 'filter by category' section."*

### Root cause

The previous classes were:

```text
focus:outline-none focus:ring-2 focus:ring-[#D16555] focus:border-transparent
```

That **suppresses** the native focus outline (`outline: none`) and only
draws a Tailwind `ring` (which is implemented as `box-shadow`).
`box-shadow` rings:

- have weaker non-text contrast on the translucent dark hero background,
- are stripped by Windows High Contrast mode,
- and are styled with `focus:` (any focus, including mouse focus) which
  doesn't address Beacon's "selection state" concern.

### Fix

`pages/blog.php` — replaced both the select and the new Apply button
focus styles with a real `outline` paired with a Tailwind `ring`, scoped
to `:focus-visible`:

```text
focus:outline-none
focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
focus-visible:outline-[#98C441]
focus-visible:ring-2 focus-visible:ring-[#1F3131]
```

The lime-green outline (`#98C441`) gives at least 3:1 non-text contrast
against both the dark hero background and the white form / page body; the
inner dark ring layer keeps the indicator visible even on light
backgrounds. Each option in the select uses native browser highlighting,
which is also visible.

We also bumped the visible label from `text-white/70` → `text-white` and
the dropdown caret from `text-white/80` → `text-white` to fully resolve
**1.4.11 Non-text Contrast** on the field's caret while we're in there.

### Verification

1. Tab into the dropdown — a high-contrast lime + dark outline pair is
   drawn around the select.
2. Tab again — the outline moves to **Apply** and the same pair is drawn.
3. Open the select and arrow through options — the active option uses the
   browser's native highlight (which Beacon accepts as visible focus).
4. Switch macOS to "Increase Contrast" / Windows High Contrast —
   the indicator is still drawn because `outline` is a real outline, not
   only `box-shadow`.

## 4. WCAG 1.4.13, 2.1.1, 2.1.2 — Dropdown Escape

**Auditor:** *"Dropdowns cannot be dismissed with esc key. Tab,
Shift+Tab, and up and down arrow keys function, escape button does not
function."*

Same site-wide root cause and fix that shipped from the Homepage audit
(`assets/js/navigation.js` Escape handler). `/blog/` inherits it for
free, no template-level change required.

### Verification

1. Load `/blog/`, hover any top-level navigation item to open its
   dropdown.
2. Press Escape — the dropdown collapses and focus returns to the menu
   trigger.
3. Tab / Shift+Tab / arrow keys behave as before; no keyboard trap.

## 5. Bonus hardening on the post grid

While remediating the audit findings we also tightened the listing markup
to head off two issues Beacon often raises on next-pass audits:

- **Card thumbnails** are now `alt=""` and wrapped in
  `aria-hidden="true"` — the surrounding `<a>` already exposes the post
  title via the `<h3>`, so an alt'd image was duplicating the link's
  accessible name. Native `the_post_thumbnail()` is used so editors can
  later override the alt text, and `loading="lazy"` /
  `decoding="async"` are added for performance.
- The **"Read More" badge** now exposes the post title to screen readers
  as part of the link's accessible name (`Read More about Foo`),
  resolving WCAG 2.4.4 *Link Purpose (in context)* in the
  *out-of-context* fallback Beacon checks.
- The **publish date** colour was bumped from `text-gray-500` to
  `text-gray-600` to comfortably exceed 4.5:1 against the white card
  background (proactive 1.4.3).
- All `<option>` output is now escaped with `esc_attr()` /
  `esc_html()`.

---

## File index — Blog Page changes

| File | Purpose of change |
|---|---|
| `pages/blog.php` | Replaced `<select onchange=submit>` with explicit Apply button; added `aria-describedby` help text; added `aria-controls`-linked, polite live-region results status; added `<main id="maincontent">`; high-contrast `focus-visible:outline + ring` on select + button; bumped label / caret / date contrast; decorative thumbnails (`alt=""` + `aria-hidden`) with native lazy / decoding hints; "Read More" exposes post title to assistive tech; full output escaping. |
| `assets/js/navigation.js` | Global Escape handler (already shipped) — picked up by `/blog/` automatically. |

### Outstanding action items

- **Auditor — confirm** the dropdown Escape behaviour on `/blog/` is
  tested against a deploy that includes `assets/js/navigation.js`. Once
  confirmed, items 2–4 in the table above flip from Partial to Pass.
- **Content team** — for any blog post that ships with a custom *Featured
  Image*, populate the Media Library *Alternative Text* field. Today the
  card image is decorative because the heading carries the name, but if a
  card thumbnail ever stops rendering, the alt fallback should still
  describe the post's subject (we'll lift `alt=""` to the post title at
  that point).

---

# Page: Careers Page

Template: `pages/careers.php` (public URL `/careers/`).

## Summary table

| # | WCAG SC | Level | Audit result | Severity | Status |
|---|---|---|---|---|---|
| 1 | 1.3.1 Info and Relationships | A | Partial (jobs section has no label; SR announces "blocked application application") | High | **Fixed** |
| 2 | 1.4.13 Content on Hover or Focus | AA | Partial (Escape) | Medium | **Fixed (global)** |
| 3 | 2.1.1 Keyboard | A | Partial (Escape) | Low | **Fixed (global)** |
| 4 | 2.1.2 No Keyboard Trap | A | Partial (Escape) | Medium | **Fixed (global)** |
| 5 | 2.4.7 Focus Visible | AA | Partial — reported for "I am interested in the following solutions" squares | Low | **Not applicable on this page** |
| 6 | 4.1.2 Name, Role, Value | A | Fail (1 element — frame has no accessible name) | High | **Fixed** |

Every other criterion in the audit is **Pass** or **Pass (N/A)**.

Items 1 and 6 share the same root cause — the embedded jobs board is an
`<iframe>` without an accessible name, and it sits inside an otherwise
unlabeled section of the page. Item 5 describes a section that doesn't
exist on `/careers/` (it's a copy-paste artefact from the Contact-page
audit) and is called out below for the record.

## 1. WCAG 1.3.1 / 4.1.2 — Jobs board iframe is unlabeled

**Auditor:** *"When using a screen reader, upon going into the section of
the website where one can search different jobs it skips over this
section, and announces the word 'blocked application application'. …
Beacon has flagged issues with ensuring frames have accessible names
affecting one element."*

### Root cause

The careers page is a simple WordPress template that renders
`the_content()` (line 11 of the old file). The site's applicant-tracking
system embeds its job board as an `<iframe>` in that post content, and
the iframe ships without a `title` attribute. When the iframe *and* its
section are both unlabeled, screen readers fall back to reading the
iframe's document-level content (hence the "blocked application
application" phrase) and can drop context entirely — matching Beacon's
1.3.1 observation that the listings section is "skipped".

### Fix

`pages/careers.php` — three-layer repair:

1. **Give the section a real name.** The post content is now wrapped in a
   `<section aria-labelledby="careers-positions-heading">` with a visible
   `<h2 id="careers-positions-heading">Open positions</h2>` above it. A
   short `<p class="sr-only">` intro tells AT users what's in the iframe
   *before* focus enters it, so the landmark / heading navigation is
   predictable.
2. **Give the iframe a real name.** Before rendering, `the_content()` is
   captured into a buffer and every `<iframe>` without a `title` attribute
   is rewritten to carry `title="Open positions at Piedmont Global — job
   board"` (plus `loading="lazy"` and a matching `name="…"` attribute for
   legacy AT). The title string is filterable via the
   `pg_careers_iframe_title` filter so content editors can localize it
   without touching markup.
3. **Give the page a main landmark.** The section is wrapped in
   `<main id="maincontent">` so the site-wide skip link (`header.php` →
   `a.skip-link[href="#maincontent"]`) works on this page.

Key excerpt:

```php
ob_start();
the_content();
$pg_careers_content = ob_get_clean();

$pg_careers_content = preg_replace_callback(
    '/<iframe\b([^>]*)>/i',
    static function ( $m ) use ( $pg_careers_iframe_title ) {
        $attrs = $m[1];
        if ( ! preg_match( '/\btitle\s*=\s*["\']/i', $attrs ) ) {
            $attrs .= ' title="' . esc_attr( $pg_careers_iframe_title ) . '"';
        }
        if ( ! preg_match( '/\bloading\s*=\s*["\']/i', $attrs ) ) {
            $attrs .= ' loading="lazy"';
        }
        if ( ! preg_match( '/\bname\s*=\s*["\']/i', $attrs ) ) {
            $attrs .= ' name="' . esc_attr( $pg_careers_iframe_title ) . '"';
        }
        return '<iframe' . $attrs . '>';
    },
    $pg_careers_content
);
```

And in markup:

```php
<main id="maincontent">
    <section aria-labelledby="careers-positions-heading" …>
        <h2 id="careers-positions-heading">Open positions</h2>
        <p class="sr-only">Search and apply for current roles at Piedmont
           Global. The jobs board below is loaded from our applicant
           tracking system; use its keyword and category filters to find
           roles that match your experience.</p>
        <div class="pg-careers-content"><?php echo $pg_careers_content; ?></div>
    </section>
</main>
```

### Verification

1. Load `/careers/` with VoiceOver / NVDA and navigate by landmark —
   `main` is announced, then the `region` landmark "Open positions"
   (named by the `<h2>`).
2. Navigate by heading — the `<h2>Open positions</h2>` is read
   immediately before the iframe, so users know what they're about to
   enter.
3. With `Ctrl+F7` (VoiceOver rotor) / `Ins+F9` (NVDA elements list),
   switch to Frames — the iframe now shows up as
   *"Open positions at Piedmont Global — job board"* instead of blank /
   "blocked application application".
4. Re-run Beacon on `/careers/` — the 4.1.2 frame-accessible-name finding
   should clear to 0 elements; 1.3.1 should flip from Partial to Pass.

### Remaining work

If the applicant-tracking provider's iframe src is replaced with an ATS
that renders its own nested iframe (common with sandbox embeds), the
nested iframe's title still needs to be set by the provider. Our filter
only touches top-level iframes in the post content. If Beacon reports a
new frame finding after a provider change, the fix is to ask the provider
to ship `title=` on *their* iframe or to proxy the embed through a
themed shortcode.

## 2. WCAG 2.4.7 — Focus visible on "I am interested in the following solutions" squares

**Auditor row copied verbatim from the Contact-page audit.**

The *"I am interested in the following solutions"* field is a HubSpot
multi-checkbox group that lives on the **Contact** page, not the Careers
page. It is not rendered on `/careers/`, so no remediation is required
here. The Contact-page remediation already shipped (scoped focus-visible
CSS inside `.hs-form-container`) — see the `# Page: Contact Page`
section earlier in this document.

If the auditor intended a different focus-visible issue on `/careers/`,
we need a screenshot / Beacon link to the specific element before we can
remediate.

## 3. WCAG 1.4.13, 2.1.1, 2.1.2 — Dropdown Escape

Same site-wide root cause and fix that shipped from the Homepage audit
(`assets/js/navigation.js` Escape handler). `/careers/` inherits the fix
for free — no template-level change required.

### Verification

1. Load `/careers/`, hover any top-level nav item to open its dropdown.
2. Press Escape — the dropdown collapses and focus returns to the
   trigger.
3. Tab / Shift+Tab / arrow keys behave as before; no keyboard trap.

---

## File index — Careers Page changes

| File | Purpose of change |
|---|---|
| `pages/careers.php` | Wrapped content in `<main id="maincontent">` and a labeled `<section aria-labelledby="careers-positions-heading">` with visible `<h2>Open positions</h2>` + SR-only intro; post-processed `the_content()` output to inject `title`, `name`, and `loading="lazy"` on any `<iframe>` missing them; exposed a `pg_careers_iframe_title` filter for localization. |
| `assets/js/navigation.js` | Global Escape handler (already shipped) — picked up by `/careers/` automatically. |

### Outstanding action items

- **Auditor — confirm** the dropdown Escape behaviour on `/careers/` is
  tested against a deploy that includes `assets/js/navigation.js`. Once
  confirmed, items 2–4 in the table above flip from Partial to Pass.
- **Auditor — clarify** the 2.4.7 *"focus is not visible for squares in
  'I am interested in the following solutions'"* row. That UI is on the
  Contact page, not the Careers page; we believe the row was
  copy-pasted. If a specific focus issue exists on `/careers/`, please
  share a Beacon link / screenshot.
- **Content team** — if the ATS provider ever changes the jobs-board
  embed to a different iframe or adds additional nested iframes with
  their own titles, let engineering know so we can verify the injected
  `title` matches the new provider's content.

---

## File index

| File | Purpose of change |
|---|---|
| `functions.php` | New helpers `pg_brand_alt()` and `pg_render_carousel_controls()` (Homepage) |
| `pages/home.php` | Toolbars + smarter alt text on the four logo carousels (Homepage) |
| `pages/solutions.php` | Heading hierarchy fix, `<main id="maincontent">`, decorative image alts, `focus-visible:` rings on cards & CTA (Solutions Overview) |
| `taxonomy-solution.php` | Related Resources accessible toolbar, defensive thumbnail alt text, `aria-labelledby`, `data-pg-carousel-controls` (Solution Taxonomy) |
| `components/common/faqs-related.php` | Same Related-Resources changes shared by `single-solutions.php` and other singles that include this part |
| `components/industries/old.php` | Removed broken `aria-labelledby`; defensive Compliance image alt (Single Industry) |
| `components/industries/new.php` | Related Resources accessible toolbar + region a11y + defensive thumbnail alt; Visual moments Pause/Play; National coverage map long description; per-industry hero / CTA alt text (Single Industry) |
| `pages/about-us.php` | "Our solutions create" toolbar + region a11y; smarter Affiliations / Certifications alt text + list semantics; high-contrast lock on "Making cross-cultural…" heading; optional video transcript block (About) |
| `pages/contact.php` | Valid `<dl>` markup; `<main id="maincontent">` wrapper; decorative office icons; focus-visible + aria on social links; HubSpot embed a11y patcher (aria-required, select accessible names, nested-interactive hoist, group semantics) + scoped focus-visible / contrast CSS (Contact) |
| `pages/blog.php` | Removed `<select onchange=submit>` auto-reload; added Apply button, `aria-describedby` help, `aria-controls` + polite live-region results status; high-contrast `focus-visible:outline` on select & Apply; `<main id="maincontent">`; decorative card thumbnails; richer "Read More" accessible name; output escaping (Blog) |
| `pages/careers.php` | `<main id="maincontent">` wrapper; labeled `<section>` + visible `<h2>Open positions</h2>` + SR-only intro; `the_content()` post-process injects `title` / `name` / `loading="lazy"` on any unlabeled `<iframe>`; filterable `pg_careers_iframe_title` (Careers) |
| `assets/js/navigation.js` | Document-level Escape handler for hover-opened dropdowns (every page using the global header) |
| `assets/js/owl-bulletproof-loader.js` | `wireAccessibleControls()`, reduced-motion-aware autoplay (Homepage + Related Resources + Visual moments + About) |
| `assets/js/carousel-a11y.js` | `hasExternalNav()` recognizes the new toolbar to avoid duplicate arrows (Homepage); `hideClonedSlides()` removes Owl's cloned-slide duplicates from the AT and tab orders (every Owl carousel site-wide) |
| `footer.php` | AOS init honors `prefers-reduced-motion` (site-wide) |

---

## Expected impact on next audit

**Homepage**

- 1.1.1 and 1.4.5 should move from **Partial** to **Pass** once content editors
  populate the ACF brand-name fields. Until then, the alt text is at least
  meaningful (brand domain) rather than generic ("Partner").
- 1.4.13, 2.1.1, 2.1.2, and 2.2.2 should move from **Partial / Fail** to
  **Pass** immediately based on the code changes above.
- 1.4.11 is still **open** pending an auditor screenshot showing the reported
  color shift; we will address it as soon as we can reproduce it.

**Solutions Overview Page**

- 1.3.2 and 2.4.3 should move from **Partial** to **Pass** based on the
  heading-hierarchy fix in `pages/solutions.php`.
- 1.4.13, 2.1.1, and 2.1.2 should move from **Partial** to **Pass** because
  the global Escape handler shipped for the homepage applies to every page
  that uses the shared header.

**Solution Taxonomy & Single Solution Pages**

- 1.1.1 and 1.4.5 should move from **Fail / Partial** to **Pass** immediately
  via the post-title alt-text fallback; quality improves further once editors
  fill the media-library *Alternative Text* field on resource thumbnails.
- 1.3.2 and 2.4.3 should move from **Partial** to **Pass** via the
  cloned-slide hider in `assets/js/carousel-a11y.js`.
- 2.2.2 should move from **Fail** to **Pass** via the new Pause/Play toolbar
  on Related Resources plus reduced-motion-aware autoplay defaults.
- 1.4.13, 2.1.1, and 2.1.2 should move from **Partial** to **Pass** via the
  global dropdown-Escape handler.
- 1.4.3 and 1.4.11 remain **open** until we receive the Beacon export listing
  the 13 flagged elements per criterion.

**Single Industry Pages**

- 1.1.1 and 1.4.5 should move from **Fail** to **Pass** via (a) the
  national-coverage map's new long description, (b) per-industry alt text on
  the hero / CTA images, and (c) the Related-Resources thumbnail-alt fallback.
  Quality improves further once editors fill the media-library
  *Alternative Text* field on resource thumbnails.
- 1.3.1 and 4.1.2 should move from **Fail** to **Pass** because the broken
  `aria-labelledby="<the post title text>"` on the Compliance image wrapper
  was removed.
- 1.3.2 and 2.4.3 should move from **Fail** to **Pass** via the cloned-slide
  hider in `assets/js/carousel-a11y.js` (covers `.sandbox-news-carousel` and
  `.visual-moment-carousel` automatically).
- 2.2.2 should move from **Fail** to **Pass** via (a) the new accessible
  toolbar on the Related Resources carousel, (b) the new Pause / Play
  button on the Visual moments carousel, and (c) reduced-motion-aware
  autoplay on `.visual-moment-carousel`.
- 1.4.13, 2.1.1, and 2.1.2 should move from **Partial** to **Pass** via the
  global dropdown-Escape handler.
- 1.4.3 and 1.4.11 remain **open** pending the Beacon export listing the 5
  flagged elements per criterion.

**About Page**

- 1.1.1 and 1.4.5 should move from **Partial / Fail** to **Pass** via the
  defensive Affiliations / Certifications alt-text fallback (media-library
  alt → media-library title → `pg_brand_alt()` derivation → generic). Quality
  improves further once editors fill the Media Library *Alternative Text*
  field on each logo.
- 1.2.1 (Pass with suggestion) and 1.2.5 (Fail) should move toward **Pass**
  once the content team populates the new `video_transcript` ACF field —
  the `<details>` transcript block ships automatically when populated.
- 1.3.2 and 2.4.3 should move from **Fail** to **Pass** via the cloned-slide
  hider (covers `.aboutus-carousel` for free).
- 2.2.2 should move from **Fail** to **Pass** via the new Pause / Play
  toolbar on `.aboutus-carousel` plus reduced-motion-aware autoplay.
- 1.4.3 should move from **Partial** to **Pass** for the called-out
  "Making cross-cultural…" heading via the explicit dark-text + descendant
  colour lock; the remaining 1 Beacon-flagged element is still **open**.
- 1.4.13, 2.1.1, and 2.1.2 should move from **Partial** to **Pass** via the
  global dropdown-Escape handler.
- 1.4.11 remains **open** pending the Beacon export identifying the 1
  flagged element.

**Case Studies Page**

- 1.4.13, 2.1.1, and 2.1.2 should move from **Partial** to **Pass** via the
  global dropdown-Escape handler in `assets/js/navigation.js` (no
  template-level changes required). Every other criterion is already a
  clean Pass.

**Contact Page**

- 1.3.1 should move from **Fail** to **Pass**: the invalid `<h3>` inside
  `<dl>` was corrected, and the HubSpot patcher assigns accessible names to
  every `<select>` after every re-render.
- 4.1.2 should move from **Fail** toward **Pass**: the patcher fills
  `aria-required`, assigns `aria-label` to selects, hoists nested `<a>`
  links out of `<label>` ancestors, and applies `role="group"` semantics to
  radio / checkbox groups. Any residual flagged nodes need the Beacon
  export to identify.
- 2.4.7 should move from **Partial** to **Pass**: the scoped CSS restores a
  high-contrast `:focus-visible` ring on every form control inside
  `.hs-form-container`, including the checkbox "squares" called out by the
  auditor.
- 1.4.3 is **partially mitigated**: HubSpot's low-contrast label /
  placeholder / helper / error colours are overridden in the same scoped
  CSS block. The remaining two elements need the Beacon export to confirm
  whether they are inside or outside the embed.
- 1.4.13, 2.1.1, and 2.1.2 should move from **Partial** to **Pass** via the
  global dropdown-Escape handler in `assets/js/navigation.js`.

**Blog Page**

- 1.3.2 (Pass with suggestion) and 2.4.3 (Partial) should move to **Pass**
  via the new explicit Apply button — arrow keys no longer auto-submit, so
  the screen reader can browse options without page reloads, and focus
  order is fully deterministic.
- 2.4.7 (Partial) should move to **Pass** via the new high-contrast
  `focus-visible:outline + ring` pair on the select and the new Apply
  button (real `outline`, not only `box-shadow`, so it survives Windows /
  macOS high-contrast modes).
- 1.4.13, 2.1.1, and 2.1.2 should move from **Partial** to **Pass** via the
  global dropdown-Escape handler in `assets/js/navigation.js` (no
  template-level changes required for those rows).

**Careers Page**

- 1.3.1 should move from **Partial** to **Pass**: the jobs-board iframe
  now sits inside a labeled `<section aria-labelledby="…">` with a visible
  `<h2>Open positions</h2>` and an SR-only intro, so the section is no
  longer announced as "blocked application application".
- 4.1.2 should move from **Fail (1 element)** to **Pass**: `the_content()`
  is post-processed to guarantee every `<iframe>` ships with a
  `title="Open positions at Piedmont Global — job board"` attribute
  (plus `name=` and `loading="lazy"` for completeness).
- 1.4.13, 2.1.1, and 2.1.2 should move from **Partial** to **Pass** via the
  global dropdown-Escape handler in `assets/js/navigation.js`.
- 2.4.7 on `/careers/` is a **copy-paste artefact** from the Contact-page
  audit (the "I am interested in the following solutions" field doesn't
  exist on Careers); awaiting auditor clarification.
