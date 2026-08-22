<?php
/**
* Plugin Name: Customer Images Swipper Plugin
* Description: Plugin that create image slider use with wordpress shortcut.
* Version: 1.0.0
* Author: Rajvinder Singh
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Plugin code starts here.

define( 'CISP_VERSION', '1.0.0' );
define( 'CISP_PLUGIN_FILE', __FILE__ );
define( 'CISP_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'CISP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

function cisp_tempalte_shortcut() {

    ob_start();

    $slider_file = CISP_PLUGIN_PATH.'templates/slider.php';

    if ( ! file_exists( $slider_file ) ) {
        return '';
    }

    include $slider_file;

    return ob_get_clean();

}

add_shortcode( 'custom_swipper_slider', 'cisp_tempalte_shortcut' );


function cisp_enqueue_slider_assets() {

    // Swiper CSS.
    wp_enqueue_style(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        '11.2.10'
    );

    // Swiper JS.
    wp_enqueue_script(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        '11.2.10',
        true
    );

    // Plugin slider CSS.
    wp_enqueue_style(
        'cisp-slider',
        CISP_PLUGIN_URL . 'assets/css/slider.css',
        array( 'swiper' ),
        '1.0.0'
    );

    // Plugin slider JS.
    wp_enqueue_script(
        'cisp-slider',
        CISP_PLUGIN_URL . 'assets/js/slider.js',
        array( 'swiper' ),
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'cisp_enqueue_slider_assets' );


if ( is_admin() ) {
    require_once CISP_PLUGIN_PATH . 'includes/admin.php';
}
