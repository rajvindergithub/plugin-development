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
    
    add_settings_section('wlc_login_page_section_id', 'Login Page Customizer Settings', null, "wp-login-page-customizer");
    
    add_settings_field('wlc_login_page_text_color', 'Page Text Color', 'wlc_login_page_text_color_layout','wp-login-page-customizer', 'wlc_login_page_section_id'); 
    
    add_settings_field('wlc_login_page_background_color', 'Page Background Color', 'wlc_login_page_background_color_layout','wp-login-page-customizer', 'wlc_login_page_section_id'); 
    
    add_settings_field('wlc_login_page_logo', 'Login Page Logo', 'wlc_login_page_logo_input','wp-login-page-customizer', 'wlc_login_page_section_id'); 
    
}

function wlc_login_page_text_color_layout(){
    ?>

    <input type="text" name="wlc_login_page_text_color" placeholder="Text Color" >
      
<?php    
}
function wlc_login_page_text_color_layout(){
    
    $text_color = get_option('wlc_login_page_text_color', "");
    ?>

    <input type="text" name="wlc_login_page_background_color_layout" placeholder="Background Color" value="<?php echo $text_color; ?>" >
      
<?php    
}

function wlc_login_page_logo_input(){
   
    ?>
    
 <input type="text" name="wlc_login_page_logo_input" placeholder="Enter Logo URL" >
      
    <?php 
}

/* 
How to get Option value save by option page
$text_color = get_option('wlc_login_page_text_color', "");

 