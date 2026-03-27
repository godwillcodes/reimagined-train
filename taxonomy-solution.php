<?php
get_header();

$term = get_queried_object(); // Current taxonomy term
$term_key = $term->taxonomy . '_' . $term->term_id;

$featured_image = get_field('featured_image', $term_key);
$tagline = get_field('tagline', $term_key);
$section_title = get_field('section_title', $term_key);
$primary_description = get_field('primary_description', $term_key);
$supporting_description = get_field('supporting_description', $term_key);
$eyebrow_text = get_field('eyebrow_text', $term_key);
$sub_solutions_section_title = get_field('sub_solutions_section_title', $term_key);
$sub_solutions_section_description = get_field('sub_solutions_section_description', $term_key);
$why_piedmont_global_eyebrow = get_field('why_piedmont_global_eyebrow', $term_key);
$why_piedmont_global_section_title = get_field('why_piedmont_global_section_title', $term_key);
$why_piedmont_global_description = get_field('why_piedmont_global_description', $term_key);
$why_piedmont_global_cards = get_field('why_piedmont_global_cards', $term_key);
$industries_section = get_field('industries_section', $term_key); // ACF Relationship field
$outcomes_section = get_field('outcomes', $term_key); // Repeater field
?>

<section class="shadow-sm">
    <div class="bg-[#1F3131] pt-8 pb-12">
        <?php
        get_template_part('components/navigation/desktop');
        get_template_part('components/navigation/mobile');
        ?>
    </div>

    <div class="h-[500px] md:h-[400px] lg:h-[554px] bg-cover bg-top relative"
        style="background-image: linear-gradient(180deg, rgba(31,49,49,0.5) 0%, #1F3131 80%), url('<?php echo esc_url($featured_image); ?>');">
        <div class="absolute inset-0 flex items-end">
            <div class="max-w-7xl mx-auto w-full px-10 lg:px-0 pb-4 md:pb-12 lg:pb-12 text-white">
                <h1 class="text-2xl md:text-4xl lg:text-4xl font-bold" data-aos="fade-up" data-aos-delay="200"
                    data-aos-duration="800">
                    <?php echo esc_html($term->name); ?>
                </h1>

                <?php if ($tagline): ?>
                <p class="text-base lg:text-lg my-4 max-w-4xl" data-aos="fade-up" data-aos-delay="400"
                    data-aos-duration="600">
                    <?php echo esc_html($tagline); ?>
                </p>
                <?php endif; ?>

                <a href="/contact" data-aos="fade-up" data-aos-delay="600" data-aos-duration="500"
                    class="inline-block bg-[#98C441] text-[#1F3131] px-5 py-2 mt-4 font-bold text-base shadow-md hover:bg-[#8AB738] focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#98C441] transition">
                    Talk to our team
                </a>
            </div>
        </div>
    </div>
</section>

