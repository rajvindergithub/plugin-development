<?php

/*
* Plugin Name:       WP Table Add and Remover
* Description:       Add or Remover a WP Table created in WP Database
* Version:           1.0
* Author:            Rajvinder Singh
* Text Domain:       wp-table-drop-create
*/
  


add_action('admin_menu', 'tdcb_create_admin_menu');

function tdcb_create_admin_menu(){
    
    add_menu_page("CSV Data Backup Plugin", 'CSV Data Backup', "manage_options", 'csv-data-backup', "tdb_export_form_data", "dashicons-database-export", 8 );
    
}

function tdb_export_form_data(){
    
    ob_start(); 
    
        include_once plugin_dir_path(). "/template/table_data_backup.php"; 

            $layout = ob_get_contents(); 

        ob_end_clean(); 
    
    echo $layout; 
    
}


add_action("admin_init", "tdcb_handle_form_export");


function tdcb_handle_form_export(){
    
    if(isset($_POST['tdb_export_form_data'])){
        
        global $wpdb; 
        
            $table_name = $wpdb->prefix . "students_data"; 
        
            $students = $wpdb->get_results(
                "SELECT * FROM {$table_name}", ARRAY_A
            ); 

            if(empty($students)){
                echo "No Data in require table"; 
            }
        
        $filename = "data_csv_".time().".csv"; 
        
            header("Content-Type: text/csv; charset=utf-8;");
            header("Content-Dispositions: attachment; filename=".$filename);
        
            $output = fopen("php://output", "w");
        
        // get the table column name 
        
        fputcsv($output, array_keys($students[0])); 
        
            foreach($students as $student){
                fputcsv($output, $student); 
            }
        
        fclose($output);
        
        exit; 
        
    }
    
}