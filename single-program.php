<?php

get_header();

while (have_posts()) {
  the_post(); ?>
  <div class="page-banner">
    <div class="page-banner__bg-image"
      style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">
        <?php the_title(); ?>
      </h1>
      <div class="page-banner__intro">
        <p>DONT FORGET TO REPLACE ME LATER</p>
      </div>
    </div>
  </div>

  <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i
            class="fa fa-home" aria-hidden="true"></i> All Programs</a> <span class="metabox__main">
          <?php the_title(); ?>
        </span></p>
    </div>

    <div class="generic-content">
      <?php the_content(); ?>
    </div>
    <?php

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
        ],
        [
          'key' => 'add_related_programs',
          'compare' => 'LIKE',
          'value' => get_the_ID(),
        ]
      ]
    ]);

    if ($events->have_posts()):

      echo '<hr class="section-break">';
      echo '<h2 class="headline headline--medium">Upcomming ' . get_the_title() . ' Event</h2>';


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


  </div>



<?php }

get_footer();

?>