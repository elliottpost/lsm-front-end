<?php
/**
 * Interface definition for our utilities
 * @author Elliott Post
 */

interface I_Util {

	/**
	 * Requires a template
	 * @param String $filename 		the filename of the template, including extension
	 * @param [String $path 		the path to the template]
	 */
	public static function getTemplate( $filename, $path = null );

	/**
	 * Includes the header template
	 */
	public static function getHeader();

	/**
	 * Includes the footer template
	 */
	public static function getFooter();

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

} //I_Util