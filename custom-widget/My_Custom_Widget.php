<?php 

class My_Custom_Widget extends WP_Widget{
    
    public function  __construct(){
         parent::__construct(
            "my_custom_widget", 
             "My Custom Widget",
             array(
                "description" => "Display Recent Posts and Static Messages"
             )
         );
    }
    
    public function form($instance){
        ?>
            <p>
                <label for="<?php echo $this->get_field_id('mcw_title'); ?>">Title</label>
                <input type="text" name="<?php echo get_field_name('mcw_title');?>" id="<?php echo $this->get_field_id('mcw_title'); ?>" class="widefat" value="" />
            </p>
            <p>
                <label for="">Display Type</label>
                <select id="<?php echo get_field_id('mcw_display_option');?>" name="<?php echo $this->get_field_name('mcw_display_option');?>" class="widefat mcw_dd_options">
                    <option value="recent_post">Recent Post</option>
                    <option value="static_message">Static Message</option>
                </select>
            </p>
            <p id="mcw_display_recent_posts">
                <label for="<?php $this->get_field_id('mcw_number_of_posts');?>">Number of Posts</label>
                <input type="number" name="<?php echo $this->get_field_name('mcw_number_of_posts');?>" id="<?php $this->get_field_id('mcw_number_of_posts');?>" value="" class="widefat" />
            </p>
            <p id="mcw_display_static_message">
                <label for="<?php $this->get_field_name('mcw_your_message');?>">Your Message</label>
                <input type="text" name="<?php $this->get_field_name('mcw_your_message');?>" id="<?php $this->get_field_id('mcw_your_message');?>" value="" class="widefat" />
            </p>

    <?php
    }
    
    public function update( $new_instance, $old_instance ){
        
    }
    
    public function widget( $args, $instance ){
        
    }
    
}