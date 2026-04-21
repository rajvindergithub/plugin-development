<?php 

//$key_id = 'rzp_test_zu00OvJ5JPTfAp';
//$key_secret = '0gHOWGAPoGq3YKUtZONZ7znA';
 

require 'vendor/autoload.php'; // Path to Razorpay SDK

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class RazorpayHandler {
    private $api_key;
    private $api_secret;
    private $api;

    public function __construct() {
        $this->api_key = 'rzp_test_zu00OvJ5JPTfAp';
        $this->api_secret = '0gHOWGAPoGq3YKUtZONZ7znA';
        $this->api = new Api($this->api_key, $this->api_secret);
    }

    /**
     * Create an order
     */
    public function createOrder($amount, $currency = 'INR', $receipt = null) {
        $orderData = [
            'receipt'         => $receipt ?: uniqid('receipt_'),
            'amount'          => $amount * 100, // Convert to paise
            'currency'        => $currency,
            'payment_capture' => 1
        ];

        try {
            return $this->api->order->create($orderData);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Verify payment signature
     */
    public function verifyPayment($data) {
        $attributes = [
            'razorpay_order_id'   => $data['razorpay_order_id'],
            'razorpay_payment_id' => $data['razorpay_payment_id'],
            'razorpay_signature'  => $data['razorpay_signature']
        ];

        try {
            $this->api->utility->verifyPaymentSignature($attributes);
            return ['success' => true];
        } catch (SignatureVerificationError $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}

 


?>