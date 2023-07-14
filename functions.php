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