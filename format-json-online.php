<?php
// format-json-online.php (plugin main file)

defined( 'ABSPATH' ) || exit;

function fjo_register_assets() {
    $ver = '0.1.1';

    // Register and enqueue stylesheet
    wp_register_style(
        'fjo-style',
        plugins_url( 'assets/css/style.css', __FILE__ ),
        array(),
        $ver
    );
    wp_enqueue_style( 'fjo-style' );

    // Register script (in footer)
    wp_register_script(
        'fjo-frontend',
        plugins_url( 'assets/js/frontend.js', __FILE__ ),
        array( 'jquery' ), // dependencies
        $ver,
        true // load in footer
    );
    wp_enqueue_script( 'fjo-frontend' );

    // Pass data from PHP to JS (use instead of inline JSON in template)
    $data = array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'fjo_nonce' ),
    );
    wp_localize_script( 'fjo-frontend', 'fjoData', $data );

    // If you need small inline JS, add it (no <script> tags) attached to handle:
    $inline_js = 'console.log("FJO initialized");';
    wp_add_inline_script( 'fjo-frontend', $inline_js );
}
add_action( 'wp_enqueue_scripts', 'fjo_register_assets' );
