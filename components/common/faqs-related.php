<?php if( have_rows('faqs') ): ?>
<section class="py-20 bg-[#F9F8F6]">
    <div class="max-w-4xl mx-auto px-6 text-center" x-data="{ active: null }">
        <div class="mb-10">
            <div
                class="inline-flex items-center gap-2 rounded-full bg-[#1f3131] px-4 py-2 text-sm font-semibold text-white">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                FAQ
            </div>
            <h2 class="mt-4 text-3xl md:text-3xl font-bold text-gray-900">Frequently asked questions</h2>
        </div>

        <div class="divide-y divide-gray-200 text-left">
            <?php $i = 0; while( have_rows('faqs') ): the_row(); $i++; 
                $question = get_sub_field('question');
                $answer = get_sub_field('answer');
            ?>
            <div class="py-4">
                <button @click="active === <?= $i ?> ? active = null : active = <?= $i ?>"
                    :aria-expanded="(active === <?= $i ?>).toString()"
                    aria-controls="faq-panel-<?= $i ?>"
                    class="w-full flex justify-between items-center text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2 rounded-sm">
                    <span class="font-bold text-gray-900 text-lg lg:text-xl"
                        :class="{ 'text-[#1F3131]': active === <?= $i ?> }">
                        <?php echo esc_html($question); ?>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-gray-500 transform transition-transform duration-200"
                        :class="{ 'rotate-180 text-[#1F3131]': active === <?= $i ?> }" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path x-show="active !== <?= $i ?>" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M12 5v14m7-7H5" />
                        <path x-show="active === <?= $i ?>" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M19 12H5" />
                    </svg>
                </button>

                <div x-show="active === <?= $i ?>" x-collapse
                    id="faq-panel-<?= $i ?>"
                    class="mt-3 text-gray-700 prose text-base leading-relaxed">
                    <?php echo wp_kses_post($answer); ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<?php
$related_blogs = get_field('related_blogs');
if ($related_blogs):
?>
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <div class="flex items-center justify-between mb-12">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Related resources</h2>
            <div class="flex items-center gap-3">
                <button id="related-blogs-prev" aria-label="Previous"
                    class="p-2 bg-[#cccccc] rounded hover:bg-[#98C441] text-[#1F3131] transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="related-blogs-next" aria-label="Next"
                    class="p-2 bg-[#cccccc] rounded hover:bg-[#98C441] text-[#1F3131] transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <button type="button" data-carousel-pause-target=".related-blogs-carousel"
                    class="p-2 bg-[#cccccc] rounded hover:bg-[#98C441] text-[#1F3131] transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2"
                    aria-label="Pause auto-rotation">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <rect x="6" y="4" width="4" height="16" rx="1" />
                        <rect x="14" y="4" width="4" height="16" rx="1" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="relative">
            <div class="owl-carousel related-blogs-carousel" role="region" aria-roledescription="carousel" aria-label="Related resources">
            <?php foreach ($related_blogs as $post): setup_postdata($post); ?>
            <a href="<?php the_permalink(); ?>"
                class="group flex flex-col h-full shadow-md relative rounded-lg border bg-white border-gray-200 transition-all duration-300 hover:shadow-xl hover:border-stone-300/30 mx-3">

                <div class="overflow-hidden rounded-t-lg">
                    <?php if (has_post_thumbnail()): ?>
                    <?php the_post_thumbnail('full', ['class' => 'w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105']); ?>
                    <?php endif; ?>
                </div>

                <div class="p-6 flex flex-col flex-1 min-h-[230px]">
                    <div class="flex items-center gap-2 text-gray-500 text-sm mb-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <?php echo get_the_date('F j, Y'); ?>
                    </div>
                    <h3 class="text-xl font-semibold text-[#1F3131] mb-3 flex-grow"><?php the_title(); ?></h3>
                    <div class="mt-auto pt-4">
                        <span
                            class="inline-flex items-center text-sm font-semibold text-[#D16555] group-hover:gap-2 transition-all duration-300">
                            Read More
                            <svg class="w-5 h-5 ml-1 transform group-hover:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </span>
                    </div>
                </div>
            </a>
            <?php endforeach; wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>