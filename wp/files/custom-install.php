<?php
require_once( dirname( __FILE__ ) . '/wp-load.php' );
require_once( ABSPATH . WPINC . '/class-phpass.php' );
$wp_hasher = new PasswordHash( 8, true );
echo $wp_hasher->HashPassword('$WPPASS');
?>