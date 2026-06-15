<?php
/**
 * Template Name: Language Access Symposium
 * Description: Landing page for the 3rd Annual Language Access Symposium
 */
get_header();
?>
<div class="bg-[#1F3131] pt-8 pb-6">
    <nav aria-label="Primary desktop navigation">
        <?php get_template_part('components/navigation/desktop'); ?>
    </nav>
    <nav aria-label="Primary mobile navigation">
        <?php get_template_part('components/navigation/mobile'); ?>
    </nav>
</div>

<main id="maincontent">
<section class="shadow-sm bg-[#1F3131]" aria-labelledby="symposium-hero-heading">
    <div class="relative py-16 lg:py-20 bg-cover bg-no-repeat bg-right-bottom"
        style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/icons/single-industries.svg'); ?>');">

        <!-- Overlays -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#1F3131] via-[#1F3131]/90 to-[#1F3131]/70"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-[#1F3131]/80 via-transparent to-[#1F3131]/40"></div>

        <div class="relative z-10">
            <div class="max-w-7xl mx-auto px-6 lg:px-0">
           

                <?php
                $event_badge_text = get_field('event_badge_text');
                $event_title = get_field('event_title');
                $event_description = get_field('event_description');
                ?>

                <!-- Event eyebrow -->
                <?php if ($event_badge_text): ?>
                <div class="inline-flex items-stretch border border-white/10 overflow-hidden mb-5"
                    role="doc-subtitle" data-aos="fade-up">
                    <div class="w-[3px] bg-[#98C441] self-stretch flex-shrink-0"></div>
                    <div class="flex items-center gap-[7px] px-3 py-[6px]">
                        <span class="text-[10px] font-semibold tracking-[.11em] uppercase leading-none text-white/95">
                            <?php echo esc_html($event_badge_text); ?>
                        </span>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Heading -->
                <?php if ($event_title): ?>
                <h1 id="symposium-hero-heading" class="text-3xl md:text-4xl lg:text-5xl font-bold text-white max-w-5xl mb-6 leading-tight"
                    >
                    <?php echo esc_html($event_title); ?>
                </h1>
                <?php else: ?>
                <h1 id="symposium-hero-heading" class="sr-only"><?php esc_html_e( 'Language Access Symposium', 'piedmontglobal' ); ?></h1>
                <?php endif; ?>

                <?php if ($event_description): ?>
                <div class="max-w-3xl lg:max-w-5xl mb-10">
                    <div class="prose prose-invert max-w-none text-base md:text-lg text-white/85 leading-relaxed prose-p:my-3 prose-headings:text-white prose-a:text-[#98C441] prose-a:underline hover:prose-a:no-underline">
                        <?php echo wp_kses_post($event_description); ?>
                    </div>
                </div>
                <?php endif; ?>

               

                <!-- Event Details Card -->
                <?php
                $event_date_day = get_field('event_date_day');
                $event_date = get_field('event_date');
                $event_time = get_field('event_time');
                $event_timezone = get_field('event_timezone');
                $event_location_name = get_field('event_location_name');
                $event_location_city = get_field('event_location_city');
                $event_refreshments_title = get_field('event_refreshments_title');
                $event_refreshments_description = get_field('event_refreshments_description');
                
                // Check if any event detail exists (must cover each block’s own condition)
                $has_event_details = $event_date_day || $event_date || $event_time || $event_timezone || $event_location_name || $event_location_city || $event_refreshments_title || $event_refreshments_description;
                
                if ($has_event_details):
                ?>
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-3 lg:p-5 mb-10 w-full"
                    data-aos="fade-up" data-aos-delay="150">
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:flex lg:items-center lg:gap-0 lg:divide-x lg:divide-white/10">

                        <!-- Date -->
                        <?php if ($event_date_day || $event_date): ?>
                        <div class="flex items-center gap-3 min-w-0 lg:flex-auto lg:px-5 lg:first:pl-0 lg:last:pr-0">
                            <div
                                class="w-12 h-12 rounded-xl bg-[#98C441]/15 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-[#98C441]" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                            </div>
                            <div>
                                <?php if ($event_date_day): ?>
                                <p class="text-white font-semibold"><?php echo esc_html($event_date_day); ?></p>
                                <?php endif; ?>
                                <?php if ($event_date): ?>
                                <p class="text-white/90"><?php echo esc_html($event_date); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Time -->
                        <?php if ($event_time || $event_timezone): ?>
                        <div class="flex items-center gap-3 min-w-0 lg:flex-auto lg:px-5 lg:first:pl-0 lg:last:pr-0">
                            <div
                                class="w-12 h-12 rounded-xl bg-[#98C441]/15 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-[#98C441]" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <?php if ($event_time): ?>
                                <p class="text-white font-semibold"><?php echo esc_html($event_time); ?></p>
                                <?php endif; ?>
                                <?php if ($event_timezone): ?>
                                <p class="<?php echo ! $event_time ? 'text-white font-semibold' : 'text-white/90'; ?>"><?php echo esc_html($event_timezone); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Location -->
                        <?php if ($event_location_name || $event_location_city): ?>
                        <div class="flex items-center gap-3 min-w-0 lg:flex-auto lg:px-5 lg:first:pl-0 lg:last:pr-0">
                            <div
                                class="w-12 h-12 rounded-xl bg-[#98C441]/15 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-[#98C441]" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </div>
                            <div>
                                <?php if ($event_location_name): ?>
                                <p class="text-white font-semibold"><?php echo esc_html($event_location_name); ?></p>
                                <?php endif; ?>
                                <?php if ($event_location_city): ?>
                                <p class="text-white/90"><?php echo esc_html($event_location_city); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Refreshments -->
                        <?php if ($event_refreshments_title || $event_refreshments_description): ?>
                        <div class="flex items-center gap-3 min-w-0 lg:flex-auto lg:px-5 lg:first:pl-0 lg:last:pr-0">
                            <div
                                class="w-12 h-12 rounded-xl bg-[#98C441]/15 flex items-center justify-center flex-shrink-0">
                               
								<svg  class="w-6 h-6 text-[#98C441]" fill="#98c440" viewBox="0 -0.5 122.88 122.88" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" style="enable-background:new 0 0 122.88 121.87" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M97.34,0.74c0.86-0.93,2.3-0.99,3.23-0.13c0.93,0.86,0.99,2.3,0.13,3.23L81.98,24.1l-0.03,0.04 c-2.29,2.77-3.86,5.33-4.56,7.67c-0.62,2.07-0.53,3.95,0.39,5.59c0.49,0.88,0.33,1.96-0.32,2.67l0,0l-8.89,9.62 c-0.87-0.95-1.56-1.72-2.02-2.22c-0.21-0.28-0.45-0.55-0.7-0.81l-0.02,0.02c-0.12-0.13-0.25-0.25-0.38-0.37l7.6-8.23 c-0.89-2.38-0.88-4.91-0.06-7.6c0.88-2.92,2.75-6.03,5.44-9.27c0.06-0.08,0.11-0.16,0.18-0.23L97.32,0.72L97.34,0.74L97.34,0.74z M57.13,55.01c-0.84-0.94-0.76-2.39,0.18-3.23c0.94-0.84,2.39-0.76,3.23,0.18c9.41,10.54,38.5,41.73,46.56,53.39 c10.63,15.05-5.83,19.79-11.29,14.31c-13.64-13.19-42.6-46.82-55.33-61.08c-4.58,1.94-9.03,2.24-13.5,0.96 c-4.81-1.37-9.52-4.58-14.3-9.51l-0.06-0.06c-3.64-3.84-6.49-7.63-8.55-11.38c-2.11-3.86-3.4-7.68-3.86-11.47 c-0.49-4.08-0.11-7.88,0.99-11.25c1.29-3.96,3.58-7.31,6.58-9.8c3.02-2.5,6.73-4.12,10.87-4.62c3.44-0.41,7.19-0.06,11.07,1.21 c5.37,1.75,11.63,6.1,16.82,11.68c3.83,4.11,7.11,8.92,9.06,13.87c2.03,5.16,2.65,10.5,1.02,15.5c-0.96,2.96-2.7,5.74-5.4,8.25 c-0.93,0.86-2.37,0.8-3.23-0.12c-0.86-0.93-0.8-2.37,0.12-3.23c2.09-1.95,3.43-4.08,4.16-6.33c1.26-3.87,0.73-8.16-0.93-12.38 c-1.74-4.42-4.69-8.74-8.15-12.45c-4.68-5.02-10.23-8.91-14.91-10.44c-3.21-1.04-6.28-1.34-9.09-1c-3.26,0.4-6.18,1.65-8.51,3.6 c-2.34,1.95-4.13,4.58-5.16,7.71c-0.89,2.73-1.2,5.87-0.79,9.26c0.39,3.2,1.5,6.47,3.32,9.81c1.91,3.43,4.53,6.9,7.9,10.45 l0.02,0.03c4.22,4.35,8.27,7.15,12.28,8.29c3.79,1.08,7.65,0.66,11.68-1.35c0.92-0.53,2.11-0.35,2.84,0.47 c12.42,13.91,42.63,48.92,56.01,61.89c5.81,2.37,9.03-0.55,6.25-5.7C100.7,102.43,63.5,62.17,57.13,55.01L57.13,55.01L57.13,55.01z M45.07,75.12l-29.16,31.55c-0.06,0.06-0.11,0.12-0.18,0.18c-4.26,4.6,3.28,11.3,7.96,6.82l28.32-30.65l3.04,3.45l-28.1,30.41l0,0 c-0.06,0.07-0.12,0.13-0.2,0.2c-1.68,1.41-3.37,2.33-5.08,2.71c-1.76,0.4-3.49,0.22-5.15-0.56c-0.28-0.11-0.54-0.25-0.77-0.46 l-4.03-3.73l0,0c-0.06-0.06-0.12-0.11-0.18-0.18c-1.56-1.8-2.3-3.72-2.1-5.75c0.19-1.92,1.21-3.79,3.14-5.59l29.44-31.86 L45.07,75.12L45.07,75.12z M75.63,57.46l1.73-1.87c0.86-0.93,2.31-0.99,3.23-0.13s0.99,2.3,0.13,3.23l-2,2.16L75.63,57.46 L75.63,57.46z M104.45,7.43c0.86-0.93,2.3-0.99,3.23-0.13c0.93,0.86,0.99,2.3,0.13,3.23L91.4,28.3c-0.86,0.93-2.3,0.99-3.23,0.13 c-0.93-0.86-0.99-2.3-0.13-3.23L104.45,7.43L104.45,7.43L104.45,7.43z M111.55,14c0.86-0.93,2.3-0.99,3.23-0.13 c0.93,0.86,0.99,2.3,0.13,3.23L98.51,34.86c-0.86,0.93-2.3,0.99-3.23,0.13c-0.93-0.86-0.99-2.3-0.13-3.23L111.55,14L111.55,14 L111.55,14z M118.91,20.83c0.86-0.93,2.3-0.99,3.23-0.13c0.93,0.86,0.99,2.31,0.13,3.23L103.55,44.2c-0.07,0.07-0.14,0.13-0.21,0.2 c-4.26,4.1-8.33,6.47-12.22,7.14c-4.22,0.73-8.09-0.47-11.64-3.57c-0.95-0.83-1.04-2.28-0.22-3.22c0.83-0.95,2.28-1.04,3.22-0.22 c2.45,2.14,5.07,2.98,7.84,2.49c2.98-0.51,6.26-2.48,9.84-5.93l0.02-0.02l18.71-20.25L118.91,20.83L118.91,20.83z"></path> </g> </g></svg>
                            </div>
                            <div>
                                <?php if ($event_refreshments_title): ?>
                                <p class="text-white font-semibold"><?php echo esc_html($event_refreshments_title); ?></p>
                                <?php endif; ?>
                                <?php if ($event_refreshments_description): ?>
                                <p class="text-white/90"><?php echo esc_html($event_refreshments_description); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- CTA Buttons -->
                <?php
                $cta_button_text = get_field('cta_button_text');
                $cta_button_url = get_field('cta_button_url');
                $cta_subtext = get_field('cta_subtext');
                
                if ($cta_button_text || $cta_subtext):
                ?>
                <div class="flex flex-col sm:flex-row gap-4" data-aos="fade-up" data-aos-delay="200">
                    <?php if ($cta_button_text): ?>
                    <a href="<?php echo esc_url($cta_button_url ?: '#register'); ?>"
                        class="inline-flex items-center justify-center gap-2 bg-[#98C441] text-[#1F3131] px-8 py-4 font-bold text-base shadow-lg hover:bg-[#8AB738] hover:shadow-xl transition-all duration-200">
                        <span><?php echo esc_html($cta_button_text); ?></span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                        </svg>
                    </a>
                    <?php endif; ?>
                    <?php if ($cta_subtext): ?>
                    <span class="inline-flex items-center gap-2 text-white/70 text-sm px-4 py-4">
                        <svg class="w-4 h-4 text-[#98C441]" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                        </svg>
                        <span><?php echo esc_html($cta_subtext); ?></span>
                    </span>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
 <?php if ( is_page(1715) ) : ?>
    <!-- Sponsor Callout (static, non-ACF) -->
    <aside class="mt-10 max-w-2xl border border-white/[0.14] bg-[linear-gradient(120deg,rgba(255,255,255,0.08),rgba(255,255,255,0.03))] px-5 py-2 shadow-[0_20px_50px_-12px_rgba(15,23,42,0.35)] backdrop-blur-[2px] md:px-7 md:py-4"
        data-aos="fade-up" data-aos-delay="125" aria-label="<?php echo esc_attr__( 'Event sponsors', 'piedmontglobal' ); ?>">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-base font-semibold uppercase tracking-[0.14em] text-white/55">
                    In collaboration with
                </p>
                <p class="mt-2 text-[15px] md:text-base font-semibold tracking-[0.01em] text-white">
                    Piedmont Global &amp; Birnbaum Interpreting Services
                </p>
            </div>
            <div class="inline-flex items-center border border-white/[0.08] bg-white/[0.04] px-3 py-2">
                <img
                    src="https://piedmontglobal.com/wp-content/uploads/SHRM-Partner-badge-rev.webp"
                    alt="SHRM Recertification Provider"
                    class="h-12 w-auto md:h-22"
                    loading="lazy"
                    decoding="async"
                />
            </div>
        </div>
    </aside>
