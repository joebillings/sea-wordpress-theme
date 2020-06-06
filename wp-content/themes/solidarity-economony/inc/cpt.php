<?php

function cptui_register_my_cpts() {

/**
 * Post Type: Case Studies.
 */

$labels = [
  "name" => __( "Case Studies", "custom-post-type-ui" ),
  "singular_name" => __( "Case Study", "custom-post-type-ui" ),
  "menu_name" => __( "Case Studies", "custom-post-type-ui" ),
  "all_items" => __( "All Case Studies", "custom-post-type-ui" ),
  "add_new" => __( "Add new", "custom-post-type-ui" ),
  "add_new_item" => __( "Add new Case Study", "custom-post-type-ui" ),
  "edit_item" => __( "Edit Case Study", "custom-post-type-ui" ),
  "new_item" => __( "New Case Study", "custom-post-type-ui" ),
  "view_item" => __( "View Case Study", "custom-post-type-ui" ),
  "view_items" => __( "View Case Studies", "custom-post-type-ui" ),
  "search_items" => __( "Search Case Studies", "custom-post-type-ui" ),
  "not_found" => __( "No Case Studies found", "custom-post-type-ui" ),
  "not_found_in_trash" => __( "No Case Studies found in trash", "custom-post-type-ui" ),
  "parent" => __( "Parent Case Study:", "custom-post-type-ui" ),
  "featured_image" => __( "Featured image for this Case Study", "custom-post-type-ui" ),
  "set_featured_image" => __( "Set featured image for this Case Study", "custom-post-type-ui" ),
  "remove_featured_image" => __( "Remove featured image for this Case Study", "custom-post-type-ui" ),
  "use_featured_image" => __( "Use as featured image for this Case Study", "custom-post-type-ui" ),
  "archives" => __( "Case Study archives", "custom-post-type-ui" ),
  "insert_into_item" => __( "Insert into Case Study", "custom-post-type-ui" ),
  "uploaded_to_this_item" => __( "Upload to this Case Study", "custom-post-type-ui" ),
  "filter_items_list" => __( "Filter Case Studies list", "custom-post-type-ui" ),
  "items_list_navigation" => __( "Case Studies list navigation", "custom-post-type-ui" ),
  "items_list" => __( "Case Studies list", "custom-post-type-ui" ),
  "attributes" => __( "Case Studies attributes", "custom-post-type-ui" ),
  "name_admin_bar" => __( "Case Study", "custom-post-type-ui" ),
  "item_published" => __( "Case Study published", "custom-post-type-ui" ),
  "item_published_privately" => __( "Case Study published privately.", "custom-post-type-ui" ),
  "item_reverted_to_draft" => __( "Case Study reverted to draft.", "custom-post-type-ui" ),
  "item_scheduled" => __( "Case Study scheduled", "custom-post-type-ui" ),
  "item_updated" => __( "Case Study updated.", "custom-post-type-ui" ),
  "parent_item_colon" => __( "Parent Case Study:", "custom-post-type-ui" ),
];

$args = [
  "label" => __( "Case Studies", "custom-post-type-ui" ),
  "labels" => $labels,
  "description" => "",
  "public" => true,
  "publicly_queryable" => true,
  "show_ui" => true,
  "show_in_rest" => true,
  "rest_base" => "",
  "rest_controller_class" => "WP_REST_Posts_Controller",
  "has_archive" => "case-studies",
  "show_in_menu" => true,
  "show_in_nav_menus" => true,
  "delete_with_user" => false,
  "exclude_from_search" => false,
  "capability_type" => "post",
  "map_meta_cap" => true,
  "hierarchical" => false,
  "rewrite" => [ "slug" => "case-studies", "with_front" => true ],
  "query_var" => true,
  "menu_icon" => "dashicons-welcome-widgets-menus",
  "supports" => [ "title", "editor", "thumbnail" ],
];

register_post_type( "case_study", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );
