<?php
/**
 * Plugin Name: Add Custom CSS
 * Description: Add Custom CSS into your theme
 * Author: Rajvinder Singh
 * Author URI: https://portfolio.myfreeonlinetools.com/
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
 

define('PLUGIN_PATH', plugin_dir_path(__FILE__));

function add_custom_page_fn() {
    add_menu_page(
        'Add Custom CSS',
        'Add Custom CSS',
        'manage_options',
        'add-custom-css',
        'add_custom_css',
        'dashicons-admin-generic',
        20
    );
}

add_action('admin_menu', 'add_custom_page_fn');

function add_custom_css(){
    
    $css_save_option = get_option('save_custom_css', '');
        echo '<h1 class="heading_plugin_css">Add Theme Custom CSS</h1>'; 
        $template = plugin_dir_path( __FILE__ ) . 'template/editor.php';
        include $template;
}

 
function save_custom_css_code(){
    
    if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Unauthorized access' );
	}

    check_admin_referer('nonce_custom_css'); 
    $get_css_code = isset($_POST['custom_css_textarea_code']) ? wp_unslash( $_POST['custom_css_textarea_code'] ) : '' ;
    update_option('save_custom_css', $get_css_code);
    $upload_dir = wp_upload_dir();
    $css_dir = trailingslashit( $upload_dir['basedir'] ) . 'custom-css/';

    // Create directory if not exists
    if ( ! file_exists( $css_dir ) ) {
        wp_mkdir_p( $css_dir );
    }
    
    $filename = 'custom-css-' . date( 'Ymd-His' ) . '.css';
    $filepath = $css_dir . $filename;
    file_put_contents( $filepath, $get_css_code );
    update_option( 'custom_css_file_path', $filename );
    cec_keep_latest_10_files( $css_dir );
   
    wp_redirect(
		admin_url( 'admin.php?page=add-custom-css&updated=1' )
	);
    
    exit; 
}

add_action('admin_post_custom_css_save_hidden', 'save_custom_css_code');


function cec_enqueue_latest_css() {

    $filename = get_option( 'custom_css_file_path' );

    if ( empty( $filename ) ) {
        return;
    }

    $upload_dir = wp_upload_dir();
    $file_path = trailingslashit( $upload_dir['basedir'] ) . 'custom-css/' . $filename;
    $file_url  = trailingslashit( $upload_dir['baseurl'] ) . 'custom-css/' . $filename;

    if ( file_exists( $file_path ) ) {

        wp_enqueue_style(
            'custom-css-plugin-enqueue',
            $file_url,
            array(),
            filemtime( $file_path )
        );
    }
    
}
add_action( 'wp_enqueue_scripts', 'cec_enqueue_latest_css' );


function cec_keep_latest_10_files( $directory ) {
    
    $files = glob( $directory . '*.css' );
    if ( count( $files ) <= 10 ) {
        return;
    }
    // Sort newest first
    usort( $files, function( $a, $b ) {
        return filemtime( $b ) - filemtime( $a );
    });

    // Delete files after first 10
    $old_files = array_slice( $files, 10 );
    foreach ( $old_files as $file ) {
        wp_delete_file( $file );
    }
}

 
