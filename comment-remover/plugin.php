<?php 

/*
 * Plugin Name:       Comment Remover
 * Description:       Read, Remove Blog Comment
 * Requires PHP:      7.2
 * Author:            Rajvinder Singh
*/

add_action('admin_menu','blog_comment_page');


define('PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugin_dir_url(__FILE__));


function enqueue_bootstrap_assets() {
    wp_enqueue_style(
        'bootstrap-css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
        array(), 
        '5.3.3'   
    );

    // Enqueue Bootstrap JS (requires Popper, included in Bootstrap 5 bundle)
    wp_enqueue_script(
        'bootstrap-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        array(), 
        '5.3.3',
        true 
    );
}

add_action('wp_enqueue_scripts', 'enqueue_bootstrap_assets');


function blog_comment_page(){

    add_menu_page( "Remove Blog Comments","Comment Remover", 'manage_options', 'comment-remover', 'comments_remover', 'dashicons-admin-generic', 6 );
    
    
}

function comments_remover(){
    
    include_once(PLUGIN_PATH.'pages/get-all-comments.php');
    
}

?>