<section class="bg-[linear-gradient(to_bottom,_#006155_0.1%,_#1F3131_20%)] w-full py-20 shadow-sm">
    <div class="max-w-7xl mx-auto px-8 lg:px-0 flex flex-col md:flex-row gap-8">
        <div class="md:w-2/3 space-y-6" data-aos="fade-up" data-aos-delay="100" data-aos-duration="900"
            data-aos-easing="ease-out-cubic">
            <?php if ($section_title): ?>
            <h2 class="text-[#98C441] text-xl mb-4"><?php echo wp_kses_post($section_title); ?></h2>
            <?php endif; ?>

            <?php if ($primary_description): ?>
            <div class="text-white  text-base md:text-xl leading-relaxed max-w-3xl">
                <?php echo wp_kses_post($primary_description); ?>
            </div>
            <?php endif; ?>
        </div>

        <div class="md:w-1/3 flex items-center" data-aos="fade-up" data-aos-delay="400" data-aos-duration="800"
            data-aos-easing="ease-out-cubic">
            <?php if ($supporting_description): ?>
            <div class="text-white text-base leading-relaxed">
                <?php echo wp_kses_post($supporting_description); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="relative py-20 bg-[#F7F7F5]">
    <div class="max-w-7xl mx-auto px-8 lg:px-0 text-center mb-10">
        <h2 class="text-base text-[#1F3131] font-bold mb-4" data-aos="fade-up" data-aos-delay="50"
            data-aos-duration="500">
            <?php echo wp_kses_post($eyebrow_text); ?>
        </h2>

        <h3 class="text-3xl lg:text-4xl font-extrabold leading-tight max-w-4xl mx-auto text-[#0F1E1E]"
            data-aos="fade-up" data-aos-delay="100" data-aos-duration="700">
            <?php echo esc_html($sub_solutions_section_title); ?>
        </h3>

        <div class="text-base lg:text-xl text-[#1F3131] max-w-3xl mx-auto mt-4" data-aos="fade-up" data-aos-delay="150"
            data-aos-duration="900">
            <?php echo wp_kses_post($sub_solutions_section_description); ?>
        </div>

        <hr class="border-t-[0.5px] border-[#1F3131] mt-10" />
    </div>
    <?php
        $args = [
            'post_type'      => 'solutions',
            'tax_query'      => [
                [
                    'taxonomy' => $term->taxonomy,
                    'field'    => 'term_id',
                    'terms'    => $term->term_id,
                ],
            ],
            'posts_per_page' => -1,
        ];

        $query = new WP_Query($args);

        if ($query->have_posts()):
            $posts = $query->posts; // store posts
    ?>
    <div class="max-w-6xl mx-auto px-8 lg:px-0 flex flex-col lg:flex-row gap-12 relative z-10 min-h-[600px]">
        <nav class="hidden lg:flex lg:w-1/3 w-full text-xs md:text-lg bg-white bg-opacity-30 backdrop-blur-md rounded-lg p-6 shadow-lg lg:bg-transparent lg:p-0 lg:shadow-none sticky top-32 self-start flex-col gap-6 overflow-x-visible pb-0 scroll-smooth no-scrollbar"
            aria-label="What We Offer Navigation">
            <?php
                $count = 1;
                foreach ($posts as $post):
                    setup_postdata($post); ?>
            <button
                class="menu-btn <?php echo $count === 1 ? 'opacity-100 border-l-4 border-l-[#98C441] pl-4 text-left text-[#0F1E1E] font-semibold' : 'opacity-50 border-l-0 pl-4 text-left text-[#555F58] font-medium'; ?> transition-opacity duration-400 ease-in-out transform hover:scale-[1.02]"
                data-target="section-<?php echo $count; ?>" <?php echo $count === 1 ? 'aria-current="true"' : ''; ?>>
                <?php the_title(); ?>
            </button>
            <?php
                    $count++;
                endforeach;
                wp_reset_postdata();
                ?>
        </nav>

        <div class="lg:w-2/3 w-full space-y-6  gap-16 overflow-y-scroll h-[85vh] mt-8 scroll-smooth" tabindex="0"
            aria-label="What We Offer Content">
            <?php
                $count = 1;
                foreach ($posts as $post):
                    setup_postdata($post);
                    $featured_image = get_the_post_thumbnail_url($post->ID, 'full');
                    $solution_tagline = get_field('solution_tagline', $post->ID);
                    ?>
            <div id="section-<?php echo $count; ?>"
                class="relative w-full lg:w-[80%] mx-auto rounded-xl overflow-hidden shadow-lg group cursor-pointer"
                onclick="window.location.href='<?php echo get_the_permalink($post->ID); ?>'">
                <?php if ($featured_image): ?>
                <img src="<?php echo esc_url($featured_image); ?>"
                    class="w-full h-64 md:h-80 lg:h-96 object-cover transition-transform duration-500 group-hover:scale-105"
                    alt="<?php echo esc_attr(get_the_title($post->ID)); ?>" loading="lazy" />
                <?php endif; ?>

                <div
                    class="absolute inset-0 bg-gradient-to-b from-black/40 to-black/70 flex flex-col justify-end p-6 transition-all duration-300 group-hover:from-black/50 group-hover:to-black/80">
                    <h2 class="text-xl md:text-2xl font-extrabold text-white">
                        <?php echo esc_html(get_the_title($post->ID)); ?>
                    </h2>

                    <div class="mt-2 text-white text-base md:text-lg max-w-prose">
                        <?php
                            if ($solution_tagline) {
                                echo wp_kses_post($solution_tagline);
                            } else {
                                echo wp_trim_words(get_the_content(null, false, $post->ID), 35, '...');
                            }
                        ?>
                    </div>

                    <span
                        class="mt-4 inline-block bg-[#98C441] text-[#1F3131] font-bold px-4 py-2 rounded-md text-sm self-start transition-opacity duration-300 opacity-90 group-hover:opacity-100">
                        Read More
                    </span>
                </div>
            </div>
            <?php
                    $count++;
                endforeach;
                wp_reset_postdata();
                ?>
        </div>
    </div>
    <?php else: ?>
    <div class=" grid grid-cols-1 md:grid-cols-3 gap-4 max-w-7xl mx-auto px-5 lg:px-0">

        <?php if( have_rows('non_pages_solutions', $term_key) ): ?>
        <?php while( have_rows('non_pages_solutions', $term_key) ): the_row(); 
        $image = get_sub_field('image'); // URL of the image
        $title = get_sub_field('title');
        $description = get_sub_field('description');
    ?>
        <div
            class="relative bg-[#ab9dba] w-full mx-auto rounded-[4px] overflow-hidden shadow-sm group cursor-pointer p-8">
            <h2 class="text-xl md:text-xl font-extrabold text-black">
                <?php echo esc_html($title); ?>
            </h2>

            <div class="h-6 md:h-10"></div>

            <div class="mt-2 text-black text-base max-w-prose">
                <?php echo esc_html($description); ?>
            </div>
        </div>

        <?php endwhile; ?>
        <?php else: ?>
        <p class="text-center mx-auto">Non-pages solutions and paged solutions are both empty.</p>
        <?php endif; ?>


    </div>
    <?php endif; ?>
