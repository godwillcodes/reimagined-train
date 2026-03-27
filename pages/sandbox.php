<?php
/**
 * Template Name: Sandbox
 * Description: 
 */
get_header();
?>

<section class="relative w-full text-white overflow-hidden"
    style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url() ); ?>'); background-size: cover; background-position: center;">
    <?php
        get_template_part('components/navigation/desktop-sandbox');
        get_template_part('components/navigation/mobile');
    ?>

    <!-- Gradient tint overlay -->
    <div class="absolute inset-0 z-10 bg-gradient-to-r from-[#1F3131]/90 via-[#1F3131]/90 to-transparent"></div>

    <div class="w-full py-20  px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="max-w-7xl mx-auto w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">

                <!-- Left: Text Content -->
                <div class="relative z-20 mt-10 flex flex-col">
                    <span class="text-4xl font-bold leading-tight">
                        Removing barrier in healthcare with intelligent access
                    </span>

                    <p class="text-base sm:text-lg lg:text-xl mt-4 sm:mt-6 leading-relaxed">
                        We help health systems deliver seamless access to care, combining language services,
                        patient-facing
                        technology, and system-wide efficiency improvements that strengthen clinical outcomes and
                        operational performance.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 mt-8 sm:mt-12">
                        <a href="#"
                            class="js-open-sandbox-modal inline-flex items-center justify-center bg-[#8DC63F] hover:bg-[#7AB22E] text-black font-bold px-6 sm:px-8 py-3 sm:py-4 text-base lg:text-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#7AB22E] focus:ring-offset-2 focus:ring-offset-[#1F3131] whitespace-nowrap">
                            Schedule a consultation
                        </a>

                        <a href="#"
                            class="inline-flex items-center justify-center sm:justify-start text-base lg:text-lg font-medium group focus:outline-none focus:ring-2 focus:ring-[#D16555] focus:ring-offset-2 transition-colors duration-200">
                            <span class="border-b-2 border-[#D16555] pb-0.5">Explore full capabilities</span>
                            <span
                                class="ml-2 text-lg transform transition-transform duration-300 group-hover:translate-x-1">→</span>
                        </a>
                    </div>

                    <!-- Trusted By Logos -->
                    <div class="mt-12 sm:mt-16">
                        <span
                            class="text-white text-base sm:text-lg font-bold mb-4 sm:mb-6 block text-center sm:text-left">
                            Trusted by
                        </span>
                        <div class="grid grid-cols-5 gap-3 sm:gap-4 max-w-md mx-auto sm:mx-0">
                            <?php 
                            $logos = [
                                'logo-01.svg',
                                'logo-02.svg',
                                'logo-03.svg',
                                'logo-04.svg',
                                'logo-05.svg',
                            ];
                            foreach ( $logos as $logo ) : ?>
                            <div class="flex items-center justify-center">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/hc/logos/' . $logo ); ?>"
                                    alt="Trusted partner logo" width="96" height="96" loading="lazy" decoding="async"
                                    class="h-12 sm:h-16 lg:h-20 w-auto object-contain transition duration-300 ease-in-out grayscale hover:grayscale-0" />
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Right: Form -->
                <div class="relative w-full lg:mt-0">

                </div>

            </div>
        </div>
    </div>
</section>


<section class="bg-white lg:py-12" aria-labelledby="why-piedmont-title">
    <div
        class="max-w-7xl border-1 p-6 sm:p-10 border-stone-300 rounded-[4px] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

        <!-- Left side: Title and Description -->
        <div class="lg:col-span-1 text-left">
            <h2 id="why-piedmont-title" class="text-2xl md:text-4xl max-w-sm font-bold mb-6 mx-auto lg:mx-0">
                Why Piedmont Global </h2>
            <div class="text-base md:text-lg text-black max-w-xl mb-6 prose mx-auto lg:mx-0">
                <p>Healthcare depends on clear communication, reliable workflows, and culturally competent support. We
                    help providers remove barriers, strengthen compliance, and build systems that perform with
                    consistency across every patient interaction.</p>

            </div>

            <!-- Two column row with ticks -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10 max-w-xl mx-auto lg:mx-0">
                <?php 
                $items = [
                    "Improve patient understanding across all points of care",
                    "Increase operational efficiency with streamlined workflows",
                    "Reduce clinical risk associated with communication gaps",
                    "Expand equitable access for diverse patient populations",
                    "Strengthen compliance through consistent documentation",
                    "Enhance provider productivity through reduced friction",
                    "Improve overall care experience with clearer interactions",
                ];

                foreach ($items as $item): ?>
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-black flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-base text-black"><?php echo esc_html($item); ?></span>
                </div>
                <?php endforeach; ?>


            </div>
            <a href="#"
                class="mt-10 inline-flex justify-center lg:justify-start self-start items-center text-base font-medium group focus:outline-none focus:ring-2 focus:ring-[#D16555] focus:ring-offset-2 transition-colors duration-200"
                aria-label="Explore full capabilities - opens contact form">
                <span class="border-b-2 border-[#D16555] pb-0.5">Explore full capabilities</span>
                <span class="ml-1 text-lg transform transition-transform duration-300 group-hover:translate-x-1"
                    aria-hidden="true">→</span>
            </a>
        </div>

        <!-- Right side: Image -->
        <div class="lg:col-span-1 flex justify-center lg:justify-end">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/hc/image419.png'); ?>"
                alt="Piedmont Global team working with Consumer goods clients" class="max-w-full h-auto object-cover">
        </div>

    </div>
