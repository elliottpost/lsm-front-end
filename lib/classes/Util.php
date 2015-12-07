<?php
/**
 * Provides basic site utilities not unique to any one particular system
 * @author Elliott Post
 */

abstract class Util implements I_Util {

	public static function getTemplate( $filename, $path = null ) {
		if( !$path )
			$path = TEMPLATES_PATH;
		if( !file_exists( $path . $filename ) )
			require TEMPLATES_PATH . "404.php";
		else
			require $path . $filename;
	} //getTemplate

	public static function getHeader() {
		static::getTemplate( "header.php" );
	} //getHeader

	public static function getFooter() {
		static::getTemplate( "footer.php" );
	} //getFooter

} //Util