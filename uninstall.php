<?php
function phplesson_deactivation() {
    global $wpdb;
    $table = $wpdb->prefix . 'html_sitemap_phplesson';
    //Delete any options that's stored also?
    $option_name = 'html-sitemap-phplesson';
    delete_option($option_name);
    $wpdb->query("DROP TABLE IF EXISTS $table");
}
