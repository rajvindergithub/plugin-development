<?php 

/*
 * Plugin Name:       Employee Management System
 * Description:       Employee Management System : Add Remove & Update
 * Author:            Rajvinder Singh
 * Text Domain:       employee-management-system
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define('EMS_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('EMS_PLUGIN_URL', plugin_dir_url(__FILE__));



add_action( 'admin_menu', 'cp_add_admin_menu' );


function cp_add_admin_menu(){
    
    
    add_menu_page(
        'Employee System | employee Management system',
        'Employee System',
        'manage_options',
        'employee-system',
        'ems_curd_system',
        'dashicons-admin-home',
        23
    );
    
    add_submenu_page( 'employee-system', 'Add Employee', 'Add Employee', 'manage_options', 'employee-system','ems_add_employee' );
    
     add_submenu_page( 'employee-system', 'List Employee', 'List Employee', 'manage_options', 'ems-list-employee','ems_list_employee' );

}

function ems_curd_system(){
    
}

/* sub menu function */

function ems_add_employee(){
   
    include_once(EMS_PLUGIN_PATH.'pages/add-employee.php');
    
}

function ems_list_employee(){

    include_once(EMS_PLUGIN_PATH.'pages/list-employee.php');
    
}

register_activation_hook(__FILE__, 'ems_create_table');

function ems_create_table(){
    
global $wpdb;
    
$table_prefix =   $wpdb->prefix;  
    
 $sql = "CREATE TABLE `{$table_prefix}ems_form_data` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(120) DEFAULT NULL,
          `email` varchar(100) DEFAULT NULL,
          `phoneNo` varchar(80) DEFAULT NULL,
          `gender` enum('male','female','other','') DEFAULT NULL,
          `designation` varchar(50) DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci" ;
    
    include_once ABSPATH."wp-admin/includes/upgrade.php"; 
    
    dbDelta($sql);
    
}


register_deactivation_hook(__FILE__, 'ems_drop_table'); 

function ems_drop_table(){
    
    global $wpdb;
    
    $table_prefix = $wpdb->prefix; 
    
    $sql = "DROP TABLE IF EXISTS {$table_prefix }ems_form_data"; 
    
    $wpdb->query($sql);
    
}

add_action("admin_enqueue_scripts", "ems_add_plugin_scripts");

function ems_add_plugin_scripts(){
    
    wp_enqueue_style("ems-bootstrap", "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css", array(), "1.0", "all"); 
    
    wp_enqueue_style("ems-data-table", "https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css", array(), "1.0", "all"); 
        
    wp_enqueue_style("ems-custom-css", EMS_PLUGIN_URL."css/custom.css", array(), "1.0", "all"); 
    
    
    
    wp_enqueue_script("ems-bootstrap", "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js", array("jquery"), "1.0.0"); 
    
    wp_enqueue_script("ems-data-table", "https://cdn.datatables.net/2.3.0/js/dataTables.js", array("jquery"), "1.0"); 
    
    wp_enqueue_script("ems-validate", EMS_PLUGIN_URL."js/validation.js", array("jquery"), "1.0"); 
    
      wp_enqueue_script("ems-validate-tel", "https://cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js", array("jquery"), "1.0"); 
    
    wp_enqueue_script("ems-script", EMS_PLUGIN_URL."js/script.js", array("jquery"), "1.0"); 
    

}


?>