</section>


<section class="relative overflow-hidden lg:pb-12" aria-labelledby="why-piedmont-title">
    <div class="absolute inset-0 w-full h-full pointer-events-none flex items-center justify-center">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/pattern-4.svg'); ?>" alt=""
            class="max-w-none w-[180%] md:w-full h-[500px] object-contain" aria-hidden="true" />
    </div>
    <div class="relative max-w-7xl mx-3  mb-6 lg:mb-0  border-1 p-8 sm:p-16 rounded-[4px] lg:mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center"
        style="background-image: linear-gradient(to bottom, #1F3131 50%, #006155 100%), url('<?php echo esc_url(get_template_directory_uri() . '/assets/hc/bg-1.svg'); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">


        <div class="lg:col-span-1 flex justify-center">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/hc/graphic-1.svg'); ?>"
                alt="Piedmont Global team working with Consumer goods clients"
                class="max-w-full p-4 h-auto object-cover">
        </div>
        <!-- Left side: Title and Description -->
        <div class="lg:col-span-1 ">
            <span class="text-[#8dc63f] text-lg mb-10">Key Features</span>
            <h2 id="why-piedmont-title"
                class="text-2xl mt-5 text-white md:text-4xl max-w-sm font-bold mb-6 mx-auto lg:mx-0">
                Hybrid intelligence model </h2>
            <div class="text-base md:text-lg text-white max-w-xl mb-6 prose-invert mx-auto lg:mx-0">
                <p>We combine human judgment with intelligent automation to create a language-access ecosystem that
                    scales with your population and adapts to the realities of clinical operations.
                    This model strengthens accuracy, reduces friction, and supports consistent oversight, thereby giving
                    providers a more stable, compliant, and efficient foundation for patient communicationss.</p>

            </div>

            <!-- Two column row with ticks -->

            <a href="#"
                class="mt-10 inline-flex justify-center lg:justify-start self-start items-center text-base font-medium group focus:outline-none focus:ring-2 focus:ring-[#D16555] focus:ring-offset-2 transition-colors duration-200"
                aria-label="Explore full capabilities - opens contact form">
                <span class="border-b-2 text-white border-[#D16555] pb-0.5">Explore full capabilities</span>
                <span
                    class="ml-1 text-lg text-white transform transition-transform duration-300 group-hover:translate-x-1"
                    aria-hidden="true">→</span>
            </a>
        </div>

        <!-- Right side: Image -->


    </div>
</section>

