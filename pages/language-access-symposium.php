<?php
/**
 * Template Name: Language Access Symposium
 * Description: Landing page for the 3rd Annual Language Access Symposium
 */
get_header();
?>
<header class="shadow-sm bg-[#1F3131]" role="banner">
    <div class="bg-[#1F3131] pt-8 pb-6">
        <nav aria-label="Primary desktop navigation">
            <?php get_template_part('components/navigation/desktop'); ?>
        </nav>
        <nav aria-label="Primary mobile navigation">
            <?php get_template_part('components/navigation/mobile'); ?>
        </nav>
    </div>

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

                <!-- Event Badge -->
                <?php if ($event_badge_text): ?>
                <div class="inline-flex items-center gap-2 bg-[#98C441]/20 border border-[#98C441]/30 rounded-full px-4 py-1.5 mb-6"
                    data-aos="fade-up">
                    <span class="w-2 h-2 bg-[#98C441] rounded-full animate-pulse"></span>
                    <span class="text-[#98C441] text-sm font-medium tracking-wide uppercase"><?php echo esc_html($event_badge_text); ?></span>
                </div>
                <?php endif; ?>

                <!-- Heading -->
                <?php if ($event_title): ?>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white max-w-3xl mb-6 leading-tight"
                    data-aos="fade-up" data-aos-delay="50">
                    <?php echo esc_html($event_title); ?>
                </h1>
                <?php endif; ?>

                <?php if ($event_description): ?>
                <p class="max-w-3xl text-base md:text-lg text-white/85 mb-10 leading-relaxed" data-aos="fade-up"
                    data-aos-delay="100">
                    <?php echo esc_html($event_description); ?>
                </p>
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
                
                // Check if any event detail exists
                $has_event_details = $event_date_day || $event_date || $event_time || $event_location_name || $event_refreshments_title;
                
                if ($has_event_details):
                ?>
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-3 lg:p-5 mb-10 max-w-5xl"
                    data-aos="fade-up" data-aos-delay="150">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-4">

                        <!-- Date -->
                        <?php if ($event_date_day || $event_date): ?>
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-[#98C441]/15 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-[#98C441]" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
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
                        <?php if ($event_time): ?>
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-[#98C441]/15 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-[#98C441]" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-white font-semibold"><?php echo esc_html($event_time); ?></p>
                                <?php if ($event_timezone): ?>
                                <p class="text-white/90"><?php echo esc_html($event_timezone); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Location -->
                        <?php if ($event_location_name || $event_location_city): ?>
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-[#98C441]/15 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-[#98C441]" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
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
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-[#98C441]/15 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-[#98C441]" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 01-6.23.693L5 15.3m14.8 0l.002 1.2a2.25 2.25 0 01-2.248 2.25H6.444a2.25 2.25 0 01-2.248-2.25l.002-1.2" />
                                </svg>
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
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                        </svg>
                    </a>
                    <?php endif; ?>
                    <?php if ($cta_subtext): ?>
                    <span class="inline-flex items-center gap-2 text-white/70 text-sm px-4 py-4">
                        <svg class="w-4 h-4 text-[#98C441]" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                        </svg>
                        <span><?php echo esc_html($cta_subtext); ?></span>
                    </span>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</header>

<!-- Symposium Agenda Section -->
<?php
$agenda_section_label = get_field('agenda_section_label');
$agenda_section_title = get_field('agenda_section_title');
$agenda_sessions = get_field('agenda_sessions');

if ($agenda_section_label || $agenda_section_title || $agenda_sessions):
?>
<section class="relative py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
       
        <!-- Section Header -->
        <?php if ($agenda_section_label || $agenda_section_title): ?>
        <div class="max-w-3xl mb-10 md:mb-16">
            <?php if ($agenda_section_label): ?>
            <p class="uppercase tracking-widest text-sm font-semibold text-[#98C441] mb-3">
                <?php echo esc_html($agenda_section_label); ?>
            </p>
            <?php endif; ?>
            <?php if ($agenda_section_title): ?>
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold leading-tight mb-4 text-[#1F3131]">
                <?php echo esc_html($agenda_section_title); ?>
            </h2>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Agenda Timeline -->
        <?php if ($agenda_sessions && is_array($agenda_sessions) && count($agenda_sessions) > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach ($agenda_sessions as $session): 
                $session_time = $session['session_time'] ?? '';
                $session_title = $session['session_title'] ?? '';
                $session_description = $session['session_description'] ?? '';
                
                if ($session_time || $session_title || $session_description):
            ?>
            <div class="bg-white p-6 md:p-10 relative rounded-lg shadow-sm">
                <div class="absolute top-0 left-0 w-full h-1 bg-[#98C441]"></div>
                <div class="flex items-center gap-3 mb-4 md:mb-6">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#1F3131] flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-[#98C441]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <?php if ($session_time): ?>
                    <div>
                        <span class="text-[#1F3131] text-xs md:text-sm font-semibold uppercase tracking-wider"><?php echo esc_html($session_time); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if ($session_title): ?>
                <h3 class="text-xl md:text-2xl font-bold mb-3 md:mb-4 text-[#1F3131]"><?php echo esc_html($session_title); ?></h3>
                <?php endif; ?>
                <?php if ($session_description): ?>
                <p class="text-gray-600 leading-relaxed">
                    <?php echo esc_html($session_description); ?>
                </p>
                <?php endif; ?>
            </div>
            <?php 
                endif;
            endforeach; ?>
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
<section class="relative py-24 md:py-32 bg-[#F9F8F6] overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-12 md:mb-16" data-aos="fade-up">
            <div>
                <p class="text-[#98C441] text-sm font-medium tracking-[0.2em] uppercase mb-3">Speakers</p>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-[#1F3131] leading-tight">Featured Speakers</h2>
            </div>
        </div>

        <!-- Speakers Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
            <?php 
            $speaker_index   = 0;
            $speakers_for_js = [];
            foreach ($speakers as $index => $speaker): 
                $speaker_image       = $speaker['speaker_image'] ?? '';
                $speaker_name        = $speaker['speaker_name'] ?? '';
                $speaker_title       = $speaker['speaker_title'] ?? '';
                $speaker_description = $speaker['speaker_description'] ?? '';
                $speaker_linkedin    = $speaker['speaker_linkedin'] ?? '';
                $delay               = $speaker_index * 100;

                // Prepare data for modal (description is WYSIWYG, sanitize with kses)
                $speakers_for_js[] = [
                    'name'        => $speaker_name,
                    'title'       => $speaker_title,
                    'photo'       => $speaker_image,
                    'linkedin'    => $speaker_linkedin,
                    'description' => wp_kses_post($speaker_description),
                ];
            ?>
            <div class="group cursor-pointer"
                 onclick="openSpeakerModal(<?php echo (int) $index; ?>)"
                 data-aos="fade-up"
                 data-aos-duration="400"
                 data-aos-delay="<?php echo (int) $delay; ?>"
                 data-aos-easing="ease-out">
                <div class="relative overflow-hidden bg-white shadow-md hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <!-- Photo -->
                    <div class="relative aspect-[4/5] overflow-hidden">
                        <?php if ($speaker_image): ?>
                            <img 
                                src="<?php echo esc_url($speaker_image); ?>" 
                                alt="<?php echo esc_attr($speaker_name); ?>"
                                class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110"
                                loading="lazy"
                                decoding="async"
                            >
                        <?php else: ?>
                            <div class="w-full h-full bg-[#1F3131]/5 flex items-center justify-center">
                                <span class="text-5xl font-bold text-[#1F3131]/20">
                                    <?php echo esc_html(mb_substr($speaker_name, 0, 1)); ?>
                                </span>
                            </div>
                        <?php endif; ?>

                        <!-- Gradient Overlay & Hover Content -->
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1F3131]/90 via-[#1F3131]/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute inset-0 flex flex-col justify-end p-5 opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                            <span class="inline-flex items-center gap-2 text-white/95 text-xs font-semibold tracking-wide mb-3 uppercase">
                                <span class="w-1.5 h-1.5 bg-[#98C441]"></span>
                                View bio
                            </span>
                            <?php if (!empty($speaker_linkedin)) : ?>
                                <div class="flex items-center gap-3">
                                    <a 
                                        href="<?php echo esc_url($speaker_linkedin); ?>" 
                                        target="_blank" 
                                        rel="noopener noreferrer"
                                        onclick="event.stopPropagation();"
                                        class="w-10 h-10 flex items-center justify-center bg-white/10 backdrop-blur-sm hover:bg-[#98C441] text-white transition-all duration-200 border border-white/30"
                                        title="View LinkedIn Profile"
                                    >
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="p-6 relative">
                        <div class="absolute top-0 left-0 right-0 h-0.5 bg-gradient-to-r from-[#98C441] via-[#98C441] to-transparent transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <?php if ($speaker_name): ?>
                                    <h3 class="text-xl font-bold text-[#1F3131] mb-1 group-hover:text-[#98C441] transition-colors duration-300">
                                        <?php echo esc_html($speaker_name); ?>
                                    </h3>
                                <?php endif; ?>
                                <?php if ($speaker_title): ?>
                                    <p class="text-[#1F3131]/70 font-medium text-sm">
                                        <?php echo esc_html($speaker_title); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <div class="w-9 h-9 bg-gray-100 flex items-center justify-center transition-all duration-300 flex-shrink-0">
                                <svg class="w-5 h-5 text-gray-400 transition-colors duration-300 transform group-hover:translate-x-0.5 group-hover:text-[#1F3131]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Bio intentionally only in modal -->
                    </div>
                </div>
            </div>
            <?php 
                $speaker_index++;
            endforeach; 
            ?>
        </div>
    </div>
</section>

<!-- Speaker Bio Modal -->
<div id="speakerBioModal" class="fixed inset-0 z-50 hidden opacity-0 transition-opacity duration-300">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-gradient-to-br from-black/80 via-black/70 to-black/80 backdrop-blur-md" onclick="closeSpeakerModal()"></div>

    <!-- Modal Content -->
    <div class="relative flex items-center justify-center min-h-screen p-4 md:p-10 lg:p-16">
        <div id="speakerBioModalContent" class="relative bg-white shadow-2xl max-w-6xl w-full max-h-[80vh] overflow-hidden transform scale-95 transition-transform duration-300 border border-gray-200">
            <!-- Close Button -->
            <button 
                type="button"
                onclick="closeSpeakerModal()" 
                class="absolute top-6 right-6 z-20 w-11 h-11 flex items-center justify-center bg-white/95 hover:bg-white shadow-lg hover:shadow-xl border border-gray-100 transition-all duration-200"
            >
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Modal Body -->
            <div class="flex flex-col md:flex-row h-full">
                <!-- Left: Photo -->
                <div class="md:w-2/5 bg-gray-50 border-r border-gray-200">
                    <div class="h-full max-h-[80vh]">
                        <img 
                            id="speakerModalPhoto" 
                            src="" 
                            alt="" 
                            class="w-full h-full object-cover"
                        >
                    </div>
                </div>

                <!-- Right: Content -->
                <div class="md:w-3/5 p-7 md:p-9 lg:p-10 flex flex-col overflow-y-auto max-h-[80vh]">
                    <div class="mb-6">
                        <p class="text-xs font-semibold tracking-[0.25em] text-[#98C441] uppercase mb-3">Speaker</p>
                        <h3 id="speakerModalName" class="text-3xl md:text-4xl font-bold text-[#1F3131] mb-3 tracking-tight"></h3>
                        <p id="speakerModalTitle" class="text-base md:text-lg text-[#1F3131]/70 font-medium"></p>
                    </div>

                    <div class="mb-8 pr-1">
                        <div id="speakerModalBio" class="text-gray-700 leading-relaxed text-base md:text-lg prose prose-lg max-w-none"></div>
                    </div>

                    <div id="speakerModalLinkedInWrapper" class="mt-auto pt-6 border-t border-gray-100 hidden">
                        <a 
                            id="speakerModalLinkedIn" 
                            href="" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-3 px-7 py-3 bg-[#1F3131] text-white hover:bg-[#98C441] hover:text-[#1F3131] transition-all duration-200 shadow-lg hover:shadow-xl font-semibold"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                            <span>View LinkedIn Profile</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    const speakersData = <?php echo wp_json_encode( $speakers_for_js ); ?>;
    const speakerModal = document.getElementById('speakerBioModal');
    const speakerModalContent = document.getElementById('speakerBioModalContent');

    function openSpeakerModal(index) {
        const speaker = speakersData[index];
        if (!speaker) {
            return;
        }

        const photoEl = document.getElementById('speakerModalPhoto');
        const nameEl = document.getElementById('speakerModalName');
        const titleEl = document.getElementById('speakerModalTitle');
        const bioEl = document.getElementById('speakerModalBio');
        const linkedInWrapper = document.getElementById('speakerModalLinkedInWrapper');
        const linkedInEl = document.getElementById('speakerModalLinkedIn');

        photoEl.src = speaker.photo || '';
        photoEl.alt = speaker.name || '';
        nameEl.textContent = speaker.name || '';
        titleEl.textContent = speaker.title || '';
        bioEl.innerHTML = speaker.description || '';

        if (speaker.linkedin && speaker.linkedin.trim() !== '') {
            linkedInEl.href = speaker.linkedin;
            linkedInWrapper.classList.remove('hidden');
        } else {
            linkedInWrapper.classList.add('hidden');
        }

        speakerModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        requestAnimationFrame(() => {
            speakerModal.classList.remove('opacity-0');
            speakerModal.classList.add('opacity-100');
            speakerModalContent.classList.remove('scale-95');
            speakerModalContent.classList.add('scale-100');
        });
    }

    function closeSpeakerModal() {
        speakerModal.classList.remove('opacity-100');
        speakerModal.classList.add('opacity-0');
        speakerModalContent.classList.remove('scale-100');
        speakerModalContent.classList.add('scale-95');

        setTimeout(() => {
            speakerModal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !speakerModal.classList.contains('hidden')) {
            closeSpeakerModal();
        }
    });
</script>

<?php endif; ?>

<!-- Two Column Section: Parking & Registration -->
<?php
$parking_section_title = get_field('parking_section_title');
$parking_section_description = get_field('parking_section_description');
$host_organization = get_field('host_organization');
?>
<section class="relative py-20 bg-gray-50 overflow-hidden">
    <!-- Subtle Pattern Background -->
    <div class="absolute inset-0 opacity-40" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%239C92AC&quot; fill-opacity=&quot;0.05&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
        <!-- Section Header -->
        <?php if ($parking_section_title || $parking_section_description || $host_organization): ?>
        <div class="text-center mb-10 md:mb-16" data-aos="fade-up">
            <?php if ($host_organization): ?>
            <div class="inline-flex items-center gap-2 bg-[#98C441]/20 border border-[#98C441]/30 rounded-full px-4 py-1.5 mb-6" data-aos="fade-up">
                <span class="w-2 h-2 bg-[#98C441] rounded-full animate-pulse"></span>
                <span class="text-[#98C441] text-sm font-medium"><?php echo esc_html($host_organization); ?></span>
            </div>
            <?php endif; ?>
            <?php if ($parking_section_title): ?>
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#1F3131] mb-6"><?php echo esc_html($parking_section_title); ?></h2>
            <?php endif; ?>
            <?php if ($parking_section_description): ?>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto"><?php echo esc_html($parking_section_description); ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-0 items-stretch">

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
            <div data-aos="fade-up" data-aos-delay="100">
                <div class="bg-[#1F3131] shadow-xl h-full overflow-hidden">
                    <!-- Card Header -->
                    <?php if ($parking_card_title || $parking_venue_name): ?>
                    <div class="px-6 md:px-8 py-5 md:py-6 border-b border-white/10">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-full bg-[#98C441] flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </div>
                            <div>
                                <?php if ($parking_card_title): ?>
                                <h3 class="text-xl font-bold text-white"><?php echo esc_html($parking_card_title); ?></h3>
                                <?php endif; ?>
                                <?php if ($parking_venue_name): ?>
                                <p class="text-white/60 text-sm"><?php echo esc_html($parking_venue_name); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Card Content -->
                    <div class="p-6 md:p-8">
                        <!-- Address -->
                        <?php if ($parking_address_line1 || $parking_address_line2): ?>
                        <div class="flex items-start gap-3 p-4 bg-white/10 rounded-xl mb-8">
                            <svg class="w-5 h-5 text-[#98C441] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <div>
                                <?php if ($parking_address_line1): ?>
                                <p class="font-semibold text-white"><?php echo esc_html($parking_address_line1); ?></p>
                                <?php endif; ?>
                                <?php if ($parking_address_line2): ?>
                                <p class="text-white/60 text-sm"><?php echo esc_html($parking_address_line2); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Step-by-step Instructions -->
                        <?php if ($parking_instructions && is_array($parking_instructions) && count($parking_instructions) > 0): ?>
                        <?php if ($parking_instructions_heading): ?>
                        <h4 class="font-bold text-[#98C441] mb-5 text-sm uppercase tracking-wide"><?php echo esc_html($parking_instructions_heading); ?></h4>
                        <?php endif; ?>
                        <div class="space-y-5">
                            <?php foreach ($parking_instructions as $index => $instruction):
                                $step_title = $instruction['step_title'] ?? '';
                                $step_description = $instruction['step_description'] ?? '';
                                
                                if ($step_title || $step_description):
                            ?>
                            <div class="flex gap-4">
                                <div
                                    class="w-8 h-8 rounded-full bg-[#98C441] flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                    <?php echo ($index + 1); ?></div>
                                <div>
                                    <?php if ($step_title): ?>
                                    <p class="font-medium text-white mb-1"><?php echo esc_html($step_title); ?></p>
                                    <?php endif; ?>
                                    <?php if ($step_description): ?>
                                    <p class="text-white/60 text-sm"><?php echo esc_html($step_description); ?></p>
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
                            class="mt-8 flex items-start gap-3 p-4 bg-[#98C441]/20 rounded-xl border border-[#98C441]/30">
                            <svg class="w-5 h-5 text-[#98C441] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                            <p class="text-sm text-white/90">
                                <span class="font-semibold text-[#98C441]">Pro tip:</span> <?php echo esc_html($parking_pro_tip); ?>
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
            <div id="register" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white shadow-xl h-full overflow-hidden border border-gray-100">
                    <!-- Card Content -->
                    <div class="p-6 md:p-8">
                        <?php if ($registration_title || $registration_description): ?>
                        <div>
                            <?php if ($registration_title): ?>
                            <h3 class="text-lg md:text-3xl font-bold text-black"><?php echo esc_html($registration_title); ?></h3>
                            <?php endif; ?>
                            <?php if ($registration_description): ?>
                            <p class="text-black/60 text-sm pt-2 pb-6"><?php echo esc_html($registration_description); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <!-- Discussion Topics CTA -->
                        <?php if ($registration_topic_email): ?>
                        <div class="flex items-start gap-3 p-4 bg-blue-50 rounded-xl border border-blue-100 mb-8">
                            <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                            </svg>
                            <div>
                                <p class="text-sm text-blue-800">
                                    <span class="font-semibold">Have a topic?</span> Submit discussion topics to
                                    <a href="mailto:<?php echo esc_attr($registration_topic_email); ?>"
                                        class="underline hover:no-underline"><?php echo esc_html($registration_topic_email); ?></a>
                                </p>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- HubSpot Form Container -->
                        <?php if ($hubspot_embed_code): ?>
                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                            <?php 
                            // Output the HubSpot embed code
                            // Since this is admin-controlled ACF field, output directly
                            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            echo $hubspot_embed_code;
                            ?>
                        </div>
                        <?php endif; ?>

                        <!-- Trust Indicator -->
                        <div class="mt-6 flex items-center justify-center gap-2 text-xs text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            <span>Your information is secure</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>






<?php
get_template_part('components/common/cta');
get_footer();
?>