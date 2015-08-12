<?php

/**
 * Plugin Name: html-sitemap-phplesson
 * Plugin URI: http://phplesson.com/wp-plugins
 * Description: html-sitemap-phplesson (HSP) plugin generate dynamically html sitemap for your WordPress website. You can hide single page,post, category, tag from your website using HSP plugin.
 * Version: 1.0 
 * Author: Rohit Gilbile
 * Author URI: http://rohitgilbile.com
 * License: A "Slug" license name e.g. GPL12
 */
global $wpdb;

register_activation_hook(__FILE__, 'phplesson_install');
register_deactivation_hook(__FILE__, 'phplesson_deactivation');
add_action('admin_menu', 'Sitemap_menu');
add_action('admin_enqueue_scripts', 'my_enqueue');
require_once 'functions.php';
require_once 'uninstall.php';
require_once 'script.php';
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
global $phplesson_db_version;
$phplesson_db_version = '1.0';
define('SITEMAP_TABLE', $wpdb->prefix . 'html_sitemap_phplesson');

function phplesson_install() {
    global $wpdb;
    global $phplesson_db_version;
    $table = SITEMAP_TABLE;
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table(
sitemap_id mediumint(9) NOT NULL AUTO_INCREMENT,
sitemap_category varchar(250),
sitemap_post varchar(250),
sitemap_pages varchar(250),
UNIQUE KEY sitemap_id (sitemap_id)
) $charset_collate;";
    dbDelta($sql);
    $sql = "insert into " . SITEMAP_TABLE . "(sitemap_category,sitemap_post,sitemap_pages) values('','','')";
    $wpdb->query($sql);
}
