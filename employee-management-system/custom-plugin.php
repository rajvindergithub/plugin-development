<?php 

/*
 * Plugin Name:       Employee Management System
 * Description:       Employee Management System : Add Remove & Update
 * Author:            Rajvinder Singh
 * Text Domain:       employee-management-system
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'admin_menu', 'cp_add_admin_menu' );


function cp_add_admin_menu(){
    
    
    add_menu_page(
        'Employee System | employee Management system',
        'Employee System',
        'manage_options',
        'employee-system',
        'ems_curd_system',
        'dashicons-admin-home',
        23
    );
    
    add_submenu_page( 'employee-system', 'Add Employee', 'Add Employee', 'manage_options', 'employee-system','ems_add_employee' );
    
     add_submenu_page( 'employee-system', 'List Employee', 'List Employee', 'manage_options', 'ems-list-employee','ems_list_employee' );

}

function ems_curd_system(){
    
}

/* sub menu function */

function ems_add_employee(){
    echo "<h2>Add Employee</h2>"; 
    
}

function ems_list_employee(){
    echo "<h2>List of Employees</h2>"; 
    
}


?>