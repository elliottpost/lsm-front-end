<?php
/**
 * Interface definition for our authentication and authorization
 * @author Elliott Post
 */

interface I_Auth {

	/**
	 * Authenticates a user
	 * For this app, it only saves credentials to the SESSION
	 * Doesn't actually authenticate at this level
	 * Because LSM will manage that for us and we're not worrying too much 
	 * about security for this project. 
	 * 
	 * However, Elliott does have extensive knowledge in this area and this 
	 * can be seen in his PHP security module & PHP security report at the link below
	 * If there were more time, Elliott would implement these features within this project also.
	 * @see http://projects.ellytronic.media/homework/comp453/php-password/
	 * @param string $email 	the user email
	 * @param String $password 	the user password (plain text)
	 *
	 */
	public static function authenticate( $email, $password );

	/**
	 * gets the email from SESSION
	 * @return String $username
	 */
	public static function getEmail();

	/**
	 * gets the password hash from SESSION
	 * @return String $hash
	 */
	public static function getPasswordHash();

	/**
	 * Starts a PHP Session
	 */
	public static function startSession();

	/**
	 * Destroys a PHP Session
	 */
	public static function destroySession();	

} //I_Auth