</section>

<?php if ($why_piedmont_global_cards): ?>
<section class="py-24 text-white bg-[linear-gradient(to_bottom,_#1F3131_50%,_#006155_100%)]">
    <div class="max-w-7xl mx-auto px-6 lg:px-0 text-center lg:text-left">
        <p data-aos="fade-up" data-aos-delay="100" data-aos-duration="900"
            class="text-lg font-bold text-[#F9F8F6] mb-3"><?php echo esc_html($why_piedmont_global_eyebrow); ?></p>

        <h2 data-aos="fade-up" data-aos-delay="200" data-aos-duration="700"
            class="text-3xl sm:text-4xl md:text-5xl max-w-4xl font-extrabold mb-6 leading-[98%]">
            <?php echo esc_html($why_piedmont_global_section_title); ?>
        </h2>

        <p data-aos="fade-up" data-aos-delay="300" data-aos-duration="600"
            class="text-base sm:text-lg text-gray-300 max-w-2xl lg:mx-0 mb-12">
            <?php echo esc_html($why_piedmont_global_description); ?>
        </p>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <?php 
            $delay = 0;
            foreach ($why_piedmont_global_cards as $card): 
                $delay += 100;  // increment delay for staggered animation
            ?>
            <div class="bg-[#006155] p-6 flex flex-col h-full transition-transform duration-300 ease-in-out hover:scale-[1.03] hover:shadow-lg hover:bg-[#007766]"
                data-aos="fade-up" data-aos-delay="<?php echo esc_attr($delay); ?>" data-aos-duration="600">
                <?php if (!empty($card['card_title'])): ?>
                <h3 class="font-semibold text-lg lg:text-xl mb-4 text-start w-full lg:max-w-[80px]">
                    <?php echo esc_html($card['card_title']); ?>
                </h3>
                <?php endif; ?>

                <div class="flex-grow h-20 lg:h-40"></div>

                <?php if (!empty($card['card_description'])): ?>
                <p class="text-gray-100 text-base  text-start lg:text-lg leading-relaxed">
                    <?php echo esc_html($card['card_description']); ?>
                </p>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
