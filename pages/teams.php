<?php
/**
 * Template Name: Teams
 * Description: 
 */
get_header();
get_template_part( 'components/banner/single-common' );
?>
<section class="px-6 lg:px-0 py-20"     style="background: linear-gradient(to bottom, #F7F7F5 0%, #F7F7F5 70%, #98C44180 85%, #00615580 100%);">

  <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-x-12 gap-y-12 items-stretch">

    <?php if (have_rows('team_repeater')): ?>
      <?php 
      $counter = 0; // Counter for staggered delays
      while (have_rows('team_repeater')): the_row(); 
        $name        = get_sub_field('name');
        $designation = get_sub_field('designation');
        $photo       = get_sub_field('photo');
        $linkedin    = get_sub_field('linkedin_url'); // optional field
        $delay = $counter * 100; // 100ms delay between each card
      ?>
        <div class="bg-white shadow-sm overflow-hidden flex flex-col w-[300px] mx-auto transition-transform duration-300 hover:-translate-y-1 hover:shadow-lg" 
             data-aos="fade-up" 
             data-aos-duration="300" 
             data-aos-delay="<?php echo $delay; ?>"
             data-aos-easing="ease-out">
          
          <!-- Image -->
          <?php if ($photo && is_array($photo) && isset($photo['url'])): ?>
            <img src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($name ?: 'Team member'); ?>" class="h-[300px] w-full object-cover">
          <?php elseif ($photo && is_string($photo)): ?>
            <img src="<?php echo esc_url($photo); ?>" alt="<?php echo esc_attr($name ?: 'Team member'); ?>" class="h-[300px] w-full object-cover">
          <?php else: ?>
            <!-- Placeholder if no image -->
            <div class="h-[300px] w-full bg-gray-200 flex items-center justify-center">
              <span class="text-gray-400 text-sm">No image</span>
            </div>
          <?php endif; ?>

          <!-- Content -->
          <div class="px-5 py-4 flex flex-col flex-grow justify-between">
            <!-- Name + Icon Row -->
            <div class="flex items-center justify-between">
              <div>
                <h3 class="text-lg font-semibold"><?php echo esc_html($name ?: 'Team Member Name'); ?></h3>
                <?php if ($designation): ?>
                  <span class="block text-sm text-gray-500 font-normal max-w-[170px] line-clamp-2"><?php echo esc_html($designation); ?></span>
                <?php endif; ?>
              </div>

              <?php if ($linkedin): ?>
                <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener" class="text-gray-400 hover:text-[#0077B5] transition-colors duration-300" aria-label="LinkedIn">
                  <img class="w-10 h-10" src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/linkedin.svg'); ?>" alt="LinkedIn">
                </a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php 
        $counter++; // Increment counter for next iteration
        endwhile; 
      ?>
    <?php else: ?>
      <!-- Fallback if no team members -->
      <div class="col-span-full text-center py-12">
        <p class="text-gray-500 text-lg">No team members found.</p>
      </div>
    <?php endif; ?>

  </div>
</section>

<!-- Explore What We Can Do Together Section -->
<section class="py-20 px-6 lg:px-0" aria-labelledby="explore-section-title">
  <div class="max-w-7xl mx-auto">
    <h2 id="explore-section-title"
        class="text-3xl max-w-xl mx-auto md:text-4xl lg:text-5xl font-bold text-[#1F3131] text-center mb-12 leading-[35px] lg:leading-[48px]">
      Explore what we can do together
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
      <?php if (have_rows('explore_cards')): ?>
        <?php while (have_rows('explore_cards')): the_row();
          $card_image = get_sub_field('image');
          $card_title = get_sub_field('title');
          $card_link  = get_sub_field('link');

          $image_url = '';
          if ($card_image) {
            if (is_array($card_image) && isset($card_image['url'])) {
              $image_url = $card_image['url'];
            } elseif (is_string($card_image)) {
              $image_url = $card_image;
            } elseif (is_numeric($card_image)) {
              $image_url = wp_get_attachment_image_url($card_image, 'full');
            }
          }

          $link_url  = $card_link ? esc_url($card_link) : '#';
          $title_text = $card_title ? esc_html($card_title) : 'Card Title';
        ?>
          <a href="<?php echo $link_url; ?>"
             class="group relative overflow-hidden rounded-sm shadow-md transition-all duration-500 ease-out  hover:shadow-2xl">
            
            <div class="relative h-[300px] w-full">
              <?php if ($image_url): ?>
                <img src="<?php echo esc_url($image_url); ?>"
                     alt="<?php echo esc_attr($title_text); ?>"
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110"
                     loading="lazy"
                     decoding="async">
              <?php else: ?>
                <div class="absolute inset-0 bg-gray-200 flex items-center justify-center">
                  <span class="text-gray-400 text-sm">No image</span>
                </div>
              <?php endif; ?>

              <!-- Gradient Overlay with enhanced hover effect -->
              <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-black/20 transition-all duration-500 group-hover:from-black/80 group-hover:via-black/50 group-hover:to-black/30"></div>

              <!-- Subtle border glow on hover -->
              <div class="absolute inset-0 border-2 border-transparent transition-all duration-500 group-hover:border-white/30"></div>

              <!-- Centered Text with enhanced animation -->
              <div class="absolute inset-0 flex items-center justify-center text-center px-6">
                <h3 class="text-white text-2xl  font-bold tracking-tight
                           transition-all duration-500 ease-out
                           group-hover:-translate-y-2 group-hover:scale-105
                           drop-shadow-lg group-hover:drop-shadow-2xl">
                  <?php echo $title_text; ?>
                </h3>
              </div>
            </div>
          </a>
        <?php endwhile; ?>
      <?php else: ?>
        <!-- Fallback if no explore cards -->
        <div class="col-span-full text-center py-12">
          <p class="text-gray-500 text-lg">No explore cards found.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>


<?php
get_template_part( 'components/common/cta' ); 
get_footer(); 
?>