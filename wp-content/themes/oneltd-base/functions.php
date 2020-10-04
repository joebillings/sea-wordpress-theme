<?php

add_action('init', 'oneltd_init');
add_action('wp_enqueue_scripts', 'oneltd_enqueue_styles');
add_action('wp_enqueue_scripts', 'oneltd_enqueue_scripts');
add_action('admin_enqueue_scripts', 'oneltd_admin_enqueue_scripts');
add_action('init', 'oneltd_add_theme_support');
add_action('init', 'oneltd_register_nav_menus');;

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

/**
 * Stuff to run on WP's init hook
 *
 * @since 0.0.1
 * @return null
 */
function oneltd_init() {
  do_action('oneltd_init');
}

/**
 * Add in the admin stylesheet and JS (if it exists in the child theme)
 * Files should be places in:
 *   {theme_dir}/admin/core.js
 *   {theme_dir}/admin/style.css
 *
 * @since 0.0.2
 * @return null
 */
function oneltd_admin_enqueue_scripts() {
  if (file_exists(trailingslashit(get_stylesheet_directory()) . 'admin/style.css')) {
    wp_enqueue_style('oneltd-admin-style', trailingslashit(get_stylesheet_directory_uri()) . 'admin/style.css', array(), date('Y-m-d-H:i:s', filemtime(trailingslashit(get_stylesheet_directory()) . 'admin/style.css')));
  }
  if (file_exists(trailingslashit(get_stylesheet_directory()) . 'admin/core.js')) {
    wp_enqueue_script('oneltd-admin-scripts', get_stylesheet_directory_uri() . '/admin/core.js');
  }
  do_action('oneltd_admin_enqueue_styles');
}

/**
 * Enqueue the stylesheet for both the parent and child themes
 *
 * @since 0.0.1
 * @return null
 */
function oneltd_enqueue_styles() {
  wp_enqueue_style('oneltd-core-style', get_stylesheet_uri(), array(), date('Y-m-d-H:i:s', filemtime(trailingslashit(get_stylesheet_directory()) . 'style.css')));
  if (file_exists(trailingslashit(get_stylesheet_directory()) . 'hacks.css')) {
    wp_enqueue_style('oneltd-hacks-css', trailingslashit(get_stylesheet_directory_uri()) . 'hacks.css', array('oneltd-core-style'), date('Y-m-d-H:i:s', filemtime(trailingslashit(get_stylesheet_directory()) . 'hacks.css')));
  }
  do_action('oneltd_enqueue_styles');
}

/**
 * Use a new version of jQuery instead of the bundled one. Enqueue the core
 * javascript and modernizr if they exist
 *
 * @since 0.0.1
 * @return null
 */
function oneltd_enqueue_scripts() {
  if (!is_admin()) {
    $core_script_dependencies = array('jquery');
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js', false);
    if (file_exists(trailingslashit(get_stylesheet_directory()) . 'js/vendor/modernizr.js')) {
      $core_script_dependencies[] = 'modernizr';
      wp_register_script('modernizr', trailingslashit(get_stylesheet_directory_uri()) . 'js/vendor/modernizr.js', array(), date('Y-m-d-H:i:s', filemtime(trailingslashit(get_stylesheet_directory()) . 'js/vendor/modernizr.js')), false);
    }
    if (file_exists(get_stylesheet_directory() . '/js/core.js')) {
      wp_register_script('core', trailingslashit(get_stylesheet_directory_uri()) . 'js/core.js', $core_script_dependencies, date('Y-m-d-H:i:s', filemtime(trailingslashit(get_stylesheet_directory()) . 'js/core.js')), false);
      wp_enqueue_script('core');
    }
  }
  do_action('oneltd_enqueue_scripts');
}

/**
 * Add post thumbnail support.
 *
 * @since 0.0.1
 * @return null
 */
if (!function_exists('oneltd_add_theme_support')) {
  function oneltd_add_theme_support() {
    add_theme_support('post-thumbnails');
  }
}

/**
 * Register the main navigation menu
 *
 * @since 0.0.1
 * @return null
 */
if (!function_exists('oneltd_register_nav_menus')) {
  function oneltd_register_nav_menus() {
    register_nav_menus(array(
      'main-navigation' => 'Main navigation'
    ));
  }
  do_action('oneltd_register_nav_menus');
}

/**
 * Get a full image url for given filename (adds theme directory in path)
 *
 * @since 0.0.1
 * @param string $image filename of image to get url for
 * @return string url of image
 */
if (!function_exists('oneltd_get_img_url')) {
  function oneltd_get_img_url($image) {
    return trailingslashit(get_stylesheet_directory_uri()) . 'images/' . $image;
  }
}

/**
 * Echo full image url for given filename (adds theme directory in path)
 *
 * @since 0.0.1
 * @param string $image filename of image to get url for
 * @return null
 */
if (!function_exists('oneltd_img_url')) {
  function oneltd_img_url($image) {
    echo oneltd_get_img_url($image);
  }
}

/**
 * Get the post thumbnail src
 *
 * @since 0.0.1
 * @param int $post_id ID of the post to get image for (defauls to current post)
 * @param string $size size of thumbnail (defaults to 'full')
 * @return thumbnail src if thumbail exists, false otherwise
 */
if (!function_exists('oneltd_get_post_thumbnail_src')) {
  function oneltd_get_post_thumbnail_src($post_id = false, $size = 'full') {
    if (!$post_id) {
      $post_id = get_the_ID();
    }
    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);
    return is_array($image) ? $image[0] : false;
  }
}

/**
 * Echo the post thumbnail src
 *
 * @since 0.0.1
 * @param int $post_id ID of the post to get image for (defauls to current post)
 * @param string $size size of thumbnail (defaults to 'full')
 */
if (!function_exists('oneltd_post_thumbnail_src')) {
  function oneltd_post_thumbnail_src($post_id = false, $size = 'full') {
    echo oneltd_get_post_thumbnail_src($post_id, $size);
  }
}

