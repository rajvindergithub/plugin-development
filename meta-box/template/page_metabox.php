<?php 
    $post_id = isset($post_id) ? $post_id : "" ; 
    $title = get_post_meta($post_id, "pmeta_title", true); 
    $description = get_post_meta($post_id, "pmeta_description", true); 
    
    wp_nonce_field('mmp_save_page_metabox_page', "mmp_save_pmetabox_nonce"); 

?>

<p>
    <label for="pmeta_title">Meta Title</label>
    <input type="text" name="pmeta_title" placeholder="Meta Title..." id="pmeta_title" value="<?php echo $title; ?>" />
</p>

<p>
    <label for="pmeta_description">Meta Description</label>
    <input type="text" id="pmeta_description" name="pmeta_description" placeholder="Meta Description" value="<?php echo $description; ?>" />
</p>