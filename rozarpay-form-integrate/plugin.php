<?php 
/*
 * Plugin Name:       RozarPay Payment Integration
 * Description:       Add RozarPay Payment Gateway for making payments
 * Version:           1.0
 * Requires PHP:      7.2
 * Author:            Rajvinder Singh
 * Text Domain:       payment-gateway
 */


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
;
 

class rozar_payment_integrate {
    
    private $plugin_path ;
    private $plugin_url ;
    private $api_key;
    
    public function __construct() {
        
    $this->plugin_path = plugin_dir_path(__FILE__);
    $this->plugin_url = plugin_dir_url(__FILE__);
    $this->api_key_id = 'rzp_test_Uew19G0f0FyxbW';     
    $this->api_key_secret = '4H2ZJdPxMlMfVwloH31hvg73';     
        
    add_shortcode('payment_form_rozarpay', [$this,'payment_integration_shortcode']);
        
        
    }
    
    public function payment_integration_shortcode(){

        ob_start(); // 🔁 Start output buffering
        
            include_once $this->plugin_path.'pages/payment-form.php'; 
        
      return ob_get_clean(); // ✅ Return the output buffer
        
    }
}

new rozar_payment_integrate();


?>