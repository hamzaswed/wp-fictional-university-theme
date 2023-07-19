<?php

// load theme files
function add_style_and_script_files()
{
  // load style files
  wp_enqueue_style('theme-reset', get_template_directory_uri() . '/build/index.css');

  wp_enqueue_style('theme-google-font', "https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i");

  wp_enqueue_style('theme-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

  wp_enqueue_style('theme-style', get_template_directory_uri() . '/build/style-index.css');

  // load script files
  wp_enqueue_script('theme-script', get_template_directory_uri() . '/build/index.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'add_style_and_script_files');

// add theme feature
function theme_feature()
{
  add_theme_support('title-tag');
}
add_action('after_setup_theme', 'theme_feature');

// add custom query to event archive page
function adjust_amin_query($query)
{

  if (!is_admin() && is_post_type_archive('program') && $query->is_main_query()) {
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', -1);

  }

  if (!is_admin() && is_post_type_archive('event') && $query->is_main_query()) {


    $today = date('Ymd');

    $query->set('meta_key', 'start_date');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_query', [
      [
        'key' => 'start_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric'
      ]
    ]);
  }
}
add_action('pre_get_posts', 'adjust_amin_query');