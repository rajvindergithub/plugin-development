<?php

function recent_five_post() {

    $arg = array(
        "post_tech" => 5,
        "post_status" => "publish"
    );

    $recent_post = wp_get_recent_posts( $arg );

    $output = '<ul>';

    foreach ( $recent_post  as $post ) {

        $output .= '<li>'. esc_html( $post['post_title'] ) .'</li>';

    }

    $output .= '</ul>';

    return $output;

}

add_shortcode( 'get_recent_five_post_wp', 'recent_five_post' );

?>

<?php

// Redirect users who are not logged in away from the "Dashboard" page.

function restrict_dashboard_page_access() {

    if ( is_page( 'dashboard' ) && !is_user_logged_in() ) {

        wp_redirect( home_url() ); 
        
        exit(); 
        
    }

}

add_action( 'template_redirect', 'restrict_dashboard_page_access' );

?>

