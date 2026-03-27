<?php get_header(); ?>

<header class="shadow-sm bg-[#1F3131]" role="banner">
    <div class="bg-[#1F3131] pt-8 pb-12">
        <nav aria-label="Primary desktop navigation">
            <?php get_template_part('components/navigation/desktop'); ?>
        </nav>
        <nav aria-label="Primary mobile navigation">
            <?php get_template_part('components/navigation/mobile'); ?>
        </nav>
    </div>

    <div class="relative h-[500px] md:h-[400px] lg:h-[554px] bg-cover bg-no-repeat bg-right-bottom"
        style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/icons/single-industries.svg'); ?>');">

        <!-- gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#1F3131]/90 via-[#1F3131]/70 to-transparent" aria-hidden="true"></div>

        <!-- Content container -->
        <div class="relative z-10 h-full flex items-center">
            <div class="max-w-7xl mx-auto w-full px-6 lg:px-0 pb-4 md:pb-12 lg:pb-12 text-white">
                <h1 class="text-2xl mt-4 md:text-4xl lg:text-5xl font-bold">
                    <?php the_title(); ?>
                </h1>
                <p class="text-base lg:text-lg my-4 max-w-4xl">
                    Conversations that explore language, culture, and the people driving global communication.
                </p>
                <a href="/contact"
                   class="inline-flex items-center gap-2 bg-[#98C441] text-[#1F3131] px-4 py-2 mt-4 font-bold text-base shadow-md hover:bg-[#8AB738] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98C441] focus:ring-offset-[#1F3131] transition-colors duration-200">
                    <span>Schedule a consultation</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</header>

<section class="bg-[#F9F8F6] py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <div class="grid grid-cols-1 gap-12 mt-0 lg:-mt-56 relative z-10">
            <?php if (have_rows('podcast_episodes')):
                $episodes = [];
                while (have_rows('podcast_episodes')): the_row();
                    $episodes[] = [
                        'episode_number' => get_sub_field('episode_number'),
                        'video_url'      => get_sub_field('video_url'),
                        'guest_name'     => get_sub_field('guest_name'),
                        'episode_title'  => get_sub_field('episode_title'),
                        'episode_desc'   => get_sub_field('episode_description'),
                        'episode_image'  => get_sub_field('episode_image'),
                    ];
                endwhile;

                usort($episodes, function ($a, $b) {
                    return intval($b['episode_number']) <=> intval($a['episode_number']);
                });

                foreach ($episodes as $episode): ?>
                    <article class="group flex flex-col md:flex-row shadow-md rounded-lg overflow-hidden transition-transform duration-300 hover:shadow-lg">

                        <!-- Video thumbnail instead of heavy iframe -->
                        <div class="w-full md:w-1/2 aspect-video md:aspect-auto relative p-6 bg-[#ab9dba]">
                            <?php if ($episode['video_url']): 
                                $youtube_id = esc_attr($episode['video_url']); ?>
                                <button class="w-full h-full relative group" data-video="<?php echo $youtube_id; ?>">
                                    <img 
                                        src="https://img.youtube.com/vi/<?php echo $youtube_id; ?>/hqdefault.jpg"
                                        alt="<?php echo esc_attr($episode['episode_title']); ?>"
                                        class="w-full h-auto object-contain object-top transition-transform duration-500 "
                                        loading="lazy"
                                    />
                                    <span class="absolute inset-0 flex items-center justify-center">
                                        <span class="bg-red-500 rounded-full p-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </span>
                                    </span>
                                </button>
                            <?php elseif ($episode['episode_image']): ?>
                                <img 
                                    src="<?php echo esc_url($episode['episode_image']['url']); ?>" 
                                    alt="<?php echo esc_attr($episode['episode_title']); ?>" 
                                    class="w-full h-auto object-cover object-top transition-transform duration-500 "
                                    loading="lazy"
                                />
                            <?php endif; ?>
                        </div>

                        <!-- Content -->
                        <div class="p-6 md:p-8 bg-white w-full md:w-1/2 flex flex-col justify-center">
                            <?php if ($episode['episode_number']): ?>
                                <div class="text-xl text-gray-900 font-bold mb-3">
                                    Episode <?php echo esc_html($episode['episode_number']); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($episode['guest_name']): ?>
                                <div class="text-gray-500 text-lg mb-3"><?php echo esc_html($episode['guest_name']); ?></div>
                            <?php endif; ?>

                            <?php if ($episode['episode_title']): ?>
                                <h3 class="text-2xl font-semibold text-[#1F3131] mb-4">
                                    <?php echo esc_html($episode['episode_title']); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if ($episode['episode_desc']): ?>
                                <div class="text-gray-600 prose text-xl leading-relaxed">
                                    <?php echo wp_kses_post($episode['episode_desc']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; endif; ?>
        </div>
    </div>
</section>

<section class="pb-40 pt-20"
         style="background: linear-gradient(to bottom, #F7F7F5 0%, #F7F7F5 70%, #98C44180 85%, #00615580 100%);">
    <div class="max-w-3xl mx-auto px-8 lg:px-0 text-center">
        <h2 class="text-3xl lg:text-5xl font-bold text-black mb-6">
            Ready to move from translation to transformation?
        </h2>
        <a href="/contact"
           class="inline-block bg-[#98C441] capitalize text-black px-6 py-3 font-bold text-base lg:text-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#98C441] focus:ring-offset-2 focus:ring-offset-[#1F311]">
            Connect with our team
        </a>
    </div>
</section>

<script>
document.addEventListener('click', function(e) {
    if (e.target.closest('button[data-video]')) {
        const btn = e.target.closest('button[data-video]');
        const id = btn.getAttribute('data-video');
        const iframe = document.createElement('iframe');
        iframe.src = "https://www.youtube.com/embed/" + id + "?autoplay=1";
        iframe.className = "w-full h-full";
        iframe.frameBorder = "0";
        iframe.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture";
        iframe.allowFullscreen = true;
        btn.replaceWith(iframe);
    }
});
</script>

<?php get_footer(); ?>
