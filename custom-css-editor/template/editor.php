<style type="text/css">
    .custom_css_textarea {
        height: 400px;
        width: 100%;
        color: #000;
    }
    
    #display_plugin_output{ display: flex;   width: 100%; column-gap: 20px;   }
    
    .d_p_o_left{ flex-basis: 70%; }

</style>

<section id="display_plugin_output">
    <div class="d_p_o_left">
        <div class="custom_css_heading">
            <h1>Custom CSS</h1>
        </div>

        <form method="POST" action="<?php echo esc_url( admin_url('admin-post.php') );?>">

            <input type="hidden" name="action" value="custom_css_save_hidden" />

            <?php wp_nonce_field( 'nonce_custom_css' ); ?>

            <div class="custom_css_field">
                <textarea name="custom_css_textarea_code" class="custom_css_textarea"><?php echo esc_textarea($css_save_option); ?>
            </textarea>
            </div>
            <div class="custom_css_submit">
                <?php submit_button('Save Custom CSS');?>
            </div>

        </form>
    </div>


    <div class="d_p_o_right">
        
          <div class="custom_css_heading">
            <h1>CSS Versions</h1>
        </div>

        <?php
        
        
        
        $files = glob( WP_CONTENT_DIR . '/uploads/custom-css/*.css' );
        
       $files = array_reverse($files); 
        
        $base_url = WP_CONTENT_URL . '/uploads/custom-css/';
        
            $i = 1; 
        
            foreach($files as $file){
                 
                echo "<div><a href=". $base_url.basename($file)." target='_blank' >Backup CSS File Version ".$i++."</a></div>";
            }
        
        ?>
    </div>

</section>