<?php endif; ?>

<?php if (!empty($industries_section)): ?>
<section class="py-20 bg-[#F9F9F6] text-[#1F3131]">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <p data-aos="fade-up" data-aos-delay="100" data-aos-duration="900" class="text-lg font-bold mb-2">Industries
            we support</p>

        <h2 data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000"
            class="text-3xl sm:text-4xl md:text-5xl max-w-4xl font-extrabold mb-6 leading-[98%]">
            Tailored solutions for regulated, high-impact sectors.
        </h2>

        <div class="grid gap-x-24 gap-y-6 sm:grid-cols-2 mt-16">
            <?php 
            $industry_delay = 0;
            foreach ($industries_section as $industry):
                    $title = get_the_title($industry);
                    $desc = get_field('industry_tagline', $industry->ID);
                    $industry_delay += 150;
                    ?>
            <a href="<?php echo esc_url(get_permalink($industry->ID)); ?>"
                class="group block border-b border-gray-300 px-4 py-6 transition-colors duration-200 ease-in-out hover:border-[#98C441]"
                data-aos="fade-up" data-aos-delay="<?php echo $industry_delay; ?>" data-aos-duration="600"
                aria-label="<?php echo esc_attr($title . ': ' . $desc); ?>">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <h3
                            class="font-semibold text-lg sm:text-xl text-[#1F3131] transition-colors duration-200 ease-in-out group-hover:text-[#0F2A2A]">
                            <?php echo esc_html($title); ?>
                        </h3>
                        <?php if ($desc): ?>
                        <div
                            class="mt-2 text-base lg:text-lg text-gray-500 transition-colors duration-200 ease-in-out group-hover:text-gray-700">
                            <?php echo wp_kses_post($desc); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/wierd-arrow.svg'); ?>"
                        alt="" aria-hidden="true"
                        class="w-8 h-8 sm:w-10 sm:h-10 flex-shrink-0 transform transition duration-200 ease-in-out group-hover:rotate-45 group-hover:scale-110">
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if ($outcomes_section): ?>
<section class="bg-white py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <div class="text-center">
            <p class="text-lg font-bold mb-2" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">Outcomes
            </p>
            <h2 class="text-3xl sm:text-4xl md:text-5xl max-w-4xl mx-auto font-extrabold mb-6 leading-[98%]"
                data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                Results you can expect
            </h2>
        </div>

        <div class="w-full mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 auto-rows-[250px]">
            <?php 
        // Define bento slots
        $bento_slots = [
          [ 'class' => 'bg-[#006155] text-white', 'span' => '' ],
          [ 'class' => 'bg-[#DFDAD4] text-[#1F3131] border border-[#DFDAD4]', 'span' => 'sm:col-span-2' ],
          [ 'class' => 'bg-[#550061] text-white', 'span' => 'lg:row-span-2' ],
          [ 'class' => 'image', 'span' => 'lg:row-span-2' ],
          [ 'class' => 'bg-[#ab9dba] text-[#1F3131]', 'span' => '' ],
          [ 'class' => 'bg-[#98C441] text-black', 'span' => '' ],
        ];

        $i = 0;
        while( have_rows('outcomes', $term_key) ): the_row();
          $title = get_sub_field('title');
          $description = get_sub_field('description');

          // Pick slot (repeats pattern if more than 6 items)
          $slot = $bento_slots[$i % count($bento_slots)];
      ?>

            <?php if( $slot['class'] === 'image' ): ?>
            <div class="relative overflow-hidden group shadow-sm flex flex-col justify-between text-white <?php echo esc_attr($slot['span']); ?>"
                data-aos="fade-up" data-aos-delay="<?php echo $i * 100; ?>" data-aos-duration="700">
                <img src="<?php echo esc_url( get_field('featured_image', $term_key) ); ?>"
                    alt="<?php echo esc_attr( $term->name ); ?>"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
            </div>
            <?php else: ?>
            <div class="<?php echo esc_attr($slot['class']); ?> p-6 flex flex-col justify-between font-semibold text-2xl rounded shadow-sm <?php echo esc_attr($slot['span']); ?>"
                data-aos="fade-up" data-aos-delay="<?php echo $i * 100; ?>" data-aos-duration="700">
                <div><?php echo esc_html($title); ?></div>
                <p class="text-lg font-normal"><?php echo esc_html($description); ?></p>
            </div>
            <?php endif; ?>

            <?php $i++; endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>





