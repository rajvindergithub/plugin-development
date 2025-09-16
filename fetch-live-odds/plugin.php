<?php
/**
 * Plugin Name:       Fetch Live Odds
 * Description:       Fetch and display live odds from bookmakers by scraping the given URL.
 * Version:           1.1
 * Author:            Rajvinder Singh
 * Text Domain:       fetch-live-odds
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Prevent direct access.
}

class Fetch_Live_Odds {

    /**
     * @var array CSS classes to scrape.
     */
    private $target_classes = ['card__item'];

    /**
     * @var int Limit number of results.
     */
    private $limit = 10;

    /**
     * Constructor: Hook into WordPress.
     */
    public function __construct() {
        add_shortcode( 'fetch_odds_live', [ $this, 'shortcode_callback' ] );
    }

    /**
     * Shortcode callback.
     * Usage: [fetch_odds_live url="https://example.com"]
     */
    public function shortcode_callback( $atts ) {
        $atts = shortcode_atts(
            [
                'url' => '',
            ],
            $atts,
            'fetch_odds_live'
        );

        if ( empty( $atts['url'] ) ) {
            return '<p style="color:red;">No URL provided.</p>';
        }

        $results = $this->fetch_data( esc_url_raw( $atts['url'] ) );

        if ( is_wp_error( $results ) ) {
            return '<p style="color:red;">Error: ' . esc_html( $results->get_error_message() ) . '</p>';
        }

        if ( empty( $results ) ) {
            return '<p style="color:red;">No data found.</p>';
        }

        // Display results as HTML list
        $output  = '<div class="fetch-live-odds">';
        $output .= '<ul>';
        foreach ( $results as $row ) {
            $output .= '<li>' . esc_html( implode( ' ', $row ) ) . '</li>';
        }
        $output .= '</ul>';
        $output .= '</div>';

        return $output;
    }

    /**
     * Fetch and scrape data from URL.
     *
     * @param string $url
     * @return array|WP_Error
     */
    private function fetch_data( $url ) {
        $response = wp_remote_get(
            $url,
            [
                'timeout' => 100,
                'headers' => [ 'User-Agent' => 'WordPress Fetch Live Odds' ],
            ]
        );

        if ( is_wp_error( $response ) ) {
            return $response;
        }

        $body = wp_remote_retrieve_body( $response );
        if ( empty( $body ) ) {
            return [];
        }

        libxml_use_internal_errors( true );
        $dom = new DOMDocument();
        $dom->loadHTML( $body );
        libxml_clear_errors();

        $xpath = new DOMXPath( $dom );

        // Build XPath query for all target classes
        $conditions = [];
        foreach ( $this->target_classes as $class ) {
            $conditions[] = "contains(concat(' ', normalize-space(@class), ' '), ' {$class} ')";
        }
        $query = '//*[' . implode( ' or ', $conditions ) . ']';

        $nodes = $xpath->query( $query );

        $data  = [];
        $count = 0;

        foreach ( $nodes as $node ) {
            if ( $count >= $this->limit ) {
                break;
            }
            // Clean up spaces and split into array
            $text      = preg_replace( '/\s+/', ' ', trim( $node->textContent ) );
            $data[]    = explode( ' ', $text );
            $count++;
        }

        return $data;
    }
}

// Initialize plugin
new Fetch_Live_Odds();
