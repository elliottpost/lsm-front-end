<?php
/**
 * Interface definition for our LSM cURL class
 * @author Elliott Post
 */

interface I_LsmCurl {

	/**
	 * Adds a header to this curl request
	 * @param String $header 	the header string, eg: Accept: application/json
	 * @throws Exception $e 	if header is not a string
	 */
	public function addHeader( $header );

	/**
	 * Removes all headers, including defaults
	 */
	public function clearHeaders();

	/**
	 * Adds a parameter to this curl request
	 * @todo
	 */
	public function addParameter();

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
	 * Returns the message (body) from the response
	 * @return String $message 		the response body
	 */
	public function getResponseContent();

} //I_LsmCurl