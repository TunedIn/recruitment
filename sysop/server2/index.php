<?php
/**
 * This file should be deployed at server2.
 *
 * Opening this file via browser should result in working web page, without any errors or notices.
 *
 * jobs@tunedin.de
 *
 * (C) TunedIn Media GmbH, 2013
 * http://www.tunedin.de/
 */

/**
 * Step 1: initialization. Check dependencies etc.
 */

// make sure error reporting is enabled
error_reporting(E_ALL);
ini_set("display_errors", 1);

// check if PHP is at right version
if  (version_compare(PHP_VERSION, '5.4.0') < 0) {
    die("PHP version should be at least 5.4.0 (using ".PHP_VERSION.")");
}


/**
 * Step 2: Do some random stuff :)
 */

$phpVersion = PHP_VERSION;
$ip = $_SERVER["REMOTE_ADDR"];

/**
 * Step 3: Display random stuff to user
 */
echo <<<EOF
<pre>
<h1>Welcome on Server2!</h1>
My PHP version is:      $phpVersion
Your IP is:             $ip

===============================================
(C) TunedIn Media GmbH, 2013
http://www.tunedin.de/
</pre>
EOF;


// go to ashes
exit;