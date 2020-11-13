<?php


// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', 'inc/acf/' );
define( 'MY_ACF_URL', 'inc/acf/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// template tags used to get content
include('inc/partials.php');
include('inc/cpt.php');
include('inc/customizer.php');

add_theme_support('responsive-embeds');
add_theme_support('post-thumbnails');


remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjecent_posts_rel_link', 10, 0);
remove_action('wp_head', 'adjecent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

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
  $headings_font = esc_html(get_theme_mod('linje_headings_fonts'));
  $body_font = esc_html(get_theme_mod('linje_body_fonts'));

  if ($headings_font) {
    wp_enqueue_style('sea-headings-fonts', '//fonts.googleapis.com/css?family=' . $headings_font);
  } else {
    wp_enqueue_style('sea-heading-fonts', '//fonts.googleapis.com/css?family=Lato:400,700,400i,700i,900');
  }
  if ($body_font) {
    wp_enqueue_style('sea-body-fonts', '//fonts.googleapis.com/css?family=' . $body_font);
  } else {
    wp_enqueue_style('sea-body-fonts', '//fonts.googleapis.com/css?family=Merriweather:300,300i,700');
  }

  wp_enqueue_style('sea-core-style', get_stylesheet_uri(), array(), date('Y-m-d-H:i:s', filemtime(trailingslashit(get_stylesheet_directory()) . 'style.css')));

  if (file_exists(trailingslashit(get_stylesheet_directory()) . 'admin/style.css')) {
    wp_enqueue_style('sea-admin-style', trailingslashit(get_stylesheet_directory_uri()) . 'admin/style.css', array(), date('Y-m-d-H:i:s', filemtime(trailingslashit(get_stylesheet_directory()) . 'admin/style.css')));
  }
}
add_action('wp_enqueue_scripts', 'sea_enqueue_styles');

// Enqueue extra scripts
function sea_enqueue_scripts()
{
  _one_log(get_stylesheet_uri());
  if (file_exists(trailingslashit(get_stylesheet_directory()) . 'admin/core.js')) {
    wp_enqueue_script('sea-admin-scripts', get_stylesheet_directory_uri() . '/admin/core.js');
  }
  if (get_field('font_awesome_kit', 'options')) {
    wp_register_script('fa', 'https://kit.fontawesome.com/' . get_field('font_awesome_kit', 'options') . '.js', array(), NULL, false);
    wp_enqueue_script('fa');
  }
}
add_action('wp_enqueue_scripts', 'sea_enqueue_scripts');

// Enqueue extra scripts
function sea_admin_enqueue_scripts()
{
  if (file_exists(trailingslashit(get_stylesheet_directory()) . 'admin/style.css')) {
    wp_enqueue_style('sea-admin-style', trailingslashit(get_stylesheet_directory_uri()) . 'admin/style.css', array(), date('Y-m-d-H:i:s', filemtime(trailingslashit(get_stylesheet_directory()) . 'admin/style.css')));
  }
  if (file_exists(trailingslashit(get_stylesheet_directory()) . 'admin/core.js')) {
    wp_enqueue_script('sea-admin-scripts', get_stylesheet_directory_uri() . '/admin/core.js');
  }
}
add_action('wp_admin_enqueue_scripts', 'sea_enqueue_scripts');

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