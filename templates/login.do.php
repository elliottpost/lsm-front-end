<?php
if( !isset( $_POST['email'], $_POST['password'] ) )
    Util::getTemplate( 'login.php' );

Auth::authenticate( $_POST['email'], $_POST['password'] );
header( "Location: " . SITE_ADDR );