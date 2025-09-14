<?php

/*
* Plugin Name:       WP API for CRUD
* Description:       Plugin enables APIs endpoints to perform CRUD operation with Database
* Version:           1.0
* Author:            Rajvinder Singh
* Text Domain:       wp-api-for-crud
*/

if ( !defined( "WPINC" ) ) {
    exit;
}

add_action( "rest_api_init", "wpc_handle_api_request" );

register_activation_hook( __FILE__, "wcp_create_students_table" );

function wcp_create_students_table() {

    global $wpdb;

    $table_name = $wpdb->prefix."tbl_students_list";

    $collate = $wpdb->get_charset_collate();

    $student_table = "CREATE TABLE `{$table_name}` (
                          `id` int(20) NOT NULL AUTO_INCREMENT,
                          `name` varchar(100) DEFAULT NULL,
                          `email` varchar(50) DEFAULT NULL,
                          `mobile` varchar(50) DEFAULT NULL,
                          `status` int(11) NOT NULL DEFAULT 1,
                          `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                          PRIMARY KEY (`id`)
                        ) {$collate}";

    include_once ABSPATH . "wp-admin/includes/upgrade.php";

    dbDelta( $student_table );

}

function wpc_handle_api_request() {

    register_rest_route( "students/v1", "students", array(
        "methods" => "GET",
        "callback" => "wp_handle_get_students_routes"
    ) );

    register_rest_route( "students/v1", "add-student", array(
        "methods" => "POST",
        "callback" => "wp_handle_add_student_routes",
        "args" => [

            "name" => [
                "type" => "string",
                "required" => true
            ],
            "email" => [
                "type" => "string",
                "required" => true
            ],
            "mobile" => [
                "type" => "string",
                "required" => false
            ]

        ]
    ) );

    register_rest_route( "students/v1", "update/(?P<id>\d+)", array(
        "methods" => "PUT",
        "callback" => "wcp_handle_update_student",
        "args" => [

            "name" => [
                "type" => "string",
                "required" => true
            ],
            "email" => [
                "type" => "string",
                "required" => true
            ],
            "mobile" => [
                "type" => "string",
                "required" => false
            ]

        ]

    ) );
    
    
    register_rest_route("students/v1", "delete", array(
        "methods" => "DELETE", 
        "callback" => "wp_handle_delete_student"
    ));

}

function wp_handle_get_students_routes() {

    global $wpdb;

    $table_name = $wpdb->prefix."tbl_students_list";

    $students = $wpdb->get_results( "Select * from {$table_name}", ARRAY_A );

    return rest_ensure_response(
        [
            "status" => true,
            "message" => "Student Data",
            "data" => $students
        ]
    );

}

function wp_handle_add_student_routes( $request ) {

    global $wpdb;

    $table_name = $wpdb->prefix."tbl_students_list";

    $name = $request->get_param( "name" );
    $email = $request->get_param( "email" );
    $phone = $request->get_param( "phone" );

    $wpdb->insert( $table_name, array(
        "name" => $name,
        "email" => $email,
        "mobile" => $phone,
    ) );

    if ( $wpdb->insert_id > 0 ) {

        return rest_ensure_response(
            [
                "status" => true,
                "message" => "Add Student successfully",
                "data" => $request->get_params()

            ]
        );

    } else {
        return rest_ensure_response(
            [
                "status" => false,
                "message" => "Falied to crete student record",
                "data" => $request->get_params()

            ]
        );

    }

}

function wcp_handle_update_student( $request ) {

    global $wpdb;

    $table_name = $wpdb->prefix."tbl_students_list";

    $name = $request->get_param( "name" );
    $email = $request->get_param( "email" );
    $phone = $request->get_param( "mobile" );

    $id = $request->get_param( "id" );

    $student_updated = $wpdb->get_row(
        "SELECT * FROM {$table_name} WHERE id = {$id}"
    );

    if ( !empty( $student_updated ) ) {

        $wpdb->update( $table_name, [

            "name" => $name,
            "email" => $email

        ], [
            'id' => $id    
        ]
        );

        return rest_ensure_response(
            [
                "status" => true,
                "message" => "Update Student Record",
                "data" => $request->get_params(),

            ]
        );

    } else {

        return rest_ensure_response(
            [
                "status" => false,
                "message" => "Student Not Found, Record Not Updated",

            ]
        );

    }

}

function wp_handle_delete_student($request){
    
    $id = $request->get_param("id");
    
    global $wpdb;

    $table_name = $wpdb->prefix."tbl_students_list";

    $select_row = $wpdb->get_row(
        "SELECT * FROM {$table_name} WHERE id = {$id}"
    );
    
//    print_r($select_row);
    
    if(!empty($select_row)){
        
        $wpdb->delete($table_name, [
            
            'id' => $id
            
        ]);
        
            
          return rest_ensure_response(
            [
                "status" => true,
                "message" => "Student Deleted Sucessfully",

            ]
        );
        
    }else{
        
          return rest_ensure_response(
            [
                "status" => false,
                "message" => "Student not deleted, not exits",

            ]
        );
        
    }
    
}

?>