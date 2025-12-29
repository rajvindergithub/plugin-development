<?php

/*
* Plugin Name:       Custom Widget
* Description:       Add custom widget for display data for recent posts
* Version:           1.0
* Author:            Rajvinder Singh
* Text Domain:       custom-widget 
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly
}


add_action("widgets_init","register_custom_widget");

include_once plugin_dir_path(__FILE__). "My_Custom_Widget.php";

function register_custom_widget(){
    
    register_widget("My_Custom_Widget");
    
}

add_action("admin_enqueue_scripts", "mcw_add_admin_script");

function mcw_add_admin_script(){
    wp_enqueue_script("admin-script", plugin_dir_url(__FILE__)."/script.js", array("jquery"), null, false);
    wp_enqueue_style("mcw_style", plugin_dir_url(__FILE__)."/style.css");
    
}