<?php
/**
 * Provides basic site utilities not unique to any one particular system
 * @author Elliott Post
 */

abstract class Util implements I_Util {

	/**
	 * Includes the header template
	 */
	public static function getHeader() {
		require_once TEMPLATES_PATH . "header.php";
	} //getHeader

	/**
	 * Includes the footer template
	 */
	public static function getFooter() {
		require_once TEMPLATES_PATH . "footer.php";
	} //getFooter


} //Util