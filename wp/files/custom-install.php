<?php
$wppass = $argv[1];
require(  dirname( __FILE__ ). '/wp-includes/class-phpass.php' );
$wp_hasher = new PasswordHash( 8, true );
echo $wp_hasher->HashPassword($wppass);
?>