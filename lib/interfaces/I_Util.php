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


} //I_Util