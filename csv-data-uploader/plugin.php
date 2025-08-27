<?php 
/*
 * Plugin Name:       CSV Data Uploader
 * Description:       Upload your CSV file into WordPress Table
 * Author:            Rajvinder Singh
 * Text Domain:       csv-data-uploader
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Stop execution
}

define("CDU_PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));

add_shortcode("csv-data-uploader", "cdu_display_uploader_form");

add_action("wp_enqueue_scripts","cdu_add_script_file");

function cdu_add_script_file(){
    
    wp_enqueue_script("cdu-script-js", CDU_PLUGIN_DIR_PATH.'/assets/js/script.js');
    
}

function cdu_display_uploader_form(){
    
    ob_start();
    
        include(CDU_PLUGIN_DIR_PATH. '/template/cdu_form.php');
    
        $template = ob_get_contents(); 
    
        ob_end_clean(); 
    
    return $template;
    
}

register_activation_hook( __FILE__, 'create_students_table' );

function create_students_table() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'students_data';
	$charset_collate = $wpdb->get_charset_collate();

	// Load dbDelta
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	$sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
		id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		name VARCHAR(100) NOT NULL,
		email VARCHAR(191) NOT NULL,
		age SMALLINT(3) UNSIGNED NULL,
		phone VARCHAR(32) NULL,
		photo VARCHAR(255) NULL,
		PRIMARY KEY  (id),
		UNIQUE KEY email (email)
	) {$charset_collate};";

	dbDelta( $sql );
    
}


?>