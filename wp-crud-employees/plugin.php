<?php

/**
* Plugin Name: WP Employees CRUD
* Description: Plugin for Perform Curd Operations
* Version: 1.0
* Author: Rajvinder Singh
*/

if(!defined("ABSPATH")){
    exit; 
}

define("WCE_DIR_PATH", plugin_dir_path(__FILE__));
define("WCE_DIR_URL", plugin_dir_url(__FILE__));

class MyEmployees{
    
    private $wpdb; 
    private $table_name; 
    private $table_prefix; 
    
    public function __construct(){
        global $wpdb; 
        $this->wpdb = $wpdb; 
        $this->table_prefix = $this->wpdb->prefix; 
        $this->table_name = $this->table_prefix."employees_table";
    }
    
    public function createEmployeesTable(){
        
        $table_prefix = $this->wpdb->prefix; 
        
        $createCommand = "CREATE TABLE 
                        `{$this->table_name}` 
                        (`id` int(11) NOT NULL AUTO_INCREMENT, 
                        `name` varchar(50) NOT NULL,
                        `email` varchar(50) DEFAULT NULL,
                        `designation` varchar(50) DEFAULT NULL,
                        PRIMARY KEY (`id`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
        
        require_once (ABSPATH. "/wp-admin/includes/upgrade.php");
        
        dbDelta($createCommand);
    
    }
    
    public function dropEmployeeTable(){
        
        $delete_command = "DROP TABLE IF EXITS {$this->table_name}";
        
        $this->wpdb->query($delete_command); 
        
    }
    
}

$emloyeeObject = new MyEmployees; 

register_activation_hook(__FILE__, [$emloyeeObject, "createEmployeesTable"]);

register_deactivation_hook(__FILE__, );



