<?php
Auth::destroySession();
header( "Location: " . SITE_ADDR );