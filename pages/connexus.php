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
    'label'   => 'Interpreter Access',
    'heading' => 'Get a qualified interpreter on the line in under 60 seconds.',
    'tag'     => 'Smart routing that matches language, certification, and specialty automatically.',
    'body'    => '<p>When language access takes too long, callers hang up, clinicians fall behind, agents make the wrong call, and the safety briefing on the plant floor lands on workers who cannot follow it. The cost is a missed appointment, a lost claim, a recordable incident, a regulatory inquiry.</p><p>Connexus routes every request through automatic call distribution filtered by language, certification, specialty, and gender preference. Queue position and wait estimates show before the request goes in. American Sign Language and Spanish are 24/7 video; other languages route through Over-the-Phone or Onsite Interpretation as the workflow requires.</p>',
    'cta'     => null,
    'img_src' => get_template_directory_uri() . '/assets/connexus/qualified-interpreter.png',
    'img_alt' => 'Connexus interpreter routing and queue interface',
    'glow'    => 'rgba(92,195,250,.22)',
  ],
  [
    'label'   => 'Compliance Proof',
    'heading' => 'Prove compliance the moment a regulator asks.',
    'tag'     => 'Audit-ready records, generated automatically.',
    'body'    => '<p>Most organizations cannot produce a clean record of every interpreted encounter from the last twelve months. Records live in different systems. Credentials live in a spreadsheet. Attestation language is missing. When the regulator asks, the answer is "we are working on it."</p><p>Connexus generates a complete call detail record for every session: interpreter credentials, language pair, timestamps, modality, and attestation language structured for the frameworks that govern your work - Title VI, Section 1557, Joint Commission, state Medicaid, OSHA hazard communication, and federal language access mandates. For our healthcare clients, encounter IDs and MRN/FIN capture roll up to Medicaid reimbursement automatically.</p>',
    'cta'     => null,
    'img_src' => get_template_directory_uri() . '/assets/connexus/compliance2.png',
    'img_alt' => 'Connexus audit-ready compliance records interface',
    'glow'    => 'rgba(158,110,230,.25)',
  ],
  [
    'label'   => 'Capacity Visibility',
    'heading' => 'See the bottleneck before it becomes one.',
    'tag'     => 'Real-time capacity across every language and channel.',
    'body'    => '<p>Most teams learn they were short on Mandarin coverage after the third request stacks up in queue. They find out Karen demand is spiking after a community partner calls to complain. By the time the report runs, the surge is over.</p><p>Connexus surfaces a real-time capacity heatmap at 15-minute intervals, broken out by language, channel, and service area. Critical and high-risk intervals trigger alerts. Operations staffs against what is coming, not what already happened.</p>',
    'cta'     => null,
    'img_src' => get_template_directory_uri() . '/assets/connexus/analytics.png',
    'img_alt' => 'Connexus real-time capacity and analytics dashboard',
    'glow'    => 'rgba(250,117,248,.22)',
  ],
  [
    'label'   => 'Cost Reconciliation',
    'heading' => 'Reconcile interpretation costs to the call, not the invoice.',
    'tag'     => 'Usage-based pricing tied to every minute used.',
    'body'    => '<p>Most interpretation contracts charge a monthly platform fee on top of per-minute rates. Volume-variable buyers - FQHCs, school districts, multi-plant manufacturers, surge clients - end up subsidizing buyers with predictable demand. The invoice arrives as a single line item with no way to attribute cost to the department, plant, or location that generated it.</p><p>Connexus bills per minute used, reconciled to call detail records, with no platform fees on top. Cost attribution by department, plant, location, and (for healthcare clients) encounter is native to the platform. Finance reconciles in minutes, not days.</p>',
    'cta'     => null,
    'img_src' => get_template_directory_uri() . '/assets/connexus/reconcile.png',
    'img_alt' => 'Connexus cost reconciliation and usage reporting interface',
    'glow'    => 'rgba(250,204,105,.22)',
  ],
];

/* Logo marquee — 8 SVG slots, repeated by the marquee loop */
$logo_count = 8;

/* ─── Section 7b · Unified platform ──────────────────── */
$features2 = [
  [
    'label'   => 'One Platform',
    'heading' => 'Run one platform across every modality and every team.',
    'tag'     => 'One pane of glass for AI and human interpretation.',
    'body'    => '<p>Most language access programs stitch together separate vendors for phone, video, onsite, and AI. Each has its own portal, its own SLA, its own invoice. Operations cannot see capacity in one view. Finance cannot reconcile against one source. Compliance cannot pull from one record.</p><p>Connexus delivers Over-the-Phone, Video Remote, Onsite, and Speech-to-Speech AI Interpretation through one dashboard, one SLA, one set of audit logs. Same accuracy reporting across every modality. Same credentialing across every interpreter. One platform replaces the sprawl.</p>',
    'cta'     => null,
    'img_src' => 'https://framerusercontent.com/images/lFhfMRQo5RH0Thw2igSZaeXOsrk.png?scale-down-to=1024&width=2700&height=2198',
    'img_alt' => 'Unified interpretation platform dashboard',
    'glow'    => 'rgba(92,195,250,.20)',
  ],
  [
    'label'   => 'Embedded Workflow',
    'heading' => 'Show up inside the workflow that already exists.',
    'tag'     => 'Embedded at the system of record.',
    'body'    => '<p>New tools that sit outside the workflow do not get used. Clinicians will not switch screens to launch an interpretation session. Contact center agents will not leave the queue to dial out. A safety officer will not open a separate portal to schedule a Karen interpreter for tomorrow\'s shift change.</p><p>Connexus lives inside the workflow your team already runs. For contact center and enterprise teams, native SIP integration and embedded controls inside Twilio Flex, Genesys, Five9, NICE, Talkdesk, and Amazon Connect put interpretation a click away from the agent\'s screen. And for our healthcare clients, Epic SMART on FHIR (in final certification) launches interpretation directly from the patient chart.</p>',
    'cta'     => null,
    'img_src' => 'https://framerusercontent.com/images/tIy3VlZuPyD8qjM1ivJXb332aNk.png?scale-down-to=1024&width=1350&height=1080',
    'img_alt' => 'Embedded interpretation workflow',
    'glow'    => 'rgba(0,97,85,.28)',
  ],
];
$pills_r1 = ['Community Healthcare','Healthcare','Manufacturing','K-12 Education','Government','Contact Centers'];
$pills_r2 = ['Contact Centers','Government','K-12 Education','Manufacturing','Healthcare','Community Healthcare'];

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
  background:
    linear-gradient(180deg, rgba(255,255,255,.070), rgba(255,255,255,.024)),
    radial-gradient(circle at 50% 0%, rgba(152,196,65,.10), transparent 62%);
  border: 1px solid rgba(242,239,233,.10);
  box-shadow:
    inset 0 1px 0 rgba(255,255,255,.10),
    inset 0 -1px 0 rgba(0,0,0,.12),
    0 14px 38px rgba(0,0,0,.20);
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