<?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Symposium Agenda Section -->
<?php
$agenda_section_label = get_field('agenda_section_label');
$agenda_section_title = get_field('agenda_section_title');
$agenda_section_description = get_field('agenda_section_description');
$agenda_sessions = get_field('agenda_sessions');
$agenda_heading_id = 'symposium-agenda-heading';

if ($agenda_section_label || $agenda_section_title || $agenda_section_description || $agenda_sessions):
?>
<section class="relative py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
       
        <!-- Section Header -->
        <?php if ($agenda_section_label || $agenda_section_title): ?>
        <div class="max-w-3xl mb-10 md:mb-16">
    <?php if ($agenda_section_label): ?>
    <div class="inline-flex items-stretch border border-[#1F3131]/[.09] overflow-hidden mb-5"
        role="doc-subtitle">
        <div class="w-[3px] bg-[#98C441] self-stretch flex-shrink-0"></div>
        <div class="flex items-center gap-[7px] px-3 py-[6px]">
            <span class="text-[10px] font-semibold tracking-[.11em] uppercase leading-none text-[#1F3131]">
                <?php echo esc_html($agenda_section_label); ?>
            </span>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($agenda_section_title): ?>
    <h2 id="<?php echo esc_attr($agenda_heading_id); ?>"
        class="text-2xl md:text-3xl lg:text-4xl font-bold leading-tight mb-4 text-[#1F3131]">
        <?php echo esc_html($agenda_section_title); ?>
    </h2>
    <?php endif; ?>

    <?php if ($agenda_section_description): ?>
   <p class="text-sm md:text-base leading-relaxed text-[#1F3131]/80 max-w-7xl">
    <?php echo wp_kses_post($agenda_section_description); ?>
