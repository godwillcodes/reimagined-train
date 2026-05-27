<?php
/**
 * Template Name: Connexus
 * Description: Connexus page template.
 */
get_header();
?>

<?php
/* ─── Static page content ────────────────────────────── */
$eyebrow = 'Language Services &amp; Strategic Growth';
$h1      = 'Break language barriers, accelerate growth';
$sub     = 'Piedmont Global connects your business to the world — with precision translation, strategic localization, and AI-powered workflows built for healthcare, government, and enterprise.';

/* ─── Section 7 · Platform features ──────────────────── */
$features = [
  [
    'label'   => 'AI Translation',
    'heading' => 'Discover Piedmont&nbsp;AI',
    'tag'     => 'Your AI-powered language assistant',
    'body'    => '<p>Like a trusted language partner, Piedmont AI works beside you continuously — organizing terminology, ensuring consistency, and drafting translations on your behalf.</p><p>It can execute complete localization workflows end-to-end, so your team never slows down.</p>',
    'cta'     => ['label' => 'Learn more', 'href' => '/solutions/ai'],
    'img_src' => 'https://framerusercontent.com/images/lFhfMRQo5RH0Thw2igSZaeXOsrk.png?scale-down-to=1024&width=2700&height=2198',
    'img_alt' => 'AI Translation interface',
    'glow'    => 'rgba(92,195,250,.22)',
  ],
  [
    'label'   => 'Smart Triage',
    'heading' => 'Respond faster to what matters most',
    'tag'     => 'Automatically prioritize incoming requests',
    'body'    => '<p>Too many translation requests, not enough clarity on urgency. Smart Triage routes work from key clients, compliance-critical content, and high-priority markets — automatically.</p><p>Even when the queue is overflowing, your team responds where it matters most.</p>',
    'cta'     => null,
    'img_src' => 'https://framerusercontent.com/images/tIy3VlZuPyD8qjM1ivJXb332aNk.png?scale-down-to=1024&width=1350&height=1080',
    'img_alt' => 'Smart Triage request view',
    'glow'    => 'rgba(158,110,230,.25)',
  ],
  [
    'label'   => 'Deadline Tracker',
    'heading' => 'Follow up on time, every time',
    'tag'     => 'Never miss a delivery window',
    'body'    => '<p>You\'re managing a critical localization project — clinical documentation, a regulatory filing, a product launch. Deadlines don\'t move.</p><p>Set a reminder when you assign work. If a milestone isn\'t confirmed, we surface it before it becomes a problem.</p>',
    'cta'     => null,
    'img_src' => 'https://framerusercontent.com/images/8Nkq7H34lGVFjNavBLLluyWHqRI.png?scale-down-to=1024&width=1350&height=1080',
    'img_alt' => 'Deadline Tracker milestone view',
    'glow'    => 'rgba(250,117,248,.22)',
  ],
  [
    'label'   => 'Team Comments',
    'heading' => 'Share and review with your team',
    'tag'     => 'Collaborate faster than ever before',
    'body'    => '<p>A client has feedback on a translation. A reviewer has questions. A product manager needs sign-off. Chasing email threads slows everything down.</p><p>Share a live review link with anyone — no account required. Comment, approve, and ship faster.</p>',
    'cta'     => null,
    'img_src' => 'https://framerusercontent.com/images/ZqoWGnqskMXBXv3DHQRTKrmHIE.png?scale-down-to=1024&width=2700&height=2080',
    'img_alt' => 'Team comments on a shared document',
    'glow'    => 'rgba(250,204,105,.22)',
  ],
  [
    'label'   => 'Glossary Snippets',
    'heading' => 'Write less and empower your&nbsp;team',
    'tag'     => 'Lock in terminology across every project',
    'body'    => '<p>Inconsistent terminology costs credibility — a drug name spelled two ways, a brand tagline that drifts, one wrong word in a legal document.</p><p>Approved terms expand automatically across linguists, projects, and languages. Your brand speaks with one voice, always.</p>',
    'cta'     => null,
    'img_src' => 'https://framerusercontent.com/images/4tbP2BbCx80JPRs6PkI8gHiJqY8.png?scale-down-to=1024&width=4050&height=3240',
    'img_alt' => 'Glossary Snippets terminology picker',
    'glow'    => 'rgba(152,196,65,.22)',
  ],
];

/* Logo marquee — 8 SVG slots, repeated by the marquee loop */
$logo_count = 8;

/* ─── Section 7b · Industries ────────────────────────── */
$features2 = [
  [
    'label'   => 'Healthcare',
    'heading' => 'Precision translation for clinical&nbsp;teams',
    'tag'     => 'Compliant across every jurisdiction',
    'body'    => '<p>From informed-consent forms to IFU translations, accuracy is non-negotiable. Our linguists are trained to the standards your regulators demand.</p><p>Every project ships with full audit trails, ISO certification, and back-translation validation on request.</p>',
    'cta'     => ['label' => 'Healthcare solutions', 'href' => '/solutions/healthcare'],
    'img_src' => 'https://framerusercontent.com/images/lFhfMRQo5RH0Thw2igSZaeXOsrk.png?scale-down-to=1024&width=2700&height=2198',
    'img_alt' => 'Healthcare translation workflow',
    'glow'    => 'rgba(92,195,250,.20)',
  ],
  [
    'label'   => 'Government',
    'heading' => 'Trusted by agencies that cannot afford errors',
    'tag'     => 'Security-cleared linguists, critical-grade work',
    'body'    => '<p>Government communications require absolute precision, discretion, and often speed. Piedmont has supported federal and state agencies for over a decade.</p><p>Our cleared linguists understand the weight of the work — and deliver accordingly.</p>',
    'cta'     => null,
    'img_src' => 'https://framerusercontent.com/images/tIy3VlZuPyD8qjM1ivJXb332aNk.png?scale-down-to=1024&width=1350&height=1080',
    'img_alt' => 'Government document translation',
    'glow'    => 'rgba(0,97,85,.28)',
  ],
  [
    'label'   => 'Finance',
    'heading' => 'Regulatory filings in any&nbsp;language',
    'tag'     => 'On deadline, in full compliance',
    'body'    => '<p>Annual reports, prospectuses, and compliance filings leave no room for linguistic ambiguity. A single mistranslation can trigger regulatory scrutiny.</p><p>Our financial translators understand GAAP, IFRS, and the exact terminology your counterparts expect globally.</p>',
    'cta'     => null,
    'img_src' => 'https://framerusercontent.com/images/8Nkq7H34lGVFjNavBLLluyWHqRI.png?scale-down-to=1024&width=1350&height=1080',
    'img_alt' => 'Financial document translation',
    'glow'    => 'rgba(250,204,105,.22)',
  ],
  [
    'label'   => 'Technology',
    'heading' => 'Software localization at&nbsp;scale',
    'tag'     => 'From UI strings to full product experiences',
    'body'    => '<p>Your product ships in 12 languages. Your documentation in 6. Your support in 4. Piedmont plugs directly into your development workflow.</p><p>We localize UI, docs, onboarding, and marketing — as fast as your engineering team ships.</p>',
    'cta'     => null,
    'img_src' => 'https://framerusercontent.com/images/ZqoWGnqskMXBXv3DHQRTKrmHIE.png?scale-down-to=1024&width=2700&height=2080',
    'img_alt' => 'Software localization workflow',
    'glow'    => 'rgba(152,196,65,.22)',
  ],
  [
    'label'   => 'Legal',
    'heading' => 'Certified translations courts&nbsp;accept',
    'tag'     => 'Every document, every jurisdiction',
    'body'    => '<p>Contracts, depositions, immigration filings, court orders. Legal translation demands certified linguists who understand both the source and target legal systems.</p><p>Piedmont provides ATA-certified translation with notarization options and same-day turnaround for urgent matters.</p>',
    'cta'     => null,
    'img_src' => 'https://framerusercontent.com/images/4tbP2BbCx80JPRs6PkI8gHiJqY8.png?scale-down-to=1024&width=4050&height=3240',
    'img_alt' => 'Legal document certification',
    'glow'    => 'rgba(92,195,250,.18)',
  ],
];
$pills_r1 = ['Healthcare','Government','Finance','Legal','Education','Technology','Life Sciences','Defense'];
$pills_r2 = ['Business Development','Operations','Compliance','Marketing','Engineering','Strategy','Clinical Trials','Regulatory Affairs'];

$pill_grads = [
  'linear-gradient(94deg,rgba(255,255,255,.07) 0%,rgba(152,196,65,.28) 100%)',
  'linear-gradient(94deg,rgba(0,97,85,.50) 0%,rgba(255,255,255,.07) 100%)',
  'linear-gradient(94deg,rgba(255,255,255,.07) 0%,rgba(0,97,85,.48) 100%)',
  'linear-gradient(94deg,rgba(152,196,65,.26) 0%,rgba(255,255,255,.07) 100%)',
];
?>

<style>
:root {
  --pg-ink: #080F0F;
  --pg-ink-2: #0B1A1A;
  --pg-forest: #0E1F1F;
  --pg-emerald: #006155;
  --pg-green: #98C441;
  --pg-cream: #F2EFE9;
}

.grad-green,
.grad-warm,
.grad-cool,
.grad-gold,
.grad-bloom,
.grad-rev {
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
}

