<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<p <?php echo get_block_wrapper_attributes(); ?>>
	<?php esc_html_e( 'Gutenberg Custom Block – hello from a dynamic block!', 'gutenberg-custom-block' ); ?>
</p>

<?php
/**
 * Render callback
 */
 

/**
 * Render Gallery Block
 */

if ( ! empty( $attributes['images'] ) ) {

    echo '<div class="custom-gallery">';

    foreach ( $attributes['images'] as $image ) {

        if ( isset( $image['url'] ) ) {

            echo '<div class="gallery-item">';

            echo '<img src="' . esc_url( $image['url'] ) . '" alt="" />';

            echo '</div>';
        }
    }

    echo '</div>';
}

