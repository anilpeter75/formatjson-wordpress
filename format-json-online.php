<?php
/**
 * Plugin Name: Format JSON Online
 * Plugin URI: https://github.com/anilpeter75/formatjson-wordpress
 * Description: A simple tool to format and validate JSON online within WordPress admin.
 * Version: 1.0.1
 * Author: Anil Peter
 * Author URI: https://anilpeter75.wordpress.com
 * License: GPL v2 or later
 * Text Domain: format-json-online
 * Domain Path: /languages
 * Requires at least: 5.0
 * Tested up to: 6.6
 * Stable tag: 1.0.1
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Enqueue JS and CSS only on the plugin's admin page
function format_json_enqueue_assets( $hook ) {
    // Adjust hook if your menu slug differs (e.g., 'settings_page_my-slug')
    if ( 'tools_page_format-json-online' !== $hook ) {
        return;
    }

    // Enqueue CSS
    wp_enqueue_style(
        'format-json-css',
        plugin_dir_url( __FILE__ ) . 'css/style.css',
        array(),
        '1.0.1'
    );

    // Enqueue JS (depends on no external libs; add 'jquery' if needed)
    wp_enqueue_script(
        'format-json-js',
        plugin_dir_url( __FILE__ ) . 'js/formatter.js',
        array(),  // Add 'jquery' here if using jQuery
        '1.0.1',
        true     // Load in footer
    );
}
add_action( 'admin_enqueue_scripts', 'format_json_enqueue_assets' );

// Add admin menu page under Tools
function format_json_add_admin_menu() {
    add_management_page(
        'Format JSON Online',  // Page title
        'JSON Formatter',      // Menu title
        'manage_options',      // Capability
        'format-json-online',  // Menu slug
        'format_json_admin_page'  // Callback
    );
}
add_action( 'admin_menu', 'format_json_add_admin_menu' );

// Admin page callback - output the form
function format_json_admin_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <div id="format-json-tool">
            <h2>Paste your JSON below and click Format to beautify/validate it.</h2>
            <textarea id="json-input" placeholder="Enter unformatted JSON here..." rows="10" cols="80"></textarea>
            <br><br>
            <button id="format-json-btn" class="button button-primary">Format JSON</button>
            <button id="clear-json-btn" class="button">Clear</button>
            <br><br>
            <h3>Formatted/Validated JSON:</h3>
            <textarea id="json-output" readonly rows="10" cols="80" placeholder="Output will appear here..."></textarea>
            <p id="json-status" style="color: green;"></p>
        </div>
    </div>
    <?php
}