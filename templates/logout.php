<?php
/**
 * Logs a user out and sends them to home page
 */

Auth::destroySession();
header( "Location: " . SITE_URI );