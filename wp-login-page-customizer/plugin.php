<?php 

/*
 * Plugin Name:       WP Login Page Customizer
 * Description:       Plugin for Customize Logo, Text, Color Background Color.
 * Author:            Rajvinder singh
 * Text Domain:       wp-login-page-customizer
 */

if( !defined("ABSPATH") ){
    exit;
}


add_action('admin_menu', "wlc_add_submenu");

function wlc_add_submenu(){
    
    add_submenu_page("options-general.php ", "WP Login Page Customier", "WP Login Page Customier", "manage_options", "wp-login-page-customier", "wlc_handle_login_setting_page");
    
}

function wlc_handle_login_setting_page(){
    
        ob_start(); 
    
            include_once plugin_dir_path(__FILE__). "template/login_setting_layout.php";
            $content = ob_get_contents(); 
            ob_end_clean(); 
    
        echo $content; 
    
}

add_action("admin_init", "wlc_login_page_setting_field_registration");

function wlc_login_page_setting_field_registration(){
    
    register_setting("wlc_login_page_settings_field_group", "wlc_login_page_text_color");
    register_setting("wlc_login_page_settings_field_group", "wlc_login_page_background_color");
    register_setting("wlc_login_page_settings_field_group", "wlc_login_page_logo");
    
}


?>