/* ── Speed section: floating screenshot card ─────────── */
.speed-screen-card {
  position: relative; overflow: hidden;
  border-radius: 20px;
  background: #0C1C1C;
  border: 1px solid rgba(242,239,233,.07);
  box-shadow:
    inset 0 1.5px 0 rgba(255,255,255,.06),
    0 0 0 1px rgba(0,0,0,.2),
    0 50px 120px rgba(0,0,0,.6),
    0 20px 52px rgba(0,0,0,.36);
}
/* Top edge accent — same glass language as other cards */
.speed-screen-card::before {
  content: ''; position: absolute; inset-inline: 0; top: 0; height: 1px;
  background: linear-gradient(to right,
    transparent 5%,
    rgba(152,196,65,.22) 35%,
    rgba(152,196,65,.16) 65%,
    transparent 95%);
  z-index: 10; pointer-events: none;
}
/* Viewport — hugs the active screenshot: full width, natural height, no fixed
   ratio. The active image sits in flow and defines the card height; the others
   overlay absolutely during the crossfade. Nothing is ever cropped or cut. */
.speed-screen-viewport {
  position: relative;
  overflow: hidden;
  border-radius: inherit;
  background: #0C1C1C;
}
.speed-screen-viewport .speed-img {
  position: absolute; inset: 0;
  display: block;
  width: 100%;
  height: 100%;
  object-fit: contain;           /* full screenshot during crossfade, no crop */
  object-position: center;
  z-index: 1;
}
.speed-screen-viewport .speed-img.is-active {
  position: relative;            /* in flow → container hugs this image */
  height: auto;                  /* natural height = full image, no letterbox */
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

  <div class="relative z-10 mx-auto max-w-6xl px-6 pb-10 pt-24 text-center lg:pb-14 lg:pt-32">

    <div class="mb-8 flex justify-center">
      <div class="inline-flex items-stretch overflow-hidden border border-[#98C441]/20">
        <div class="w-[2.5px] self-stretch bg-[#98C441]/55 flex-shrink-0"></div>
        <div class="flex items-center gap-2 px-3 py-[7px]">
          <span class="text-[10px] font-bold tracking-[.15em] uppercase text-[#98C441]/65">Language Services &amp; Strategic Growth</span>
        </div>
      </div>
    </div>

    <h1 class="text-[clamp(2.35rem,5.7vw,3.85rem)]  mx-auto max-w-2xl font-extrabold leading-[1.03] tracking-[-0.045em] text-[#F2EFE9] drop-shadow-[0_18px_60px_rgba(0,0,0,.28)]">
    Connect every conversation, in every language, in seconds.
    </h1>

    <p class="mx-auto mt-6  text-base font-normal mx-auto max-w-2xl leading-[1.82] text-[#F2EFE9]/58">
    Connexus™ is Piedmont Global's enterprise interpretation management platform. Human interpretation in 300+ languages, real-time AI interpretation for scale, and one portal for scheduling, billing, compliance, and reporting - delivered under one SLA.    </p>

    <div class="mt-11 flex flex-wrap items-center justify-center gap-2.5">
      <a href="#contact"
        class="inline-flex items-center gap-1.5 rounded-[8px] bg-[#98C441] px-[22px] py-[11px] text-base font-bold text-[#080F0F] transition
          [box-shadow:inset_0_1px_0_rgba(255,255,255,.28),inset_0_-1px_0_rgba(0,0,0,.12),0_1px_3px_rgba(0,0,0,.3),0_4px_18px_rgba(152,196,65,.22)]
          hover:-translate-y-px hover:bg-[#A6D34E]
          hover:[box-shadow:inset_0_1px_0_rgba(255,255,255,.30),inset_0_-1px_0_rgba(0,0,0,.12),0_1px_3px_rgba(0,0,0,.3),0_8px_24px_rgba(152,196,65,.30)]
          focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2 focus-visible:ring-offset-[#080F0F]">
          Book a Demo
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true" focusable="false">
          <path d="M2 6h8M6.5 3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
      <a href="#solutions"
        class="inline-flex items-center gap-1.5 rounded-[8px] border border-white/[.09] px-[18px] py-[11px] text-base font-medium text-[#F2EFE9]/50 transition
          hover:border-white/[.18] hover:text-[#F2EFE9]/82
          focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/20">
          Download Technical Requirements
        <svg width="11" height="11" viewBox="0 0 11 11" fill="none" aria-hidden="true" focusable="false">
          <path d="M3.5 2l4 3.5-4 3.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
    </div>

    <?php
    $avatars = [
      ['initials' => 'JL', 'bg' => '#2D4C3A'],
      ['initials' => 'MR', 'bg' => '#2A3E4C'],
      ['initials' => 'AK', 'bg' => '#3C4A2E'],
      ['initials' => 'TP', 'bg' => '#3A2D4A'],
    ];
    ?>
    <div class="mt-8 flex justify-center">
      <div class="inline-flex items-center gap-[14px] rounded-full border border-white/[.07] bg-white/[.04] py-2.5 pl-2.5 pr-5">
        <div class="flex items-center" aria-hidden="true">
          <?php foreach ($avatars as $i => $av) : ?>
          <span class="flex h-[28px] w-[28px] items-center justify-center rounded-full border-2 border-[#080F0F] text-[8.5px] font-bold text-[#F2EFE9]/65 <?php echo $i > 0 ? '-ml-2' : ''; ?>"
                style="background:<?php echo esc_attr($av['bg']); ?>; position:relative; z-index:<?php echo 10 - $i; ?>">
            <?php echo esc_html($av['initials']); ?>
          </span>
          <?php endforeach; ?>
        </div>

        <div class="h-[18px] w-px bg-white/[.10]" aria-hidden="true"></div>

        <div class="flex items-center gap-0.5" aria-label="5 stars">
          <?php for ($i = 0; $i < 5; $i++) : ?>
          <svg width="11" height="11" viewBox="0 0 12 12" fill="#98C441" aria-hidden="true">
            <path d="M6 1l1.4 2.8 3.1.45-2.25 2.2.53 3.1L6 8.1l-2.78 1.45.53-3.1L1.5 4.25l3.1-.45z"/>
          </svg>
          <?php endfor; ?>
        </div>

        <div class="h-[18px] w-px bg-white/[.10]" aria-hidden="true"></div>

        <p class="text-[12.5px] font-normal leading-[1.4] tracking-[-0.01em] text-[#F2EFE9]/45">
        Trusted across hospitals and federally qualified health centers, multi-plant manufacturers, K-12 districts, government agencies, and contact centers.
        </p>
      </div>
    </div>

  </div>

  <?php /* ── Product screenshot composition ── */ ?>
  <div class="relative z-10 mx-auto max-w-[1060px] px-4 pb-28 sm:px-6 sm:pb-36">

    <?php /* Atmospheric halo behind the cards */ ?>
    <div class="pointer-events-none absolute -inset-x-16 inset-y-0 rounded-[60px]" aria-hidden="true"
         style="background: radial-gradient(ellipse 70% 60% at 50% 58%, rgba(0,97,85,.28) 0%, transparent 68%);
                filter: blur(4px); opacity: .55;"></div>

    <?php /* ── Primary window · WelcomeModal ── */ ?>
    <div class="relative overflow-hidden rounded-[14px] sm:rounded-[20px]"
         style="background: #0C1C1C;
                box-shadow:
                  0 0 0 1px rgba(255,255,255,.09),
                  inset 0 1.5px 0 rgba(255,255,255,.065),
                  0 54px 140px rgba(0,0,0,.68),
                  0 20px 50px rgba(0,0,0,.40);">

      <?php /* Browser chrome */ ?>
      <div class="flex items-center gap-3 border-b border-white/[.06] px-4 py-[11px]" aria-hidden="true">
        <div class="flex shrink-0 items-center gap-[6px]">
          <span class="block h-[11px] w-[11px] rounded-full" style="background:#FF5F57; opacity:.72"></span>
          <span class="block h-[11px] w-[11px] rounded-full" style="background:#FFBD2E; opacity:.72"></span>
          <span class="block h-[11px] w-[11px] rounded-full" style="background:#28C840; opacity:.72"></span>
        </div>
        <div class="mx-auto flex h-[23px] w-[200px] items-center justify-center rounded-[6px]
                    bg-white/[.055] text-[10px] tracking-[.005em] text-white/26">
          app.connexus.io
        </div>
        <div class="w-[54px] shrink-0" aria-hidden="true"></div>
      </div>

      <?php /* Top-edge accent line */ ?>
      <div class="absolute inset-x-0 top-0 h-px pointer-events-none z-10" aria-hidden="true"
           style="background: linear-gradient(to right, transparent 5%, rgba(152,196,65,.24) 35%, rgba(152,196,65,.18) 65%, transparent 95%);"></div>

      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/connexus/CNX_ADMIN_WelcomeModal.png'); ?>"
           alt="Connexus admin dashboard — platform overview and welcome screen"
           loading="eager" decoding="async"
           width="2165" height="1483"
           class="block w-full select-none">

    </div>

    <?php /* Bottom fade — dissolves screenshot into the marquee section */ ?>
    <div class="pointer-events-none absolute inset-x-0 bottom-0 h-44 sm:h-56" aria-hidden="true"
         style="background: linear-gradient(to bottom, transparent 0%, rgba(8,15,15,.55) 40%, #080F0F 88%);"></div>

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
    Behind every interpreted encounter at Piedmont Global - across hospitals and health centers, K-12 classrooms, manufacturing floors, government agencies, and contact center queues.
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
  padding: 12px 24px;
  font-size: 13px; font-weight: 650; letter-spacing: -.01em;
  border: 1px solid rgba(242,239,233,.105);
  background:
    linear-gradient(180deg, rgba(255,255,255,.070), rgba(255,255,255,.025)),
    radial-gradient(ellipse 90% 120% at 50% 0%, rgba(152,196,65,.075), transparent 62%);
  color: rgba(242,239,233,.58);
  box-shadow:
    inset 0 1px 0 rgba(255,255,255,.12),
    inset 0 -1px 0 rgba(0,0,0,.14),
    0 12px 34px rgba(0,0,0,.20);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  transition: border-color .32s, color .32s, box-shadow .32s,
              background .32s, transform .32s cubic-bezier(.22,1,.36,1);
}
.pg-pill:hover {
  border-color: rgba(152,196,65,.34);
  background:
    linear-gradient(180deg, rgba(255,255,255,.090), rgba(255,255,255,.035)),
    radial-gradient(ellipse 90% 120% at 50% 0%, rgba(152,196,65,.13), transparent 62%);
  color: rgba(242,239,233,.92);
  box-shadow:
    inset 0 1px 0 rgba(255,255,255,.14),
    inset 0 -1px 0 rgba(0,0,0,.14),
    0 0 0 1px rgba(152,196,65,.13),
    0 18px 42px rgba(0,0,0,.24),
    0 0 34px rgba(152,196,65,.10);
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
  background:
    linear-gradient(145deg, rgba(255,255,255,.070) 0%, rgba(255,255,255,.026) 100%),
    radial-gradient(ellipse 100% 140% at 50% 0%, rgba(0,120,104,.38), transparent 68%);
  border-color: rgba(0,160,128,.25);
  color: rgba(190,250,232,.78);
  box-shadow:
    inset 0 1.5px 0 rgba(255,255,255,.13),
    inset 0 -1px 0 rgba(0,0,0,.14),
    0 0 34px rgba(0,105,90,.20),
    0 14px 36px rgba(0,0,0,.22);
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
  background:
    linear-gradient(145deg, rgba(255,255,255,.075) 0%, rgba(255,255,255,.028) 100%),
    radial-gradient(ellipse 100% 140% at 50% 0%, rgba(152,196,65,.25), transparent 68%);
  border-color: rgba(152,196,65,.30);
  color: rgba(226,255,154,.82);
  box-shadow:
    inset 0 1.5px 0 rgba(255,255,255,.13),
    inset 0 -1px 0 rgba(0,0,0,.12),
    0 0 34px rgba(152,196,65,.15),
    0 14px 36px rgba(0,0,0,.22);
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
  <div class="relative z-10 mx-auto max-w-5xl text-center">

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
    Language access has quietly become operationally critical.
    </h2>

    <?php /* Body */ ?>
    <div class="mx-auto mt-8  space-y-4 text-center text-[clamp(.95rem,1.4vw,1.08rem)] font-light leading-[1.88] text-[#F2EFE9]/52">
      <p>Every patient enrollment, every contact center call, every classroom conversation, every safety briefing on the plant floor now has a language access dimension. Compliance assumes it. Workers depend on it. Audit logs have to prove it. And most organizations are still managing it with a dial-in number and a scheduling spreadsheet.</p>
      <p>It is not anyone's fault. The industry has worked this way for decades. With Connexus, that changes.</p>
    </div>

  </div>

  <?php /* ── Eyebrow separating copy from pills ── */ ?>
  <div class="relative z-10 mx-auto mt-20 mb-14 flex justify-center">
    <div class="inline-flex items-stretch overflow-hidden border border-[#98C441]/20">
      <div class="w-[2.5px] self-stretch bg-[#98C441]/55 flex-shrink-0"></div>
      <div class="flex items-center gap-2 px-3 py-[7px]">
        <span class="text-[10px] font-bold tracking-[.15em] uppercase text-[#98C441]/65">Sectors &amp; Functions</span>
      </div>
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
    'num'     => '01',
    'label'   => 'Outcome 1',
    'head'    => "Instant clinical-grade\ninterpretation",
    'sub'     => 'Connect to a qualified interpreter in seconds, not minutes. Across 300+ languages, delivered in the modality your workflow requires.',
    'img_src' => get_template_directory_uri() . '/assets/connexus/appointments.png',
    'img_alt' => 'Connexus appointments and interpreter scheduling interface',
    'glow'    => 'rgba(92,195,250,.22)',
  ],
  [
    'num'     => '02',
    'label'   => 'Outcome 2',
    'head'    => "Audit-ready encounter\ndocumentation",
    'sub'     => 'Every interaction automatically recorded for compliance. Title VI, Section 1557, Joint Commission, and state Medicaid requirements embedded in every record.',
    'img_src' => get_template_directory_uri() . '/assets/connexus/compliance.png',
    'img_alt' => 'Connexus compliance and audit-ready documentation interface',
    'glow'    => 'rgba(158,110,230,.25)',
  ],
  [
    'num'     => '03',
    'label'   => 'Outcome 3',
    'head'    => "Scalable language access\ninfrastructure",
    'sub'     => 'Meet demand without expanding headcount. AI Interpreter handles real-time volume; credentialed human interpreters reserved for high-stakes encounters.',
    'img_src' => get_template_directory_uri() . '/assets/connexus/users-roster-detail.png',
    'img_alt' => 'Connexus interpreter roster and capacity management interface',
    'glow'    => 'rgba(250,117,248,.22)',
  ],
];
$speed_total = count($speed_steps);
?>

<!-- ════════════════════════════════════════════════════
     SECTION 5 · SPEED (image + stacking headlines)
════════════════════════════════════════════════════ -->
<section class="relative bg-[#080F0F] px-6 pb-24 sm:pb-32 lg:py-0" id="speed-scroll" aria-label="Speed and responsiveness">
  <div class="pointer-events-none absolute inset-0" aria-hidden="true" style="background:
    radial-gradient(ellipse 55% 45% at 15% 55%, rgba(0,97,85,.25) 0%, transparent 58%),
    radial-gradient(ellipse 50% 40% at 85% 30%, rgba(152,196,65,.12) 0%, transparent 60%),
    linear-gradient(180deg, #080F0F 0%, #0B1A1A 50%, #080F0F 100%)"></div>

  <div class="relative z-10 mx-auto grid max-w-[1360px] grid-cols-1 gap-12 lg:min-h-[300vh] lg:grid-cols-[1.45fr_1fr] lg:gap-20">

    <?php /* ── LEFT · sticky panel ── */ ?>
    <div class="lg:sticky lg:top-0 lg:flex lg:h-screen lg:flex-col lg:items-center lg:justify-center">

      <?php /* Floating screenshot card — crossfades per step */ ?>
      <div class="speed-screen-card mx-auto w-full max-w-[880px]" id="speedImgCard">

        <?php /* Native-ratio viewport — images and glow stack here */ ?>
        <div class="speed-screen-viewport">
          <div id="speedImgGlow" class="feat-glow-orb"
               style="background:radial-gradient(50% 50%, <?php echo esc_attr($speed_steps[0]['glow']); ?> 0%, transparent 100%); opacity:.55;"
               aria-hidden="true"></div>
          <?php foreach ($speed_steps as $si => $s) : ?>
          <img src="<?php echo esc_url($s['img_src']); ?>"
               alt="<?php echo esc_attr($s['img_alt']); ?>"
               loading="<?php echo $si === 0 ? 'eager' : 'lazy'; ?>" decoding="async"
               class="speed-img<?php echo $si === 0 ? ' is-active' : ''; ?>"
               style="opacity:<?php echo $si === 0 ? '1' : '0'; ?>;
                      transition: opacity .65s cubic-bezier(.22,1,.36,1)">
          <?php endforeach; ?>
        </div>

      </div>

      <?php /* Step counter + progress bar */ ?>
      <div class="mt-7 hidden w-full max-w-[880px] items-center gap-4 lg:flex">
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

  <div class="relative z-10 mx-auto grid max-w-[1320px] grid-cols-1 items-center gap-14 lg:grid-cols-[1fr_1.3fr] lg:gap-20">

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
      <h2 class="text-[clamp(2.35rem,5.7vw,3.85rem)] font-extrabold leading-[1.03] tracking-[-0.045em] text-[#F2EFE9]">
        Built to fit the stack you already run.
      </h2>

      <?php /* Supporting copy */ ?>
      <p class="mt-6 text-base leading-[1.84] text-[#F2EFE9]/44">
        Browser-based, AWS-hosted, SAML/SSO-ready. Native SIP and native integration with Twilio Flex, Genesys, Five9, NICE, Talkdesk, and Amazon Connect. And for our healthcare clients, Epic SMART on FHIR (in final certification) and the Redox middleware path to 95+ EHR systems (in progress). Fits the stack you have. No rip-and-replace.
      </p>

      <?php /* Subtle platform chips */ ?>
      <div class="mt-8 flex flex-wrap gap-2" aria-label="Supported platforms">
        <?php foreach (['AWS-hosted','SAML/SSO','Native SIP','Twilio Flex','Genesys','Five9','NICE','Talkdesk','Amazon Connect','Epic SMART on FHIR','Redox'] as $pl) : ?>
        <span class="rounded-[6px] border border-white/[.08] bg-white/[.04] px-3 py-[6px] text-[11.5px] font-medium text-white/38">
          <?php echo esc_html($pl); ?>
        </span>
        <?php endforeach; ?>
      </div>
    </div>

    <?php /* ── Right: image card ── */ ?>
    <div class="flex items-center justify-center lg:justify-end">
      <div class="w-full max-w-[640px]">

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

          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/connexus/test.png'); ?>"
               alt="Connexus integrations and connected platform stack"
               loading="lazy" decoding="async"
               class="relative z-[1] block h-auto w-full opacity-[.86]">
        </div>

      </div>
    </div>

  </div>
</section>



<!-- ════════════════════════════════════════════════════
     SECTION 6b · AI INTERPRETER
════════════════════════════════════════════════════ -->
<section class="relative overflow-hidden bg-[#080F0F] px-6 py-24 sm:py-32 lg:py-40" aria-label="Connexus AI Interpreter">

  <div class="pointer-events-none absolute inset-0" aria-hidden="true" style="background:
    radial-gradient(ellipse 62% 85% at 84% 52%,   rgba(0,97,85,.22)    0%, transparent 55%),
    radial-gradient(ellipse 50% 65% at 16% 44%,   rgba(152,196,65,.08) 0%, transparent 58%),
    radial-gradient(ellipse 70% 35% at 50% -5%,   rgba(152,196,65,.08) 0%, transparent 65%),
    radial-gradient(ellipse 60% 30% at 50% 108%,  rgba(0,97,85,.10)    0%, transparent 68%);"></div>

  <div class="relative z-10 mx-auto grid max-w-[1140px] grid-cols-1 items-center gap-14 lg:grid-cols-2 lg:gap-20">

    <?php /* ── Left: repeated image card ── */ ?>
    <div class="flex items-center justify-center lg:justify-start">
      <div class="w-full max-w-[460px]">
        <div class="relative overflow-hidden rounded-[22px]"
             style="
               background: rgba(12,24,24,.88);
               border: 1px solid rgba(242,239,233,.075);
               box-shadow:
                 inset 0 1.5px 0 rgba(255,255,255,.055),
                 0 32px 90px rgba(0,0,0,.46),
                 0 0 0 1px rgba(0,0,0,.20);
             ">
          <div class="absolute inset-x-0 top-0 h-px pointer-events-none z-10"
               style="background: linear-gradient(to right, transparent 5%, rgba(152,196,65,.30) 35%, rgba(152,196,65,.22) 65%, transparent 95%);"
               aria-hidden="true"></div>
          <div class="pointer-events-none absolute inset-x-0 top-0 h-32"
               style="background: radial-gradient(ellipse 80% 100% at 50% -10%, rgba(152,196,65,.10) 0%, transparent 70%);"
               aria-hidden="true"></div>
          <img src="https://framerusercontent.com/images/pRTepi2wStAhn0iR4AR9ul4BPI.png?width=1920&height=1080"
               alt="Connexus AI Interpreter interface"
               loading="lazy" decoding="async"
               class="relative z-[1] block h-auto w-full opacity-[.86]">
        </div>
      </div>
    </div>

    <?php /* ── Right: copy ── */ ?>
    <div>
      <div class="mb-8 inline-flex items-stretch overflow-hidden border border-[#98C441]/20">
        <div class="w-[2.5px] self-stretch bg-[#98C441]/55 flex-shrink-0"></div>
        <div class="flex items-center gap-2 px-3 py-[7px]">
          <span class="text-[10px] font-bold tracking-[.15em] uppercase text-[#98C441]/65">AI Interpreter</span>
        </div>
      </div>

      <h2 class="text-[clamp(2.35rem,5.7vw,3.85rem)] font-extrabold leading-[1.03] tracking-[-0.045em] text-[#F2EFE9]">
        Meet the Connexus AI Interpreter.
      </h2>

      <p class="mt-5 text-[13px] font-semibold tracking-[.005em] text-white/48">
        Real-time AI interpretation, governed by linguists.
      </p>

      <p class="mt-6 text-base leading-[1.84] text-[#F2EFE9]/50">
        The Speech-to-Speech AI Interpreter handles surge volume in 50+ languages with under-one-second latency and 95%+ accuracy on domain-adapted language pairs. Real-time confidence scoring runs on every call, with automatic fallback to a credentialed human interpreter the moment accuracy drops below threshold. Linguists with sector expertise build the glossary and run the QA loop. The AI is the engine. Language professionals stay in control.
      </p>

      <a href="#"
         class="group mt-8 inline-flex items-center gap-2 text-[13.5px] font-semibold text-[#98C441]
                transition-all duration-200 hover:gap-3.5
                focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2 focus-visible:ring-offset-[#080F0F]">
        Learn how the AI Interpreter works &gt;
      </a>
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
/* The screenshot — hugs the card: full width, natural height, never cropped */
.feat-img-card img {
  position: relative; z-index: 1;
  display: block; width: 100%; height: auto;
  object-fit: contain; object-position: center;
  transition: transform .7s cubic-bezier(.22,1,.36,1), opacity .5s;
  opacity: .88;
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
  opacity: 1;
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
      /* 0 · Interpreter Access */
      'radial-gradient(ellipse 68% 52% at 10% 44%, rgba(0,97,85,.24) 0%, transparent 58%),
       radial-gradient(ellipse 52% 42% at 88% 26%, rgba(92,195,250,.11) 0%, transparent 58%)',
      /* 1 · Compliance Proof */
      'radial-gradient(ellipse 68% 52% at 10% 50%, rgba(0,97,85,.30) 0%, transparent 58%),
       radial-gradient(ellipse 52% 42% at 88% 26%, rgba(152,196,65,.15) 0%, transparent 58%)',
      /* 2 · Capacity Visibility */
      'radial-gradient(ellipse 68% 52% at 10% 54%, rgba(0,97,85,.22) 0%, transparent 58%),
       radial-gradient(ellipse 52% 42% at 88% 30%, rgba(152,196,65,.12) 0%, transparent 58%)',
      /* 3 · Cost Reconciliation */
      'radial-gradient(ellipse 68% 52% at 10% 48%, rgba(0,97,85,.26) 0%, transparent 58%),
       radial-gradient(ellipse 52% 42% at 88% 28%, rgba(242,239,233,.08) 0%, transparent 58%)',
    ];
    foreach ($atmos as $ai => $bg) :
    ?>
    <div class="feat-atmo" style="opacity:<?php echo $ai === 0 ? '1' : '0'; ?>;background:<?php echo $bg; ?>"></div>
    <?php endforeach; ?>
  </div>

  <?php /* ── Two-column layout ─── */ ?>
  <div class="relative z-10 mx-auto max-w-[1360px] px-6 lg:px-14 lg:grid lg:grid-cols-[1fr_1.4fr] lg:gap-20 lg:items-start">

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
  var imgs     = section.querySelectorAll('.speed-img');
  var glowEl   = document.getElementById('speedImgGlow');
  var progEl   = document.getElementById('speed-progress');
  var curEl    = document.getElementById('speed-step-cur');
  var labelEl  = document.getElementById('speed-step-label');
  var total    = steps.length;
  if (!total || !copies.length) return;

  /* Data arrays from PHP */
  var labels = <?php echo json_encode(array_column($speed_steps, 'label')); ?>;
  var nums   = <?php echo json_encode(array_column($speed_steps, 'num')); ?>;
  var glows  = <?php echo json_encode(array_column($speed_steps, 'glow')); ?>;

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

    /* 5 — image crossfade; active image goes in-flow so the card hugs it */
    imgs.forEach(function (img, i) {
      var on = i === idx;
      img.classList.toggle('is-active', on);
      img.style.opacity = on ? '.88' : '0';
    });

    /* 6 — glow colour swap */
    if (glowEl && glows[idx]) {
      glowEl.style.background =
        'radial-gradient(50% 50%, ' + glows[idx] + ' 0%, transparent 100%)';
    }
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
        'title'       => 'Precision Language Matching Engine',
        'img_src'     => 'https://framerusercontent.com/images/REVBb6Xx0fylloJfcV48hXBs2n0.png?width=1056&height=672',
        'img_alt'     => 'Match interpreters by language, certification, clinical specialty, and patient preference in real time with automated routing logic.',
        'img_pos'     => 'object-left-top',
        'overlay_rgb' => '0,97,85',
      ],
      [
        'title'       => 'Human-Safe AI Interpretation Layer',
        'img_src'     => 'https://framerusercontent.com/images/9qNX5HraxuRB6kIHb4x9u9jDkk.png?width=1504&height=672',
        'img_alt'     => 'AI monitors live interpretation quality and escalates seamlessly to credentialed human interpreters when risk or inaccuracy is detected.',
        'img_pos'     => 'object-center object-top',
        'overlay_rgb' => '152,196,65',
      ],
    ],
  ],
  [
    'layout' => 'wide-narrow',
    'cards'  => [
      [
        'title'       => 'Always-On Video Interpretation Coverage',
        'img_src'     => 'https://framerusercontent.com/images/CJ3ScV4rAlNNF6B194Y2LYy3Yk.png?width=1504&height=672',
        'img_alt'     => 'On-demand ASL and Spanish video interpretation available 24/7 for the highest-volume clinical communication needs.',
        'img_pos'     => 'object-left-top',
        'overlay_rgb' => '152,196,65',
      ],
      [
        'title'       => 'Real-Time Language Demand Intelligence',
        'img_src'     => 'https://framerusercontent.com/images/zkpXYjJGOWWUsn7WWpWoQE19dhs.png?width=1056&height=672',
        'img_alt'     => 'Live capacity heatmaps surface bottlenecks across languages and channels in 15-minute intervals for operational control.',
        'img_pos'     => 'object-left-top',
        'overlay_rgb' => '0,97,85',
      ],
    ],
  ],
  [
    'layout' => 'narrow-wide',
    'cards'  => [
      [
        'title'       => 'Enterprise Role &amp; Access Control System',
        'img_src'     => 'https://framerusercontent.com/images/IqcSLQmU6S3LAkdIXKj3OsrYBEE.png?width=1056&height=672',
        'img_alt'     => 'Role-based permissions for administrators, schedulers, interpreters, and frontline staff to enforce secure and structured access.',
        'img_pos'     => 'object-left-top',
        'overlay_rgb' => '152,196,65',
      ],
      [
        'title'       => 'Granular Cost Attribution Engine',
        'img_src'     => 'https://framerusercontent.com/images/kAYdZmg1ASUGUocYEYh3fvuj7ZY.png?width=1504&height=672',
        'img_alt'     => 'Track interpretation spend at the level of department, facility, or encounter for precise financial accountability and reporting.',
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
  padding: 22px 22px 18px;
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
  min-height: 128px;
  overflow: hidden;
}
.pg-bento-img img {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  opacity: .80;
  filter: saturate(.88);
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
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 10px;
  font-weight: 700;
  letter-spacing: .15em;
  text-transform: uppercase;
  color: rgba(152,196,65,.62);
  margin-bottom: 11px;
}

.pg-bento-label::before {
  content: '';
  display: block;
  width: 18px;
  height: 1px;
  background: rgba(152,196,65,.38);
}

/* ── Card title ───────────────────────────────────────────────── */
.pg-bento-h {
  font-size: clamp(1rem, 1.25vw, 1.18rem);
  font-weight: 700;
  line-height: 1.22;
  letter-spacing: -.020em;
  color: #F2EFE9;
}

.pg-bento-desc {
  margin-top: 10px;
  font-size: clamp(.78rem, .9vw, .86rem);
  line-height: 1.55;
  color: rgba(242,239,233,.54);
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
          class="text-[clamp(2.35rem,5.7vw,3.85rem)] font-extrabold leading-[1.03] tracking-[-0.045em] text-[#F2EFE9]">
        Every detail,
        engineered to move faster.
      </h2>
    </div>

    <?php /* Grid */ ?>
    <div class="flex flex-col gap-3">
      <?php $card_index = 0; ?>

      <?php foreach ($rows as $row) :
        $cols = $col_classes[$row['layout']];
      ?>
      <div class="grid grid-cols-1 gap-3 sm:grid-cols-12">
        <?php foreach ($row['cards'] as $ci => $card) :
          $card_index++;
        ?>

        <article class="pg-bento-card <?php echo esc_attr($cols[$ci]); ?>"
                 style="min-height:340px">

          <?php /* ── Text zone ──────────────────────── */ ?>
          <div class="pg-bento-text">
            <span class="pg-bento-label"><?php printf('Capability %02d', $card_index); ?></span>
            <h3 class="pg-bento-h"><?php echo wp_kses_post($card['title']); ?></h3>
            <p class="pg-bento-desc"><?php echo esc_html($card['img_alt']); ?></p>
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
     SECTION 7b · UNIFIED WORKFLOW (sticky scroll)
════════════════════════════════════════════════════ -->

<?php
$atmos2 = [
  /* 0 One Platform */
  'radial-gradient(ellipse 68% 52% at 88% 48%, rgba(152,196,65,.18) 0%, transparent 58%),
   radial-gradient(ellipse 52% 42% at 12% 26%, rgba(0,97,85,.22)    0%, transparent 58%)',
  /* 1 Embedded Workflow */
  'radial-gradient(ellipse 68% 52% at 88% 50%, rgba(0,97,85,.30) 0%, transparent 58%),
   radial-gradient(ellipse 52% 42% at 12% 28%, rgba(152,196,65,.12) 0%, transparent 60%)',
];
?>

<section class="relative bg-[#080F0F] pt-24 sm:pt-32 lg:pt-40" id="unified-platform" aria-label="Unified interpretation workflow">

  <?php /* Top-entry bloom */ ?>
  <div class="pointer-events-none absolute inset-x-0 top-0 h-40" aria-hidden="true"
       style="background:radial-gradient(ellipse 60% 100% at 50% 0%, rgba(152,196,65,.10) 0%, transparent 70%)"></div>

  <?php /* ── Per-platform atmosphere layers ── */ ?>
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
        <span class="text-[10px] font-bold tracking-[.15em] uppercase text-[#98C441]/65">Operational command layer</span>
      </div>
    </div>
    <h2 class="mt-4 text-[clamp(2rem,4.2vw,3.4rem)] font-extrabold leading-[1.08] tracking-[-0.042em] text-[#F2EFE9] max-w-[640px]">
      One platform for every way interpretation happens.
    </h2>
  </div>

  <?php /* ── Two-column layout (images LEFT · copy RIGHT — mirrored from §7) ── */ ?>
  <div class="relative z-10 mx-auto max-w-[1360px] px-6 lg:px-14 lg:grid lg:grid-cols-[1fr_1.4fr] lg:gap-20 lg:items-start">

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
             id="featDots2" aria-label="Platform feature navigation"></nav>

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
     JS: Section 7b — unified platform sticky + atmosphere
════════════════════════════════════════════════════ -->
<script>
(function () {
  var section = document.getElementById('unified-platform');
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
    btn.setAttribute('aria-label', 'Go to platform feature ' + (i + 1));
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
    'company'    => 'Reference accounts pending',
    'dot'        => '#98C441',
    'initials'   => 'RH',
    'name'       => '[Name and Title]',
    'role'       => 'A regional health system serving [N] sites',
    'quote_html' => '&ldquo;Language access used to mean three vendors, four invoices, and a separate audit log for every regulator. Connexus consolidated all of it into one platform with one bill - and we can finally see capacity before it becomes a crisis.&rdquo;',
    'learn_href' => '#',
  ],
];
?>

<!-- ════════════════════════════════════════════════════
     SECTION 9 · CUSTOMER TESTIMONIAL
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
    radial-gradient(ellipse 68% 58% at 50% 115%, rgba(0,97,85,.22)   0%, transparent 62%);"></div>

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
          <span class="text-[10px] font-bold tracking-[.15em] uppercase text-[#98C441]/65">Customer story preview</span>
        </div>
      </div>
    </div>

    <?php /* ── Pull quote — seeded from index 0; JS swaps on badge click ── */ ?>
    <blockquote id="testi-quote"
                class="testi-quote mb-12 text-[clamp(1.5rem,2.6vw,2.5rem)]
                       font-extrabold leading-[1.22] tracking-[-0.032em] text-[#F2EFE9]">
      <?php echo wp_kses_post($testimonials[0]['quote_html']); ?>
    </blockquote>

    <?php /* ── Attribution + inline CTA ── */ ?>
    <div class="mb-16 flex flex-wrap items-center gap-y-6">

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
          Read the full story &gt;
        </a>

      </div>

    </div>

    <?php /* ── Logo strip placeholder ── */ ?>
    <div class="grid grid-cols-1 gap-2 sm:grid-cols-3" aria-label="Reference account logo strip placeholder">
      <?php foreach (['Hold for cleared reference accounts', 'Logo strip held for approval', 'No named accounts until rights confirmed'] as $placeholder) : ?>
      <div class="rounded-[18px] border border-white/[.07] bg-white/[.035] px-5 py-6 text-center text-[12px] font-semibold uppercase tracking-[.11em] text-white/30">
        <?php echo esc_html($placeholder); ?>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<?php
/**
 * Section 13: Final CTA — Connexus demo booking
 */
?>

<style>
/* ── CTA primary button ──────────────────────────────── */
.cta-primary-btn {
  background:
    radial-gradient(ellipse 90% 150% at 16% 20%, rgba(255,255,255,.26) 0%, transparent 52%),
    linear-gradient(108deg, #79B41E 0%, #98C441 38%, #B3DF52 72%, #C2EE60 100%);
  position: relative; overflow: hidden;
  box-shadow:
    inset 0 1.5px 0 rgba(255,255,255,.30),
    inset 0 -1.5px 0 rgba(0,0,0,.16),
    0 0 0 1px rgba(0,0,0,.20),
    0 22px 52px rgba(152,196,65,.22),
    0 8px 22px rgba(0,0,0,.28);
  transition: filter .22s, transform .22s cubic-bezier(.22,1,.36,1), box-shadow .22s;
}
/* Static top-left sheen */
.cta-primary-btn::before {
  content: ''; position: absolute; inset: 0;
  background: linear-gradient(112deg, rgba(255,255,255,.16) 0%, transparent 36%);
  pointer-events: none; z-index: 1;
}
/* Hover shimmer sweep */
@keyframes cta-shimmer {
  0%   { transform: translateX(-130%) skewX(-14deg); }
  100% { transform: translateX(260%)  skewX(-14deg); }
}
.cta-primary-btn::after {
  content: ''; position: absolute; inset: 0; z-index: 2;
  background: linear-gradient(90deg,
    transparent 15%,
    rgba(255,255,255,.28) 50%,
    transparent 85%);
  transform: translateX(-130%) skewX(-14deg);
  pointer-events: none;
}
.cta-primary-btn:hover::after {
  animation: cta-shimmer .68s cubic-bezier(.22,1,.36,1) forwards;
}
.cta-primary-btn:hover {
  filter: brightness(1.06);
  transform: translateY(-2px);
  box-shadow:
    inset 0 1.5px 0 rgba(255,255,255,.32),
    inset 0 -1.5px 0 rgba(0,0,0,.16),
    0 0 0 1px rgba(0,0,0,.20),
    0 30px 68px rgba(152,196,65,.28),
    0 12px 28px rgba(0,0,0,.34);
}
.cta-primary-btn:hover .cta-arrow {
  background: rgba(11,26,26,.28);
  transform: translateX(5px);
}
.cta-arrow { transition: background .18s, transform .24s cubic-bezier(.22,1,.36,1); }

/* ── CTA secondary button ────────────────────────────── */
.cta-secondary-btn {
  box-shadow:
    inset 0 1px 0 rgba(255,255,255,.055),
    0 0 0 1px rgba(0,0,0,.15),
    0 16px 40px rgba(0,0,0,.18);
  transition: background .22s, border-color .22s,
              transform .22s cubic-bezier(.22,1,.36,1), box-shadow .22s;
}
.cta-secondary-btn:hover {
  transform: translateY(-1px);
  box-shadow:
    inset 0 1px 0 rgba(255,255,255,.065),
    0 0 0 1px rgba(152,196,65,.10),
    0 22px 56px rgba(0,0,0,.24);
}

/* ── Availability dot pulse ──────────────────────────── */
@keyframes cta-dot-pulse {
  0%, 100% { box-shadow: 0 0 0 0   rgba(152,196,65,.55), 0 0 6px  rgba(152,196,65,.40); }
  50%       { box-shadow: 0 0 0 4px rgba(152,196,65,.00), 0 0 12px rgba(152,196,65,.60); }
}
.badge-pulse { animation: cta-dot-pulse 2.6s ease-in-out infinite; }
</style>

<section class="relative overflow-hidden bg-[#080F0F] px-6 py-32 sm:px-12 sm:py-40 lg:px-16"
         aria-labelledby="cta-heading">

  <?php /* ── Multi-layer mesh atmosphere ── */ ?>
  <div class="pointer-events-none absolute inset-0" aria-hidden="true"
       style="background:
         radial-gradient(ellipse 72% 64% at 50% 52%,  rgba(0,97,85,.26)    0%, transparent 58%),
         radial-gradient(ellipse 46% 36% at 12%  8%,  rgba(152,196,65,.10) 0%, transparent 52%),
         radial-gradient(ellipse 42% 32% at 88% 94%,  rgba(0,97,85,.12)    0%, transparent 50%),
         radial-gradient(ellipse 68% 55% at 50%  0%,  rgba(0,97,85,.22)    0%, transparent 60%),
         radial-gradient(ellipse 78% 62% at 50% 108%, rgba(152,196,65,.26) 0%, transparent 60%),
         radial-gradient(ellipse 38% 50% at  0% 50%,  rgba(0,0,0,.20)      0%, transparent 55%),
         radial-gradient(ellipse 38% 50% at 100% 50%, rgba(0,0,0,.20)      0%, transparent 55%),
         linear-gradient(180deg, #080F0F 0%, #0D1E1E 32%, #0D1E1E 68%, #080F0F 100%);">
  </div>

  <?php /* ── Top hairline seam — gradient bridges testimonial → CTA ── */ ?>
  <div class="pointer-events-none absolute inset-x-0 top-0 h-px" aria-hidden="true"
       style="background: linear-gradient(to right,
         transparent 5%,
         rgba(0,97,85,.22) 28%,
         rgba(152,196,65,.18) 50%,
         rgba(0,97,85,.22) 72%,
         transparent 95%);">
  </div>

  <?php /* ── Centered content glow halo — lit backdrop behind CTA ── */ ?>
  <div class="pointer-events-none absolute left-1/2 top-1/2 h-[520px] w-[760px]
              -translate-x-1/2 -translate-y-1/2 rounded-full"
       aria-hidden="true"
       style="background: radial-gradient(ellipse 75% 65% at 50% 50%,
                rgba(152,196,65,.058) 0%, transparent 72%);
              filter: blur(2px);">
  </div>

  <?php /* ── Bottom floor hairline ── */ ?>
  <div class="pointer-events-none absolute bottom-0 left-1/2 h-px w-[58%] -translate-x-1/2"
       aria-hidden="true"
       style="background: linear-gradient(to right, transparent, rgba(152,196,65,.26), transparent);">
  </div>

  <div class="relative z-10 mx-auto flex max-w-[660px] flex-col items-center text-center">

    <?php /* Eyebrow */ ?>
    <div class="mb-9 inline-flex items-stretch overflow-hidden border border-[#98C441]/20">
      <div class="w-[2.5px] self-stretch bg-[#98C441]/55 flex-shrink-0"></div>
      <div class="flex items-center gap-2 px-3 py-[7px]">
        <span class="text-[10px] font-bold tracking-[.15em] uppercase text-[#98C441]/65">Live workflow demo</span>
      </div>
    </div>

    <?php /* Heading */ ?>
    <h2 id="cta-heading"
        class="mb-6 text-[clamp(2.35rem,5.7vw,3.85rem)] font-extrabold leading-[1.03]
               tracking-[-0.045em] text-[#F2EFE9]">
      See Connexus inside<br>your workflow.
    </h2>

    <?php /* Body */ ?>
    <p class="mb-14 max-w-[500px] text-[16px] font-light leading-[1.80] text-[#F2EFE9]/50">
      Bring your call flow, compliance questions, and integration stack. We will show how Connexus routes, records, and reports interpretation across the systems you already run.
    </p>

    <?php /* ── HubSpot embed form ── */ ?>
    <div class="w-full max-w-[520px] text-left">
      <script src="https://js.hsforms.net/forms/embed/22423917.js" defer></script>
      <div class="hs-form-frame"
           data-region="na1"
           data-form-id="40af2630-b243-4860-b484-8a15e2cc3895"
           data-portal-id="22423917"></div>
    </div>

    <?php /* Trust signal */ ?>
    <p class="mt-10 flex items-center gap-2.5 text-[11.5px] text-[#F2EFE9]/22">
      <span class="badge-pulse block h-[5px] w-[5px] shrink-0 rounded-full"
            style="background:rgba(152,196,65,.60);" aria-hidden="true"></span>
      Live walkthroughs only. No automated recordings, no generic deck.
    </p>

  </div>
</section>
<?php get_footer(); ?>