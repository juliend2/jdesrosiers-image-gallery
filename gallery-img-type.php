<?php

define('JDIG_CPT_NAME', 'Gallery Images');
define('JDIG_CPT_SINGLE', 'Gallery Image');
define('JDIG_CPT_TYPE', 'gallery-image');

add_theme_support('post-thumbnails', array(JDIG_CPT_TYPE));

function jdig_register_cpt() {
  register_post_type(JDIG_CPT_TYPE, array(
    'label' => __(JDIG_CPT_NAME),  
    'singular_label' => __(JDIG_CPT_SINGLE),  
    'public' => true,  
    'show_ui' => true,  
    'capability_type' => 'post',  
    'hierarchical' => false,  
    'rewrite' => true,  
    'supports' => array('title', 'thumbnail'),
    'taxonomies' => array('image-gallery')
  ));
}

add_action('init', 'jdig_register_cpt');

