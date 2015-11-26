<?php
/**
 * Instantiates an I_LsmCurl
 * @author Elliott Post
 */

class LsmCurl implements I_LsmCurl {

	private $_ch;
	private $_url;
	private $_headers;
	private $_responseStatus;
	private $_responseBody;

	private $_debug;

	/**
	 * Sets up the the instance vars and sets default options for the 
	 */
	public function __construct( $debug = false ) {
		$this->_debug = $debug;

		//set up default variables
		$this->_headers = array();
		$this->_ch = curl_init();

        $this->_headers[] = 'Accept: application/json';
        $this->_headers[] = 'Content-Type: application/json';

        $this->_url = LSM_API_ENDPOINT;

		$this->_responseStatus = null;
		$this->_responseBody = null;

        //set default method
        curl_setopt( $this->_ch, CURLOPT_HTTPGET, true );		

	} //constructor

	public function __destruct() {
		//close the curl connection, if active
		@curl_close( $this->_ch );
	} //destructor

	public function addHeader( $header ) {
		if( !is_string( $header ) )
			throw new Exception( "Supplied paramater must be a string." );
		$this->_headers[] = $header;
	} //addHeader

	public function clearHeaders() {
		$this->_headers = array();
	} //clearHeaders

	public function addParameter() {
		//@todo
	} //addParameter

	public function usePost() {
		curl_reset( $this->_ch );
        curl_setopt( $this->_ch, CURLOPT_POST, true );
	} //usePost

	public function useGet() {
		curl_reset( $this->_ch );
        curl_setopt( $this->_ch, CURLOPT_HTTPGET, true );
	} //useGet

	public function usePut() {
		curl_reset( $this->_ch );
		curl_setopt( $this->_ch, CURLOPT_CUSTOMREQUEST, 'PUT');
	} //usePut

	public function useDelete() {
		curl_reset( $this->_ch );
		curl_setopt( $this->_ch, CURLOPT_CUSTOMREQUEST, 'DELETE' );
	} //useDelete

	public function setEndpoint( $endpoint ) {
		$this->_url = $endpoint;

	} //setEndpoint

	public function sendRequest() {
		curl_setopt( $this->_ch, CURLOPT_HTTPHEADER, $this->_headers );
		curl_setopt( $this->_ch, CURLOPT_URL, $this->_url );

        ob_start();
        curl_exec( $this->_ch );
        $this->_responseStatus = curl_getinfo( $this->_ch, CURLINFO_HTTP_CODE );
        $this->_responseBody = ob_get_clean();

        if( $this->_debug ) {
        	echo "<p class='debug'><pre>DEBUG" . PHP_EOL;
        	var_dump( $this );
        	echo "</pre></p>";
        }
	} //sendRequest

	public function getResponseStatus() {
		return $this->_responseStatus;
	} //getResponseStatus

	public function getResponseContent() {
		return $this->_responseBody;
	} //getResponseContent

} //LsmCurl