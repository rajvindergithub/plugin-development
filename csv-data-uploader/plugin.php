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

//echo CDU_PLUGIN_DIR_PATH; 

add_shortcode("csv-data-uploader", "cdu_display_uploader_form");

add_action("wp_enqueue_scripts","cdu_add_script_file");
 
function cdu_add_script_file(){
    
    wp_enqueue_script("cdu-script-js", plugin_dir_url(__FILE__).'/assets/js/script.js', array("jquery"));
    
    wp_localize_script("cdu-script-js","cdu_object", array(
        "ajax_url" => admin_url('admin-ajax.php')
    ));
    
    
    
    
}

add_action('wp_ajax_cdu_submit_form_data','cdu_ajax_handler');
    add_action('wp_ajax_nopriv_cdu_submit_form_data','cdu_ajax_handler');

    
function cdu_ajax_handler(){
    
    if($_FILES['csv_data_file']){
        
        $csvFile = $_FILES['csv_data_file']['tmp_name'];
        
        $handle = fopen($csvFile, "r");
           
     	global $wpdb;

	    $table_name = $wpdb->prefix . 'students_data';
        
        if($handle){
            $row = 0;
            
            while( ($data = fgetcsv($handle, 1000, ",")) !== FALSE ){
                
                if($row == 0){
                    $row++;
                    continue;
                }
                
                $wpdb->insert($table_name, array(
                    "name" => $data[1],
                    "email" => $data[2],
                    "age" => $data[3],
                    "phone" => $data[4],
                    "photo" => $data[5],
                
                )); 
                
            }
            
            fclose($handle);
            
              echo json_encode(
                array(
                    "status" => 1, 
                    "message" => "Hello From csv data"
                    )
                );
            
        }
        
    }else{
            echo json_encode(
                array(
                    "status" => 0, 
                    "message" => "Getting Error"
                    )
                );
        exit; 
    }
    
    

    
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