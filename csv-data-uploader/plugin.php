<?php 
/*
 * Plugin Name:       CSV Data Uploader
 * Description:       Handle the basics with this plugin.
 * Author:            John Smith
 * Text Domain:       csv-data-uploader
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Stop execution
}


add_shortcode("csv-data-uploader", "cdu_display_uploader_form");

function cdu_display_uploader_form(){
    
    return "<h3>CSV Data Uploader Fetch Result</h3>";
    
}


?>