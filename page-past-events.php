<?php

get_header(); ?>

<div class="page-banner">
  <div class="page-banner__bg-image"
    style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title">All Past Events</h1>
    <div class="page-banner__intro">
      <p>A recap of our past events</p>
    </div>
  </div>
</div>

<div class="container container--narrow page-section">
  <?php

  $today = date('Ymd');
  $past_events = new WP_Query([
    'paged' => get_query_var('paged', 1),
    'post_type' => 'event',
    'meta_key' => 'start_date',
    'orderby' => 'meta_value_num',
    'order' => 'DEASC',
    'meta_query' => [
      [
        'key' => 'start_date',
        'compare' => '<',
        'value' => $today,
        'type' => 'numeric'
      ]
    ]
  ]);


  while ($past_events->have_posts()) {
    $past_events->the_post(); ?>
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
        <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
        <p>
          <?php echo wp_trim_words(get_the_content(), 18); ?> <a href="<?php the_permalink(); ?>" class="nu gray">Learn
            more</a>
        </p>
      </div>
    </div>
  <?php }
  echo paginate_links([
    'total' => $past_events->max_num_pages
  ]);
  ?>
</div>

<?php get_footer();

?>