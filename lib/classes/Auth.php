<?php
/**
 * Class definition for our authentication and authorization
 * @author Elliott Post
 */

class Auth implements I_Auth {

	public static function startSession() {
		session_start();
	} //startSession

	public static function destroySession() {
		session_destroy();
	} //destroySession

	public static function authenticate( $email, $password ) {
		$_SESSION['email'] = $email;
		$_SESSION['passwordHash'] = md5( $password );
	} //authenticate

	public static function isAuthenticated() {
		if( empty( static::getEmail() ) || empty( static::getPasswordHash() ) )
			return false;
		return true;
	} //isAuthenticated

	public static function getEmail() {
		return isset( $_SESSION['email'] ) ? $_SESSION['email'] : null;
	} //getemail

	public static function getPasswordHash() {
		return isset( $_SESSION['passwordHash'] ) ? $_SESSION['passwordHash'] : null;
	} //getPasswordHash

} //Auth