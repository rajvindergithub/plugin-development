<?php
 
require( 'vendor/autoload.php' );

use Razorpay\Api\Api;
   

if ( isset( $_POST ) && isset( $_POST['payment_button'] ) ) {

  
    $keyId = 'rzp_test_Uew19G0f0FyxbW';
    $keySecret = '4H2ZJdPxMlMfVwloH31hvg73';
   
        $api = new Api($keyId, $keySecret);

        // Generate a new order
        $orderData = [
            'receipt'         => '1234',
            'amount'          => 50000, // amount in paise = ₹500
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
        ];

        $order = $api->order->create($orderData);
        $orderId = $order['id'];

        echo json_encode([
            'orderId' => $orderId
        ]);
 
}

?>
