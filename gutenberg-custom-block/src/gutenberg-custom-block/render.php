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

$text  = $attributes['textValue'] ?? '';
$image = $attributes['imageUrl'] ?? '';

ob_start();
?>

<div class="gutenblog-output">

    <?php if ( $image ) : ?>
        <div class="gutenblog-image">
            <img src="<?php echo esc_url( $image ); ?>" alt="">
        </div>
    <?php endif; ?>

    <?php if ( $text ) : ?>
        <div class="gutenblog-text">
            <h3>
                <?php echo esc_html( $text ); ?>
            </h3>
        </div>
    <?php endif; ?>

</div>

<?php
return ob_get_clean();