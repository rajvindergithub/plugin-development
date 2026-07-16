<?php
/**
 * Admin editor template.
 *
 * @package CustomCSSEditor
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$status = isset( $_GET['custom-css-editor-status'] ) ? sanitize_key( wp_unslash( $_GET['custom-css-editor-status'] ) ) : '';

$messages = array(
    'updated'      => __( 'Custom CSS saved successfully.', 'custom-css-editor' ),
    'upload-error' => __( 'WordPress could not access the uploads directory.', 'custom-css-editor' ),
    'not-writable' => __( 'The custom CSS upload directory is not writable.', 'custom-css-editor' ),
    'save-error'   => __( 'The CSS file could not be saved.', 'custom-css-editor' ),
);
?>

<div class="wrap custom-css-editor">
    
    <div class="custom-css-editor-header">
        <h1><?php esc_html_e( 'Custom CSS Editor', 'custom-css-editor' ); ?></h1>
    </div>

    <?php if ( isset( $messages[ $status ] ) ) : ?>
        <div class="notice <?php echo 'updated' === $status ? 'notice-success' : 'notice-error'; ?> is-dismissible">
            <p><?php echo esc_html( $messages[ $status ] ); ?></p>
        </div>
    <?php endif; ?>

<section id="display_plugin_output">
    <div class="d_p_o_left">
         

        <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">

            <input type="hidden" name="action" value="custom_css_editor_save" />

            <?php wp_nonce_field( 'custom_css_editor_save_css' ); ?>

            <div class="custom_css_field">
                <textarea name="custom_css_textarea_code" class="custom_css_textarea" spellcheck="false"><?php echo esc_textarea( $css_save_option ); ?></textarea>
            </div>
            <div class="custom_css_submit">
                <?php submit_button( __( 'Save Custom CSS', 'custom-css-editor' ) ); ?>
            </div>

        </form>
    </div>

    <div class="d_p_o_right">
        <div class="custom_css_heading">
            <h2><?php esc_html_e( 'CSS Versions', 'custom-css-editor' ); ?></h2>
        </div>

        <?php
        $upload_dir = wp_upload_dir();
        $files      = empty( $upload_dir['error'] ) ? glob( trailingslashit( $upload_dir['basedir'] ) . 'custom-css/*.css' ) : array();
        $files      = is_array( $files ) ? $files : array();
        $base_url   = empty( $upload_dir['error'] ) ? trailingslashit( $upload_dir['baseurl'] ) . 'custom-css/' : '';

        usort(
            $files,
            function ( $a, $b ) {
                return filemtime( $b ) - filemtime( $a );
            }
        );

        if ( empty( $files ) ) :
            ?>
            <p><?php esc_html_e( 'No saved CSS versions yet.', 'custom-css-editor' ); ?></p>
            <?php
        else :
            ?>
            <ol class="custom-css-editor-versions">
                <?php foreach ( $files as $index => $file ) : ?>
                    <?php
                    $filename = basename( $file );
                    $file_url = $base_url . rawurlencode( $filename );
                    ?>
                    <li>
                        <a href="<?php echo esc_url( $file_url ); ?>" target="_blank" rel="noopener noreferrer">
                            <?php
                            printf(
                                /* translators: %d: CSS version number. */
                                esc_html__( 'Backup CSS File Version %d', 'custom-css-editor' ),
                                absint( $index + 1 )
                            );
                            ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ol>
            <?php
        endif;
        ?>
    </div>

</section>
</div>
