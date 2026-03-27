<?php
/**
 * Template Name: NABE Dinner
 * Description: 
 */
get_header();
?>
<header class="shadow-sm bg-[#1F3131]" role="banner">
    <div class="bg-[#1F3131] pt-8 pb-12">
        <nav aria-label="Primary desktop navigation">
            <?php get_template_part('components/navigation/desktop'); ?>
        </nav>
        <nav aria-label="Primary mobile navigation">
            <?php get_template_part('components/navigation/mobile'); ?>
        </nav>
    </div>

    <div class="relative h-[500px] md:h-[400px] lg:h-[300px] bg-cover bg-no-repeat bg-right-bottom"
        style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/icons/single-industries.svg'); ?>');">

        <!-- gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#1F3131]/90 via-[#1F3131]/70 to-transparent"
            aria-hidden="true"></div>

        <!-- Content container -->
        <div class="relative z-10 h-full flex items-center">
            <div class="max-w-7xl mx-auto w-full px-6 lg:px-0 pb-4 md:pb-12 lg:pb-12 text-white">
                <h1 class="text-2xl mt-4 md:text-4xl lg:text-5xl font-bold aos-init aos-animate" data-aos="fade-up"
                    data-aos-duration="400" data-aos-delay="50">
                    Piedmont Global Hosts Post-NABE Dinner at Lou Malnati’s
                </h1>

                <a href="#nabe-dinner-form"
                    class="inline-flex items-center gap-2 bg-[#98C441] text-[#1F3131] px-4 py-2 mt-4 font-bold text-base shadow-md rounded-0 hover:bg-[#8AB738] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98C441] focus:ring-offset-[#1F3131] transition-colors duration-200"
                    aria-label="Schedule a consultation - opens contact form">
                    <span>Confirm attendance</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</header>

<section class="bg-[#F9F8F6] py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">

            <!-- Left: Registration Form -->
            <div class="bg-white p-10 lg:p-12 shadow-sm border border-gray-200">
                <h2 class="text-3xl font-serif font-medium text-[#1F3131] mb-10 tracking-tight" id="nabe-dinner-form">
                    Dinner Registration
                </h2>

                <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/embed/v2.js"></script>
                <script>
                    hbspt.forms.create({
                        portalId: "22423917",
                        formId: "c9285919-4561-4800-9820-710e5b1f340b",
                        region: "na1"
                    });
                </script>
            </div>

            <!-- Right: Event Details -->
            <div>


                <div class="space-y-6 mb-10">
                    <!-- Location -->
                    <div class="flex gap-4">
                        <div
                            class="w-12 h-12 rounded-full bg-[#98C441]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-[#98C441]" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </div>
                        <div class="flex items-center">
                            <p class="font-semibold text-[#1F3131] text-lg leading-snug">
                                Lou Malnati's Pizza, 805 S State St, Chicago, IL 60605
                            </p>
                        </div>
                    </div>

                    <!-- Date -->
                    <div class="flex gap-4">
                        <div
                            class="w-12 h-12 rounded-full bg-[#98C441]/10 flex items-center justify-center flex-shrink-0">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 text-[#98C441]">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>

                        </div>
                        <div class="flex items-center">
                            <p class="font-semibold text-[#1F3131] text-lg leading-snug">
                                <span class="font-semibold text-[#1F3131]"></span> Tuesday, February 10th
                            </p>
                        </div>
                    </div>

                    <!-- Time -->
                    <div class="flex gap-4">
                        <div
                            class="w-12 h-12 rounded-full bg-[#98C441]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-[#98C441]" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex items-center">
                            <p class="font-semibold text-[#1F3131] text-lg leading-snug">
                                <span class="font-semibold text-[#1F3131]"></span> 6:30 PM
                            </p>
                        </div>
                    </div>
                </div>


                <p class="text-gray-700 leading-relaxed mb-10 text-lg">
                    After a day of sessions at the <a target="_blank"
                        href="https://nabe-conference.com/registration.html" class="text-gray-600 underline">NABE
                        Conference</a>, you'll want to make some time to
                    experience Chicago Culture. In my hometown, Deep Dish Pizza is an integral part of that culture.<p class="text-gray-700 leading-relaxed mb-10 text-lg">
				
                    Join <a target="_blank" href="https://www.linkedin.com/in/mark-byrne-mba-5a6b5326/"
                        class="text-gray-600 underline">Mark Byrne</a> from Piedmont Global and experience a taste of
                    Chicago at Lou
                    Malnati's Pizza. The restaurant is located at 805 S State St, Chicago, IL 60605; which is a 10
                    minute drive from McCormick Place. Seating is limited, please confirm your attendance ASAP. Hope to
                    see you there!
                </p>


            </div>

        </div>
        <div class="mt-12 pt-8 max-w-3xl mx-auto border-t text-center border-gray-200">
            <p class="text-base italic text-black leading-relaxed">
                Piedmont Global is a strategic globalization organization, focused on promoting language access
                in school districts across the country. We provide a full suite of <a class="text-gray-600 underline"
                    href="https://piedmontglobal.com/solutions/translation/">translation</a>,
                <a href="https://piedmontglobal.com/solutions/interpreting/"
                    class="text-gray-600 underline">interpretation</a>, and professional development offerings to help
                districts remove
                language barriers and give families meaningful participation in their sons and daughters
                education.
            </p>
        </div>
    </div>
</section>



<?php
get_template_part('components/common/cta');
get_footer();
?>