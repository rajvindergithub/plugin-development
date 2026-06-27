<?php
/**
 * Plugin uninstall cleanup.
 *
 * @package CustomCSSEditor
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

delete_option( 'save_custom_css' );
delete_option( 'custom_css_file_path' );

$upload_dir = wp_upload_dir();

if ( empty( $upload_dir['error'] ) ) {
    $css_dir = trailingslashit( $upload_dir['basedir'] ) . 'custom-css/';
    $files   = glob( $css_dir . '*.css' );

    if ( is_array( $files ) ) {
        foreach ( $files as $file ) {
            wp_delete_file( $file );
        }
    }

    if ( is_dir( $css_dir ) ) {
        rmdir( $css_dir );
    }
}
