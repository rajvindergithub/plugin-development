<?php
/**
 * Plugin Name: 1) Hello world
 * Description: Our first Gutenberg block
 */

defined( 'ABSPATH' ) || exit;

function gutenberg_boilerplate_block() {
    wp_register_script(
        'gutenberg-step01', 
        plugins_url( 'block.js', __FILE__ ),   
        array( 'wp-blocks', 'wp-element' )    
    );
    
    
    wp_register_style(
        'css-gutenberg-editor-style',
         plugin_dir_url(__FILE__).'editor.css', 
         array(),
        '1.0.0.',
        'all'
    ); 
    
    wp_register_style(
        'css-gutenberg-frontend-style',
         plugin_dir_url(__FILE__).'style.css', 
         array(),
        '1.0.0.',
        'all'
    );


    register_block_type( 'gutenberg/hello-world', array(
        'editor_script' => 'gutenberg-step01',
        'editor_style'  =>  'css-gutenberg-editor-style',
        'style'         =>  'css-gutenberg-frontend-style'
    ) );
}
add_action( 'init', 'gutenberg_boilerplate_block' );