</p>
    <?php endif; ?>
</div>
        <?php endif; ?>

        <!-- Agenda (table layout) -->
        <?php if ($agenda_sessions && is_array($agenda_sessions) && count($agenda_sessions) > 0): ?>
        <div class="symposium-agenda-wrap overflow-x-auto max-md:overflow-x-visible rounded-xl border border-[#1F3131]/10 bg-white shadow-[0_4px_28px_rgba(31,49,49,0.07)]"
            role="region"
            <?php
            if ($agenda_section_title) {
                echo ' aria-labelledby="' . esc_attr($agenda_heading_id) . '"';
            } else {
                echo ' aria-label="' . esc_attr(__('Event agenda', 'piedmontglobal')) . '"';
            }
            ?>>
            <div class="h-[3px] w-full bg-[#98C441]" aria-hidden="true"></div>
            <table class="symposium-agenda-table w-full min-w-0 table-fixed border-collapse text-left">
                <caption class="sr-only"><?php echo esc_html($agenda_section_title ?: __('Symposium agenda', 'piedmontglobal')); ?></caption>
                <thead>
                    <tr class="border-b border-[#1F3131]/10 bg-[#1F3131]/[0.04]">
                        <th scope="col"
                            class="w-[30%] max-w-[11rem] py-4 pl-6 pr-4 align-bottom text-[10px] font-semibold uppercase tracking-[.11em] text-[#1F3131]/70">
                            <?php esc_html_e('Time', 'piedmontglobal'); ?>
                        </th>
                        <th scope="col"
                            class="py-4 pl-4 pr-6 align-bottom text-[10px] font-semibold uppercase tracking-[.11em] text-[#1F3131]/70">
                            <?php esc_html_e('Session', 'piedmontglobal'); ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agenda_sessions as $session) :
                        $session_time = $session['session_time'] ?? '';
                        $session_title = $session['session_title'] ?? '';
                        $session_description = $session['session_description'] ?? '';

                        if (! $session_time && ! $session_title && ! $session_description) {
                            continue;
                        }
                        ?>
                    <tr class="border-b border-[#1F3131]/[0.08] transition-colors last:border-b-0 hover:bg-[#98C441]/[0.06]">
                        <td class="align-top border-r border-[#1F3131]/[0.06] py-5 pl-6 pr-4">
                            <?php if ($session_time) : ?>
                            <span class="block text-base font-semibold uppercase tracking-[.12em] text-[#1F3131] tabular-nums">
                                <?php echo esc_html($session_time); ?>
                            </span>
                            <?php else : ?>
                            <span class="text-[#1F3131]/35">&mdash;</span>
                            <?php endif; ?>
                        </td>
                        <td class="align-top break-words py-5 pl-4 pr-6">
                            <?php if ($session_title) : ?>
                            <h3 class="text-xl font-bold leading-snug text-[#1F3131]">
                                <?php echo esc_html($session_title); ?>
                            </h3>
                            <?php endif; ?>
                            <?php if ($session_description) : ?>
                            <div class="<?php echo $session_title ? 'mt-2' : 'mt-0'; ?> text-sm prose leading-relaxed text-gray-600 md:text-base">
                                <?php echo wp_kses_post($session_description); ?>
                            </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<!-- Speakers Section -->
