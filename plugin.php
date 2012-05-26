<?php
/* 
Plugin Name: JDesrosiers Image Gallery 
Plugin URI: 
Description: A plugin to create Image Galleries using custom post types
Author: Julien Desrosiers
Version: 1.0 
Author URI: http://www.juliendesrosiers.com
*/

define('JDIG_VERSION', '1.0');
define('JDIG_NAME', 'JDesrosiers Image Gallery');
define('JDIG_PATH', dirname(__FILE__));
define('JDIG_URL', WP_PLUGIN_URL . '/' . plugin_basename(JDIG_PATH) . '/');

// Functions:
// -----------------------------------------------------------------------

function jdig_enqueue_assets() {
  wp_enqueue_script('prettyphoto', JDIG_URL.'/js/prettyphoto.js', array('jquery'), '3.1.4');
  wp_enqueue_style('prettyphoto', JDIG_URL.'/css/prettyPhoto.css');
}

function jdig_script() {
  print '<script type="text/javascript" charset="utf-8"> 
    jQuery(window).load(function() { 
      jQuery("a[rel=\'prettyPhoto[jdig_gal]\']").prettyPhoto({
        theme: "dark_square",
        social_tools: "",
        gallery_markup: ""
      });
    }); 
  </script>';  
}

function jdig_get_gallery($gallery_slug='') {
  global $post;
  $gallery = '<div class="jdig-gallery"><ul class="jdig-images">';
  $query = "post_type=" . JDIG_CPT_TYPE;
  if ($gallery_slug !== '') {
    $query .= "&gallery=" . $gallery_slug;
  }
  // query_posts($query);
  $the_query = new WP_Query( $query );
  if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();  
    if (has_post_thumbnail($post->ID)) {
      $thumb_id = get_post_thumbnail_id($post->ID);
      $thumb = get_the_post_thumbnail($post->ID, 'thumbnail');  
      $img_url = wp_get_attachment_url($thumb_id);  
      $gallery .= '<li><a rel="prettyPhoto[jdig_gal]" class="jdig-image" href="' . $img_url . '">' . $thumb . '</a></li>';
    }
  endwhile; endif; wp_reset_postdata();  
  $gallery .= '</ul></div>';
  
  return $gallery; 
}

// the template tag equivalent:
function jdig_gallery($gallery_slug = '') {
  print jdig_get_gallery($gallery_slug);
}

function jdig_gallery_shortcode($atts) {
  return jdig_get_gallery($atts['gallery']);
}

// Includes:
// -----------------------------------------------------------------------
require_once(JDIG_PATH . '/gallery-img-type.php');
require_once(JDIG_PATH . '/gallery-taxonomy.php');

// Actions:
// -----------------------------------------------------------------------
add_action('wp_head', 'jdig_script');  
add_action('wp_enqueue_scripts', 'jdig_enqueue_assets');

// Shortcodes:
// -----------------------------------------------------------------------
add_shortcode('jdimagegallery', 'jdig_gallery_shortcode');