<?php if( have_rows('faqs', $term_key) ): ?>
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
            <?php $i = 0; while( have_rows('faqs', $term_key) ): the_row(); $i++; 
                $question = get_sub_field('question');
                $answer = get_sub_field('answer');
            ?>
            <div class="py-4">
                <button @click="active === <?= $i ?> ? active = null : active = <?= $i ?>"
                    class="w-full flex justify-between items-center text-left focus:outline-none">
                    <span class="font-bold text-gray-900 text-lg lg:text-xl"
                        :class="{ 'text-[#1F3131]': active === <?= $i ?> }">
                        <?php echo esc_html($question); ?>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-gray-500 transform transition-transform duration-200"
                        :class="{ 'rotate-180 text-[#1F3131]': active === <?= $i ?> }" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path x-show="active !== <?= $i ?>" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M12 5v14m7-7H5" />
                        <path x-show="active === <?= $i ?>" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M19 12H5" />
                    </svg>
                </button>

                <div x-show="active === <?= $i ?>" x-collapse
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
$related_blogs = get_field('related_blogs', $term_key);
if ($related_blogs):
    global $post;
?>
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <div class="flex items-center justify-between mb-12">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Related resources</h2>
            <div class="flex items-center gap-3">
                <button id="related-blogs-prev" aria-label="Previous"
                    class="p-2 bg-[#cccccc] rounded hover:bg-[#98C441] text-[#1F3131] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="related-blogs-next" aria-label="Next"
                    class="p-2 bg-[#cccccc] rounded hover:bg-[#98C441] text-[#1F3131] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="relative">
            <div class="owl-carousel related-blogs-carousel">
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




<section class="bg-[#1F3131] py-28 text-center">
    <div class="max-w-2xl mx-auto px-4">
        <!-- Heading -->
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-[#F9F8F6] tracking-tight" data-aos="fade-up"
            data-aos-delay="100" data-aos-duration="800">
            Let’s talk about making success inevitable.
        </h2>

        <!-- Subheading -->
        <p class="mt-6 text-base lg:text-lg text-[#F9F8F6] leading-relaxed" data-aos="fade-up" data-aos-delay="200"
            data-aos-duration="600">
            Looking for a partner to help you solve today’s challenges — and prepare for tomorrow’s opportunities? Let's build something lasting—together.
        </p>
       

        <!-- CTA Buttons -->
        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-6" data-aos="fade-up"
            data-aos-delay="400" data-aos-duration="700">
            <a href=/contact"
                class="bg-[#8DC63F] hover:bg-[#7AB22E] text-[#1F3131] font-bold px-6 py-3 text-base lg:text-lg transition">
                Schedule a consultation
            </a>
            <a href="/resources" class="group flex items-center text-[#F9F8F6] font-medium text-base lg:text-lg
       transition-colors duration-300 hover:text-[#F9F8F6]/80">
                Explore our resources
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>