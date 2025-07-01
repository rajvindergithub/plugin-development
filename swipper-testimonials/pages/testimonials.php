<div class="container">
    <div class="row">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">


                <?php
$args = array(
    'post_type'      => 'testimonial',
    'posts_per_page' => -1, // Change as needed
);

$loop = new WP_Query($args);

if ($loop->have_posts()) :
    while ($loop->have_posts()) : $loop->the_post();

        // ACF Fields
        $testimonial_image = get_field('photo'); // image field
        $testimonial_title = get_field('name_title'); // text or WYSIWYG field
        
        ?>


                <div class="swiper-slide">
                    <div class="testimonials-item">
                        <div class="t-i-para">

                            <p><?php the_content(); ?> </p>
                        </div>


                        <div class="t-i-divider">
                        </div>
                        <div class="t-i-footer">
                            <div class="t-i-f-left">
                                <div class="t-i-f-l-img">

                                    <?php if($testimonial_image):?>

                                    <img src="<?php echo esc_url($testimonial_image); ?>" />

                                    <?php endif; ?>

                                </div>
                                <div class="t-i-f-l-heading-name">
                                    <div class="t-i-f-l-heading">
                                        <?php if(the_title()):?>
                                        <h4><?php echo the_title(); ?></h4>
                                        <?php endif; ?>
                                    </div>
                                    <div class="t-i-f-l-name">
                                        <?php if($testimonial_title):?>
                                        <?php echo $testimonial_title; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="t-i-f-right">
                                <img src="<?php echo PLUGIN_URL;?>assets/images/testimonials-icon.png" />
                            </div>
                        </div>

                    </div>
                </div>




                <?php
    endwhile;
    wp_reset_postdata();
else :
    echo '<p>No Testimonials.</p>';
endif;
?>


            </div>

        </div>
    </div>
</div>
