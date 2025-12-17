<?php
/**
 * Plugin Name: Cards Swipper Slider
 * Description: Layout Cards Swipper Slider
 * Version:     1.0.0
 * Author:      Rajvinder Singh
 * Text Domain: cards-swipper-slider
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_shortcode( 'cards_swipper_slider', 'home_page_swipper_slider' );

function home_page_swipper_slider() {
    
    ob_start(); 
    
    include_once plugin_dir_path( __FILE__ ).'template/cards.php';
    
    return ob_get_clean();

}


?>

