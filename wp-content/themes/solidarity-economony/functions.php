<?php

// template tags used to get content
include('inc/template-tags.php');
include('inc/cpt.php');

// add_editor_style('editor-style.css');
// add_theme_support('editor-styles');
add_theme_support('responsive-embeds');

// Register the navigation menus
function sea_register_nav_menu()
{
  register_nav_menus(array(
    'main-navigation' => __('Main navigation', 'text_domain'),
    'footer-navigation'  => __('Footer navigation', 'text_domain'),
  ));
}
add_action('after_setup_theme', 'sea_register_nav_menu');

// Get a template file
function one_get_content($type, $slug, $args = null)
{
  $url = '/inc/' . $type . '/' . $slug . '.php';
  if (locate_template($url)) {
    include(locate_template($url));
  } else {
    echo '<p>missing template: ' . $url . '</p>';
  }
}

// Get and print out an SVG file
function get_svg($slug)
{
  $url = '/images/' . $slug . '.svg';
  if (locate_template($url)) {
    include(locate_template($url));
  } else {
    echo '<p>missing template: ' . $url . '</p>';
  }
}

/* Register Options Page */
function sea_setup_options()
{
  if (function_exists('acf_add_options_page')) :
    acf_add_options_page(array(
      'page_title'  => 'Options',
      'menu_title'  => 'Options',
      'menu_slug'   => 'options',
      'capability'  => 'manage_options',
      'redirect'    => true
    ));
  endif;

  if (function_exists('acf_add_options_sub_page')) :
    acf_add_options_sub_page(array(
      'title' => 'Header Options',
      'parent' => 'options',
      'capability' => 'manage_options'
    ));
  endif;

  if (function_exists('acf_add_options_sub_page')) :
    acf_add_options_sub_page(array(
      'title' => 'Site Options',
      'parent' => 'options',
      'capability' => 'manage_options'
    ));
  endif;

  if (function_exists('acf_add_options_sub_page')) :
    acf_add_options_sub_page(array(
      'title' => 'Footer Options',
      'parent' => 'options',
      'capability' => 'manage_options'
    ));
  endif;
}
add_action('init', 'sea_setup_options');

// Adds the correct tld to acf instructions
function sea_add_site_url_to_instructions($field)
{
  // Set the site url in the instructions
  if ($field['name'] == 'icon') {
    $field['instructions'] = str_replace('{{site_url}}', get_site_url(), $field['instructions']);
    return $field;
  }

  return $field;
}
add_filter('acf/load_field', 'sea_add_site_url_to_instructions', 20);

// Blocks

// ACF blocks
function sea_register_blocks()
{

  if (!function_exists('acf_register_block_type'))
    return;

  acf_register_block_type(array(
    'name'      => 'sea-map',
    'title'     => __('SEA Map'),
    'render_template' => 'inc/blocks/map.php',
    'category'    => 'widgets',
    'icon'      => 'location',
    'mode'      => 'auto',
    'keywords'    => array(),
    'post_types' => array()
  ));

  acf_register_block_type(array(
    'name'      => 'case-studies-links',
    'title'     => __('Case Studies Links'),
    'render_template' => 'inc/blocks/case-studies-links.php',
    'category'    => 'widgets',
    'icon'      => 'welcome-widgets-menus',
    'mode'      => 'auto',
    'keywords'    => array(),
    'post_types' => array()
  ));
}
add_action('acf/init', 'sea_register_blocks');

function custom_block_styles()
{
  wp_enqueue_style('custom-block-styles', get_theme_file_uri('editor-style.css'));
}
add_action('enqueue_block_editor_assets', 'custom_block_styles', 2);

/**
 * Gutenberg scripts and styles
 * @link https://www.billerickson.net/wordpress-color-palette-button-styling-gutenberg
 */
function be_gutenberg_scripts()
{
  wp_enqueue_script('be-editor', get_stylesheet_directory_uri() . '/assets/js/editor.js', array('wp-blocks', 'wp-dom'), filemtime(get_stylesheet_directory() . '/assets/js/editor.js'), true);
}
add_action('enqueue_block_editor_assets', 'be_gutenberg_scripts');

// Enqueue Extra Styles
function sea_enqueue_styles()
{
  wp_enqueue_style('google_fonts', 'https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,900|Merriweather:300,300i,700', false, false);
}
add_action('oneltd_enqueue_styles', 'sea_enqueue_styles');

// Enqueue extra scripts
function sea_enqueue_scripts()
{
  if (get_field('font_awesome_kit', 'options')) {
    wp_register_script('fa', 'https://kit.fontawesome.com/' . get_field('font_awesome_kit', 'options') . '.js', array(), NULL, false);
    wp_enqueue_script('fa');
  }
}
add_action('oneltd_enqueue_scripts', 'sea_enqueue_scripts');

if (!function_exists('_one_log')) {
  function _one_log($message)
  {
    $error_path = ini_get('error_log');
    $error_path_as_array = explode("/", $error_path);
    $error_path_as_array[count($error_path_as_array) - 1] = 'debug.log';
    $time_stamp = '[' . date('d\-F\-Y H:i:s e') . ']: ';
    if (is_array($message) || is_object($message)) {
      file_put_contents(implode('/', $error_path_as_array), $time_stamp . print_r($message, true) . PHP_EOL, FILE_APPEND);
    } else {
      file_put_contents(implode('/', $error_path_as_array), $time_stamp . $message . PHP_EOL, FILE_APPEND);
    }
  }
}

/**
 * See documentation of base theme at
 * http://git.oneltd.co.uk/one/oneltd-base/blob/master/README.md
 *
 * The base theme does some important bits while enqueuing scripts and styles,
 * you therefore need to load your extra ones a little differently to usual.
 *
 * To enqueue styles:
 *
 * add_action('oneltd_enqueue_styles', 'SITENAME_enqueue_styles');
 * function SITENAME_enqueue_styles() {
 *   wp_enqueue_style(...);
 * }
 *
 * To enqueue scripts:
 *
 * add_action('oneltd_enqueue_scripts', 'SITENAME_enqueue_scripts');
 * function SITENAME_enqueue_scripts() {
 *   wp_register_script(...);
 *   // etc
 * }
 */
