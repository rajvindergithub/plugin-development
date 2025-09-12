<?php 

/*
 * Plugin Name:       ACF Custom Blocks with PHP
 * Description:       Create custom ACF Blocks for Gutenberg
 * Author:            Rajvinder Singh
*/
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


 

// Your plugin code here

class ACF_Block{
    
    public function __construct(){
        
        add_action('acf/init', [$this, 'registor_acf_block']);
        
    }
    
    public function registor_acf_block(){
        
        
        acf_register_block_type(array(
            'name'              => 'testimonial',
            'title'             => __('Testimonial'),
            'description'       => __('A custom testimonial block.'),
            'render_template'   => plugin_dir_path(__FILE__) .'blocks/testimonial.php',
            'category'          => 'text',
        ));
        
    }
    
}

new ACF_Block(); 


?>