<?php
define( 'WP_INSTALLING', true );
 
/** Load WordPress Bootstrap */
require_once( dirname( __FILE__ ) . '/wp-load.php' );
 
/** Load WordPress Administration Upgrade API */
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
 
/** Load WordPress Translation Install API */
require_once( ABSPATH . 'wp-admin/includes/translation-install.php' );
 
/** Load wpdb */
require_once( ABSPATH . WPINC . '/wp-db.php' );
 
define('WP_SITEURL', 'http://localhost/wordpress');
$weblog_title = '$domain';
$user_name = '$domain';
$admin_email = 'info@aiyongtech.com';
$public = 1;
$admin_password = '$domain'; // in plain text
$loaded_language = '';
$result = wp_install($weblog_title, $user_name, $admin_email, $public, '', wp_slash( $admin_password ), $loaded_language);
?>