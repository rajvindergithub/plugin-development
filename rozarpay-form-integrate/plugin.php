<?php
/*
* Plugin Name:       RozarPay Payment Integration
* Description:       Add RozarPay Payment Gateway for making payments
* Version:           1.0
* Requires PHP:      7.2
* Author:            Rajvinder Singh
* Text Domain:       payment-gateway
*/

//$key_id = 'rzp_test_zu00OvJ5JPTfAp';
//$key_secret = '0gHOWGAPoGq3YKUtZONZ7znA';

require_once 'razorpay/Razorpay.php';

use Razorpay\Api\Api;

class rozar_payment_integrate {

    private $api_key;
    private $api_secret;
    private $api;

    public function __construct() {

        add_shortcode( 'payment_form_rozarpay', [$this, 'payment_integration_shortcode'] );

        add_action( 'wp_enqueue_scripts', [$this, 'myplugin_enqueue_scripts' ] );

        add_action( 'wp_ajax_myplugin_handle_ajax', [$this, 'myplugin_handle_ajax_callback'] );
        add_action( 'wp_ajax_nopriv_myplugin_handle_ajax', [$this, 'myplugin_handle_ajax_callback'] );
        
        $this->api_key = 'rzp_test_zu00OvJ5JPTfAp';
        $this->api_secret = '0gHOWGAPoGq3YKUtZONZ7znA';

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

        if (
            ! isset( $_POST['nonce'] ) ||
            ! wp_verify_nonce( $_POST['nonce'], 'myplugin_nonce' )
        ) {
            wp_send_json_error( ['message' => 'Nonce check failed!'] );
        }

        if ( empty( $_POST ) ) {
            wp_send_json_error( 'Name cannot be empty.' );
        }

        $full_name = sanitize_text_field( $_POST['full_name'] );
        $payment_email = sanitize_text_field( $_POST['payment_email'] );
        $payment_mobile = sanitize_text_field( $_POST['payment_mobile'] );
        $payment_amount = sanitize_text_field( $_POST['payment_amount'] );

//                return [
//                    'name'=> $full_name,
//                    'email'=> $payment_email,
//                    'mobile' => $payment_mobile,
//                    'amount'=> $payment_amount
//                ];
        
            try{
                
            $api = new Api($this->api_key, $this->api_secret);

              $order =   $api->order->create(
                    array(
                        'receipt' => 'rp_myfreeonline_'.time(),
                        'amount' => $payment_amount*100,
                        'currency' => 'INR',
                        'notes'=> 
                        array('payee_name'=> $full_name,
                              'payee_email'=> $payment_email,
                              'payee_mobile'=> $payment_mobile
                             )
                    )
                );  
            
               $message = "Payment made successfully.";
                
            }
            catch(Exception $e){
                die("Error ".$e->getMessage());
            }

        wp_send_json_success( [
            'message' => $message,
            'id' => $order['id'],
            'recipt' => $order['receipt']
        ] );
    }
}

new rozar_payment_integrate();
 

?>
