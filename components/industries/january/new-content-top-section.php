<?php
// Check if either title or content exists before displaying the section
$top_insight_title = get_field('top_insight_title');
$top_insight_content = get_field('top_insight_content');

if ($top_insight_title || $top_insight_content):
?>
<section class="relative w-full py-10">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-0">
    <!-- Insight / Tip Callout -->
    <div class="relative overflow-hidden rounded-sm border-l-8 border-[#006155] foundation-gradient px-8 py-10 shadow-[0_0_0_1px_rgba(0,0,0,0.02),0_2px_8px_rgba(0,0,0,0.04),0_12px_32px_rgba(0,0,0,0.06)] transition-all duration-500 hover:shadow-[0_0_0_1px_rgba(0,0,0,0.03),0_4px_12px_rgba(0,0,0,0.06),0_16px_48px_rgba(0,0,0,0.1)] sm:px-12 sm:py-12 lg:px-16 lg:py-14">
      <!-- Subtle background pattern -->
      <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(to_right,rgba(31,49,49,0.01)_1px,transparent_1px),linear-gradient(to_bottom,rgba(31,49,49,0.01)_1px,transparent_1px)] bg-[size:64px_64px]"></div>

      <!-- Accent glow on left edge -->
      <div class="pointer-events-none absolute top-1/4 left-0 h-1/2 w-32 bg-[#006155]/15 blur-2xl"></div>

      <!-- Content -->
      <div class="relative z-10">
        <div class="mb-6 flex items-center gap-3">
          <?php 
          $top_small_title = get_field('top_insights_small_title');
          $small_title_text = $top_small_title ? $top_small_title : 'Insight';
          ?>
          <span class="inline-block text-base font-semibold tracking-[0.2em] text-[#5E5D59] uppercase"><?php echo esc_html($small_title_text); ?></span>
        </div>

        <?php if ($top_insight_title): ?>
        <h3 class="text-3xl leading-tight font-bold tracking-tight text-[#1F3131] ">
          <?php echo esc_html($top_insight_title); ?>
        </h3>
        <?php endif; ?>

        <?php if ($top_insight_content): ?>
        <div class="mt-8 mb-12 max-w-none prose prose-lg prose-slate prose-headings:text-[#1F3131] prose-headings:font-bold prose-p:text-[#1F3131]/90 prose-p:leading-relaxed prose-a:text-[#006155] prose-a:font-semibold prose-a:no-underline hover:prose-a:underline prose-strong:text-[#1F3131] prose-strong:font-bold prose-ul:text-[#1F3131]/90 prose-ol:text-[#1F3131]/90 prose-li:marker:text-[#006155]">
          <?php echo wp_kses_post($top_insight_content); ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>