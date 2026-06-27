<?php
/**
 * Plugin Name: Smart Frontend Custom CSS Version Manager 
 * Plugin URI: https://portfolio.myfreeonlinetools.com/
 * Description: Add custom CSS to your WordPress site from a simple admin editor, with recent saved versions kept as backups.
 * Version: 1.0.0
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Author: Rajvinder Singh
 * Author URI: https://portfolio.myfreeonlinetools.com/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: custom-css-editor
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'CUSTOM_CSS_EDITOR_VERSION', '1.0.0' );
define( 'CUSTOM_CSS_EDITOR_FILE', __FILE__ );
define( 'CUSTOM_CSS_EDITOR_PATH', plugin_dir_path( __FILE__ ) );
define( 'CUSTOM_CSS_EDITOR_URL', plugin_dir_url( __FILE__ ) );
define( 'CUSTOM_CSS_EDITOR_OPTION', 'save_custom_css' );
define( 'CUSTOM_CSS_EDITOR_FILE_OPTION', 'custom_css_file_path' );

/**
 * Get the capability required to manage custom CSS.
 *
 * @return string
 */
function custom_css_editor_capability() {
    return apply_filters( 'custom_css_editor_capability', 'manage_options' );
}

/**
 * Register the admin menu page.
 *
 * @return void
 */
function custom_css_editor_add_admin_page() {
    add_menu_page(
        __( 'Custom CSS Editor', 'custom-css-editor' ),
        __( 'Custom CSS', 'custom-css-editor' ),
        custom_css_editor_capability(),
        'custom-css-editor',
        'custom_css_editor_render_admin_page',
        'dashicons-admin-generic',
        20
    );
}
add_action( 'admin_menu', 'custom_css_editor_add_admin_page' );

/**
 * Enqueue admin assets.
 *
 * @param string $hook_suffix Current admin page hook.
 * @return void
 */
function custom_css_editor_enqueue_admin_assets( $hook_suffix ) {
    if ( 'toplevel_page_custom-css-editor' !== $hook_suffix ) {
        return;
    }

    wp_enqueue_style(
        'custom-css-editor-admin',
        CUSTOM_CSS_EDITOR_URL . 'assets/plugin.css',
        array(),
        CUSTOM_CSS_EDITOR_VERSION
    );
}
add_action( 'admin_enqueue_scripts', 'custom_css_editor_enqueue_admin_assets' );

/**
 * Render the plugin admin page.
 *
 * @return void
 */
function custom_css_editor_render_admin_page() {
    if ( ! current_user_can( custom_css_editor_capability() ) ) {
        wp_die( esc_html__( 'You do not have permission to access this page.', 'custom-css-editor' ) );
    }

    $css_save_option = get_option( CUSTOM_CSS_EDITOR_OPTION, '' );
    $template        = CUSTOM_CSS_EDITOR_PATH . 'template/editor.php';

    include $template;
}

/**
 * Save custom CSS from the admin editor.
 *
 * @return void
 */
function custom_css_editor_save_css() {
    if ( ! current_user_can( custom_css_editor_capability() ) ) {
        wp_die( esc_html__( 'You do not have permission to save custom CSS.', 'custom-css-editor' ) );
    }

    check_admin_referer( 'custom_css_editor_save_css' );

    $css_code = isset( $_POST['custom_css_textarea_code'] ) ? wp_unslash( $_POST['custom_css_textarea_code'] ) : '';
    $css_code = is_string( $css_code ) ? $css_code : '';

    update_option( CUSTOM_CSS_EDITOR_OPTION, $css_code );

    $upload_dir = wp_upload_dir();

    if ( ! empty( $upload_dir['error'] ) ) {
        custom_css_editor_redirect_with_status( 'upload-error' );
    }

    $css_dir = trailingslashit( $upload_dir['basedir'] ) . 'custom-css/';

    if ( ! file_exists( $css_dir ) ) {
        wp_mkdir_p( $css_dir );
    }

    if ( ! is_dir( $css_dir ) || ! wp_is_writable( $css_dir ) ) {
        custom_css_editor_redirect_with_status( 'not-writable' );
    }

    $filename = sanitize_file_name( 'custom-css-' . current_time( 'Ymd-His' ) . '.css' );
    $filepath = $css_dir . $filename;

    require_once ABSPATH . 'wp-admin/includes/file.php';
    WP_Filesystem();

    global $wp_filesystem;

    if ( ! $wp_filesystem || ! $wp_filesystem->put_contents( $filepath, $css_code, FS_CHMOD_FILE ) ) {
        custom_css_editor_redirect_with_status( 'save-error' );
    }

    update_option( CUSTOM_CSS_EDITOR_FILE_OPTION, $filename );
    custom_css_editor_keep_latest_files( $css_dir );

    custom_css_editor_redirect_with_status( 'updated' );
}
add_action( 'admin_post_custom_css_editor_save', 'custom_css_editor_save_css' );

/**
 * Enqueue the latest saved CSS file on the front end.
 *
 * @return void
 */
function custom_css_editor_enqueue_latest_css() {
    $filename = get_option( CUSTOM_CSS_EDITOR_FILE_OPTION );

    if ( empty( $filename ) ) {
        return;
    }

    $upload_dir = wp_upload_dir();

    if ( ! empty( $upload_dir['error'] ) ) {
        return;
    }

    $filename  = sanitize_file_name( $filename );
    $file_path = trailingslashit( $upload_dir['basedir'] ) . 'custom-css/' . $filename;
    $file_url  = trailingslashit( $upload_dir['baseurl'] ) . 'custom-css/' . rawurlencode( $filename );

    if ( file_exists( $file_path ) ) {
        wp_enqueue_style(
            'custom-css-editor-public',
            esc_url_raw( $file_url ),
            array(),
            filemtime( $file_path )
        );
    }
}
add_action( 'wp_enqueue_scripts', 'custom_css_editor_enqueue_latest_css' );

/**
 * Keep only the latest saved CSS files.
 *
 * @param string $directory CSS backup directory.
 * @param int    $limit     Maximum number of files to keep.
 * @return void
 */
function custom_css_editor_keep_latest_files( $directory, $limit = 10 ) {
    $files = glob( trailingslashit( $directory ) . '*.css' );

    if ( ! is_array( $files ) || count( $files ) <= $limit ) {
        return;
    }

    usort(
        $files,
        function ( $a, $b ) {
        return filemtime( $b ) - filemtime( $a );
        }
    );

    $old_files = array_slice( $files, $limit );
    foreach ( $old_files as $file ) {
        wp_delete_file( $file );
    }
}

/**
 * Redirect back to the settings page with a status flag.
 *
 * @param string $status Status query value.
 * @return void
 */
function custom_css_editor_redirect_with_status( $status ) {
    wp_safe_redirect(
        add_query_arg(
            array(
                'page'                    => 'custom-css-editor',
                'custom-css-editor-status' => sanitize_key( $status ),
            ),
            admin_url( 'admin.php' )
        )
    );

    exit;
}

 