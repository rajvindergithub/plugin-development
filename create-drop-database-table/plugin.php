<?php

/*
* Plugin Name:       WP Table Add and Remover
* Description:       Add or Remover a WP Table created in WP Database
* Version:           1.0
* Author:            Rajvinder Singh
* Text Domain:       wp-table-drop-create
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly
}

class wp_remove_add_table {

    public function __construct() {

        $this->plugin_path = plugin_dir_path( __FILE__ );
        $this->plugin_url  = plugin_dir_url( __FILE__ );

        add_action( 'admin_menu', array( $this, 'main_page_table_add_remover' ) );

        add_action( 'admin_enqueue_scripts', array( $this, 'wp_enqueue_script_ddptable' ) );

    }

    public function wp_enqueue_script_ddptable() {

        wp_enqueue_script(
            'drop-add-db-table-js', $this->plugin_url . 'assets/js/custom.js', array( 'jquery' ),
            '1.0.0', true
        );

        wp_enqueue_style(
            'drop-add-db-table-css',
            $this->plugin_url. 'assets/css/custom.css',
            array(), 'all'
        );
    }

    public function main_page_table_add_remover() {
        add_menu_page(
            'WP Add & Remove Table',
            'WP Add & Remove Table',
            'manage_options',
            'wp-table-add-remover',
            array( $this, 'wp_table_inner_add_remove' ),
            'dashicons-admin-generic',
            20
        );
    }

    public function wp_table_inner_add_remove() {

        global $wpdb;

        if ( isset( $_POST ) && isset( $_POST['create-table-submit'] ) ) {

            $table_name = $_POST['create-tb-name'];

            $successMessage = $this->wp_create_table( $table_name );

        }

        include_once( $this->plugin_path.'pages/drop-add-table.php' );

    }

    public function wp_create_table( $table ) {

        global $wpdb;

        $table_name = $wpdb->prefix.$table;

        $table_exists = $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" );

        if ( $table_exists === $table_name ) {
            
            return "<div class='create_table_message'>Table {$table_name} exists in the database.</div>";
             
            
        } else {

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            // create table
            $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(100) NOT NULL,
            email varchar(100) DEFAULT '' NOT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

            dbDelta( $sql );

            return "<div class='create_table_message'>{$table_name} is created successfully.</div>";

        }

    }

}

new wp_remove_add_table();

?>