<?php 
$speakers = get_field('speakers_repeater');
if ($speakers && is_array($speakers) && count($speakers) > 0): 
?>
<section class="relative py-24 md:py-32 overflow-hidden bg-[#f7f6f4]">
    <!-- Ambient depth (Notion-style soft wash) -->
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_85%_55%_at_50%_-8%,rgba(152,196,65,0.09),transparent_55%)]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute inset-0 opacity-[0.35]" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;72&quot; height=&quot;72&quot; viewBox=&quot;0 0 72 72&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%231F3131&quot; fill-opacity=&quot;0.035&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');" aria-hidden="true"></div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-0">
        <!-- Section Header + carousel controls (same pattern as related-blogs / FAQs related) -->
        <div class="flex flex-col gap-8 md:flex-row md:items-end md:justify-between mb-10 md:mb-14" data-aos="fade-up">
            <div class="max-w-2xl">
                <div class="inline-flex items-stretch border border-[#1F3131]/[.09] overflow-hidden mb-5 bg-white/60 backdrop-blur-sm shadow-[0_1px_2px_rgba(15,23,42,0.04)]"
                    role="doc-subtitle">
                    <div class="w-[3px] bg-[#98C441] self-stretch flex-shrink-0"></div>
                    <div class="flex items-center gap-[7px] px-3 py-[6px]">
                        <span class="text-[10px] font-semibold tracking-[.11em] uppercase leading-none text-[#1F3131]">
                            THOUGHT LEADERS 
                        </span>
                    </div>
                </div>
                <h2 class="text-3xl md:text-4xl lg:text-[2.75rem] font-semibold text-[#1F3131] leading-[1.12] tracking-tight">Featured Speakers</h2>
            </div>
            <div class="flex shrink-0 items-center gap-3">
                <button type="button" id="symposium-speakers-prev" aria-label="<?php echo esc_attr__('Previous speakers', 'piedmontglobal'); ?>"
                    class="p-2 bg-[#cccccc] rounded hover:bg-[#98C441] text-[#1F3131] transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" class="w-6 h-6" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button type="button" id="symposium-speakers-next" aria-label="<?php echo esc_attr__('Next speakers', 'piedmontglobal'); ?>"
                    class="p-2 bg-[#cccccc] rounded hover:bg-[#98C441] text-[#1F3131] transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" class="w-6 h-6" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="relative" data-aos="fade-up">
            <div class="owl-carousel owl-theme symposium-speakers-carousel" role="region" aria-roledescription="carousel" aria-label="<?php echo esc_attr__('Featured speakers', 'piedmontglobal'); ?>">
            <?php 
            $speakers_for_js = [];
            foreach ($speakers as $index => $speaker): 
                $speaker_image       = $speaker['speaker_image'] ?? '';
                $speaker_name        = $speaker['speaker_name'] ?? '';
                $speaker_title       = $speaker['speaker_title'] ?? '';
                $speaker_description = $speaker['speaker_description'] ?? '';
                $speaker_linkedin    = $speaker['speaker_linkedin'] ?? '';

                // Prepare data for modal (description is WYSIWYG, sanitize with kses)
                $speakers_for_js[] = [
                    'name'        => $speaker_name,
                    'title'       => $speaker_title,
                    'photo'       => $speaker_image,
                    'linkedin'    => $speaker_linkedin,
                    'description' => wp_kses_post($speaker_description),
                ];
            ?>
            <div class="item h-full px-1 sm:px-2">
            <div class="group relative flex h-full min-h-0 flex-col overflow-hidden rounded-2xl border border-gray-200/90 bg-white shadow-[0_1px_2px_rgba(15,23,42,0.04),0_8px_24px_-4px_rgba(15,23,42,0.08)] transition-all duration-300 ease-out hover:-translate-y-1 hover:border-gray-300/90 hover:shadow-[0_12px_40px_-8px_rgba(15,23,42,0.14)] focus-within:-translate-y-1 focus-within:border-gray-300/90 focus-within:shadow-[0_12px_40px_-8px_rgba(15,23,42,0.14)]">

                <!-- Primary action: open bio modal -->
                <button
                    type="button"
                    onclick="openSpeakerModal(<?php echo (int) $index; ?>)"
                    class="absolute inset-0 z-10 cursor-pointer rounded-2xl bg-transparent text-left outline-none focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2 focus-visible:ring-offset-[#f7f6f4]"
                    aria-label="<?php
                        $speaker_label = trim($speaker_name . ($speaker_title ? ', ' . $speaker_title : ''));
                        /* translators: %s: speaker name (and optional title) */
                        echo esc_attr( sprintf( __( 'View bio for %s', 'piedmontglobal' ), $speaker_label ) );
                    ?>"
                ></button>

                <!-- Photo -->
                <div class="relative aspect-[4/5] w-full flex-shrink-0 overflow-hidden bg-gray-100">
                    <?php if ($speaker_image): ?>
                        <img
                            src="<?php echo esc_url($speaker_image); ?>"
                            alt=""
                            class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110"
                            loading="lazy"
                            decoding="async"
                        >
                    <?php else: ?>
                        <div class="w-full h-full bg-[#1F3131]/5 flex items-center justify-center">
                            <span class="text-5xl font-bold text-[#1F3131]/20" aria-hidden="true">
                                <?php
                                $speaker_initial = function_exists('mb_substr')
                                    ? mb_substr((string) $speaker_name, 0, 1)
                                    : substr((string) $speaker_name, 0, 1);
                                echo esc_html($speaker_initial);
                                ?>
                            </span>
                        </div>
                    <?php endif; ?>

                    <!-- Decorative gradient overlay (hover only) -->
                    <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-[#1F3131]/92 via-[#1F3131]/35 to-transparent opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 transition-opacity duration-300" aria-hidden="true"></div>
                    <div class="pointer-events-none absolute inset-0 flex flex-col justify-end p-5 opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 transition-all duration-300 translate-y-3 group-hover:translate-y-0 group-focus-within:translate-y-0" aria-hidden="true">
                        <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-[11px] font-medium tracking-wide text-white/95 backdrop-blur-sm">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#98C441]"></span>
                            View bio
                        </span>
                    </div>
                </div>

                <!-- Info -->
                <div class="relative flex flex-1 flex-col border-t border-gray-100/90 p-5 md:p-6">
                    <div class="pointer-events-none absolute left-0 top-0 h-[2px] w-full origin-left scale-x-0 bg-gradient-to-r from-[#98C441] to-[#98C441]/30 transition-transform duration-300 group-hover:scale-x-100 group-focus-within:scale-x-100" aria-hidden="true"></div>
                    <div class="flex items-start justify-between gap-4">
                        <div class="min-w-0 flex-1">
                            <?php if ($speaker_name): ?>
                                <h3 class="text-lg font-semibold tracking-tight text-[#1F3131] md:text-xl mb-1 transition-colors duration-200 group-hover:text-[#1a2b2b]">
                                    <?php echo esc_html($speaker_name); ?>
                                </h3>
                            <?php endif; ?>
                            <?php if ($speaker_title): ?>
                                <p class="text-sm font-medium leading-snug text-[#1F3131]/55 line-clamp-2">
                                    <?php echo esc_html($speaker_title); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="flex items-center gap-2">
                            <?php if (!empty($speaker_linkedin)) : ?>
                                <!-- LinkedIn link is a sibling of the primary button: keyboard reachable, raised above overlay button via z-index -->
                                <a
                                    href="<?php echo esc_url($speaker_linkedin); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="relative z-20 inline-flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg border border-gray-200/80 bg-white text-gray-500 transition-colors duration-200 hover:border-[#0a66c2]/40 hover:bg-[#0a66c2] hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-[#0a66c2] focus-visible:ring-offset-2"
                                    aria-label="<?php
                                        /* translators: %s: speaker name */
                                        echo esc_attr( sprintf( __( '%s on LinkedIn (opens in new tab)', 'piedmontglobal' ), $speaker_name ) );
                                    ?>"
                                >
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                            <?php endif; ?>
                            <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg border border-gray-200/80 bg-gray-50/90 text-gray-400 transition-all duration-300 group-hover:border-[#98C441]/35 group-hover:bg-[#98C441]/10 group-hover:text-[#1F3131] group-focus-within:border-[#98C441]/35 group-focus-within:bg-[#98C441]/10 group-focus-within:text-[#1F3131]" aria-hidden="true">
                                <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-0.5 group-focus-within:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Speaker Bio Modal -->
<div id="speakerBioModal" class="fixed inset-0 z-50 hidden opacity-0 transition-opacity duration-300" role="dialog" aria-modal="true" aria-labelledby="speakerModalName" aria-label="<?php echo esc_attr__( 'Speaker bio', 'piedmontglobal' ); ?>">
    <!-- Backdrop (receives clicks; overlay uses pointer-events-none so empty area hits this layer) -->
    <div class="absolute inset-0 z-0 bg-zinc-950/55 backdrop-blur-[2px]" onclick="closeSpeakerModal()" aria-hidden="true"></div>

    <!-- Modal Content -->
    <div class="pointer-events-none relative z-10 flex min-h-screen items-center justify-center p-4 sm:p-6 md:p-10 lg:p-12">
        <div id="speakerBioModalContent" class="pointer-events-auto relative w-full max-h-[min(88vh,900px)] max-w-5xl overflow-hidden rounded-2xl border border-gray-200/90 bg-white shadow-[0_25px_80px_-12px_rgba(15,23,42,0.25)] ring-1 ring-black/[0.04] transform scale-95 transition-transform duration-300 ease-out">
            <!-- Close Button -->
            <button
                type="button"
                id="speakerModalClose"
                onclick="closeSpeakerModal()"
                class="absolute right-4 top-4 z-20 flex h-10 w-10 items-center justify-center rounded-full border border-gray-200/80 bg-white text-gray-500 shadow-sm transition-all duration-200 hover:bg-gray-50 hover:text-gray-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#98C441]"
                aria-label="<?php esc_attr_e('Close speaker bio', 'piedmontglobal'); ?>"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Modal Body -->
            <div class="flex h-full max-h-[min(88vh,900px)] flex-col md:flex-row">
                <!-- Left: Photo -->
                <div class="relative md:w-[42%] bg-gradient-to-b from-gray-50 to-gray-100/80 md:border-r md:border-gray-100">
                    <div class="aspect-[4/5] w-full min-h-[240px] max-h-[45vh] md:aspect-auto md:max-h-none md:h-full md:min-h-[420px]">
                        <img 
                            id="speakerModalPhoto" 
                            src="" 
                            alt="" 
                            class="h-full w-full object-cover object-top"
                        >
                    </div>
                </div>

                <!-- Right: Content -->
                <div class="flex max-h-[min(88vh,900px)] flex-1 flex-col overflow-y-auto overscroll-contain p-6 sm:p-8 md:w-[58%] md:p-10">
                    <div class="mb-8">
                        <div class="mb-5 inline-flex items-stretch overflow-hidden rounded-md border border-[#1F3131]/[.09] bg-white shadow-[0_1px_2px_rgba(15,23,42,0.04)]"
                            role="doc-subtitle">
                            <div class="w-[3px] bg-[#98C441] self-stretch flex-shrink-0"></div>
                            <div class="flex items-center gap-[7px] px-3 py-[6px]">
                                <span class="text-[10px] font-semibold tracking-[.11em] uppercase leading-none text-[#1F3131]">
                                    Speaker
                                </span>
                            </div>
                        </div>
                        <h3 id="speakerModalName" class="text-2xl font-semibold tracking-tight text-[#1F3131] sm:text-3xl md:text-[2rem] md:leading-tight mb-2"></h3>
                        <p id="speakerModalTitle" class="text-[15px] font-medium leading-snug text-[#1F3131]/60 md:text-base"></p>
                    </div>

                    <div class="mb-8 pr-0.5">
                        <div id="speakerModalBio" class="prose prose-lg max-w-none text-[15px] leading-relaxed text-gray-600 symposium-speaker-modal-bio md:text-base"></div>
                    </div>

                    <div id="speakerModalLinkedInWrapper" class="mt-auto hidden border-t border-gray-100 pt-6">
                        <a
                            id="speakerModalLinkedIn"
                            href=""
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-2.5 rounded-lg bg-[#1F3131] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:bg-[#98C441] hover:text-[#1F3131] focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#98C441]"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                            <span>LinkedIn <span class="sr-only">(<?php esc_html_e('opens in new tab', 'piedmontglobal'); ?>)</span></span>
                            <svg class="h-4 w-4 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        var speakersData = <?php echo wp_json_encode( $speakers_for_js, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE ); ?>;
        var speakerModal = document.getElementById('speakerBioModal');
        var speakerModalContent = document.getElementById('speakerBioModalContent');
        var lastFocusedTrigger = null;

        // Selectors for focusable elements within the modal
        var FOCUSABLE_SELECTORS = [
            'a[href]',
            'area[href]',
            'button:not([disabled])',
            'input:not([disabled]):not([type="hidden"])',
            'select:not([disabled])',
            'textarea:not([disabled])',
            'iframe',
            '[tabindex]:not([tabindex="-1"])',
            '[contenteditable="true"]'
        ].join(',');

        function getFocusable() {
            if (!speakerModalContent) return [];
            return Array.prototype.filter.call(
                speakerModalContent.querySelectorAll(FOCUSABLE_SELECTORS),
                function (el) {
                    return !el.hasAttribute('disabled') &&
                        el.getAttribute('aria-hidden') !== 'true' &&
                        el.offsetParent !== null;
                }
            );
        }

        function trapFocus(e) {
            if (e.key !== 'Tab') return;
            var focusable = getFocusable();
            if (focusable.length === 0) {
                e.preventDefault();
                return;
            }
            var first = focusable[0];
            var last = focusable[focusable.length - 1];
            var active = document.activeElement;

            if (e.shiftKey) {
                if (active === first || !speakerModalContent.contains(active)) {
                    e.preventDefault();
                    last.focus();
                }
            } else {
                if (active === last) {
                    e.preventDefault();
                    first.focus();
                }
            }
        }

        function onKeyDown(e) {
            if (speakerModal.classList.contains('hidden')) return;
            if (e.key === 'Escape') {
                e.preventDefault();
                closeSpeakerModal();
                return;
            }
            trapFocus(e);
        }

        window.openSpeakerModal = function (index) {
            var speaker = speakersData[index];
            if (!speaker) return;

            lastFocusedTrigger = document.activeElement;

            var photoEl = document.getElementById('speakerModalPhoto');
            var nameEl = document.getElementById('speakerModalName');
            var titleEl = document.getElementById('speakerModalTitle');
            var bioEl = document.getElementById('speakerModalBio');
            var linkedInWrapper = document.getElementById('speakerModalLinkedInWrapper');
            var linkedInEl = document.getElementById('speakerModalLinkedIn');

            photoEl.src = speaker.photo || '';
            // Photo duplicates the name shown in the dialog heading; mark as decorative
            photoEl.alt = '';
            nameEl.textContent = speaker.name || '';
            titleEl.textContent = speaker.title || '';
            bioEl.innerHTML = speaker.description || '';

            // Defensive: keep aria-label in sync with the heading content (MAJ-05)
            if (speaker.name) {
                speakerModal.setAttribute('aria-label', speaker.name);
            }

            if (speaker.linkedin && String(speaker.linkedin).trim() !== '') {
                linkedInEl.href = speaker.linkedin;
                linkedInWrapper.classList.remove('hidden');
            } else {
                linkedInWrapper.classList.add('hidden');
            }

            speakerModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            document.addEventListener('keydown', onKeyDown);

            requestAnimationFrame(function () {
                speakerModal.classList.remove('opacity-0');
                speakerModal.classList.add('opacity-100');
                speakerModalContent.classList.remove('scale-95');
                speakerModalContent.classList.add('scale-100');

                // Move focus into the dialog (close button is a stable, predictable target)
                var closeBtn = document.getElementById('speakerModalClose');
                if (closeBtn && typeof closeBtn.focus === 'function') {
                    closeBtn.focus();
                }
            });
        };

        window.closeSpeakerModal = function () {
            speakerModal.classList.remove('opacity-100');
            speakerModal.classList.add('opacity-0');
            speakerModalContent.classList.remove('scale-100');
            speakerModalContent.classList.add('scale-95');

            document.removeEventListener('keydown', onKeyDown);

            setTimeout(function () {
                speakerModal.classList.add('hidden');
                document.body.style.overflow = '';

                // Restore focus to the element that opened the modal
                if (lastFocusedTrigger && typeof lastFocusedTrigger.focus === 'function') {
                    try {
                        lastFocusedTrigger.focus();
                    } catch (err) { /* no-op */ }
                }
                lastFocusedTrigger = null;
            }, 300);
        };
    })();
</script>

<?php endif; ?>

<!-- Two Column Section: Parking & Registration -->
<?php
$parking_section_title = get_field('parking_section_title');
$parking_section_description = get_field('parking_section_description');
$host_organization = get_field('host_organization');
?>
<section class="relative overflow-hidden bg-[#fafafa] py-20 md:py-28">
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_90%_60%_at_50%_100%,rgba(31,49,49,0.04),transparent_55%)]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute inset-0 opacity-[0.5]" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%231F3131&quot; fill-opacity=&quot;0.04&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');" aria-hidden="true"></div>

    <div class="relative mx-auto max-w-7xl px-6 lg:px-8">
        <!-- Section Header -->
        <?php if ($parking_section_title || $parking_section_description || $host_organization): ?>
        <div class="mb-12 text-center md:mb-16">
            <?php if ($host_organization): ?>
            <div class="mb-5 flex justify-center">
                <div class="inline-flex items-stretch overflow-hidden rounded-md border border-[#1F3131]/[.09] bg-white shadow-[0_1px_2px_rgba(15,23,42,0.04)]"
                    role="doc-subtitle">
                    <div class="w-[3px] bg-[#98C441] self-stretch flex-shrink-0"></div>
                    <div class="flex items-center gap-[7px] px-3 py-[6px]">
                        <span class="text-[10px] font-semibold tracking-[.11em] uppercase leading-none text-[#1F3131]">
                            <?php echo esc_html($host_organization); ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($parking_section_title): ?>
            <h2 class="mb-4 text-2xl font-semibold tracking-tight text-[#1F3131] md:text-3xl lg:text-4xl"><?php echo esc_html($parking_section_title); ?></h2>
            <?php endif; ?>
            <?php if ($parking_section_description): ?>
            <p class="mx-auto max-w-2xl text-base leading-relaxed text-gray-600 md:text-lg"><?php echo esc_html($parking_section_description); ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
		
		<?php if ( is_page(1773) ) : ?>
    <div class="my-10 max-w-4xl mx-auto mb-10 md:mb-16">
        <img src="https://piedmontglobal.com/wp-content/uploads/pg_attendance_title_case.svg" alt="Conference table layout" />
    </div>
