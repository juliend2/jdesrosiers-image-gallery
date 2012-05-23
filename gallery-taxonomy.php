<?php

define('JDIG_TAX_NAME', 'Image Galleries');
define('JDIG_TAX_SINGLE', 'Image Gallery');
define('JDIG_TAX_SLUG', 'image-gallery');

function create_imagegallery_taxonomy() {
  register_taxonomy(JDIG_TAX_SLUG, array(JDIG_CPT_TYPE), array(
    'hierarchical' => true,
    'labels' => array(
      'name' => _x( JDIG_TAX_NAME, 'taxonomy general name'),
      'singular_name' => _x( JDIG_TAX_SINGLE, 'taxonomy singular name' ),
      'search_items' =>  __( 'Search ' . JDIG_TAX_NAME ),
      'all_items' => __( 'All ' . JDIG_TAX_NAME ),
      'parent_item' => __( 'Parent ' . JDIG_TAX_SINGLE ),
      'parent_item_colon' => __( 'Parent ' . JDIG_TAX_SINGLE . ':' ),
      'edit_item' => __( 'Edit ' . JDIG_TAX_SINGLE ), 
      'update_item' => __( 'Update ' . JDIG_TAX_SINGLE ),
      'add_new_item' => __( 'Add New ' . JDIG_TAX_SINGLE ),
      'new_item_name' => __( 'New ' . JDIG_TAX_SINGLE . ' Name' ),
      'menu_name' => __( JDIG_TAX_SINGLE ),
    ),
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => JDIG_TAX_SLUG )
  ));
}

add_action('init', 'create_imagegallery_taxonomy', 0 );
