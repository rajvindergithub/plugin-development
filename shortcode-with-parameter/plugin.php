<?php 

/*
 * Plugin Name:       Shortcode with Parameter
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Author:            Rajvinder Singh
 * Text Domain:       shortcode-with-parameter
 */


defined( 'ABSPATH' ) || exit;


add_shortcode('custom_rating', 'wordpress_custom_rating'); 

function wordpress_custom_rating($attributes){
    
    $attributes = shortcode_attr(
        array(
            "brand" => "Blog User",
            "rating" => "5.0"
        ), $attributes, "student"
    );
    
    return "<h3>From Brand: {$attributes['brand']}, we get great rating of : {$attribute['rating']; } </h3>"; 
    
}


?>