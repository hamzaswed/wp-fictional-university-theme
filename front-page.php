<?php

get_header();

?>

<div class="page-banner">
  <div class="page-banner__bg-image"
    style="background-image: url(<?php echo get_theme_file_uri('/images/library-hero.jpg') ?>)"></div>
  <div class="page-banner__content container t-center c-white">
    <h1 class="headline headline--large">Welcome!</h1>
    <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
    <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re
      interested in?</h3>
    <a href="<?php echo get_post_type_archive_link('program'); ?>" class="btn btn--large btn--blue">Find Your Major</a>
  </div>
</div>

<div class="full-width-split group">
  <div class="full-width-split__one">
    <div class="full-width-split__inner">
      <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>

      <?php
      // descending => تنازلي 
      // ascending => تصاعدي 
      
      $today = date('Ymd');

      $events = new WP_Query([
        'post_type' => 'event',
        'posts_per_page' => 2,
        'meta_key' => 'start_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => [
          [
            'key' => 'start_date',
            'compare' => '>=',
            'value' => $today,
            'type' => 'numeric'
          ]
        ]
      ]);

      if ($events->have_posts()):

        while ($events->have_posts()):

          $events->the_post(); ?>

          <div class="event-summary">
            <a class="event-summary__date t-center" href="<?php the_permalink() ?>">
              <span class="event-summary__month">
                <?php
                $event_date = new DateTime(get_field('start_date'));
                echo $event_date->format('F'); ?>
              </span>
              <span class="event-summary__day">
                <?php echo $event_date->format('j'); ?>
              </span>
            </a>
            <div class="event-summary__content">
              <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink() ?>">
                  <?php the_title(); ?>
                </a></h5>
              <p>
                <?php echo (has_excerpt()) ? get_the_excerpt() . '…' : wp_trim_words(get_the_content(), 18) ?> <a
                  href="<?php the_permalink() ?>" class="nu gray">Read
                  more</a>
              </p>
            </div>
          </div>

        <?php endwhile; ?>

      <?php wp_reset_postdata() ?>

      <?php endif; ?>

      <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event') ?>"
          class="btn btn--blue">View All Events</a></p>
    </div>
  </div>
  <div class="full-width-split__two">
    <div class="full-width-split__inner">
      <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>

      <?php

      $blog_posts = new WP_Query([
        'posts_per_page' => 2
      ]);

      if ($blog_posts->have_posts()):

        while ($blog_posts->have_posts()):

          $blog_posts->the_post();

          ?>

          <div class="event-summary">
            <a class="event-summary__date event-summary__date--beige t-center" href="#">
              <span class="event-summary__month">
                <?php the_time('F') ?>
              </span>
              <span class="event-summary__day">
                <?php the_time('j') ?>
              </span>
            </a>
            <div class="event-summary__content">
              <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink() ?>">
                  <?php the_title() ?>
                </a></h5>
              <p>
                <?php echo (has_excerpt()) ? get_the_excerpt() . '…' : wp_trim_words(get_the_content(), 18) ?> <a
                  href="<?php the_permalink() ?>" class="nu gray">Read
                  more</a>
              </p>
            </div>
          </div>


        <?php endwhile; ?>

      <?php

      endif;

      wp_reset_postdata();
      ?>

      <p class="t-center no-margin"><a href="<?php echo site_url('blog') ?>" class="btn btn--yellow">View All Blog
          Posts</a>
      </p>
    </div>
  </div>
</div>

<div class="hero-slider">
  <div data-glide-el="track" class="glide__track">
    <div class="glide__slides">
      <div class="hero-slider__slide"
        style="background-image: url(<?php echo get_theme_file_uri('/images/bus.jpg') ?>)">
        <div class="hero-slider__interior container">
          <div class="hero-slider__overlay">
            <h2 class="headline headline--medium t-center">Free Transportation</h2>
            <p class="t-center">All students have free unlimited bus fare.</p>
            <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="hero-slider__slide"
        style="background-image: url(<?php echo get_theme_file_uri('/images/apples.jpg') ?>)">
        <div class="hero-slider__interior container">
          <div class="hero-slider__overlay">
            <h2 class="headline headline--medium t-center">An Apple a Day</h2>
            <p class="t-center">Our dentistry program recommends eating apples.</p>
            <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="hero-slider__slide"
        style="background-image: url(<?php echo get_theme_file_uri('/images/bread.jpg') ?>)">
        <div class="hero-slider__interior container">
          <div class="hero-slider__overlay">
            <h2 class="headline headline--medium t-center">Free Food</h2>
            <p class="t-center">Fictional University offers lunch plans for those in need.</p>
            <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
          </div>
        </div>
      </div>
    </div>
    <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
  </div>
</div>


<?php

get_footer();