<?php 

/*
 * Plugin Name:       My Custom Meta Box 
 * Description:       Meta Box for Wordpress Pages and Post
 * Author:            Rajvinder Singh
 * Text Domain:       meta-box-custom
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


add_action('add_meta_boxes', 'mmp_register_page_metabox');

function mmp_register_page_metabox(){
    add_meta_box("mmp_metabox_id", "My Custom Metabox - SEO","mmp_create_page_metabox","page"); 
    
}

function mmp_create_page_metabox(){
    
    ob_start(); 
    
        include plugin_dir_path(__FILE__).'template/page_metabox.php';

            $template = ob_get_contents(); 

        ob_end_clean();
    
    echo $template; 
    
}

// save data of custom metabox

add_action("save_post", "mmp_save_page_metabox_page");

function mmp_save_page_metabox_page($post_id){
    
    //check wp nonce
    if(wp_verify_nonce($_POST['mmp_save_pmetabox_nonce']), "mmp_save_page_metabox_page"){
        return; 
    }
    
    //check autosave
    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE ){
        return; 
    }
    
    
    if(isset($_POST['pmeta_title'])){
        update_post_meta($post_id, "pmeta_title", $_POST['pmeta_title']);  
        }
    
    if(isset($_POST['pmeta_description'])){    
        update_post_meta($post_id, "pmeta_description", $_POST['pmeta_description']);  
    }
    
}

//retrive meta box data 

add_action('wp_head','mmp_add_head_meta_tags');

function mmp_add_head_meta_tags(){
    if(is_page()){
       
        global $post; 
        
        $post_id = $post->ID; 
        $title = get_post_meta($post_id, "pmeta_title", true); 
        $description = get_post_meta($post_id, "pmeta_description", true); 
        
        if(!empty($title)){
            echo '<meta name="title" content="'.$title.'" />';
        }
        
              if(!empty($description)){
            echo '<meta name="description" content="'.$description.'" />';
        }
        
        
    }
    
}