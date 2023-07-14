<?php

get_header();


if (have_posts()) {

  while (have_posts()) {

    the_post(); ?>

    <div class="page-banner">
      <div class="page-banner__bg-image"
        style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>)"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">
          <?php the_title(); ?>
        </h1>
        <div class="page-banner__intro">
          <p>DON'T FORGET TO FIX ME LETTER 🎈</p>
        </div>
      </div>
    </div>
    <div class="container container--narrow page-section">

      <?php
      $current_page_id = get_the_ID();
      $parent_page_id = wp_get_post_parent_id($current_page_id);
      ?>

      <?php if ($parent_page_id): ?>

        <div class="metabox metabox--position-up metabox--with-home-link">
          <p>
            <a class="metabox__blog-home-link" href="<?php echo get_permalink($parent_page_id) ?>">
              <i class="fa fa-home" aria-hidden="true"></i> Back to
              <?php echo get_the_title($parent_page_id) ?>
            </a>
            <span class="metabox__main">
              <?php the_title() ?>
            </span>
          </p>
        </div>

      <?php endif; ?>


      <?php

      $children_of = $parent_page_id;

      if (!$parent_page_id) {
        $children_of = $current_page_id;
      }

      $arguments = get_pages([
        'post_type' => 'page',
        'post_status' => 'publish'
      ]);

      $children = get_page_children($children_of, $arguments);

      ?>

      <?php if (!empty($children)): ?>

        <div class="page-links">
          <h2 class="page-links__title"><a href="<?php echo get_the_permalink($children_of) ?>">
              <?php echo get_the_title($children_of) ?>
            </a></h2>

          <ul class="min-list">

            <?php foreach ($children as $child): ?>

              <?php
              $page_title = $child->post_title;
              $page_link = get_permalink($child->ID);
              ?>

              <li class="current_page_item">
                <a href="<?php echo $page_link ?>">
                  <?php echo $page_title ?>
                </a>
              </li>

            <?php endforeach; ?>

          </ul>

        </div>

      <?php endif ?>


      <div class="generic-content">
        <?php the_content(); ?>
      </div>

    </div>

    <?php

  }

}

get_footer();