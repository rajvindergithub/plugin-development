<?php 

/*
 * Plugin Name:       Author Meta Box 
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Author:            Rajvinder Singh
 * Text Domain:       author-meta-box
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Stop execution immediately
}

function wp_authors_metabox(){
    
    add_meta_box("owt-author-id", 'Author Meta Box', 'wp_author_callback_function',"book", "side",'high');
    
}

add_action('add_meta_boxes', 'wp_authors_metabox');

function wp_author_callback_function(){
    
    wp_nonce_field(basename(__FILE__), "wp_author_nonce");

    ?>
    
    <p>
        <label for="ddauthor">Select Author</label> 
        
        <?php 
            $post_id = $post->ID; 
            $author_id = get_post_meta($post_id,owt_book_author_name, true); 
    
        ?>
        
        <select name="author_name">
            <?php 
                $all_authors = get_users(array("role" => "author"));
                foreach($all_authors as $index=>$author){
                    
                        $selected = ""; 
                    
                    if($author_id == $author->data->ID){ 
                        $selected = 'selected="selected"'; 
                    }
                    
                   ?>
                    <option <?php echo $selected; ?> value="<?php echo $author->data->display_name; ?>" id="<?php echo $author->data->display_name;; ?>">
                        <?php echo $author->data->display_name;; ?>
                    </option>
            <?php }
            ?>
             
        </select>
    </p>

    <?php 
}


add_action("save_post","wp_save_author_data", 10, 2);

function wp_save_author_data($post_id, $post){
    
    if(!isset($_POST['wp_author_nonce']) || !wp_verify_nonce($_POST['wp_author_nonce'], basename(__FILE__))){
        return  $post_id; 
        
    }
    
    $book_slug = "book"; 
    
    if($book_slug != $post->post_type){
        return $post_id; 
    }
    
    $author_name = ""; 
    
    if(isset($_POST['author_name'])){
        $author_name = sanitize_text_field($_POST['author_name']);
    }else{
        $author_name = '';
    }
    
    update_post_meta($post_id, "owt_book_author_name", $author_name); 
    
}



?>