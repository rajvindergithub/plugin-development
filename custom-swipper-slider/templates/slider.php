<?php 
 

$selected_images = get_option(
    'my_swiper_selected_images',
    array()
);

$slider_image_path = CISP_PLUGIN_PATH.'includes/assets/images/';
$slider_image_url = CISP_PLUGIN_URL.'includes/assets/images/';

 

//print_r($selected_images);

?>

    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
          
          <?php foreach($selected_images as $image): ?>
                 <div class="swiper-slide">
                
                     <img src="<?php echo $slider_image_url.$image ?>" />
                     
                     
          
                </div>
          <?php endforeach; ?>
           
      </div>
         <div class="swiper-pagination"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>



