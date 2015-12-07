<?php
/**
 * Interface definition for our LSM cURL class
 * @author Elliott Post
 */

interface I_LsmCurl {

	/**
	 * Adds a header to this curl request
	 * @param String $key 		the header key, eg: "Content-Type"
	 * @param String $value 	the header value, eg: "application/XML";
	 * @throws Exception $e 	if either header key or value are not strings
	 */
	public function addHeader( $key, $value );

	/**
	 * Adds a parameter to this curl request
	 * @param String $key 		the key
	 * @param String $value 	the key's value
	 */
	public function addParameter( $key, $value );

	/**
	 * Overwrites existing parameters and sets the passed array (or object) as
	 * the new parameters
	 * @param array/object $parameters 	an associative array or object
	 */
	public function setParameters( $parameters );

	/**
	 * Adds basic auth to the request
	 * @param String $username 	the username
	 * @param String $password 	the password
	 */
	public function addBasicAuth( $username, $password );

	/**
	 * Adds LSM Authorization from the current session
	 * @uses Auth::getEmail()
	 * @uses Auth::getPasswordHash()
	 */
	public function addLsmAuth();	

	/**
	 * Sets the curl request to use POST
	 */
	public function usePost();

	/**
	 * Sets the curl request to use GET
	 */
	public function useGet();

	/**
	 * Sets the curl request to use PUT
	 */
	public function usePut();

	/**
	 * Sets the curl request to use DELETE
	 */
	public function useDelete();

	/**
	 * Sets the endpoint
	 * @param String $endpoint 		the url to send request to
	 */
	public function setEndpoint( $endpoint );

	/**
	 * Sends the curl request 
	 * @throws Exception if build is not ready
	 */
	public function sendRequest();

	/**
	 * Returns the status code from the response
	 * @return int $status 		200, 403, 404, 500, etc.
	 */
	public function getResponseStatus();

	/**
	 * Returns the headers from the response
	 * @return String $headers 		the response headers
	 */
	public function getResponseHeaders() ;

	/**
	 * Returns the message (body) from the response
	 * @return mixed $message 		the response body, parsed into PHP array/objects
	 */
	public function getResponseContent();

	/**
	 * Returns the raw response (before our intermediary wrapper parses it into PHP objects)
	 * @return String $rawMessage 		the response body as received from the API
	 */
	public function getRawResponseContent();

} //I_LsmCurl