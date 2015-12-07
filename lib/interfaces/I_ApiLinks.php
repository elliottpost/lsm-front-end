<?php
/**
 * Works with HATEOAS links from the API
 * @author Elliott Post
 */

interface I_ApiLinks {

	/**
	 * Takes the HATEOAS link array and converts it into 
	 * link buttons
	 * @param String[] &$response 	the cURL response object
	 */
	public static function linksToHtml( &$response );

	/**
	 * Encodes a HATEOAS link in base64 & url encoded
	 * @param String $link 			the HATEOAS link to encode
	 * @return String $encodedLink	the encoded HATEOAS link
	 */
	public static function encodeHateoasLink( $link );

	/**
	 * Decodes an encoded HATEOAS link in base64 & url encoded
	 * @param String $encodedlink	the HATEOAS link to decode
	 * @return String $link			the original HATEOAS link
	 */
	public static function decodeHateoasLink( $link );	

} //ApiLinks