<section class="bg-white lg:pb-12" aria-labelledby="why-piedmont-title">
    <div class="max-w-7xl mx-auto border-1 p-6 sm:p-10 border-stone-300 rounded-[4px]"
        style="background: linear-gradient(to bottom, #F7F7F5 0%, #F7F7F5 80%, #98C44180 95%, #98C44180 100%);">

        <h2 id="why-piedmont-title" class="text-2xl md:text-4xl max-w-sm font-bold mb-6  mx-auto lg:mx-0">
            Our solutions
        </h2>

        <p class="text-base md:text-lg text-black mb-12 prose  lg:mx-0">
            A unified operating layer for language that centralizes interpreting, localization, and communication
            workflows into a single, coherent system. It improves accuracy, accelerates response times, and strengthens
            clinical reliability across every point of care.
        </p>

        <div x-data="{
                tabs: [
                    { id: 'langops', label: 'LangOps' },
                    { id: 'accessibility', label: 'Accessibility' },
                    { id: 'dataservice', label: 'Data service' },
                    { id: 'staffing', label: 'Staffing' },
                    { id: 'consulting', label: 'Consulting' },
                ],
                active: 'langops',
                content: {
                    langops: {
                        title: 'LangOps',
                        description: 'Centralized language operations to unify interpreting, translation, and localization into a single operational layer.',
                        image: '<?php echo esc_url(get_template_directory_uri() . '/assets/hc/Col.png'); ?>',
                    },
                    accessibility: {
                        title: 'Accessibility',
                        description: 'Solutions that enhance access, clarity, and inclusion across every patient interaction.',
                                                image: '<?php echo esc_url(get_template_directory_uri() . '/assets/hc/Col.png'); ?>',

                    },
                    dataservice: {
                        title: 'Data Service',
                        description: 'Analytics-driven insights designed to improve communication workflows and operational efficiency.',
                                                image: '<?php echo esc_url(get_template_directory_uri() . '/assets/hc/Col.png'); ?>',

                    },
                    staffing: {
                        title: 'Staffing',
                        description: 'Reliable interpreter workforce solutions to support system-wide language needs.',
                                                image: '<?php echo esc_url(get_template_directory_uri() . '/assets/hc/Col.png'); ?>',

                    },
                    consulting: {
                        title: 'Consulting',
                        description: 'Expert advisory services that strengthen communication strategy, compliance, and patient experience.',
                                                image: '<?php echo esc_url(get_template_directory_uri() . '/assets/hc/Col.png'); ?>',

                    },
                }
            }" class="w-full pb-10">

            <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">

                <div class="space-y-4">
                    <template x-for="tab in tabs" :key="tab.id">
                        <button @click="active = tab.id"
                            class="w-full flex items-center gap-3 py-3 px-4 text-left transition text-gray-800 border border-transparent rounded-lg bg-white"
                            :class="active === tab.id ? 'shadow-lg border-gray-300' : ''">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/hc/icon.png'); ?>"
                                alt="" class="w-5 h-5 flex-shrink-0">
                            <span x-text="tab.label" class="flex-1"></span>
                            <span class="ml-auto" x-show="active === tab.id">→</span>
                        </button>
                    </template>

                    <a href="#"
                        class="mt-5 inline-flex self-start items-center text-base font-medium group focus:outline-none focus:ring-2 focus:ring-[#D16555] focus:ring-offset-2 transition-colors duration-200">
                        <span class="border-b-2 border-[#D16555] pb-0.5">Explore full capabilities</span>
                        <span class="ml-1 text-lg transform transition-transform duration-300 group-hover:translate-x-1"
                            aria-hidden="true">→</span>
                    </a>
                </div>

                <div class="lg:col-span-2 flex mt-8 lg:mt-0">
                    <div class="max-w-full space-y-4 text-center lg:text-left bg-white p-6 rounded-[4px]">

                        <h3 class="text-xl font-bold text-gray-900" x-text="content[active].title"></h3>

                        <p class="text-sm text-gray-700 leading-relaxed" x-text="content[active].description"></p>

                        <a href="#" class="inline-flex items-center text-sm font-medium border-b-2 border-[#D16555]">
                            Learn more →
                        </a>

                        <img :src="content[active].image" alt=""
                            class="h-auto w-full object-contain mx-auto rounded-lg" />


                    </div>
                </div>

            </div>

        </div>

    </div>
</section>


