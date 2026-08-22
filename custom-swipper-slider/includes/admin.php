<?php 
 

define( 'MY_SWIPER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MY_SWIPER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );


function cisp_add_admin_menu() {

    add_menu_page(
        'Slider Images',
        'Slider Images',
        'manage_options',
        'cisp-slider',
        'cisp_slider_admin_page',
        'dashicons-images-alt2',
        25
    );
}

add_action( 'admin_menu', 'cisp_add_admin_menu' );


function cisp_slider_admin_page() {

    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $image_dir = MY_SWIPER_PLUGIN_DIR . 'assets/images/';
    $image_url = MY_SWIPER_PLUGIN_URL . 'assets/images/';

    /*
     * Create image directory if it doesn't exist
     */
    if ( ! file_exists( $image_dir ) ) {
        wp_mkdir_p( $image_dir );
    }


    /**
     * Upload image
     */
    if (
        isset( $_POST['my_swiper_upload'] ) &&
        check_admin_referer( 'my_swiper_upload_action', 'my_swiper_upload_nonce' )
    ) {

        if ( ! empty( $_FILES['slider_image']['name'] ) ) {

            $file = $_FILES['slider_image'];

            $allowed_types = array(
                'image/jpeg',
                'image/png',
                'image/gif',
                'image/webp'
            );

            if ( in_array( $file['type'], $allowed_types, true ) ) {

                $filename = sanitize_file_name( $file['name'] );

                /*
                 * Avoid duplicate filenames
                 */
                $filename = wp_unique_filename(
                    $image_dir,
                    $filename
                );

                $destination = $image_dir . $filename;

                if ( move_uploaded_file(
                    $file['tmp_name'],
                    $destination
                ) ) {

                    echo '<div class="notice notice-success is-dismissible">
                        <p>Image uploaded successfully.</p>
                    </div>';

                } else {

                    echo '<div class="notice notice-error">
                        <p>Unable to upload image.</p>
                    </div>';
                }

            } else {

                echo '<div class="notice notice-error">
                    <p>Only JPG, PNG, GIF and WebP images are allowed.</p>
                </div>';
            }
        }
    }


    /**
     * Delete image
     */
    if (
        isset( $_GET['delete_image'] ) &&
        check_admin_referer(
            'delete_image_' . sanitize_file_name( $_GET['delete_image'] )
        )
    ) {

        $filename = sanitize_file_name(
            $_GET['delete_image']
        );

        $file_path = $image_dir . $filename;

        if ( file_exists( $file_path ) ) {

            unlink( $file_path );

            /*
             * Remove deleted image from selected slider images
             */
            $selected_images = get_option(
                'my_swiper_selected_images',
                array()
            );

            $selected_images = array_filter(
                $selected_images,
                function( $image ) use ( $filename ) {

                    return basename( $image ) !== $filename;
                }
            );

            update_option(
                'my_swiper_selected_images',
                array_values( $selected_images )
            );

            echo '<div class="notice notice-success is-dismissible">
                <p>Image deleted successfully.</p>
            </div>';
        }
    }


    /**
     * Save selected images
     */
    if (
        isset( $_POST['my_swiper_save_selection'] ) &&
        check_admin_referer(
            'my_swiper_selection_action',
            'my_swiper_selection_nonce'
        )
    ) {

        $selected_images = isset( $_POST['slider_images'] )
            ? (array) $_POST['slider_images']
            : array();

        $selected_images = array_map(
            'sanitize_text_field',
            $selected_images
        );

        /*
         * Only store filenames that actually exist
         */
        $selected_images = array_filter(
            $selected_images,
            function( $filename ) use ( $image_dir ) {

                return file_exists(
                    $image_dir . basename( $filename )
                );
            }
        );

        update_option(
            'my_swiper_selected_images',
            array_values( $selected_images )
        );

        echo '<div class="notice notice-success is-dismissible">
            <p>Slider images saved successfully.</p>
        </div>';
    }


    /*
     * Get images
     */
    $images = array();

    if ( is_dir( $image_dir ) ) {

        $files = scandir( $image_dir );

        foreach ( $files as $file ) {

            if ( in_array( $file, array( '.', '..' ), true ) ) {
                continue;
            }

            $extension = strtolower(
                pathinfo( $file, PATHINFO_EXTENSION )
            );

            if (
                in_array(
                    $extension,
                    array( 'jpg', 'jpeg', 'png', 'gif', 'webp' ),
                    true
                )
            ) {

                $images[] = $file;
            }
        }
    }


    /*
     * Previously selected images
     */
    $selected_images = get_option(
        'my_swiper_selected_images',
        array()
    );

    ?>

    <div class="wrap">

        <h1>Swiper Slider Images</h1>

        <hr>

        <h2>Upload Slider Image</h2>

        <form method="post" enctype="multipart/form-data">

            <?php
            wp_nonce_field(
                'my_swiper_upload_action',
                'my_swiper_upload_nonce'
            );
            ?>

            <input
                type="file"
                name="slider_image"
                accept="image/jpeg,image/png,image/gif,image/webp"
                required
            >

            <button
                type="submit"
                name="my_swiper_upload"
                class="button button-primary"
            >
                Upload Image
            </button>

        </form>


        <hr>

        <h2>Select Images For Swiper Slider</h2>

        <form method="post">

            <?php
            wp_nonce_field(
                'my_swiper_selection_action',
                'my_swiper_selection_nonce'
            );
            ?>

            <div class="my-swiper-images">

                <?php if ( ! empty( $images ) ) : ?>

                    <?php foreach ( $images as $image ) : ?>

                        <?php
                        $image_src = $image_url . rawurlencode( $image );

                        $is_selected = in_array(
                            $image,
                            $selected_images,
                            true
                        );
                        ?>

                        <div class="my-swiper-image-item">

                            <label>

                                <input
                                    type="checkbox"
                                    name="slider_images[]"
                                    value="<?php echo esc_attr( $image ); ?>"
                                    <?php checked( $is_selected, true ); ?>
                                >

                                <img
                                    src="<?php echo esc_url( $image_src ); ?>"
                                    alt=""
                                >

                            </label>

                            <div class="my-swiper-image-name">

                                <?php echo esc_html( $image ); ?>

                            </div>

                            <a
                                href="<?php
                                echo esc_url(
                                    wp_nonce_url(
                                        admin_url(
                                            'admin.php?page=cisp-slider&delete_image=' .
                                            rawurlencode( $image )
                                        ),
                                        'delete_image_' . $image
                                    )
                                );
                                ?>"
                                class="button button-small"
                                onclick="return confirm('Are you sure you want to delete this image?');"
                            >
                                Delete
                            </a>

                        </div>

                    <?php endforeach; ?>

                <?php else : ?>

                    <p>No slider images uploaded.</p>

                <?php endif; ?>

            </div>


            <?php if ( ! empty( $images ) ) : ?>

                <p>

                    <button
                        type="submit"
                        name="my_swiper_save_selection"
                        class="button button-primary"
                    >
                        Save Slider Selection
                    </button>

                </p>

            <?php endif; ?>

        </form>

    </div>


    <style>

        .my-swiper-images {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .my-swiper-image-item {
            background: #fff;
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
        }

        .my-swiper-image-item img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
            margin: 10px 0;
        }

        .my-swiper-image-name {
            font-size: 12px;
            margin-bottom: 10px;
            word-break: break-all;
        }

        .my-swiper-image-item label {
            cursor: pointer;
        }

        .my-swiper-image-item input[type="checkbox"] {
            transform: scale(1.3);
        }

        @media screen and (max-width: 900px) {

            .my-swiper-images {
                grid-template-columns: repeat(2, 1fr);
            }

        }

    </style>

    <?php
}