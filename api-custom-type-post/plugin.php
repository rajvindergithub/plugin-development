<?php 

/**
 * Plugin Name:       API Development Custom Post
 * Description:       WordPress Rest API Development for CPT Job Posting
 * Version:           1.0.0
 * Requires PHP:      7.2
 * Author:            Rajvinder Singh
 * Text Domain:       job-listing-cpt
 */

/*API Path*/
/*
http://localhost/plugin-development/wp-json/jobs/v1/all 
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
 
function rs_register_job_api_routes() {

	register_rest_route(
		'jobs/v1',
		'/all',
		array(
			'methods'             => 'GET',
			'callback'            => 'rs_get_all_jobs',
			'permission_callback' => '__return_true',
		)
	);
}

add_action( 'rest_api_init', 'rs_register_job_api_routes' );

function rs_get_all_jobs() {

	$args = array(
		'post_type'      => 'job',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
	);

	$query = new WP_Query( $args );

	$jobs = array();

	if ( $query->have_posts() ) {

		while ( $query->have_posts() ) {

			$query->the_post();

			$post_id = get_the_ID();
            
            	if ( function_exists( 'get_fields' ) ) {
				$acf_fields = get_fields( $post_id );
			}

			$jobs[] = array(
				'id'                => $post_id,
				'title'             => get_the_title(),
				'slug'              => get_post_field( 'post_name', $post_id ),
				'featured_image'    => get_the_post_thumbnail_url( $post_id, 'full' ),
				'date'              => get_the_date( 'Y-m-d H:i:s' ),
				'link'              => get_permalink(),
                'acf_fields'     => $acf_fields,
			);
		}

		wp_reset_postdata();
	}

	return rest_ensure_response(
		array(
			'status' => true,
			'count'  => count( $jobs ),
			'data'   => $jobs,
		)
	);
}