<section class="lg:pb-10">
    <div class="max-w-7xl mx-auto py-16 px-6 lg:px-0">
        <!-- Title and description -->
        <div class="flex flex-col items-center text-center mb-8">
            <h2 id="why-piedmont-title" class="text-2xl md:text-4xl font-bold mb-2">
                Piedmont Global Healthcare
            </h2>
            <div class="text-base text-black prose  mb-3">
                <p>
                    A unified operating layer for language that centralizes interpreting, localization, and
                    communication
                    workflows into a single, coherent system. It improves accuracy, accelerates response times, and
                    strengthens
                    clinical reliability across every point of care.
                </p>
            </div>
        </div>

        <!-- Card -->
        <div class="border border-stone-300 rounded-[4px] lg:p-12 p-6"
            style="background: linear-gradient(to bottom, #FFFFFF 0%, #FFFFFF 80%, #98C44180 95%, #98C44180 100%);">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

                <!-- Left side: Text -->
                <div class="lg:col-span-1 text-left">
                    <span class="text-[#D16555] text-base font-medium mb-4 inline-block">STAGE 1 • REGISTRATION</span>
                    <h3 class="text-2xl md:text-4xl max-w-sm font-bold mt-2">Registration Made Simple</h3>
                    <div class="text-base md:text-lg text-black max-w-xl mb-6 prose">
                        <p>
                            Healthcare depends on clear communication, reliable workflows, and culturally competent
                            support. We
                            help providers remove barriers, strengthen compliance, and build systems that perform with
                            consistency
                            across every patient interaction.
                        </p>
                    </div>

                    <!-- Features -->
                    <div class="grid grid-cols-1 gap-4 mt-6 max-w-xl">
                        <?php 
              $items = [
                "Improve patient understanding across all points of care",
                "Increase operational efficiency with streamlined workflows",
                "Reduce clinical risk associated with communication gaps",
                "Expand equitable access for diverse patient populations",
              ];
              foreach ($items as $item): ?>
                        <div class="flex items-center gap-3">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 text-[#D16555] flex-shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                            <span class="text-base text-black"><?php echo esc_html($item); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <a href="#"
                        class="mt-8 inline-flex items-center text-base font-medium border-b-2 border-[#D16555] pb-0.5">
                        Explore full capabilities
                        <span class="ml-1 text-lg">→</span>
                    </a>
                </div>

                <!-- Right side: Image -->
                <div class="lg:col-span-1 flex justify-center lg:justify-end">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/hc/image419.png'); ?>"
                        alt="Piedmont Global team working with Consumer goods clients"
                        class="max-w-full h-auto object-cover">
                </div>

            </div>

            <!-- Navigation and markers -->
            <div class="mt-24">
                <div class="flex flex-col md:flex-row items-center justify-between">

                    <!-- Markers: numbers on the edge -->
                    <!-- Markers -->
                    <div class="flex justify-start gap-3 md:gap-4 md:flex-1">
                        <span
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-[#006155] text-white font-semibold 
               hover:bg-[#98C441] hover:text-[#006155] hover:border hover:border-[#006155] transition-colors duration-200">1</span>
                        <span
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-[#006155] text-white font-semibold 
               hover:bg-[#98C441] hover:text-[#006155] hover:border hover:border-[#006155] transition-colors duration-200">2</span>
                        <span
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-[#006155] text-white font-semibold 
               hover:bg-[#98C441] hover:text-[#006155] hover:border hover:border-[#006155] transition-colors duration-200">3</span>
                        <span
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-[#006155] text-white font-semibold 
               hover:bg-[#98C441] hover:text-[#006155] hover:border hover:border-[#006155] transition-colors duration-200">4</span>
                    </div>

                    <!-- Navigation buttons -->
                    <div class="flex justify-end gap-3 md:flex-1 mt-4 md:mt-0">
                        <button
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-[#006155]  text-white
                 hover:bg-[#98C441] hover:text-[#006155] hover:border hover:border-[#006155] transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                        </button>

                        <button
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-[#006155]  text-white
                 hover:bg-[#98C441] hover:text-[#006155] hover:border hover:border-[#006155] transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </button>
                    </div>


                </div>
            </div>

        </div>
    </div>
</section>



<section class=" lg:pb-10">
    <div class="max-w-7xl mx-auto bg-[#F9F8F6] border-1 border-stone-300 rounded-[4px] py-16 px-10">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl md:text-3xl lg:text-4xl font-bold  max-w-[150px] lg:max-w-lg">
                Related resources
            </h2>
            <div class="flex items-center gap-3">
                <button id="sandbox-news-prev" aria-label="Previous" class="p-2 bg-[#cccccc] rounded hover:bg-black/5 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="sandbox-news-next" aria-label="Next" class="p-2 bg-[#cccccc] rounded hover:bg-black/5 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <button type="button" data-carousel-pause-target=".sandbox-news-carousel"
                    class="p-2 bg-[#cccccc] rounded hover:bg-black/5 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2"
                    aria-label="Pause auto-rotation">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <rect x="6" y="4" width="4" height="16" rx="1" />
                        <rect x="14" y="4" width="4" height="16" rx="1" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="relative z-10">
            <div class="owl-carousel sandbox-news-carousel pt-6" role="region" aria-roledescription="carousel" aria-label="Related resources">

                <?php
                $news_query = new WP_Query([
                    'post_type'      => 'post',
                    'posts_per_page' => 10,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ]);

                if ( $news_query->have_posts() ) :
                    while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
                <a href="<?php the_permalink(); ?>"
                    class="group flex flex-col h-[500px] shadow-md relative rounded border bg-white border-[#ffffff]/40 transition-transform duration-300 hover:shadow-lg">

                    <!-- Image -->
                    <div class="overflow-hidden h-1/2 rounded-t-[4px]">
                        <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail('full', ['class' => 'w-full h-auto object-cover object-top transition-transform duration-500 group-hover:scale-105']); ?>
                        <?php endif; ?>
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex flex-col flex-1">
                        <div class="text-gray-500 text-sm mb-2"><?php echo get_the_date('F j, Y'); ?></div>
                        <h3 class="text-xl font-semibold text-[#1F3131] mb-2"><?php the_title(); ?></h3>
                        <div class="flex-1"></div>
                        <div class="self-start">
                            <span
                                class="inline-flex items-center lg:text-base text-sm font-medium border-b-2 border-[#D16555]">
                                Read More <span class="ml-1 text-lg">→</span>
                            </span>
                        </div>
                    </div>

                </a>

                <?php endwhile;
                    wp_reset_postdata();
                endif;
                ?>

            </div>
        </div>
    </div>

</section>

<section class="bg-white lg:pb-10" aria-labelledby="why-piedmont-title">
    <div class="max-w-7xl mx-auto border-1 px-10 pb-40 pt-12 border-stone-300 rounded-[4px]"
        style="background: linear-gradient(to bottom, #F7F7F5 0%, #F7F7F5 70%, #98C44180 85%, #98C44180 100%);">

        <div class="max-w-4xl mx-auto px-6 text-center" x-data="{ active: null }">
            <div class="mb-10">
                <div
                    class="inline-flex items-center gap-2 rounded-full bg-[#1f3131] px-4 py-2 text-sm font-semibold text-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    FAQ
                </div>
                <h2 class="mt-4 text-3xl md:text-3xl font-bold text-gray-900">Frequently asked questions</h2>
            </div>

            <div class="divide-y divide-gray-200 text-left">
                <div class="py-4">
                    <button @click="active === 1 ? active = null : active = 1"
                        class="w-full flex justify-between items-center text-left focus:outline-none">
                        <span class="font-bold text-gray-900 text-lg lg:text-xl"
                            :class="{ 'text-[#1F3131]': active === 1 }">
                            How is Piedmont Global’s medical translation and interpretation different from traditional
                            LSPs? </span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-gray-500 transform transition-transform duration-200"
                            :class="{ 'rotate-180 text-[#1F3131]': active === 1 }" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path x-show="active !== 1" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 5v14m7-7H5"></path>
                            <path x-show="active === 1" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 12H5" style="display: none;"></path>
                        </svg>
                    </button>

                    <div x-show="active === 1" x-collapse="" class="mt-3 text-gray-700 prose text-base leading-relaxed"
                        style="display: none;">
                        <p><span data-olk-copy-source="MailCompose">As a <a
                                    href="http://piedmont-global.local/strategic-globalization/">Strategic Globalization
                                    Organization</a> (SGO), we support the full patient communication lifecycle—not just
                                translation. Our LangOps teams provide services through a variety of mediums including
                                audio, video and written formats.&nbsp;</span></p>
                        <p><span data-olk-copy-source="MailCompose">We work with healthcare providers to create
                                connections to EHR/EMR systems, enable multilingual digital front doors, and align our
                                services to meet compliance objectives. Our SME linguists specialize in high-risk
                                medical domains such as oncology, cardiology, pediatrics, radiology, and behavioral
                                health.</span></p>
                        <p><a
                                href="http://piedmont-global.local/blog/strategic-globalization-a-global-operations-framework/">Read
                                more about our unique approach –&gt;</a></p>
                    </div>
                </div>
                <div class="py-4">
                    <button @click="active === 2 ? active = null : active = 2"
                        class="w-full flex justify-between items-center text-left focus:outline-none">
                        <span class="font-bold text-gray-900 text-lg lg:text-xl"
                            :class="{ 'text-[#1F3131]': active === 2 }">
                            Can you integrate with our clinical, administrative, or digital systems? </span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-gray-500 transform transition-transform duration-200"
                            :class="{ 'rotate-180 text-[#1F3131]': active === 2 }" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path x-show="active !== 2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 5v14m7-7H5"></path>
                            <path x-show="active === 2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 12H5" style="display: none;"></path>
                        </svg>
                    </button>

                    <div x-show="active === 2" x-collapse="" class="mt-3 text-gray-700 prose text-base leading-relaxed"
                        style="display: none;">
                        <p><span data-olk-copy-source="MailCompose">Depending on the EMR/EHR platform, Piedmont Global
                                will work with our clients to integrate our systems. While typically, EMR/EHR systems
                                can be nuanced, our development teams are well versed in the technology necessary to
                                make these connections. Some of the systems we can work with include patient engagement
                                portals, telehealth systems and call centers.</span></p>
                        <p><span data-olk-copy-source="MailCompose">We can also support custom middleware, APIs, and SSO
                                onboarding, aligning language and technology for efficient use and global growth. Our
                                technical team collaborates with IT and compliance leaders to ensure secure deployments
                                and build a strong global readiness roadmap.</span></p>
                        <p><a href="https://meetings.hubspot.com/abartlett5?__hstc=11347755.ae86cb90510d36ebac6959ba34cd577e.1761138861379.1764000180154.1764044157537.40&amp;__hssc=11347755.123.1764044157537&amp;__hsfp=2043927728"
                                target="_blank" rel="noopener noreferrer"
                                aria-label="Connect with Andrew to learn how we can support your healthcare system –&gt; (opens in new tab)">Connect
                                with Andrew to learn how we can support your healthcare system –&gt;</a></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>





<section class="bg-[#1F3131] pt-12 lg:pt-20 lg:mt-40 mt-0" aria-labelledby="why-piedmont-title">
    <div
        class="max-w-7xl border-1 bg-[linear-gradient(to_bottom,_#006155_100%,_#98C441_100%)] p-8 sm:p-12 lg:p-20 -mt-24 lg:-mt-60 rounded-[4px] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-10 items-center shadow-sm">

        <!-- Left side: Title and Description -->
        <div class="lg:col-span-1 text-center lg:text-left">
            <h2 id="why-piedmont-title" class="text-2xl md:text-4xl text-white max-w-sm font-bold mb-6 mx-auto lg:mx-0">
                Let’s build a better
                patient experience. </h2>
            <div class="text-base md:text-lg text-white max-w-xl mb-6 prose-invert mx-auto lg:mx-0">
                <p>Connect with a healthcare strategist today to assess your current language access approach and
                    explore what’s possible.</p>

            </div>

            <div class="mt-10 flex flex-col md:flex-row gap-6">
                <a href="#"
                    class="bg-[#8DC63F] js-open-sandbox-modal hover:bg-[#7AB22E] text-[#1F3131] font-medium px-6 py-3 text-base  transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#7AB22E] focus:ring-offset-2 focus:ring-offset-[#1F3131]"
                    aria-label="Schedule a consultation - opens contact form">
                    Schedule a consultation
                </a>


                <a href="/resources" class="group flex items-center text-[#F9F8F6] font-medium text-base 
       transition-colors duration-300 hover:text-[#F9F8F6]/80">
                    Download Language access guide
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>

                </a>



            </div>
        </div>

        <!-- Right side: Image -->
        <div class="lg:col-span-1 flex justify-center">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/hc/Desktop.svg'); ?>"
                alt="Piedmont Global team working with Consumer goods clients" class="max-w-full h-auto object-cover">
        </div>

    </div>
</section>





<script>
(() => {
    const counters = document.querySelectorAll("[data-target]");
    const duration = 1500; // total animation duration in ms

    const animateCounter = (el) => {
        const target = parseFloat(el.dataset.target);
        const suffix = el.dataset.suffix || "";
        const start = 0;
        const startTime = performance.now();

        const step = (timestamp) => {
            const elapsed = timestamp - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const value = Math.floor(progress * target);

            el.textContent =
                target >= 1000 ? value.toLocaleString() + suffix : value + suffix;

            if (progress < 1) requestAnimationFrame(step);
        };

        requestAnimationFrame(step);
    };

    const observer = new IntersectionObserver(
        (entries, obs) => {
            for (const entry of entries) {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    obs.unobserve(entry.target);
                }
            }
        }, {
            threshold: 0.5
        }
    );

    counters.forEach((el) => observer.observe(el));
})();
</script>

<?php
get_footer(); 
?>