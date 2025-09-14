<?php 
/*
 * Plugin Name:       Woocommerce Custom Product
 * Description:       Develop plugin for Woocommerce Custom Products
 * Version:           1.0
 * Author:            Rajvinder Singh
 * Text Domain:       woocommerce-custom-product
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Stop execution.
}

add_action("admin_menu", "wcp_add_menu"); 

add_action("admin_enqueue_scripts", "wcp_add_scripts");


function wcp_add_scripts(){
    
    wp_enqueue_media(); 
    
    wp_enqueue_script("wcp-script", plugin_dir_url(__FILE__)."assets/scripts.js");
    
}

//check WooCommerce is Activated and Install or Not

function wcp_show_woocommerce_error(){
    echo '<div class="notice notice-error is-dimissible">
            <p>Please Install and Active the WooCommerce Plugin</p>
        </div>';
}



if( !in_array("woocommerce/woocommerce.php", apply_filters("active_plugins", get_option("active_plugins")))){
    
    add_action("admin_notices", "wcp_show_woocommerce_error");
   
}



function wcp_add_menu(){
    
    add_menu_page('WooCommerce Product Creator', 'WooCommerce Product Creator', 'manage_options', 'wcp-woocommerce-product-creator', 'wcp_add_woocommerce_product_layout', 'dashicons-cloud-upload', 9); 
    
}

function wcp_add_woocommerce_product_layout(){
   
    ob_start(); 
    
        include_once plugin_dir_path(__FILE__). 'template/add_woocomerce_product_form.php';
    
        $template = ob_get_contents(); 
    
        ob_end_clean();
    
        echo $template; 
}

add_action('admin_init', 'wcp_handle_add_product_form_submit');

function wcp_handle_add_product_form_submit(){
    
    if( isset($_POST['btn_submit_woocom_product']) ){
        
        if(!wp_verify_nonce( $_POST['wcp_nonce_value'], "wcp_handle_add_product_form_submit" ) ){
            
            exit; 
            
        }
    
        
        $wcp_name = sanitize_text_field($_POST['wcp_name']);
        $wcp_regular_price = sanitize_text_field($_POST['wcp_regular_price']);
        $wcp_sale_price = sanitize_text_field($_POST['wcp_sale_price']);
        $wcp_sku = sanitize_text_field($_POST['wcp_sku']);
        $wcp_short_description = sanitize_text_field($_POST['wcp_short_description']);
        $wcp_description = sanitize_text_field($_POST['wcp_description']);
        
        
        
        $status = "publish";
            
        
        if( class_exists("WC_Product_Simple")){
            
            $productObject = new WC_Product_Simple(); 
            
            $productObject->set_name($wcp_name); 
            $productObject->set_regular_price($wcp_regular_price); 
            $productObject->set_sale_price($wcp_sale_price); 
            $productObject->set_sku($wcp_sku); 
            $productObject->set_description($wcp_description); 
            $productObject->set_short_description($wcp_short_description); 
            $productObject->set_image_id($_POST['product_media_id']
                                        ); 
            
            $productObject->set_status($status); 
            
            $productObject->save();
            
            echo '<div class="notice notice-success">WooCommerce Product Added Successfully</div>'; 
            
        }
        
    }
    
}


?>