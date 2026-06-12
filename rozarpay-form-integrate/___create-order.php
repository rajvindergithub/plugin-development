<?php 

 
require_once 'razorpay/Razorpay.php';

use Razorpay\Api\Api;

$api_key = 'rzp_test_zu00OvJ5JPTfAp';
$api_secret = '0gHOWGAPoGq3YKUtZONZ7znA';     
    

try{
$api = new Api($api_key, $api_secret);
    
    $api->order->create(
        array(
            'receipt' => '123',
            'amount' => 5000,
            'currency' => 'INR',
            'notes'=> 
            array('key1'=> 'value3',
                  'key2'=> 'value2'
                 )
        )
    );  
    
}
catch(Exception $e){
    die("Error ".$e->getMessage());
}





?>