<?php 

/*
 * Plugin Name:       Comment Remover
 * Description:       Read, Remove Blog Comment
 * Requires PHP:      7.2
 * Author:            Rajvinder Singh
*/
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Your plugin code here


add_action('admin_menu','blog_comment_page');


define('PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugin_dir_url(__FILE__));


function blog_comment_page(){
    add_menu_page( "Remove Blog Comments","Comment Remover", 'manage_options', 'comment-remover', 'comments_remover', 'dashicons-admin-generic', 6 );
}


function comments_remover(){
    
    include_once(PLUGIN_PATH.'pages/get-all-comments.php');
    
}

function enqueue_bootstrap_assets() {
    wp_enqueue_style('bootstrap-css-comment','https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',      array(),'5.3.3'   
    );  
    
    wp_enqueue_style(
        'data-table-css-comment',     '//cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css',
        array(),'1.0'
    );

    // Enqueue Bootstrap JS (requires Popper, included in Bootstrap 5 bundle)
    wp_enqueue_script(
        'bootstrap-js-comment',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        array('jquery'), 
        '1.0' , true
    );    
    
    // Enqueue data table js
    wp_enqueue_script(
        'data-table-js-comment',
        '//cdn.datatables.net/2.3.1/js/dataTables.min.js',
        array('jquery'), 
        '1.0', true
    );
    
        wp_enqueue_script(
        'comment-script',
        PLUGIN_URL.'js/comment-script.js',
        array('jquery'), 
        'all', true
    );
    
}

add_action('admin_enqueue_scripts', 'enqueue_bootstrap_assets');



?>
