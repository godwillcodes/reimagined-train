<?php
/**
 * Template Name: Portals
 * Description: 
 */
get_header();
get_template_part( 'components/banner/single-common' );
?>

<section class="bg-white relative overflow-hidden">
    <!-- Main Content -->
    <div class="relative z-10 py-20 px-6 lg:px-0">
        <div class="max-w-7xl mx-auto">

            <!-- Services Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

                <!-- Translation Card -->
                <article data-aos="fade-up" data-aos-duration="400" data-aos-delay="50" class="service-card  p-12 transition-all duration-500 hover:shadow-2xl group animate-slide-up"
                    style="background: linear-gradient(180deg, #1F3131 0%, #006155 100%);">
                    <div class="flex flex-col h-full">
                        <!-- Icon & Header -->
                        <div class="flex items-center mb-6">
                            <div
                                class="w-10 h-10 rounded-0 bg-[#98C441] flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h3 class="lg:text-3xl text-2xl font-bold text-white">Translation</h3>
                        </div>

                        <!-- Content -->
                        <div class="flex-1">
                            <p class="text-gray-300 text-lg leading-relaxed mb-8">
                                Submit and manage translation requests through our secure, intelligent platform with
                                real-time progress tracking and quality assurance.
                            </p>

                            <!-- Features -->
                            <ul class="space-y-3 mb-8 text-lg">
                                <li class="flex items-center text-gray-300">
                                    <div class="w-2 h-2 bg-[#98C441] rounded-full mr-3"></div>
                                    Secure document upload
                                </li>
                                <li class="flex items-center text-gray-300">
                                    <div class="w-2 h-2 bg-[#98C441] rounded-full mr-3"></div>
                                    Real-time progress tracking
                                </li>
                                <li class="flex items-center text-gray-300">
                                    <div class="w-2 h-2 bg-[#98C441] rounded-full mr-3"></div>
                                    Quality assurance
                                </li>
                            </ul>
                        </div>

                        <!-- CTA -->
                        <a target="_blank" href="https://projects.pgls.com/ui/?_gl=1*1wg54ta*_gcl_au*MTc2MTc5NTc1NC4xNzUzNjk2OTQ3*_ga*MTU1NzMxNzk5Mi4xNzQ0MjgzMTQ3*_ga_PFP8XNZMS7*czE3NTY4OTY1MTUkbzQ3JGcxJHQxNzU2ODk3MDIwJGo2MCRsMCRoMA..#/login"
                            class="portal-link inline-flex items-center justify-center w-full px-8 py-4 bg-[#98C441] text-[#1F3131] font-semibold rounded-0 hover:from-[#98C441] hover:to-[#98C441] transition-all duration-300 group">
                            Access Translation Portal
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </article>

                <!-- Interpreting Card -->
                <article data-aos="fade-up" data-aos-duration="400" data-aos-delay="100" class="service-card  p-12  transition-all duration-500 hover:shadow-2xl group animate-slide-up"
                    style="background: linear-gradient(180deg, #1F3131 0%, #006155 100%);">
                    <div class="flex flex-col h-full">
                        <!-- Icon & Header -->
                        <div class="flex items-center mb-6">
                            <div
                                class="w-10 h-10 rounded-2xl bg-[#98C441] flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                </svg>
                            </div>
                            <h3 class="text-3xl font-bold text-white">Interpreting</h3>
                        </div>

                        <!-- Content -->
                        <div class="flex-1">
                            <p class="text-gray-300 text-lg leading-relaxed mb-8">
                                Connect to professional interpreting services with region-specific portals designed for
                                efficient scheduling and seamless communication.
                            </p>

                            <!-- Regional Portals -->
                            <div class="space-y-4 mb-8">
                                <a target="_blank" href="https://pgls.interpretmanager.com/ng/#/app/account/sign-in"
                                    class="portal-link flex items-center justify-between p-4 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 hover:border-[#98C441]/30 transition-all duration-300 group">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-[#98C441] rounded-full mr-4"></div>
                                        <span class="text-white font-medium">Piedmont Global Portal</span>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-[#98C441] group-hover:translate-x-1 transition-all duration-300"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>

                                <a target="_blank" href="https://pgls.interpreterintelligence.com/app/login"
                                    class="portal-link flex items-center justify-between p-4 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 hover:border-[#98C441]/30 transition-all duration-300 group">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-[#98C441] rounded-full mr-4"></div>
                                        <span class="text-white font-medium">Spokane Portal</span>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-[#98C441] group-hover:translate-x-1 transition-all duration-300"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>

                                <a target="_blank" href="https://pgls.interpreterintelligence.com/app/login"
                                    class="portal-link flex items-center justify-between p-4 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 hover:border-[#98C441]/30 transition-all duration-300 group">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-[#98C441] rounded-full mr-4"></div>
                                        <span class="text-white font-medium">Minneapolis Portal</span>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-[#98C441] group-hover:translate-x-1 transition-all duration-300"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <!-- SMS Opt-in Section -->
            <div data-aos="fade-up" data-aos-duration="400" data-aos-delay="150" class="text-center animate-fade-in"
                style="animation-delay: 0.4s; background: linear-gradient(180deg, #1F3131 0%, #006155 100%);">
                <div class="glass-effect  p-12 max-w-2xl mx-auto">
                    <div class="w-12 h-12 bg-[#98C441] rounded-2xl flex items-center justify-center mx-auto mb-8">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>

                    <h4 class="lg:text-3xl text-2xl font-bold text-white mb-4">
                        Stay Connected
                    </h4>
                    <p class="text-lg text-gray-100 leading-relaxed mb-8 max-w-lg mx-auto">
                        Get instant notifications about job availability, scheduling updates, and important
                        announcements via SMS
                    </p>


                    <a target="_blank" href="/sms-opt-in/"
                        class="portal-link inline-flex items-center px-8 py-4 bg-[#98C441] text-[#1F3131]   font-semibold  hover:from-[#98C441] hover:to-[#98C441] transition-all duration-300 group">
                        Interpreter SMS Opt-In
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_template_part( 'components/common/cta' ); 
get_footer(); 
?>