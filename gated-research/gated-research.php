<?php 

/*
 * Plugin Name:       Research Article
 * Description:       Registers a custom post type called Research Article.
 * Version:           1.0.0
 * Author:            Rajvinder Singh
 * Author URI:        https://portfolio.myfreeonlinetools.com/
 * Text Domain:       gated-research
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
 


function ra_register_cpt() {
    register_post_type('research_article', [
        'label' => 'Research Articles',
        'public' => true,
        'show_in_rest' => true,
        'supports' => ['title','editor']
    ]);
}

add_action('init','ra_register_cpt');

register_activation_hook(__FILE__, function(){
    ra_register_cpt();
    flush_rewrite_rules();
});


register_deactivation_hook(__FILE__, 'flush_rewrite_rules');


?>