<?php
/**
 * Plugin Name: Format JSON Online
 * Plugin URI: https://www.formatjsononline.com/
 * Description: A simple plugin that lets you format and validate JSON directly inside WordPress. Links out to the full tool at FormatJSONOnline.com.
 * Version: 1.0
 * Author: Anil Peter
 * Author URI: https://anilpeter.vercel.app
 * License: GPL2
 */

// Hook into WP Admin Menu
add_action('admin_menu', 'fjo_add_admin_menu');

function fjo_add_admin_menu() {
    add_menu_page(
        'Format JSON Online',
        'JSON Formatter',
        'manage_options',
        'format-json-online',
        'fjo_admin_page',
        'dashicons-editor-code'
    );
}

function fjo_admin_page() {
    ?>
    <div class="wrap">
        <h1>Format JSON Online</h1>
        <p>Paste your JSON below to format it. For advanced features, visit <a href="https://formatjsononline.com" target="_blank">Format JSON Online</a>.</p>
        
        <textarea id="json-input" style="width:100%; height:200px;"></textarea>
        <br><br>
        <button onclick="formatJson()">Format JSON</button>
        <br><br>
        <pre id="json-output" style="background:#f5f5f5; padding:10px;"></pre>
        
        <script>
            function formatJson() {
                try {
                    const input = document.getElementById("json-input").value;
                    const obj = JSON.parse(input);
                    document.getElementById("json-output").textContent = JSON.stringify(obj, null, 2);
                } catch (e) {
                    document.getElementById("json-output").textContent = "Invalid JSON!";
                }
            }
        </script>
    </div>
    <?php
}
?>
