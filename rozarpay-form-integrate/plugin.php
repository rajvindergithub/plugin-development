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
    exit;
    // Exit if accessed directly
}

require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

use Razorpay\Api\Api;

class rozar_payment_integrate {

    private $api_key = 'rzp_test_Uew19G0f0FyxbW';
    private $api_secret = '4H2ZJdPxMlMfVwloH31hvg73';

    public function __construct() {

        add_shortcode( 'payment_form_rozarpay', [$this, 'payment_integration_shortcode'] );

        add_action( 'wp_enqueue_scripts', [$this, 'myplugin_enqueue_scripts' ] );

        add_action( 'wp_ajax_myplugin_handle_ajax', [$this, 'myplugin_handle_ajax_callback'] );
        add_action( 'wp_ajax_nopriv_myplugin_handle_ajax', [$this, 'myplugin_handle_ajax_callback'] );

    }

    public function payment_integration_shortcode() {

        ob_start();

        include_once plugin_dir_path( __FILE__ ).'pages/payment-form.php';

        return ob_get_clean();

    }

    public function myplugin_enqueue_scripts() {
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'myplugin-ajax', plugin_dir_url( __FILE__ ) . 'pages/assets/my-ajax.js', ['jquery'], '1.0', true );

        wp_localize_script( 'myplugin-ajax', 'myplugin_ajax_obj', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'myplugin_nonce' )
        ] );
    }

    function myplugin_handle_ajax_callback() {
        check_ajax_referer( 'myplugin_nonce', 'nonce' );

//        $name = sanitize_text_field( $_POST['name'] );
        
        print_r($_POST);

        if ( empty( $_POST ) ) {
            wp_send_json_error( 'Name cannot be empty.' );
        }

      
        wp_send_json_success( [
            'message' => $message
        ] );
    }

}

new rozar_payment_integrate();

?>