.grad-green { background-image: linear-gradient(135deg, #D6F08B 0%, var(--pg-green) 44%, #5F9D1A 100%); }
.grad-warm  { background-image: linear-gradient(92deg, var(--pg-cream) 0%, #D6F08B 42%, var(--pg-green) 100%); }
.grad-cool  { background-image: linear-gradient(90deg, #E8F5D0 0%, var(--pg-green) 48%, var(--pg-emerald) 100%); }
.grad-gold  { background-image: linear-gradient(90deg, #FAF5E7 0%, #CDEB72 48%, var(--pg-green) 100%); }
.grad-bloom { background-image: linear-gradient(90deg, var(--pg-cream) 0%, #BFE163 46%, var(--pg-emerald) 100%); }
.grad-rev   { background-image: linear-gradient(90deg, var(--pg-green) 0%, #DDEFA8 52%, var(--pg-cream) 100%); }


.pg-surface {
  position: relative;
  overflow: hidden;
  border: 1px solid rgba(242,239,233,.075);
  background:
    linear-gradient(180deg, rgba(255,255,255,.045), rgba(255,255,255,.018)),
    radial-gradient(circle at 50% 0%, rgba(152,196,65,.12), transparent 58%);
  box-shadow: 0 28px 90px rgba(0,0,0,.34), inset 0 1px 0 rgba(255,255,255,.055);
}

.pg-glass-pill {
  box-shadow: inset 0 1px 0 rgba(255,255,255,.08), 0 12px 34px rgba(0,0,0,.18);
  backdrop-filter: blur(12px);
}

.copy-panel {
  opacity:0;transform:translateY(14px);
  transition:opacity .5s cubic-bezier(.22,1,.36,1),transform .5s cubic-bezier(.22,1,.36,1);
  position:absolute;inset:0;pointer-events:none;
}
.copy-panel.on {
  opacity:1;transform:none;
  position:relative;pointer-events:auto;
}

.feat-dot {
  display:block;width:3px;height:3px;border-radius:50%;
  background:rgba(255,255,255,.20);border:none;padding:0;cursor:pointer;
  transition:height .35s cubic-bezier(.22,1,.36,1),border-radius .35s,background .35s,box-shadow .35s;
}
.feat-dot.on { height:18px;border-radius:2px;background:var(--pg-green);box-shadow:0 0 24px rgba(152,196,65,.55) }

/* ── Speed scroll headline ───────────────────────────── */
.speed-copy {
  opacity: 0.09;
  transform: translateY(16px);
  transition: opacity .55s cubic-bezier(.22,1,.36,1),
              transform .55s cubic-bezier(.22,1,.36,1);
}
.speed-copy.on {
  opacity: 1;
  transform: none;
}

/* ── Step number / category label ───────────────────── */
.speed-num {
  display: block;
  font-size: 11px; font-weight: 700; letter-spacing: .13em;
  text-transform: uppercase;
  color: rgba(152,196,65,.62);
  margin-bottom: 18px;
  opacity: 0;
  transform: translateY(6px);
  transition: opacity .4s cubic-bezier(.22,1,.36,1),
              transform .4s cubic-bezier(.22,1,.36,1);
}
.speed-step.is-active .speed-num { opacity: 1; transform: none; }

/* ── Supporting sub-copy ─────────────────────────────── */
.speed-sub {
  font-size: 15px; line-height: 1.78;
  color: rgba(242,239,233,.36);
  margin-top: 22px;
  max-width: 400px;
  opacity: 0;
  transform: translateY(10px);
  transition: opacity .48s .12s cubic-bezier(.22,1,.36,1),
              transform .48s .12s cubic-bezier(.22,1,.36,1);
  pointer-events: none;
}
.speed-step.is-active .speed-sub {
  opacity: 1;
  transform: none;
  pointer-events: auto;
}
</style>


<!-- ════════════════════════════════════════════════════
     SECTION 1 · HERO
════════════════════════════════════════════════════ -->
<section class="relative overflow-hidden bg-[#080F0F]" aria-label="Hero">

  <?php get_template_part('components/navigation/desktop'); ?>
  <?php get_template_part('components/navigation/mobile'); ?>

  <div class="pointer-events-none absolute inset-0" aria-hidden="true" style="background:
    radial-gradient(ellipse 72% 48% at 50% -12%, rgba(152,196,65,.20) 0%, transparent 58%),
    radial-gradient(ellipse 54% 36% at 50% 110%, rgba(0,97,85,.30) 0%, transparent 58%),
    linear-gradient(180deg, rgba(8,15,15,.58) 0%, rgba(14,31,31,.78) 52%, rgba(8,15,15,1) 100%);"></div>

  <div class="pointer-events-none absolute -top-28 left-1/2 h-[420px] w-[680px] -translate-x-1/2 blur-[2px]" aria-hidden="true"
    style="background:radial-gradient(ellipse at 50% 30%,rgba(152,196,65,.16) 0%,transparent 70%)"></div>

  <?php /* Bottom edge — a teal breath that bleeds into the seam below */ ?>
  <div class="pointer-events-none absolute bottom-0 left-0 right-0 h-40" aria-hidden="true"
       style="background:radial-gradient(ellipse 60% 100% at 50% 100%, rgba(0,97,85,.20) 0%, transparent 70%)"></div>

  <div class="relative z-10 mx-auto max-w-[720px] px-6 pb-28 pt-24 text-center lg:pb-36 lg:pt-32">

    <div class="mb-8 flex justify-center">
      <div class="inline-flex items-stretch overflow-hidden border border-[#98C441]/20">
        <div class="w-[2.5px] self-stretch bg-[#98C441]/55 flex-shrink-0"></div>
        <div class="flex items-center gap-2 px-3 py-[7px]">
          <span class="text-[10px] font-bold tracking-[.15em] uppercase text-[#98C441]/65">Language Services &amp; Strategic Growth</span>
        </div>
      </div>
    </div>

    <h1 class="text-[clamp(2.35rem,5.7vw,3.85rem)] font-extrabold leading-[1.03] tracking-[-0.045em] text-[#F2EFE9] drop-shadow-[0_18px_60px_rgba(0,0,0,.28)]">
      Break language barriers, accelerate growth
    </h1>

    <p class="mx-auto mt-6 max-w-[460px] text-[15px] font-normal leading-[1.82] text-[#F2EFE9]/58">
      Piedmont Global connects your business to the world — with precision translation, strategic localization, and AI-powered workflows built for healthcare, government, and enterprise.
    </p>

    <div class="mt-11 flex flex-wrap items-center justify-center gap-2.5">
      <a href="#contact"
        class="inline-flex items-center gap-1.5 rounded-[8px] bg-[#98C441] px-[22px] py-[11px] text-[13px] font-bold text-[#080F0F] transition
          [box-shadow:inset_0_1px_0_rgba(255,255,255,.28),inset_0_-1px_0_rgba(0,0,0,.12),0_1px_3px_rgba(0,0,0,.3),0_4px_18px_rgba(152,196,65,.22)]
          hover:-translate-y-px hover:bg-[#A6D34E]
          hover:[box-shadow:inset_0_1px_0_rgba(255,255,255,.30),inset_0_-1px_0_rgba(0,0,0,.12),0_1px_3px_rgba(0,0,0,.3),0_8px_24px_rgba(152,196,65,.30)]
          focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2 focus-visible:ring-offset-[#080F0F]">
        Get started
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true" focusable="false">
          <path d="M2 6h8M6.5 3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
      <a href="#solutions"
        class="inline-flex items-center gap-1.5 rounded-[8px] border border-white/[.09] px-[18px] py-[11px] text-[13px] font-medium text-[#F2EFE9]/50 transition
          hover:border-white/[.18] hover:text-[#F2EFE9]/82
          focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/20">
        Explore solutions
        <svg width="11" height="11" viewBox="0 0 11 11" fill="none" aria-hidden="true" focusable="false">
          <path d="M3.5 2l4 3.5-4 3.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
    </div>

    <div class="mt-8 flex items-center justify-center gap-2.5">
      <div class="flex" aria-hidden="true">
        <span class="flex h-[25px] w-[25px] items-center justify-center rounded-full border-[1.5px] border-[#080F0F] bg-[#354A40] text-[8px] font-bold text-[#F2EFE9]/55">JL</span>
        <span class="flex h-[25px] w-[25px] -ml-1.5 items-center justify-center rounded-full border-[1.5px] border-[#080F0F] bg-[#2D4438] text-[8px] font-bold text-[#F2EFE9]/55">MR</span>
        <span class="flex h-[25px] w-[25px] -ml-1.5 items-center justify-center rounded-full border-[1.5px] border-[#080F0F] bg-[#3A4A35] text-[8px] font-bold text-[#F2EFE9]/55">AK</span>
        <span class="flex h-[25px] w-[25px] -ml-1.5 items-center justify-center rounded-full border-[1.5px] border-[#080F0F] bg-[#2E3D3A] text-[8px] font-bold text-[#F2EFE9]/55">+</span>
      </div>
      <p class="text-[11.5px] text-[#F2EFE9]/34">
        <span class="text-[#98C441] text-[9px] tracking-[.5px]" aria-label="5 stars">★★★★★</span>
        &nbsp;Trusted by <span class="font-medium text-[#F2EFE9]/52">500+</span> global organizations
      </p>
    </div>

  </div>
</section>



<!-- ════════════════════════════════════════════════════
     SECTION 2 · LOGO MARQUEE
════════════════════════════════════════════════════ -->
<section class="relative bg-[#080F0F] py-14 sm:py-16" aria-label="Trusted by">
  <div class="pointer-events-none absolute inset-0" aria-hidden="true"
       style="background:radial-gradient(ellipse 80% 100% at 50% 50%, rgba(0,97,85,.07) 0%, transparent 68%)"></div>
  <div class="relative overflow-hidden"
    style="mask-image:linear-gradient(to right,transparent 0%,black 8%,black 92%,transparent 100%);
           -webkit-mask-image:linear-gradient(to right,transparent 0%,black 8%,black 92%,transparent 100%)">
    <div class="flex w-max items-center gap-[56px]">
      <?php
      /* 8 logos × 3 passes = 24 items; first 8 are visible, rest aria-hidden */
      $total_slots = $logo_count * 3;
      for ($i = 0; $i < $total_slots; $i++) :
        $dup = $i >= $logo_count;
      ?>
      <div class="flex h-[28px] w-[110px] shrink-0 items-center opacity-[.32] transition hover:opacity-[.65]"
           <?php echo $dup ? 'aria-hidden="true"' : ''; ?>>
        <img src="http://bis.local/wp-content/uploads/2026/01/BIS-All-white-Logo-scaled-e1749035726582-1.webp"
             alt="<?php echo $dup ? '' : 'Partner logo'; ?>"
             loading="lazy" decoding="async"
             class="h-full w-full object-contain object-center">
      </div>
      <?php endfor; ?>
    </div>
  </div>
</section>



<!-- ════════════════════════════════════════════════════
     SECTION 3 · BIG NUMBER
════════════════════════════════════════════════════ -->
<section class="relative flex min-h-[420px] items-center justify-center overflow-hidden bg-[#080F0F] px-6 py-24 sm:py-32 lg:py-40 sm:min-h-[500px] lg:min-h-[560px]"
         aria-label="Scale stat">
  <div class="pointer-events-none absolute inset-0" aria-hidden="true" style="background:
    radial-gradient(ellipse 62% 48% at 50% 50%,  rgba(0,97,85,.18)   0%, transparent 60%),
    radial-gradient(ellipse 42% 30% at 50% 12%,  rgba(152,196,65,.10) 0%, transparent 68%),
    radial-gradient(ellipse 58% 40% at 50% 100%, rgba(152,196,65,.10) 0%, transparent 65%);"></div>
  <img src="https://framerusercontent.com/images/DL1CwjDuNaGH88jNAq23UH2bk0c.png?width=1728&height=815"
       alt="" aria-hidden="true" loading="lazy" decoding="async" width="1728" height="815"
       class="absolute left-1/2 top-1/2 h-auto w-[62vw] max-w-[920px] -translate-x-1/2 -translate-y-1/2 object-contain object-center pointer-events-none select-none opacity-60">
  <div class="relative z-10 mx-auto max-w-[700px] text-center">
    <h2 class="text-[clamp(1.5rem,2.6vw,2.5rem)] font-extrabold leading-[1.22] tracking-[-0.032em] text-[#F2EFE9]">
      Piedmont Global has delivered<br>
      over 50 million words<br>
      for clients worldwide.
    </h2>
  </div>
</section>



<!-- ════════════════════════════════════════════════════
     SECTION 4 · PROBLEM + PILL TAGS
════════════════════════════════════════════════════ -->

<style>
/* ── Pill rows: scroll-driven parallax ───────────────────── */
.pg-pill-row {
  will-change: transform;
  /* No CSS transition — JS updates on every scroll frame for tightness */
}

/* ── Pill base — ghost glass ──────────────────────────── */
.pg-pill {
  display: inline-flex; align-items: center; gap: 9px; white-space: nowrap;
  border-radius: 99px;
  padding: 11px 24px;
  font-size: 13px; font-weight: 600; letter-spacing: -.01em;
  border: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.030);
  color: rgba(242,239,233,.38);
  box-shadow:
    inset 0 1px 0 rgba(255,255,255,.06),
    0 1px 4px rgba(0,0,0,.18);
  transition: border-color .32s, color .32s, box-shadow .32s,
              transform .32s cubic-bezier(.22,1,.36,1);
}
.pg-pill:hover {
  border-color: rgba(152,196,65,.28);
  color: rgba(242,239,233,.86);
  box-shadow:
    inset 0 1px 0 rgba(255,255,255,.09),
    0 0 0 1px rgba(152,196,65,.12),
    0 6px 20px rgba(0,0,0,.22);
  transform: translateY(-2px);
}

/* ── Shared accent dot ────────────────────────────────── */
.pg-pill-teal::before,
.pg-pill-green::before {
  content: '';
  display: block;
  width: 6px; height: 6px;
  border-radius: 50%;
  flex-shrink: 0;
}

/* ── Teal accent ──────────────────────────────────────── */
.pg-pill-teal {
  background: linear-gradient(145deg, rgba(0,105,90,.52) 0%, rgba(0,80,68,.38) 100%);
  border-color: rgba(0,160,128,.28);
  color: rgba(100,230,195,.82);
  box-shadow:
    inset 0 1.5px 0 rgba(255,255,255,.11),
    inset 0 -1px 0 rgba(0,0,0,.14),
    0 0 32px rgba(0,105,90,.22),
    0 4px 16px rgba(0,0,0,.24);
}
.pg-pill-teal::before {
  background: rgba(0,210,165,.92);
  box-shadow:
    0 0 0 2.5px rgba(0,210,165,.16),
    0 0 14px rgba(0,210,165,.72);
}
.pg-pill-teal:hover {
  color: rgba(140,250,215,.96);
  box-shadow:
    inset 0 1.5px 0 rgba(255,255,255,.13),
    inset 0 -1px 0 rgba(0,0,0,.14),
    0 0 0 1px rgba(0,160,128,.26),
    0 0 42px rgba(0,120,100,.28),
    0 8px 24px rgba(0,0,0,.26);
  transform: translateY(-2px);
}

/* ── Green accent ─────────────────────────────────────── */
.pg-pill-green {
  background: linear-gradient(145deg, rgba(152,196,65,.22) 0%, rgba(110,155,40,.16) 100%);
  border-color: rgba(152,196,65,.28);
  color: rgba(192,238,90,.82);
  box-shadow:
    inset 0 1.5px 0 rgba(255,255,255,.11),
    inset 0 -1px 0 rgba(0,0,0,.12),
    0 0 32px rgba(152,196,65,.15),
    0 4px 16px rgba(0,0,0,.22);
}
.pg-pill-green::before {
  background: rgba(162,210,70,.94);
  box-shadow:
    0 0 0 2.5px rgba(152,196,65,.18),
    0 0 14px rgba(152,196,65,.68);
}
.pg-pill-green:hover {
  color: rgba(220,255,115,.96);
  box-shadow:
    inset 0 1.5px 0 rgba(255,255,255,.13),
    inset 0 -1px 0 rgba(0,0,0,.12),
    0 0 0 1px rgba(152,196,65,.24),
    0 0 42px rgba(152,196,65,.20),
    0 8px 24px rgba(0,0,0,.24);
  transform: translateY(-2px);
}
</style>

<?php
/* Pill accent cycle: plain / teal / plain / green */
$pill_accent = ['pg-pill-plain','pg-pill-teal','pg-pill-plain','pg-pill-green'];
?>

<section id="pg-problem" class="relative overflow-hidden bg-[#080F0F] px-6 pb-0 pt-24 text-center sm:pt-32 lg:pt-40" aria-label="The problem">

  <?php /* Spotlight from top + soft teal floor */ ?>
  <div class="pointer-events-none absolute inset-0" aria-hidden="true" style="background:
    radial-gradient(ellipse 58% 52% at 50% -8%,  rgba(152,196,65,.18) 0%, transparent 58%),
    radial-gradient(ellipse 90% 30% at 50% 108%, rgba(0,97,85,.22)   0%, transparent 65%),
    radial-gradient(ellipse 40% 40% at 50% 42%,  rgba(0,97,85,.06)   0%, transparent 72%);"></div>

  <?php /* ── Copy ── */ ?>
  <div class="relative z-10 mx-auto max-w-[680px] text-center">

    <?php /* Eyebrow */ ?>
    <div class="mb-8 flex justify-center">
      <div class="inline-flex items-stretch overflow-hidden border border-[#98C441]/20">
        <div class="w-[2.5px] self-stretch bg-[#98C441]/55 flex-shrink-0"></div>
        <div class="flex items-center gap-2 px-3 py-[7px]">
          <span class="text-[10px] font-bold tracking-[.15em] uppercase text-[#98C441]/65">The problem</span>
        </div>
      </div>
    </div>

    <?php /* Headline */ ?>
    <h2 class="text-center  text-5xl font-extrabold leading-[1.08] tracking-[-0.042em] text-[#F2EFE9]">
      Language gaps are the biggest barrier
      hiding in plain sight
    </h2>

    <?php /* Body */ ?>
    <div class="mx-auto mt-8 max-w-[580px] space-y-4 text-center text-[clamp(.95rem,1.4vw,1.08rem)] font-light leading-[1.88] text-[#F2EFE9]/52">
      <p>Organizations lose deals, fail compliance audits, and damage client relationships — not because of poor strategy, but because of miscommunication across languages.</p>
      <p>Most language solutions haven't evolved in decades. With Piedmont Global, this all changes.</p>
    </div>

  </div>

  <?php /* ── Floating label separating copy from pills ── */ ?>
  <div class="relative z-10 mx-auto mt-20 mb-14 flex justify-center">
    <div class="inline-flex items-center gap-[10px] rounded-full
                border border-white/[.10]
                bg-gradient-to-b from-[rgba(255,255,255,.055)] to-[rgba(255,255,255,.022)]
                px-6 py-[11px]
                shadow-[inset_0_1.5px_0_rgba(255,255,255,.08),0_16px_48px_rgba(0,0,0,.18)]">
      <?php /* Glow dot */ ?>
      <span class="relative flex h-[8px] w-[8px] flex-shrink-0" aria-hidden="true">
        <span class="absolute inset-0 rounded-full bg-[#98C441]/50 blur-[3px]"></span>
        <span class="relative block h-[8px] w-[8px] rounded-full bg-[#98C441]/80"></span>
      </span>
      <span class="text-[12.5px] font-semibold tracking-[.13em] uppercase text-[#F2EFE9]/52">
        Sectors &amp; Functions
      </span>
    </div>
  </div>

  <?php /* ── Pill rows — centered, scroll-driven parallax ── */ ?>
  <div class="relative z-10 space-y-[14px]" aria-label="Sectors and functions we serve">

    <?php
    $mask = 'mask-image:linear-gradient(to right,transparent 0%,black 7%,black 93%,transparent 100%);
             -webkit-mask-image:linear-gradient(to right,transparent 0%,black 7%,black 93%,transparent 100%)';
    ?>

    <?php /* Row 1 — drifts left on scroll */ ?>
    <div class="flex justify-center overflow-hidden" style="<?php echo $mask; ?>">
      <div id="pg-pills-r1" class="pg-pill-row flex w-max items-center gap-[10px]">
        <?php foreach ($pills_r1 as $pi => $pill) :
          $accent = $pill_accent[$pi % count($pill_accent)];
        ?>
        <span class="pg-pill <?php echo esc_attr($accent); ?>">
          <?php echo esc_html($pill); ?>
        </span>
        <?php endforeach; ?>
      </div>
    </div>

    <?php /* Row 2 — drifts right on scroll */ ?>
    <div class="flex justify-center overflow-hidden" style="<?php echo $mask; ?>">
      <div id="pg-pills-r2" class="pg-pill-row flex w-max items-center gap-[10px]">
        <?php foreach ($pills_r2 as $pi => $pill) :
          $accent = $pill_accent[($pi + 1) % count($pill_accent)];
        ?>
        <span class="pg-pill <?php echo esc_attr($accent); ?>">
          <?php echo esc_html($pill); ?>
        </span>
        <?php endforeach; ?>
      </div>
    </div>

  </div>

  <?php /* Bottom fade into next section — no hard edge */ ?>
  <div class="pointer-events-none relative z-10 mt-0 h-24 sm:h-32 lg:h-40"
       style="background:linear-gradient(to bottom,transparent,#080F0F);"
       aria-hidden="true"></div>

</section>

<!-- ════════════════════════════════════════════════════
     JS: Section 4 — scroll-driven pill parallax
════════════════════════════════════════════════════ -->
<script>
(function () {
  var section = document.getElementById('pg-problem');
  var r1      = document.getElementById('pg-pills-r1');
  var r2      = document.getElementById('pg-pills-r2');
  if (!section || !r1 || !r2) return;

  /* Max drift in px — feels physical without being distracting */
  var DRIFT = 64;

  function update() {
    var rect     = section.getBoundingClientRect();
    var vh       = window.innerHeight;
    /* progress: 0 when section top is at viewport bottom (entering)
                 0.5 when section is centred in viewport
                 1 when section bottom is at viewport top (leaving) */
    var progress = (vh - rect.top) / (vh + rect.height);
    var p        = Math.max(0, Math.min(1, progress));
    /* offset: -DRIFT → 0 → +DRIFT as user scrolls through section */
    var offset   = (p - 0.5) * 2 * DRIFT;

    r1.style.transform = 'translateX(' + (-offset).toFixed(2) + 'px)'; /* drifts left  */
    r2.style.transform = 'translateX(' + ( offset).toFixed(2) + 'px)'; /* drifts right */
  }

  window.addEventListener('scroll', update, { passive: true });
  update(); /* seed initial position */
})();
</script>


<?php
/* ─── Section 5 · Speed steps ──────────────────────────────── */
$speed_steps = [
  [
    'num'   => '01',
    'label' => 'Delivery',
    'head'  => "Deliver translations\ntwice as fast as before.",
    'sub'   => 'AI-assisted workflows and automated QA cut turnaround in half — without sacrificing a word of accuracy.',
  ],
  [
    'num'   => '02',
    'label' => 'Compliance',
    'head'  => "Stay fully compliant\nacross every market.",
    'sub'   => 'Built-in regulatory glossaries and jurisdiction-specific review flows keep every deliverable market-ready.',
  ],
  [
    'num'   => '03',
    'label' => 'Collaboration',
    'head'  => "Collaborate globally\nfaster than ever before.",
    'sub'   => 'Shared glossaries, real-time comments, and async review tools unify your global team around one source of truth.',
  ],
];
$speed_total = count($speed_steps);
?>

<!-- ════════════════════════════════════════════════════
     SECTION 5 · SPEED (image + stacking headlines)
════════════════════════════════════════════════════ -->
<section class="relative bg-[#080F0F] px-6 py-24 sm:py-32 lg:py-0" id="speed-scroll" aria-label="Speed and responsiveness">
  <div class="pointer-events-none absolute inset-0" aria-hidden="true" style="background:
    radial-gradient(ellipse 55% 45% at 15% 55%, rgba(0,97,85,.25) 0%, transparent 58%),
    radial-gradient(ellipse 50% 40% at 85% 30%, rgba(152,196,65,.12) 0%, transparent 60%),
    linear-gradient(180deg, #080F0F 0%, #0B1A1A 50%, #080F0F 100%)"></div>

  <div class="relative z-10 mx-auto grid max-w-[1200px] grid-cols-1 gap-12 lg:min-h-[300vh] lg:grid-cols-2 lg:gap-20">

    <?php /* ── LEFT · sticky panel ── */ ?>
    <div class="lg:sticky lg:top-0 lg:flex lg:h-screen lg:flex-col lg:items-center lg:justify-center">

      <?php /* Image card */ ?>
      <div class="pg-surface mx-auto w-full max-w-[440px] rounded-[28px] p-2 lg:max-w-[460px]">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_50%_10%,rgba(152,196,65,.12),transparent_55%)]" aria-hidden="true"></div>
        <img src="https://framerusercontent.com/images/ZzEcgyBWKakgLd4hnleDpz8lPcs.png?width=1080&height=1350"
             alt="Piedmont Global interface" loading="lazy" decoding="async"
             class="relative z-10 mx-auto block h-auto max-h-[65vh] w-auto max-w-full rounded-[22px] object-contain">
      </div>

      <?php /* Step counter + progress bar */ ?>
      <div class="mt-7 hidden w-full max-w-[440px] items-center gap-4 lg:flex lg:max-w-[460px]">
        <span id="speed-step-label"
              class="min-w-[80px] text-[11px] font-bold tracking-[.13em] uppercase text-[#98C441]/65 transition-all duration-400">
          <?php echo esc_html($speed_steps[0]['label']); ?>
        </span>
        <div class="relative h-[1.5px] flex-1 overflow-hidden rounded-full" style="background:rgba(255,255,255,.08)">
          <div id="speed-progress"
               class="absolute left-0 top-0 h-full rounded-full transition-all duration-500 ease-[cubic-bezier(.22,1,.36,1)]"
               style="width:<?php echo number_format(100 / $speed_total, 4); ?>%;
                      background:linear-gradient(to right,rgba(152,196,65,.85),rgba(0,97,85,.60))">
          </div>
        </div>
        <span class="text-[11px] font-bold tracking-[.10em] text-white/20">
          <span id="speed-step-cur"><?php echo esc_html($speed_steps[0]['num']); ?></span>
          <span class="mx-[3px] text-white/12">/</span>
          <?php echo sprintf('%02d', $speed_total); ?>
        </span>
      </div>

    </div>

    <?php /* ── RIGHT · scrolling steps ── */ ?>
    <div class="flex flex-col lg:py-[50vh]">
      <?php foreach ($speed_steps as $si => $s) : ?>
      <div class="speed-step<?php echo $si === 0 ? ' is-active' : ''; ?> flex min-h-[55vh] items-center lg:min-h-screen"
           data-speed-step="<?php echo $si; ?>">
        <div>
          <span class="speed-num"><?php echo esc_html($s['num']); ?> &mdash; <?php echo esc_html($s['label']); ?></span>
          <div class="speed-copy<?php echo $si === 0 ? ' on' : ''; ?> text-[clamp(1.8rem,3vw,2.8rem)] font-extrabold leading-[1.15] tracking-[-0.035em] text-[#F2EFE9]">
            <?php echo nl2br(esc_html($s['head'])); ?>
          </div>
          <p class="speed-sub"><?php echo esc_html($s['sub']); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>



<!-- ════════════════════════════════════════════════════
     SECTION 6 · INTEGRATIONS
════════════════════════════════════════════════════ -->
<section class="relative overflow-hidden bg-[#080F0F] px-6 py-24 sm:py-32 lg:py-40" id="solutions" aria-label="Integrations">

  <?php /* Directional atmosphere — glow sits behind the text (left),
           very faint hint behind the image (right) */ ?>
  <div class="pointer-events-none absolute inset-0" aria-hidden="true" style="background:
    radial-gradient(ellipse 62% 85% at 16% 52%,   rgba(0,97,85,.22)    0%, transparent 55%),
    radial-gradient(ellipse 50% 65% at 84% 44%,   rgba(152,196,65,.07) 0%, transparent 58%),
    radial-gradient(ellipse 70% 35% at 50% -5%,   rgba(0,97,85,.10)    0%, transparent 65%),
    radial-gradient(ellipse 60% 30% at 50% 108%,  rgba(152,196,65,.09) 0%, transparent 68%);"></div>

  <div class="relative z-10 mx-auto grid max-w-[1140px] grid-cols-1 items-center gap-14 lg:grid-cols-2 lg:gap-20">

    <?php /* ── Left: copy ── */ ?>
    <div>
      <?php /* Eyebrow */ ?>
      <div class="mb-8 inline-flex items-stretch overflow-hidden border border-[#98C441]/20">
        <div class="w-[2.5px] self-stretch bg-[#98C441]/55 flex-shrink-0"></div>
        <div class="flex items-center gap-2 px-3 py-[7px]">
          <span class="text-[10px] font-bold tracking-[.15em] uppercase text-[#98C441]/65">Integrations</span>
        </div>
      </div>

      <?php /* Heading */ ?>
      <h2 class="text-[clamp(2rem,4.2vw,3.4rem)] font-extrabold leading-[1.08] tracking-[-0.042em] text-[#F2EFE9]">
        Built for teams that use<br>
        any platform,<br>
        any workflow
      </h2>

      <?php /* Supporting copy */ ?>
      <p class="mt-6 max-w-[360px] text-[15px] leading-[1.84] text-[#F2EFE9]/44">
        Connect with the tools your teams already rely on — from CAT platforms and TMS systems to enterprise content pipelines and review workflows.
      </p>

      <?php /* Subtle platform chips */ ?>
      <div class="mt-8 flex flex-wrap gap-2" aria-label="Supported platforms">
        <?php foreach (['SDL Trados','memoQ','Phrase','Contentful','Salesforce','Adobe XD'] as $pl) : ?>
        <span class="rounded-[6px] border border-white/[.08] bg-white/[.04] px-3 py-[6px] text-[11.5px] font-medium text-white/38">
          <?php echo esc_html($pl); ?>
        </span>
        <?php endforeach; ?>
      </div>
    </div>

    <?php /* ── Right: image card ── */ ?>
    <div class="flex items-center justify-center lg:justify-end">
      <div class="w-full max-w-[460px]">

        <?php /* Glass card */ ?>
        <div class="relative overflow-hidden rounded-[22px]"
             style="
               background: rgba(12,24,24,.88);
               border: 1px solid rgba(242,239,233,.075);
               box-shadow:
                 inset 0 1.5px 0 rgba(255,255,255,.055),
                 0 32px 90px rgba(0,0,0,.46),
                 0 0 0 1px rgba(0,0,0,.20);
             ">

          <?php /* Top-edge accent line */ ?>
          <div class="absolute inset-x-0 top-0 h-px pointer-events-none z-10"
               style="background: linear-gradient(to right, transparent 5%, rgba(152,196,65,.30) 35%, rgba(152,196,65,.22) 65%, transparent 95%);"
               aria-hidden="true"></div>

          <?php /* Inner top glow */ ?>
          <div class="pointer-events-none absolute inset-x-0 top-0 h-32"
               style="background: radial-gradient(ellipse 80% 100% at 50% -10%, rgba(152,196,65,.10) 0%, transparent 70%);"
               aria-hidden="true"></div>

          <img src="https://framerusercontent.com/images/pRTepi2wStAhn0iR4AR9ul4BPI.png?width=1920&height=1080"
               alt="Platform integrations — SDL Trados, memoQ, Phrase, Contentful and more"
               loading="lazy" decoding="async"
               class="relative z-[1] block h-auto w-full opacity-[.86]">
        </div>

      </div>
    </div>

  </div>
</section>



<!-- ════════════════════════════════════════════════════
     SECTION 7 · FEATURES (sticky scroll — elevated)
════════════════════════════════════════════════════ -->

<style>
/* ── Per-feature atmosphere layers ───────────────────── */
.feat-atmo {
  position: absolute; inset: 0; pointer-events: none;
  transition: opacity 1.1s cubic-bezier(.22, 1, .36, 1);
}

/* ── Copy panel ───────────────────────────────────────── */
/* Defines defaults + transitions. JS drives all state changes
   via inline styles so there is zero class/inline-style conflict. */
#features .copy-panel {
  position: absolute; inset: 0;
  opacity: 0;
  transform: translateY(16px);
  pointer-events: none;
  /* transition lives here; inline-style changes inherit it */
  transition: opacity .55s cubic-bezier(.22,1,.36,1),
              transform .55s cubic-bezier(.22,1,.36,1);
}
/* PHP renders the first panel with class="copy-panel on".
   This gives a visible initial state before JS initialises. */
#features .copy-panel.on {
  opacity: 1; transform: translateY(0px);
  position: relative; pointer-events: auto;
}

/* ── Tag accent line ──────────────────────────────────── */
.feat-tag-row {
  display: flex; align-items: center; gap: 10px;
  margin-bottom: 20px;
}
.feat-tag-row::before {
  content: '';
  display: block; flex-shrink: 0;
  width: 22px; height: 2px; border-radius: 2px;
  background: #98C441; opacity: .80;
}

/* ── Feature counter chip ─────────────────────────────── */
.feat-counter {
  font-size: 10.5px; font-weight: 700;
  font-variant-numeric: tabular-nums;
  letter-spacing: .10em;
  color: rgba(242,239,233,.25);
}

/* ── Nav pip track ────────────────────────────────────── */
.feat-pip {
  display: block; width: 3px; border-radius: 99px;
  background: rgba(255,255,255,.18);
  border: none; padding: 0; cursor: pointer;
  height: 3px;
  transition:
    height .45s cubic-bezier(.22,1,.36,1),
    background .45s,
    box-shadow .45s;
}
.feat-pip.on {
  height: 22px;
  background: #98C441;
  box-shadow: 0 0 12px rgba(152,196,65,.55), 0 0 28px rgba(152,196,65,.30);
}

/* ── Image card ───────────────────────────────────────── */
.feat-img-card {
  position: relative; overflow: hidden;
  border-radius: 26px;
  border: 1px solid rgba(242,239,233,.08);
  background: rgba(10,22,22,.92);
  box-shadow:
    inset 0 1.5px 0 rgba(255,255,255,.055),
    0 32px 96px rgba(0,0,0,.46);
  transition: box-shadow .7s cubic-bezier(.22,1,.36,1),
              border-color .7s;
  aspect-ratio: 1350 / 1080;
}
/* Inner ring sheen */
.feat-img-card::after {
  content: ''; position: absolute; inset: 0; border-radius: 26px;
  box-shadow: inset 0 0 0 1px rgba(255,255,255,.055);
  pointer-events: none; z-index: 10;
}
/* Glow orb behind image */
.feat-glow-orb {
  position: absolute; inset: -44%; border-radius: 50%;
  pointer-events: none; z-index: 0;
  transition: background 1s cubic-bezier(.22,1,.36,1), opacity 1s;
}
/* The screenshot */
.feat-img-card img {
  position: relative; z-index: 1;
  display: block; width: 100%; height: 100%;
  object-fit: cover; object-position: center;
  transition: transform .7s cubic-bezier(.22,1,.36,1), opacity .5s;
  opacity: .82;
}
/* Active state: subtle scale */
.feature-step.is-active .feat-img-card {
  border-color: rgba(152,196,65,.16);
  box-shadow:
    inset 0 1.5px 0 rgba(255,255,255,.065),
    0 40px 110px rgba(0,0,0,.52),
    0 0 0 1px rgba(152,196,65,.09);
}
.feature-step.is-active .feat-img-card img {
  transform: scale(1.018); opacity: .90;
}

/* ── Caption bar ──────────────────────────────────────── */
.feat-caption {
  display: flex; align-items: center; justify-content: space-between;
  margin-top: 14px; padding: 0 2px;
}
</style>

<section class="relative bg-[#080F0F] pt-24 sm:pt-32 lg:pt-40" id="features" aria-label="Platform features">

  <?php /* Top-edge bloom — receives hand-off from Integrations seam above */ ?>
  <div class="pointer-events-none absolute inset-x-0 top-0 h-40" aria-hidden="true"
       style="background:radial-gradient(ellipse 60% 100% at 50% 0%, rgba(0,97,85,.14) 0%, transparent 70%)"></div>

  <?php /* ── Per-feature atmosphere layers ─── */ ?>
  <div id="featAtmos" aria-hidden="true">
    <?php
    /* Each feature gets its own unique atmospheric gradient composition */
    $atmos = [
      /* 0 · AI Translation — teal + cool blue */
      'radial-gradient(ellipse 68% 52% at 10% 44%, rgba(0,97,85,.24) 0%, transparent 58%),
       radial-gradient(ellipse 52% 42% at 88% 26%, rgba(92,195,250,.11) 0%, transparent 58%)',
      /* 1 · Smart Triage — deep violet */
      'radial-gradient(ellipse 68% 52% at 8% 50%,  rgba(88,48,168,.22) 0%, transparent 58%),
       radial-gradient(ellipse 52% 42% at 90% 28%, rgba(158,110,230,.12) 0%, transparent 60%)',
      /* 2 · Deadline Tracker — magenta / rose */
      'radial-gradient(ellipse 68% 52% at 10% 54%, rgba(185,42,130,.18) 0%, transparent 58%),
       radial-gradient(ellipse 52% 42% at 88% 30%, rgba(250,100,195,.10) 0%, transparent 58%)',
      /* 3 · Team Comments — amber / warm gold */
      'radial-gradient(ellipse 68% 52% at 10% 48%, rgba(135,82,0,.22) 0%, transparent 58%),
       radial-gradient(ellipse 52% 42% at 88% 28%, rgba(250,200,80,.11) 0%, transparent 58%)',
      /* 4 · Glossary Snippets — brand green */
      'radial-gradient(ellipse 68% 52% at 10% 50%, rgba(0,97,85,.30) 0%, transparent 58%),
       radial-gradient(ellipse 52% 42% at 88% 26%, rgba(152,196,65,.15) 0%, transparent 58%)',
    ];
    foreach ($atmos as $ai => $bg) :
    ?>
    <div class="feat-atmo" style="opacity:<?php echo $ai === 0 ? '1' : '0'; ?>;background:<?php echo $bg; ?>"></div>
    <?php endforeach; ?>
  </div>

  <?php /* ── Two-column layout ─── */ ?>
  <div class="relative z-10 mx-auto max-w-[1200px] px-6 lg:px-14 lg:grid lg:grid-cols-2 lg:gap-24 lg:items-start">

    <?php /* ── LEFT · sticky copy ─── */ ?>
    <div class="hidden lg:flex lg:sticky lg:top-0 lg:h-screen lg:items-center">
      <div class="relative w-full max-w-[460px]">

        <?php /* Nav pip track */ ?>
        <nav class="absolute -left-8 top-1/2 -translate-y-1/2 flex flex-col items-center gap-[9px]"
             id="featDots" aria-label="Feature navigation"></nav>

        <?php /* Copy panels */ ?>
        <div class="relative" id="copyStack">
          <?php foreach ($features as $i => $f) : ?>
          <div class="copy-panel<?php echo $i === 0 ? ' on' : ''; ?>" data-idx="<?php echo $i; ?>">

            <?php /* Top row: category label + counter */ ?>
            <div class="mb-5 flex items-center justify-between">
              <p class="text-[10px] font-bold uppercase tracking-[.16em] text-[#98C441]/60">
                <?php echo esc_html($f['label']); ?>
              </p>
              <span class="feat-counter"><?php printf('%02d&thinsp;/&thinsp;%02d', $i + 1, count($features)); ?></span>
            </div>

            <?php /* Heading */ ?>
            <h2 class="mb-5 text-[clamp(1.75rem,2.5vw,2.5rem)] font-extrabold leading-[1.15] tracking-[-0.038em] text-[#F2EFE9]">
              <?php echo wp_kses_post($f['heading']); ?>
            </h2>

            <?php /* Tagline with accent rule */ ?>
            <div class="feat-tag-row">
              <span class="text-[12.5px] font-semibold tracking-[.005em] text-white/48">
                <?php echo esc_html($f['tag']); ?>
              </span>
            </div>

            <?php /* Body */ ?>
            <div class="space-y-3.5 max-w-[420px] text-[14.5px] leading-[1.88] text-white/50">
              <?php echo wp_kses_post($f['body']); ?>
            </div>

            <?php if ($f['cta']) : ?>
            <a href="<?php echo esc_url($f['cta']['href']); ?>"
               class="group mt-8 inline-flex items-center gap-2 text-[13.5px] font-semibold text-[#98C441]
                      transition-all duration-200 hover:gap-3.5
                      focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2 focus-visible:ring-offset-[#080F0F]">
              <?php echo esc_html($f['cta']['label']); ?>
              <svg width="14" height="12" viewBox="0 0 14 12" fill="none" aria-hidden="true" focusable="false"
                   class="transition-transform duration-200 group-hover:translate-x-1">
                <path d="M1 6h12M8 1.5L13 6l-5 4.5" stroke="currentColor" stroke-width="1.65" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </a>
            <?php endif; ?>

          </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>

    <?php /* ── RIGHT · scrolling image steps ─── */ ?>
    <div class="py-20 lg:py-[20vh]" id="featRight">
      <?php foreach ($features as $i => $f) : ?>
      <div class="feature-step flex min-h-screen items-center" data-step="<?php echo $i; ?>">
        <div class="w-full">

          <?php /* Mobile copy (visible below lg) */ ?>
          <div class="mb-7 lg:hidden">
            <div class="mb-3 flex items-center justify-between">
              <p class="text-[10px] font-bold uppercase tracking-[.16em] text-[#98C441]/60"><?php echo esc_html($f['label']); ?></p>
              <span class="text-[10.5px] tabular-nums text-white/24"><?php printf('%02d / %02d', $i + 1, count($features)); ?></span>
            </div>
            <h2 class="text-[clamp(1.75rem,2.5vw,2.5rem)] font-extrabold leading-[1.15] tracking-[-0.038em] text-[#F2EFE9] mb-3">
              <?php echo wp_kses_post($f['heading']); ?>
            </h2>
            <p class="text-[13px] text-white/44"><?php echo esc_html($f['tag']); ?></p>
          </div>

          <?php /* Image card */ ?>
          <div class="feat-img-card">
            <div class="feat-glow-orb"
                 style="background:radial-gradient(50% 50%, <?php echo esc_attr($f['glow']); ?> 0%, transparent 100%); opacity:.60;"
                 aria-hidden="true"></div>
            <img src="<?php echo esc_url($f['img_src']); ?>"
                 alt="<?php echo esc_attr($f['img_alt']); ?>"
                 loading="lazy" decoding="async">
          </div>

          <?php /* Caption bar */ ?>
          <div class="feat-caption" aria-hidden="true">
            <span class="text-[10.5px] font-semibold tracking-[.09em] uppercase text-white/22">
              <?php echo esc_html($f['label']); ?>
            </span>
            <span class="text-[10.5px] tabular-nums text-white/18">
              <?php printf('%02d&thinsp;/&thinsp;%02d', $i + 1, count($features)); ?>
            </span>
          </div>

        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>


<!-- ════════════════════════════════════════════════════
     JS: Section 5 sticky scroll
════════════════════════════════════════════════════ -->
<script>
(function () {
  var section  = document.getElementById('speed-scroll');
  if (!section || !('IntersectionObserver' in window)) return;

  var steps    = section.querySelectorAll('.speed-step');
  var copies   = section.querySelectorAll('.speed-copy');
  var progEl   = document.getElementById('speed-progress');
  var curEl    = document.getElementById('speed-step-cur');
  var labelEl  = document.getElementById('speed-step-label');
  var total    = steps.length;
  if (!total || !copies.length) return;

  /* Label strings from PHP */
  var labels = <?php echo json_encode(array_column($speed_steps, 'label')); ?>;
  var nums   = <?php echo json_encode(array_column($speed_steps, 'num')); ?>;

  var cur = -1;

  function activate(idx) {
    if (idx === cur) return;
    cur = idx;

    /* 1 — headline brightness */
    copies.forEach(function (c, i) { c.classList.toggle('on', i === idx); });

    /* 2 — step context: num label + sub-copy fade */
    steps.forEach(function (s, i) { s.classList.toggle('is-active', i === idx); });

    /* 3 — progress bar */
    if (progEl) progEl.style.width = ((idx + 1) / total * 100).toFixed(3) + '%';

    /* 4 — counter + label */
    if (curEl)   curEl.textContent   = nums[idx]   || '';
    if (labelEl) labelEl.textContent = labels[idx] || '';
  }

  /* rootMargin: only the central 24% of the viewport triggers — very intentional */
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (e) {
      if (e.isIntersecting) activate(Number(e.target.dataset.speedStep));
    });
  }, { rootMargin: '-38% 0px -38% 0px', threshold: 0 });

  steps.forEach(function (s) { io.observe(s); });

  /* Seed — ensures state is correct on load regardless of scroll position */
  activate(0);
})();
</script>


<!-- ════════════════════════════════════════════════════
     JS: Section 7 — features sticky + atmosphere
════════════════════════════════════════════════════ -->
<script>
(function () {
  const section = document.getElementById('features');
  if (!section) return;

  const steps  = section.querySelectorAll('.feature-step');
  const panels = section.querySelectorAll('.copy-panel');
  const atmos  = section.querySelectorAll('.feat-atmo');
  const dotsEl = document.getElementById('featDots');
  if (!steps.length || !dotsEl) return;

  let cur = -1;

  /* ── Build nav pips ─────────────────────────────────── */
  const pips = Array.from({ length: steps.length }, (_, i) => {
    const btn = document.createElement('button');
    btn.className = 'feat-pip' + (i === 0 ? ' on' : '');
    btn.setAttribute('aria-label', 'Go to feature ' + (i + 1));
    btn.addEventListener('click', () =>
      steps[i].scrollIntoView({ behavior: 'smooth', block: 'center' })
    );
    dotsEl.appendChild(btn);
    return btn;
  });

  /* ── Activate a feature ─────────────────────────────── */
  function activate(idx) {
    if (idx === cur) return;
    cur = idx;

    /* Copy panels — pure inline styles, no class toggling.
       CSS transition on opacity/transform still fires because
       the `transition` property lives on .copy-panel in the stylesheet. */
    panels.forEach((p, i) => {
      const on = i === idx;
      p.style.opacity       = on ? '1'               : '0';
      p.style.transform     = on ? 'translateY(0px)' : 'translateY(16px)';
      p.style.position      = on ? 'relative'        : 'absolute';
      p.style.pointerEvents = on ? 'auto'            : 'none';
    });

    /* Nav pips */
    pips.forEach((pip, i) => pip.classList.toggle('on', i === idx));

    /* Active step (drives CSS image scale + border colour) */
    steps.forEach((s, i) => s.classList.toggle('is-active', i === idx));

    /* Atmosphere cross-fade */
    atmos.forEach((a, i) => { a.style.opacity = i === idx ? '1' : '0'; });
  }

  /* ── IntersectionObserver ───────────────────────────── */
  if (!('IntersectionObserver' in window)) { activate(0); return; }

  const io = new IntersectionObserver(
    entries => entries.forEach(e => {
      if (e.isIntersecting) activate(Number(e.target.dataset.step));
    }),
    /* -35% top/bottom → 30 % detection band in the centre of the viewport.
       Wide enough that min-h-screen steps are never missed. */
    { rootMargin: '-35% 0px -35% 0px', threshold: 0 }
  );

  steps.forEach(s => io.observe(s));
  /* Seed the initial state without relying on the observer */
  activate(0);
})();
</script>


<?php
/**
 * Section: Feature Bento Grid
 * 3 rows of asymmetric card pairs — alternating narrow/wide layout.
 * Each card: screenshot fills the card, title floats at top, coloured
 * gradient rises from the bottom to anchor each image tonally.
 */

$rows = [
  [
    'layout' => 'narrow-wide',   // left col narrower
    'cards'  => [
      [
        'title'       => 'Have perfect timing with Send&nbsp;Later',
        'img_src'     => 'https://framerusercontent.com/images/REVBb6Xx0fylloJfcV48hXBs2n0.png?width=1056&height=672',
        'img_alt'     => 'Send Later scheduling interface',
        'img_pos'     => 'object-left-top',
        'overlay_rgb' => '0,97,85',
      ],
      [
        'title'       => 'Reply faster with Instant&nbsp;Reply',
        'img_src'     => 'https://framerusercontent.com/images/9qNX5HraxuRB6kIHb4x9u9jDkk.png?width=1504&height=672',
        'img_alt'     => 'Instant Reply AI suggestions',
        'img_pos'     => 'object-center object-top',
        'overlay_rgb' => '152,196,65',
      ],
    ],
  ],
  [
    'layout' => 'wide-narrow',
    'cards'  => [
      [
        'title'       => 'Snooze emails for&nbsp;later',
        'img_src'     => 'https://framerusercontent.com/images/CJ3ScV4rAlNNF6B194Y2LYy3Yk.png?width=1504&height=672',
        'img_alt'     => 'Snooze emails feature',
        'img_pos'     => 'object-left-top',
        'overlay_rgb' => '152,196,65',
      ],
      [
        'title'       => 'Hit Inbox Zero with keyboard shortcuts',
        'img_src'     => 'https://framerusercontent.com/images/zkpXYjJGOWWUsn7WWpWoQE19dhs.png?width=1056&height=672',
        'img_alt'     => 'Keyboard shortcuts cheat sheet',
        'img_pos'     => 'object-left-top',
        'overlay_rgb' => '0,97,85',
      ],
    ],
  ],
  [
    'layout' => 'narrow-wide',
    'cards'  => [
      [
        'title'       => 'Improve interactions with social&nbsp;insight',
        'img_src'     => 'https://framerusercontent.com/images/IqcSLQmU6S3LAkdIXKj3OsrYBEE.png?width=1056&height=672',
        'img_alt'     => 'Social insight contact enrichment',
        'img_pos'     => 'object-left-top',
        'overlay_rgb' => '152,196,65',
      ],
      [
        'title'       => 'Unsubscribe and clear spam&nbsp;instantly',
        'img_src'     => 'https://framerusercontent.com/images/kAYdZmg1ASUGUocYEYh3fvuj7ZY.png?width=1504&height=672',
        'img_alt'     => 'One-click unsubscribe panel',
        'img_pos'     => 'object-center object-top',
        'overlay_rgb' => '0,97,85',
      ],
    ],
  ],
];

// Col widths per layout
$col_classes = [
  'narrow-wide' => ['sm:col-span-5', 'sm:col-span-7'],
  'wide-narrow' => ['sm:col-span-7', 'sm:col-span-5'],
];
?>

<?php /* ══════════════════════════════════════════════════════════════════
   SECTION 8 · FEATURE BENTO GRID
   Layout per card: eyebrow → title → 1 px rule → image
══════════════════════════════════════════════════════════════════ */ ?>

<style>
/* ── Bento card shell ─────────────────────────────────────────── */
.pg-bento-card {
  display: flex;
  flex-direction: column;
  position: relative;
  border-radius: 18px;
  overflow: hidden;
  background: linear-gradient(180deg,
    rgba(22,35,35,.92) 0%,
    rgba(14,26,26,.96) 100%);
  border: 1px solid rgba(242,239,233,.07);
  box-shadow:
    0 2px 0 rgba(255,255,255,.04) inset,
    0 24px 64px rgba(0,0,0,.38);
  transition: transform .28s cubic-bezier(.22,1,.36,1),
              border-color .28s,
              box-shadow .28s;
}
.pg-bento-card:hover {
  transform: translateY(-2px);
  border-color: rgba(152,196,65,.22);
  box-shadow:
    0 2px 0 rgba(255,255,255,.05) inset,
    0 32px 80px rgba(0,0,0,.44),
    0 0 0 1px rgba(152,196,65,.10);
}

/* ── Text zone (top) ──────────────────────────────────────────── */
.pg-bento-text {
  padding: 22px 24px 20px;
  flex-shrink: 0;
}

/* ── Rule ─────────────────────────────────────────────────────── */
.pg-bento-rule {
  flex-shrink: 0;
  height: 1px;
  margin: 0 0 0 0;
  background: linear-gradient(
    to right,
    transparent 0%,
    rgba(152,196,65,.18) 30%,
    rgba(242,239,233,.08) 60%,
    transparent 100%
  );
}

/* ── Image zone (bottom, fills remainder) ─────────────────────── */
.pg-bento-img {
  flex: 1 1 0%;
  position: relative;
  min-height: 160px;
  overflow: hidden;
}
.pg-bento-img img {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  opacity: .80;
  saturate: .88;
  transition: transform .55s cubic-bezier(.22,1,.36,1), opacity .35s;
}
.pg-bento-card:hover .pg-bento-img img {
  transform: scale(1.025);
  opacity: .90;
}

/* Edge vignette inside image zone — blends image into card bg */
.pg-bento-img::after {
  content: '';
  position: absolute;
  inset: 0;
  pointer-events: none;
  z-index: 2;
  background:
    linear-gradient(to bottom, rgba(14,26,26,.22) 0%, transparent 28%, transparent 72%, rgba(14,26,26,.30) 100%),
    linear-gradient(to right,  rgba(14,26,26,.18) 0%, transparent 12%, transparent 88%, rgba(14,26,26,.18) 100%);
}

/* ── Eyebrow label ────────────────────────────────────────────── */
.pg-bento-label {
  display: block;
  font-size: 10px;
  font-weight: 700;
  letter-spacing: .15em;
  text-transform: uppercase;
  color: rgba(152,196,65,.62);
  margin-bottom: 9px;
}

/* ── Card title ───────────────────────────────────────────────── */
.pg-bento-h {
  font-size: clamp(.93rem, 1.15vw, 1.08rem);
  font-weight: 700;
  line-height: 1.30;
  letter-spacing: -.020em;
  color: #F2EFE9;
}
</style>

<section class="relative overflow-hidden bg-[#080F0F] px-4 py-24 sm:px-6 sm:py-32 lg:py-40"
         aria-labelledby="bento-heading">

  <?php /* Section atmosphere */ ?>
  <div class="pointer-events-none absolute inset-0" aria-hidden="true" style="background:
    radial-gradient(ellipse 52% 38% at 50% -4%,  rgba(152,196,65,.14) 0%, transparent 62%),
    radial-gradient(ellipse 70% 55% at 50% 105%, rgba(0,97,85,.18)   0%, transparent 60%),
    linear-gradient(180deg, #080F0F 0%, #0A1818 50%, #080F0F 100%);"></div>

  <div class="relative z-10 mx-auto max-w-[880px]">

    <?php /* Section header */ ?>
    <div class="mb-12 text-center">
      <div class="mb-6 flex justify-center">
        <div class="inline-flex items-stretch overflow-hidden border border-[#98C441]/20">
          <div class="w-[2.5px] self-stretch bg-[#98C441]/55 flex-shrink-0"></div>
          <div class="flex items-center gap-2 px-3 py-[7px]">
            <span class="text-[10px] font-bold tracking-[.15em] uppercase text-[#98C441]/65">Built for precision</span>
          </div>
        </div>
      </div>
      <h2 id="bento-heading"
          class="text-[clamp(2rem,4.2vw,3.4rem)] font-extrabold leading-[1.08] tracking-[-0.042em] text-[#F2EFE9]">
        Every detail,
        engineered to move faster.
      </h2>
    </div>

    <?php /* Grid */ ?>
    <div class="flex flex-col gap-3">

      <?php foreach ($rows as $row) :
        $cols = $col_classes[$row['layout']];
      ?>
      <div class="grid grid-cols-1 gap-3 sm:grid-cols-12">
        <?php foreach ($row['cards'] as $ci => $card) : ?>

        <article class="pg-bento-card <?php echo esc_attr($cols[$ci]); ?>"
                 style="min-height:280px">

          <?php /* ── Text zone ──────────────────────── */ ?>
          <div class="pg-bento-text">
            <span class="pg-bento-label"><?php echo esc_html($card['img_alt']); ?></span>
            <h3 class="pg-bento-h"><?php echo wp_kses_post($card['title']); ?></h3>
          </div>

          <?php /* ── Separator rule ───────────────────── */ ?>
          <div class="pg-bento-rule" aria-hidden="true"></div>

          <?php /* ── Image zone ──────────────────────── */ ?>
          <div class="pg-bento-img">
            <img src="<?php echo esc_url($card['img_src']); ?>"
                 alt=""
                 loading="lazy"
                 decoding="async"
                 class="<?php echo esc_attr($card['img_pos']); ?>">
          </div>

        </article>

        <?php endforeach; ?>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>


<!-- ════════════════════════════════════════════════════
     SECTION 7b · INDUSTRIES (sticky scroll)
════════════════════════════════════════════════════ -->

<?php
$atmos2 = [
  /* 0 Healthcare — cyan / teal */
  'radial-gradient(ellipse 68% 52% at 88% 44%, rgba(92,195,250,.17) 0%, transparent 58%),
   radial-gradient(ellipse 52% 42% at 12% 26%, rgba(0,97,85,.20)    0%, transparent 58%)',
  /* 1 Government — deep teal */
  'radial-gradient(ellipse 68% 52% at 88% 50%, rgba(0,97,85,.30)    0%, transparent 58%),
   radial-gradient(ellipse 52% 42% at 12% 28%, rgba(0,70,60,.22)    0%, transparent 60%)',
  /* 2 Finance — warm amber */
  'radial-gradient(ellipse 68% 52% at 88% 54%, rgba(200,140,20,.18) 0%, transparent 58%),
   radial-gradient(ellipse 52% 42% at 12% 30%, rgba(135,82,0,.20)   0%, transparent 58%)',
  /* 3 Technology — brand green */
  'radial-gradient(ellipse 68% 52% at 88% 48%, rgba(152,196,65,.18) 0%, transparent 58%),
   radial-gradient(ellipse 52% 42% at 12% 26%, rgba(0,97,85,.22)    0%, transparent 58%)',
  /* 4 Legal — cool blue */
  'radial-gradient(ellipse 68% 52% at 88% 50%, rgba(60,130,210,.16) 0%, transparent 58%),
   radial-gradient(ellipse 52% 42% at 12% 28%, rgba(0,60,120,.14)   0%, transparent 60%)',
];
?>

<section class="relative bg-[#080F0F] pt-24 sm:pt-32 lg:pt-40" id="industries" aria-label="Industries we serve">

  <?php /* Top-entry bloom */ ?>
  <div class="pointer-events-none absolute inset-x-0 top-0 h-40" aria-hidden="true"
       style="background:radial-gradient(ellipse 60% 100% at 50% 0%, rgba(152,196,65,.10) 0%, transparent 70%)"></div>

  <?php /* ── Per-industry atmosphere layers ── */ ?>
  <div id="featAtmos2" aria-hidden="true">
    <?php foreach ($atmos2 as $ai => $bg) : ?>
    <div class="feat-atmo" style="opacity:<?php echo $ai === 0 ? '1' : '0'; ?>;background:<?php echo $bg; ?>"></div>
    <?php endforeach; ?>
  </div>

  <?php /* ── Section header ── */ ?>
  <div class="relative z-10 mx-auto max-w-[1200px] px-6 lg:px-14 pt-20 pb-1 lg:pt-28">
    <div class="inline-flex items-stretch overflow-hidden border border-[#98C441]/20">
      <div class="w-[2.5px] self-stretch bg-[#98C441]/55 flex-shrink-0"></div>
      <div class="flex items-center gap-2 px-3 py-[7px]">
        <span class="text-[10px] font-bold tracking-[.15em] uppercase text-[#98C441]/65">Industries</span>
      </div>
    </div>
    <h2 class="mt-4 text-[clamp(2rem,4.2vw,3.4rem)] font-extrabold leading-[1.08] tracking-[-0.042em] text-[#F2EFE9] max-w-[640px]">
      Built for the sectors where<br>
      precision is&nbsp;everything
    </h2>
  </div>

  <?php /* ── Two-column layout (images LEFT · copy RIGHT — mirrored from §7) ── */ ?>
  <div class="relative z-10 mx-auto max-w-[1200px] px-6 lg:px-14 lg:grid lg:grid-cols-2 lg:gap-24 lg:items-start">

    <?php /* ── LEFT · scrolling image steps ── */ ?>
    <div class="py-4 lg:py-[10vh]" id="featRight2">
      <?php foreach ($features2 as $i => $f) : ?>
      <div class="feature-step2 flex min-h-screen items-center" data-step2="<?php echo $i; ?>">
        <div class="w-full">

          <?php /* Mobile copy */ ?>
          <div class="mb-7 lg:hidden">
            <div class="mb-3 flex items-center justify-between">
              <p class="text-[10px] font-bold uppercase tracking-[.16em] text-[#98C441]/60"><?php echo esc_html($f['label']); ?></p>
              <span class="text-[10.5px] tabular-nums text-white/24"><?php printf('%02d / %02d', $i + 1, count($features2)); ?></span>
            </div>
            <h3 class="text-[clamp(1.75rem,2.5vw,2.5rem)] font-extrabold leading-[1.15] tracking-[-0.038em] text-[#F2EFE9] mb-3">
              <?php echo wp_kses_post($f['heading']); ?>
            </h3>
            <p class="text-[13px] text-white/44"><?php echo esc_html($f['tag']); ?></p>
          </div>

          <?php /* Image card */ ?>
          <div class="feat-img-card">
            <div class="feat-glow-orb"
                 style="background:radial-gradient(50% 50%, <?php echo esc_attr($f['glow']); ?> 0%, transparent 100%); opacity:.60;"
                 aria-hidden="true"></div>
            <img src="<?php echo esc_url($f['img_src']); ?>"
                 alt="<?php echo esc_attr($f['img_alt']); ?>"
                 loading="lazy" decoding="async">
          </div>

          <?php /* Caption */ ?>
          <div class="feat-caption" aria-hidden="true">
            <span class="text-[10.5px] font-semibold tracking-[.09em] uppercase text-white/22"><?php echo esc_html($f['label']); ?></span>
            <span class="text-[10.5px] tabular-nums text-white/18"><?php printf('%02d&thinsp;/&thinsp;%02d', $i + 1, count($features2)); ?></span>
          </div>

        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <?php /* ── RIGHT · sticky copy ── */ ?>
    <div class="hidden lg:flex lg:sticky lg:top-0 lg:h-screen lg:items-center lg:order-last">
      <div class="relative w-full max-w-[460px]">

        <?php /* Nav pip track */ ?>
        <nav class="absolute -right-8 top-1/2 -translate-y-1/2 flex flex-col items-center gap-[9px]"
             id="featDots2" aria-label="Industry navigation"></nav>

        <?php /* Copy panels */ ?>
        <div class="relative" id="copyStack2">
          <?php foreach ($features2 as $i => $f) : ?>
          <div class="copy-panel<?php echo $i === 0 ? ' on' : ''; ?>" data-idx2="<?php echo $i; ?>">

            <div class="mb-5 flex items-center justify-between">
              <p class="text-[10px] font-bold uppercase tracking-[.16em] text-[#98C441]/60"><?php echo esc_html($f['label']); ?></p>
              <span class="feat-counter"><?php printf('%02d&thinsp;/&thinsp;%02d', $i + 1, count($features2)); ?></span>
            </div>

            <h3 class="mb-5 text-[clamp(1.75rem,2.5vw,2.5rem)] font-extrabold leading-[1.15] tracking-[-0.038em] text-[#F2EFE9]">
              <?php echo wp_kses_post($f['heading']); ?>
            </h3>

            <div class="feat-tag-row">
              <span class="text-[12.5px] font-semibold tracking-[.005em] text-white/48"><?php echo esc_html($f['tag']); ?></span>
            </div>

            <div class="space-y-3.5 max-w-[420px] text-[14.5px] leading-[1.88] text-white/50">
              <?php echo wp_kses_post($f['body']); ?>
            </div>

            <?php if ($f['cta']) : ?>
            <a href="<?php echo esc_url($f['cta']['href']); ?>"
               class="group mt-8 inline-flex items-center gap-2 text-[13.5px] font-semibold text-[#98C441]
                      transition-all duration-200 hover:gap-3.5
                      focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2 focus-visible:ring-offset-[#080F0F]">
              <?php echo esc_html($f['cta']['label']); ?>
              <svg width="14" height="12" viewBox="0 0 14 12" fill="none" aria-hidden="true" focusable="false"
                   class="transition-transform duration-200 group-hover:translate-x-1">
                <path d="M1 6h12M8 1.5L13 6l-5 4.5" stroke="currentColor" stroke-width="1.65" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </a>
            <?php endif; ?>

          </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>

  </div>
</section>


<!-- ════════════════════════════════════════════════════
     JS: Section 7b — industries sticky + atmosphere
════════════════════════════════════════════════════ -->
<script>
(function () {
  var section = document.getElementById('industries');
  if (!section) return;

  var steps  = section.querySelectorAll('.feature-step2');
  var panels = section.querySelectorAll('[data-idx2]');
  var atmos  = document.getElementById('featAtmos2')
               ? document.getElementById('featAtmos2').querySelectorAll('.feat-atmo') : [];
  var dotsEl = document.getElementById('featDots2');
  if (!steps.length || !dotsEl) return;

  var cur = -1;

  var pips = Array.from({ length: steps.length }, function(_, i) {
    var btn = document.createElement('button');
    btn.className = 'feat-pip' + (i === 0 ? ' on' : '');
    btn.setAttribute('aria-label', 'Go to industry ' + (i + 1));
    btn.addEventListener('click', function() {
      steps[i].scrollIntoView({ behavior: 'smooth', block: 'center' });
    });
    dotsEl.appendChild(btn);
    return btn;
  });

  function activate(idx) {
    if (idx === cur) return;
    cur = idx;
    panels.forEach(function(p, i) {
      var on = i === idx;
      p.style.opacity       = on ? '1'               : '0';
      p.style.transform     = on ? 'translateY(0px)' : 'translateY(16px)';
      p.style.position      = on ? 'relative'        : 'absolute';
      p.style.pointerEvents = on ? 'auto'            : 'none';
    });
    pips.forEach(function(pip, i) { pip.classList.toggle('on', i === idx); });
    steps.forEach(function(s, i) { s.classList.toggle('is-active', i === idx); });
    atmos.forEach(function(a, i) { a.style.opacity = i === idx ? '1' : '0'; });
  }

  if (!('IntersectionObserver' in window)) { activate(0); return; }

  var io = new IntersectionObserver(function(entries) {
    entries.forEach(function(e) {
      if (e.isIntersecting) activate(Number(e.target.dataset.step2));
    });
  }, { rootMargin: '-35% 0px -35% 0px', threshold: 0 });

  steps.forEach(function(s) { io.observe(s); });
  activate(0);
})();
</script>


<?php
/* ─── Section 9 · Testimonials ──────────────────────────────
   ACF migration: swap static values for get_field() calls.
   Each entry maps 1-to-1 to a repeater row.                  */
$testimonials = [
  [
    'company'    => 'Pfizer',
    'dot'        => '#98C441',
    'initials'   => 'SM',
    'name'       => 'Sarah Mitchell',
    'role'       => 'Senior Director of Global Operations',
    'quote_html' => 'I want my team to have <span class="pg-hl">the best language services&nbsp;available</span> to them. Things that make their work easier and more precise. <span class="pg-hl">Piedmont Global is the partner for the&nbsp;job.</span>',
    'learn_href' => '#',
  ],
  [
    'company'    => 'Deloitte',
    'dot'        => '#A8D44A',
    'initials'   => 'JR',
    'name'       => 'James Reynolds',
    'role'       => 'VP of International Compliance',
    'quote_html' => 'Piedmont Global manages our <span class="pg-hl">global compliance translations</span> with exceptional precision. Teams across <span class="pg-hl">twelve countries rely on them every day.</span>',
    'learn_href' => '#',
  ],
  [
    'company'    => 'HHS',
    'dot'        => '#7AB520',
    'initials'   => 'AK',
    'name'       => 'Angela Kim',
    'role'       => 'Director of Language Access Programs',
    'quote_html' => 'For health communication across languages, accuracy isn\'t optional. <span class="pg-hl">Piedmont Global delivers exactly that</span> — reliably, at scale, across <span class="pg-hl">every program we run.</span>',
    'learn_href' => '#',
  ],
];
?>

<!-- ════════════════════════════════════════════════════
     SECTION 9 · TESTIMONIAL + PHOTO STRIP + CTA BAR
════════════════════════════════════════════════════ -->

<style>
/* ── Glass chip highlight ─────────────────────────────────── */
.pg-hl {
  display: inline;
  background: linear-gradient(135deg,
    rgba(0,97,85,.26) 0%,
    rgba(152,196,65,.16) 100%);
  border-radius: 8px;
  padding: 4px 12px 5px 10px;
  color: #F2EFE9;
  box-shadow:
    inset 0 1.5px 0 rgba(255,255,255,.07),
    inset 0 0 0 1px rgba(152,196,65,.18),
    0 4px 20px rgba(0,97,85,.14);
}

/* ── Photo strip ──────────────────────────────────────────── */
.pg-photo-thumb {
  position: relative; overflow: hidden;
  border-radius: 18px;
  aspect-ratio: 4 / 3;
}
.pg-photo-thumb img {
  display: block; width: 100%; height: 100%; object-fit: cover;
  filter: brightness(.78) saturate(.80);
  transition: filter .5s cubic-bezier(.22,1,.36,1),
              transform .5s cubic-bezier(.22,1,.36,1);
}
.pg-photo-thumb:hover img {
  filter: brightness(.94) saturate(.98);
  transform: scale(1.05);
}
/* Glass edge + bottom vignette */
.pg-photo-thumb::after {
  content: ''; position: absolute; inset: 0; border-radius: 18px;
  background: linear-gradient(to bottom, transparent 55%, rgba(8,15,15,.38) 100%);
  box-shadow: inset 0 0 0 1px rgba(255,255,255,.065);
  pointer-events: none;
}

/* ── CTA bar ──────────────────────────────────────────────── */
.pg-cta-bar {
  position: relative; overflow: hidden;
  background: linear-gradient(102deg,
    #78B21C 0%, #98C441 32%, #AADA4C 68%, #B8E855 100%);
  border: 1px solid rgba(255,255,255,.12);
  box-shadow:
    inset 0 1.5px 0 rgba(255,255,255,.18),
    0 24px 64px rgba(0,0,0,.28);
  transition: filter .18s, box-shadow .22s;
}
.pg-cta-bar::before {
  content: ''; position: absolute; inset: 0;
  background:
    radial-gradient(ellipse 50% 140% at 16% 50%, rgba(255,255,255,.13) 0%, transparent 58%),
    radial-gradient(ellipse 30% 80%  at 88% 50%, rgba(0,0,0,.06)       0%, transparent 65%);
  pointer-events: none;
}
.pg-cta-bar:hover {
  filter: brightness(1.06);
  box-shadow: inset 0 1.5px 0 rgba(255,255,255,.18), 0 32px 80px rgba(0,0,0,.34);
}
.pg-cta-bar:hover .pg-cta-arrow {
  background: rgba(11,26,26,.28);
  transform: translateX(6px);
}
.pg-cta-arrow {
  transition: background .18s, transform .24s cubic-bezier(.22,1,.36,1);
}

/* ── Company badge ────────────────────────────────────────── */
.pg-co-badge {
  display: inline-flex; align-items: center; gap: 9px;
  border: 1px solid rgba(242,239,233,.10);
  background: rgba(255,255,255,.05);
  border-radius: 12px;
  padding: 11px 20px;
  font-size: 13.5px; font-weight: 700; letter-spacing: -.012em;
  color: rgba(242,239,233,.65);
  box-shadow: inset 0 1px 0 rgba(255,255,255,.055);
  transition: border-color .24s, background .24s, color .24s, box-shadow .24s;
}
.pg-co-badge:hover {
  border-color: rgba(152,196,65,.30);
  background: rgba(152,196,65,.06);
  color: rgba(242,239,233,.90);
  box-shadow: inset 0 1px 0 rgba(255,255,255,.065), 0 0 0 1px rgba(152,196,65,.12);
}
.pg-co-badge { cursor: pointer; }
.pg-co-badge--active {
  border-color: rgba(152,196,65,.45);
  background: rgba(152,196,65,.10);
  color: rgba(242,239,233,.96);
  box-shadow:
    inset 0 1px 0 rgba(255,255,255,.09),
    0 0 0 1px rgba(152,196,65,.20),
    0 4px 18px rgba(152,196,65,.08);
}

/* ── Quote crossfade ──────────────────────────────────────── */
.testi-quote {
  transition: opacity .18s ease;
}
.testi-quote--out {
  opacity: 0 !important;
}

.pg-co-badge-dot {
  display: block; width: 7px; height: 7px;
  border-radius: 50%; flex-shrink: 0;
  box-shadow: 0 0 6px currentColor;
}
</style>

<section class="relative overflow-hidden bg-[#080F0F] pb-24"
         aria-label="Client testimonial">

  <?php /* Rich atmosphere: deep teal sweep left, ghost green right */ ?>
  <div class="pointer-events-none absolute inset-0" aria-hidden="true" style="background:
    radial-gradient(ellipse 70% 60% at 8%  50%, rgba(0,97,85,.24)    0%, transparent 58%),
    radial-gradient(ellipse 48% 42% at 92% 18%, rgba(152,196,65,.08) 0%, transparent 56%),
    radial-gradient(ellipse 55% 35% at 50% 88%, rgba(0,97,85,.10)    0%, transparent 65%);"></div>

  <div class="relative z-10 mx-auto max-w-[1200px]">

    <?php /* ── Quote mark image ── */ ?>
    <div class="mb-7" aria-hidden="true">
      <img src="https://framerusercontent.com/images/9gOOXodO4dGLO6w5Bq3wSUZpmjo.png?width=276&height=224"
           alt="" width="64" height="52"
           class="h-auto w-[64px] object-contain opacity-60 select-none pointer-events-none">
    </div>

    <?php /* ── Eyebrow ── */ ?>
    <div class="mb-8">
      <div class="inline-flex items-stretch overflow-hidden border border-[#98C441]/20">
        <div class="w-[2.5px] self-stretch bg-[#98C441]/55 flex-shrink-0"></div>
        <div class="flex items-center gap-2 px-3 py-[7px]">
          <span class="text-[10px] font-bold tracking-[.15em] uppercase text-[#98C441]/65">What clients are saying</span>
        </div>
      </div>
    </div>

    <?php /* ── Pull quote — seeded from index 0; JS swaps on badge click ── */ ?>
    <blockquote id="testi-quote"
                class="testi-quote mb-12 text-[clamp(1.5rem,2.6vw,2.5rem)]
                       font-extrabold leading-[1.22] tracking-[-0.032em] text-[#F2EFE9]">
      <?php echo wp_kses_post($testimonials[0]['quote_html']); ?>
    </blockquote>

    <?php /* ── Meta row: author LEFT · badges RIGHT ── */ ?>
    <div class="mb-16 flex flex-wrap items-center justify-between gap-y-6">

      <?php /* ── Left: avatar + name/role + hairline + learn more ── */ ?>
      <div class="flex items-center">

        <?php /* Avatar with outer glow ring */ ?>
        <div class="relative shrink-0">
          <div class="absolute -inset-[3px] rounded-full opacity-40"
               style="background:conic-gradient(rgba(152,196,65,.55) 0deg, rgba(0,97,85,.25) 180deg, rgba(152,196,65,.55) 360deg)"
               aria-hidden="true"></div>
          <div id="testi-avatar"
               class="relative flex h-[50px] w-[50px] items-center justify-center rounded-full
                      bg-gradient-to-br from-[#3A5245] to-[#2A3E34]
                      text-[12.5px] font-bold tracking-[.02em] text-[#F2EFE9]/78
                      ring-1 ring-black/40 transition-opacity duration-150">
            <?php echo esc_html($testimonials[0]['initials']); ?>
          </div>
        </div>

        <?php /* Name + role */ ?>
        <div class="ml-4">
          <p id="testi-name" class="text-[14.5px] font-semibold leading-tight text-[#F2EFE9]/92 transition-opacity duration-150">
            <?php echo esc_html($testimonials[0]['name']); ?>
          </p>
          <p id="testi-role" class="mt-[3px] text-[12px] leading-snug text-white/34 transition-opacity duration-150">
            <?php echo esc_html($testimonials[0]['role']); ?>
          </p>
        </div>

        <?php /* Hairline rule */ ?>
        <div class="mx-7 h-10 w-px"
             style="background:linear-gradient(to bottom, transparent, rgba(255,255,255,.12), transparent)"
             aria-hidden="true"></div>

        <?php /* Learn more */ ?>
        <a href="#"
           class="group inline-flex items-center gap-2 text-[13.5px] font-medium text-white/40
                  transition-colors duration-200 hover:text-white/75
                  focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2 focus-visible:ring-offset-[#080F0F]">
          Learn more
          <svg width="15" height="12" viewBox="0 0 15 12" fill="none" aria-hidden="true"
               class="transition-transform duration-200 group-hover:translate-x-1.5">
            <path d="M8 1L14 6m0 0L8 11M14 6H1"
                  stroke="currentColor" stroke-width="1.65"
                  stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>

      </div>

      <?php /* ── Right: company badges (clickable — switches testimonial) ── */ ?>
      <div class="flex flex-wrap items-center gap-3" role="group" aria-label="Switch testimonial by company">
        <?php foreach ($testimonials as $ti => $t) : ?>
        <button type="button"
                class="pg-co-badge testi-badge<?php echo $ti === 0 ? ' pg-co-badge--active' : ''; ?>"
                data-testi="<?php echo $ti; ?>"
                aria-pressed="<?php echo $ti === 0 ? 'true' : 'false'; ?>">
          <span class="pg-co-badge-dot"
                style="background:<?php echo esc_attr($t['dot']); ?>; color:<?php echo esc_attr($t['dot']); ?>"
                aria-hidden="true"></span>
          <?php echo esc_html($t['company']); ?>
        </button>
        <?php endforeach; ?>
      </div>

    </div>

    <?php /* ── Photo strip ── */ ?>
    <?php
    $photos = [
      ['src' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=900&q=85',  'alt' => 'Mountain landscape at dusk'],
      ['src' => 'https://images.unsplash.com/photo-1501854140801-50d01698950b?w=900&q=85',  'alt' => 'Aerial view of misty mountains'],
      ['src' => 'https://images.unsplash.com/photo-1523712999610-f77fbcfc3843?w=900&q=85',  'alt' => 'Sunlit forest road'],
      ['src' => 'https://images.unsplash.com/photo-1511300636408-a63a89df3482?w=900&q=85',  'alt' => 'Foggy mountain valley'],
    ];
    ?>
    <div class="grid grid-cols-2 gap-2 sm:grid-cols-4">
      <?php foreach ($photos as $i => $photo) : ?>
      <div class="pg-photo-thumb <?php echo $i % 2 === 1 ? 'mt-4' : ''; ?>">
        <img src="<?php echo esc_url($photo['src']); ?>"
             alt="<?php echo esc_attr($photo['alt']); ?>"
             loading="lazy" decoding="async">
      </div>
      <?php endforeach; ?>
    </div>

    <?php /* ── CTA bar ── */ ?>
    <a href="#contact"
       class="pg-cta-bar mt-2 flex items-center justify-between rounded-[22px] px-10 py-10 sm:px-16"
       aria-label="Get started with Piedmont Global">
      <span class="relative z-10 text-[clamp(2rem,4.2vw,3.4rem)] font-extrabold
                   tracking-[-0.040em] text-[#0A1A1A]">
        Get Started
      </span>
      <div class="pg-cta-arrow relative z-10 flex h-[62px] w-[62px] shrink-0 items-center
                  justify-center rounded-full bg-[rgba(10,26,26,.16)]
                  ring-1 ring-[rgba(10,26,26,.10)]">
        <svg width="24" height="20" viewBox="0 0 24 20" fill="none" aria-hidden="true">
          <path d="M13 1L23 10m0 0L13 19M23 10H1"
                stroke="#0A1A1A" stroke-width="2.2"
                stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
    </a>

  </div>
</section>

<script>
/* ── Section 9 · Testimonial switcher ───────────────────────
   Click any company badge to cross-fade the quote and swap
   the author. Data is seeded from PHP for easy ACF migration:
   replace the json_encode() value with get_field() output.   */
(function () {
  var testimonials = <?php echo json_encode(array_values($testimonials), JSON_HEX_TAG | JSON_HEX_AMP); ?>;

  var quoteEl  = document.getElementById('testi-quote');
  var avatarEl = document.getElementById('testi-avatar');
  var nameEl   = document.getElementById('testi-name');
  var roleEl   = document.getElementById('testi-role');
  var badges   = document.querySelectorAll('.testi-badge');
  var cur = -1; /* -1 so the seed call always runs */

  function activateTesti(idx, animate) {
    if (idx === cur) return;
    cur = idx;
    var t = testimonials[idx];

    /* Update badge aria + active class */
    badges.forEach(function (b, i) {
      var on = i === idx;
      b.classList.toggle('pg-co-badge--active', on);
      b.setAttribute('aria-pressed', on ? 'true' : 'false');
    });

    if (!animate) return; /* skip fade on first seed */

    /* Fade out → swap content → fade in */
    quoteEl.classList.add('testi-quote--out');
    setTimeout(function () {
      quoteEl.innerHTML   = t.quote_html;
      avatarEl.textContent = t.initials;
      nameEl.textContent  = t.name;
      roleEl.textContent  = t.role;
      quoteEl.classList.remove('testi-quote--out');
    }, 180);
  }

  badges.forEach(function (b, i) {
    b.addEventListener('click', function () { activateTesti(i, true); });
  });

  activateTesti(0, false); /* seed badge state, no animation */
})();
</script>

<?php get_footer(); ?>