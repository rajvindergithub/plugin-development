<?php 

/*
 * Plugin Name:       Research Article
 * Description:       Registers a custom post type called Research Article.
 * Version:           1.0.0
 * Author:            Rajvinder Singh
 * Author URI:        https://portfolio.myfreeonlinetools.com/
 * Text Domain:       gated-research
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}





// register research article post type 
function ra_register_cpt() {
    register_post_type('research_article', [
        'label' => 'Research Articles',
        'public' => true,
        'show_in_rest' => true,
        'supports' => ['title','editor']
    ]);
}
add_action('init','ra_register_cpt');


//restriction 
add_action('template_redirect', function() {
    if ( is_singular('research_article') && !is_user_logged_in() ) {
        
        $login_url = wp_login_url( get_permalink() );

        wp_die(
            '<p>You must be logged in to view this <b>research article. </b></p>
             <p><a href="'. esc_url($login_url) .'">Click here to login</a></p>
             <script>
                 setTimeout(function(){
                     window.location.href = "'. esc_url($login_url) .'";
                 }, 1500);
             </script>',
            'Access Restricted',
            [ 'response' => 403 ]
        );
    }
});
  

// active hook
register_activation_hook(__FILE__, function(){
    ra_register_cpt();
    flush_rewrite_rules();
    
        for($i=1;$i<=10;$i++){
        wp_insert_post([
            'post_title'   => "Sample Research Article $i",
            'post_content' => "This is demo content for Research Article $i.",
            'post_type'    => 'research_article',
            'post_status'  => 'publish'
        ]);
    }
    
});


// active de-active hook
register_deactivation_hook(__FILE__, 'flush_rewrite_rules');

 
// rest api 
add_action( 'rest_api_init', function () {
    register_rest_route( 'eg/v1', '/articles/(?P<id>\d+)', array(
        'methods'             => 'GET',
        'callback'            => 'get_research_article_by_id',
        'permission_callback' => '__return_true',
    ));
});

function get_research_article_by_id( $request ) {
    
    $post_id = (int) $request['id'];
    $post    = get_post( $post_id );
    
     if ( empty( $post ) || $post->post_type !== 'research_article' ) {
        return new WP_Error( 'no_article', 'Invalid article ID or article not found', array( 'status' => 404 ) );
    }

    return array(
//          'id'      => $post->ID,
//          'title'   => esc_html(get_the_title( $post )),
            'summary' => esc_html($post->post_content),
//          'link'    => esc_url(get_permalink( $post )),
    );
    
    
//result url
//http://localhost/plugin-development/wp-json/eg/v1/articles/193
//http://localhost/plugin-development/wp-json/eg/v1/articles/194    
    
}



?>
