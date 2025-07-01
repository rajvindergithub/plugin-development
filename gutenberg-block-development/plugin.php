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

    register_block_type( 'gutenberg/hello-world', array(
        'editor_script' => 'gutenberg-step01',
    ) );
}
add_action( 'init', 'gutenberg_boilerplate_block' );