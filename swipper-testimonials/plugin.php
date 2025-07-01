<?php 


/*
 * Plugin Name:       Testimonials
 * Description:       User Testimonials Section
 * Version:           1.0
 * Author:            Rajvinder Singh
 * Text Domain:       user-testimonials
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define('PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugin_dir_url(__FILE__));

function enqueue_assets() {
    // Bootstrap CSS
    wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' );

    // Swiper CSS
    wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css' );
    
     wp_enqueue_style( 'my-plugin-style', PLUGIN_URL . 'assets/css/testimonials.css', array(), '1.0' );


    // jQuery (optional if needed, WP includes it)
    wp_enqueue_script( 'jquery' );

    // Bootstrap JS (needs Popper included)
    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), null, true );

    // Swiper JS
    wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true );
    
     wp_enqueue_script( 'my-plugin-script', PLUGIN_URL . 'assets/js/testimonials.js', array('jquery'), '1.1', true );


    // Your custom JS (optional)
//    wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/custom.js', array('swiper-js'), '1.0', true );
    
}
add_action( 'wp_enqueue_scripts', 'enqueue_assets' );



function user_testimonials() {
    include_once(PLUGIN_PATH.'pages/testimonials.php');
}


add_shortcode('testimonials', 'user_testimonials');


?>