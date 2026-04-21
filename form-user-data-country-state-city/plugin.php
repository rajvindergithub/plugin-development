<?php
/*
Plugin Name: Another User Custom Form Data 
Description: Store Custom Form Data Use with Shortcode [custom-user-form]
Version: 1.0
Author: Rajvinder Singh
*/

if (!defined('ABSPATH')) exit;


function create_custom_user_form_table(){
    
    global $wpdb; 
    
    $table_custom_data = $wpdb->prefix.'add_custom_user_data'; 
     
    $create_table_query = "CREATE TABLE {$table_custom_data} (
      `id` int(100) NOT NULL,
      `name` varchar(100) NOT NULL,
      `email` varchar(100) NOT NULL,
      `age` int(100) NOT NULL,
      `country` varchar(100) NOT NULL,
      `state` varchar(100) NOT NULL,
      `city` varchar(100) NOT NULL,
      `created_at` datetime NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ";
    
    require_once(ABSPATH .'wp-admin/includes/upgrade.php');
    
    dbDelta($create_table_query);
    
}

register_activation_hook(__FILE__, 'create_custom_user_form_table');


function custom_user_form_fun() {

    ob_start();
    
    $plugin_path = plugin_dir_path(__FILE__);
 
    include($plugin_path. 'template/form-data-user.php');

    return ob_get_clean();
}

add_shortcode('custom_user_form', 'custom_user_form_fun');


//add_action('init', 'handle_custom_form_data');


add_action('wp_ajax_handle_custom_form_data', 'handle_custom_form_data');
add_action('wp_ajax_nopriv_handle_custom_form_data', 'handle_custom_form_data');

function handle_custom_form_data(){
    
   global $wpdb; 
        
        $table_custom = $wpdb->prefix. 'add_custom_user_data'; 
        
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $age = sanitize_text_field($_POST['age']);
        $country = sanitize_text_field($_POST['country']);
        $state = sanitize_text_field($_POST['state']);
        $city = sanitize_text_field($_POST['city']);
        
         $result = $wpdb->insert(
            $table_custom,
            array(
                'name'    => $name,
                'email'   => $email,
                'age'     => $age,
                'country' => $country,
                'state'   => $state,
                'city'    => $city
            ) 
        );

        
         if ($result === false) {

            echo "Insert Failed: " . $wpdb->last_error;

        } else {

            echo "Data Inserted Successfully";

            // Get Insert ID
            $insert_id = $wpdb->insert_id;
        }
        
     wp_die(); // Required in AJAX
    
}


//add admin page

function add_admin_page_custom_form(){
    
    add_menu_page(
        'Custom User Form',
        'Custom User Form',
        'manage_options',
        'custom-form-user-data',
        'custom_form_user_data',
        'dashicons-feedback',
        10
    );
}

add_action('admin_menu', 'add_admin_page_custom_form');


function custom_form_user_data(){
    
    global $wpdb; 
    
    $table_custom_data = $wpdb->prefix. 'add_custom_user_data'; 
     $plugin_path = plugin_dir_path(__FILE__);
    
   
    
    $get_user_form_data = $wpdb->get_results("SELECT * FROM {$table_custom_data}");
     
    
      include_once($plugin_path.'template/fetch-user-form-data.php');
    
}

add_action('init', 'delete_record_custom_form');


function delete_record_custom_form(){
    
    global $wpdb;

    $table_name = $wpdb->prefix . 'add_custom_user_data';
    
    if(isset($_POST['delete_record_submit'])){
        
        $row_id = $_POST['delete_record'];
        
      $wpdb->delete(
        $table_name,
        array('id' => $row_id) 
    );

    wp_redirect(admin_url('admin.php?page=custom-form-user-data'));
        
    exit;
       
        
    }
}

