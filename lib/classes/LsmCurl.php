<?php
/**
 * Instantiates an I_LsmCurl
 * @author Elliott Post
 */

class LsmCurl implements I_LsmCurl {

	private $_ch;
	private $_method;
	private $_url;
	private $_headers;
	private $_parameters;
	private $_responseStatus;
	private $_responseHeaders;
	private $_responseBody;
	private $_rawResponseBody;

	private $_debug;

	/**
	 * Sets up the the instance vars and sets default options for the 
	 */
	public function __construct( $debug = false ) {
		if( !$debug )
			$debug = DEBUG_API_CALLS;
		$this->_debug = $debug;

		//set up default variables
		$this->_headers = array();
		$this->_ch = new \Curl\Curl();

        $this->addHeader( 'Accept', 'application/json' );
        $this->addHeader( 'Content-Type', 'application/json' );

        $this->_parameters = array();

        $this->_url = LSM_API_ENDPOINT;

		$this->_responseStatus = null;
		$this->_responseHeaders = null;
		$this->_responseBody = null;
		$this->_rawResponseBody = null;

	} //constructor

	public function __destruct() {
		$this->_ch->close();
	} //destructor

	public function addHeader( $key, $value ) {
		if( !is_string( $key ) || !is_string( $value ) )
			throw new Exception( "Supplied paramater must be a string." );
		$this->_headers[ $key ] = $value;
	} //addHeader

	public function addParameter( $key, $value ) {
		$this->_parameters[ $key ] = $value;
	} //addParameter

	public function setParameters( $parameters ) {
		$this->_parameters = (array) $parameters;
	} //setParameters	

	public function addBasicAuth( $username, $password ) {
		$this->_ch->setBasicAuthentication( $username, $password );
	} //addBasicAuth

	public function addLsmAuth() {
		$this->addHeader( "email", Auth::getEmail() );
		$this->addHeader( "password", Auth::getPasswordHash() );
	} //addLsmAuth

	public function usePost() {
		$this->_method = "post";
	} //usePost

	public function useGet() {
		$this->_method = "get";
	} //useGet

	public function usePut() {
		$this->_method = "put";
	} //usePut

	public function useDelete() {
		$this->_method = "delete";
	} //useDelete

	public function setEndpoint( $endpoint ) {
		$this->_url = $endpoint;

	} //setEndpoint

	public function sendRequest() {
		$this->addLsmAuth();

		//add the headers
		foreach( $this->_headers as $k => $v )
			$this->_ch->setHeader( $k, $v );
		
		//determine our method and send the request
		switch( $this->_method ):
			case "post":
				$this->_ch->post( $this->_url, $this->_parameters );
				break;

			case "get":
				$this->_ch->get( $this->_url, $this->_parameters );
				break;

			case "put":
				$this->_ch->put( $this->_url, $this->_parameters );
				break;

			case "delete":
				$this->_ch->delete( $this->_url, $this->_parameters );
				break;

		endswitch;
      		
        $this->_responseHeaders = $this->_ch->responseHeaders; 
        $this->_responseStatus = $this->_ch->httpStatusCode;
        $this->_responseBody = $this->_ch->response;
        $this->_rawResponseBody = $this->_ch->rawResponse;

        if( $this->_debug ) {
        	echo "<pre class='debug'><h3>DEBUG - DUMP OF LSM CURL WRAPPER:</h3>" . PHP_EOL;
        	var_dump( $this );
        	echo "</pre>";
        }
	} //sendRequest

	public function getResponseStatus() {
		return $this->_responseStatus;
	} //getResponseStatus

	public function getResponseHeaders() {
		return $this->_responseHeaders;
	} //getResponseHeaders

	public function getResponseContent() {
		return $this->_responseBody;
	} //getResponseContent

	public function getRawResponseContent() {
		return $this->_rawResponseBody;
	} //getRawResponseContent

} //LsmCurl