<?php endif; ?>

        <div class="grid grid-cols-1 items-stretch gap-8 lg:grid-cols-2 lg:gap-10 xl:gap-12">

            <!-- Left Column: Parking & Directions -->
            <?php
            $parking_card_title = get_field('parking_card_title');
            $parking_venue_name = get_field('parking_venue_name');
            $parking_address_line1 = get_field('parking_address_line1');
            $parking_address_line2 = get_field('parking_address_line2');
            $parking_instructions_heading = get_field('parking_instructions_heading');
            $parking_instructions = get_field('parking_instructions');
            $parking_pro_tip = get_field('parking_pro_tip');
            
            if ($parking_card_title || $parking_venue_name || $parking_address_line1 || $parking_instructions):
            ?>
            <div >
                <div class="flex h-full flex-col overflow-hidden rounded-2xl border border-white/10 bg-[#1F3131] shadow-[0_20px_50px_-12px_rgba(15,23,42,0.35)] ring-1 ring-black/20">
                    <!-- Card Header -->
                    <?php if ($parking_card_title || $parking_venue_name): ?>
                    <div class="border-b border-white/[0.08] bg-gradient-to-r from-white/[0.04] to-transparent px-6 py-6 md:px-8 md:py-7">
                        <div class="flex items-start gap-4">
                            <div
                                class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-[#98C441] shadow-[0_4px_14px_rgba(152,196,65,0.35)]">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </div>
                            <div class="min-w-0 pt-0.5">
                                <?php if ($parking_card_title): ?>
                                <h3 class="text-lg font-semibold tracking-tight text-white md:text-xl"><?php echo esc_html($parking_card_title); ?></h3>
                                <?php endif; ?>
                                <?php if ($parking_venue_name): ?>
                                <p class="mt-1 text-sm font-medium text-white/55"><?php echo esc_html($parking_venue_name); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Card Content -->
                    <div class="flex flex-1 flex-col p-6 md:p-8">
                        <!-- Address -->
                        <?php if ($parking_address_line1 || $parking_address_line2): ?>
                        <div class="mb-8 flex items-start gap-3 rounded-xl border border-white/[0.07] bg-white/[0.06] p-4 backdrop-blur-sm">
                            <svg class="w-5 h-5 text-[#98C441] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <div class="min-w-0">
                                <?php if ($parking_address_line1): ?>
                                <p class="font-semibold leading-snug text-white"><?php echo esc_html($parking_address_line1); ?></p>
                                <?php endif; ?>
                                <?php if ($parking_address_line2): ?>
                                <p class="mt-1 text-sm leading-relaxed text-white/55"><?php echo esc_html($parking_address_line2); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Step-by-step Instructions -->
                        <?php if ($parking_instructions && is_array($parking_instructions) && count($parking_instructions) > 0): ?>
                        <?php if ($parking_instructions_heading): ?>
                        <h4 class="mb-4 text-xs font-semibold uppercase tracking-[0.14em] text-[#98C441]/95"><?php echo esc_html($parking_instructions_heading); ?></h4>
                        <?php endif; ?>
                        <div class="space-y-3">
                            <?php foreach ($parking_instructions as $index => $instruction):
                                $step_title = $instruction['step_title'] ?? '';
                                $step_description = $instruction['step_description'] ?? '';
                                
                                if ($step_title || $step_description):
                            ?>
                            <div class="flex gap-4 rounded-xl border border-white/[0.06] bg-white/[0.04] p-4">
                                <span class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-[#98C441]/15 text-xs font-bold text-[#98C441] ring-1 ring-[#98C441]/25">
                                    <?php echo ($index + 1); ?></span>
                                <div class="min-w-0 pt-0.5">
                                    <?php if ($step_title): ?>
                                    <p class="mb-1 text-sm font-semibold text-white"><?php echo esc_html($step_title); ?></p>
                                    <?php endif; ?>
                                    <?php if ($step_description): ?>
                                    <p class="text-sm leading-relaxed text-white/55"><?php echo esc_html($step_description); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php 
                                endif;
                            endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <!-- Pro Tip -->
                        <?php if ($parking_pro_tip): ?>
                        <div
                            class="mt-auto flex items-start gap-3 rounded-xl border border-[#98C441]/25 bg-[#98C441]/[0.12] p-4">
                            <svg class="mt-0.5 h-5 w-5 flex-shrink-0 text-[#98C441]" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                            <p class="text-sm leading-relaxed text-white/85">
                                <span class="font-semibold text-[#98C441]">Pro tip</span>
                                <span class="text-white/40"> — </span><?php echo esc_html($parking_pro_tip); ?>
                            </p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Right Column: Registration Form -->
            <?php
            $registration_title = get_field('registration_title');
            $registration_description = get_field('registration_description');
            $registration_topic_email = get_field('registration_topic_email');
            $hubspot_embed_code = get_field('hubspot_embed_code');
            ?>
            <div id="register">
                <div class="flex h-full flex-col overflow-hidden rounded-2xl border border-gray-200/90 bg-white shadow-[0_1px_3px_rgba(15,23,42,0.04),0_12px_40px_-8px_rgba(15,23,42,0.08)] ring-1 ring-black/[0.03]">
                    <!-- Card Content -->
                    <div class="flex flex-1 flex-col p-6 sm:p-8 md:p-10">
                        <?php if ($registration_title || $registration_description): ?>
                        <div class="border-b border-gray-100 pb-6 mb-8">
                            <?php if ($registration_title): ?>
                            <h3 class="text-xl font-semibold tracking-tight text-[#111] sm:text-2xl md:text-[1.65rem] md:leading-snug"><?php echo esc_html($registration_title); ?></h3>
                            <?php endif; ?>
                            <?php if ($registration_description): ?>
                            <p class="mt-3 max-w-xl text-sm leading-relaxed text-gray-600 md:text-[15px]"><?php echo esc_html($registration_description); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <!-- Discussion Topics CTA -->
                        <?php if ($registration_topic_email): ?>
                        <div class="mb-8 flex items-start gap-3 rounded-xl border border-gray-200/80 bg-[#f6f7f9] p-4">
                            <svg class="mt-0.5 h-5 w-5 flex-shrink-0 text-gray-500" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                            </svg>
                            <div>
                                <p class="text-[13px] leading-relaxed text-gray-700 md:text-sm">
                                    <span class="font-semibold text-gray-900">Have a topic?</span>
                                    Email
                                    <a href="mailto:<?php echo esc_attr($registration_topic_email); ?>"
                                        class="font-medium text-[#1F3131] underline decoration-gray-300 underline-offset-2 transition-colors hover:decoration-[#98C441]"><?php echo esc_html($registration_topic_email); ?></a>
                                </p>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- HubSpot Form Container -->
                        <?php if ($hubspot_embed_code): ?>
                        <div class="rounded-xl border border-gray-100 bg-white p-4 shadow-[inset_0_1px_2px_rgba(15,23,42,0.04)] sm:p-6 md:p-8">
                            <?php 
                            // Output the HubSpot embed code
                            // Since this is admin-controlled ACF field, output directly
                            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            echo $hubspot_embed_code;
                            ?>
                        </div>
                        <?php endif; ?>

                        <!-- Trust Indicator -->
                        <div class="mt-8 flex items-center justify-center gap-2 text-[11px] font-medium text-gray-600 md:text-xs">
                            <svg class="h-3.5 w-3.5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            <span>Your information is handled securely</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>






</main>

<?php
get_footer();
?>