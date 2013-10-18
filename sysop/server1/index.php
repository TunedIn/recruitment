<?php
/**
 * This file should be deployed at server1.
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

// check if Phalcon is loaded
if (!extension_loaded("phalcon")) {
    die("PHP extension Phalcon should be loaded. <a href='http://phalconphp.com/en/download'>Get Phalcon</a>.");
}

// check if Phalcon is at right version
if  (version_compare(\Phalcon\Version::get(), '1.2.4 RC 2') < 0) {
    die("Phalcon version should be at least 1.2.4 RC 2 (using ".\Phalcon\Version::get().")");
}

if (!defined('PDO::ATTR_DRIVER_NAME')) {
   die("PDO driver should be loaded. <a href='http://www.php.net/manual/de/pdo.installation.php'>More info</a>");
}


/**
 * Step 2: Do some random stuff :)
 */

// load config
$config = new Phalcon\Config\Adapter\Ini("config.ini");


// required by PHP when handling dates
date_default_timezone_set($config->environment->timezone);

// establish MySQL connection
$connection = new Phalcon\Db\Adapter\Pdo\Mysql(array(
    'host' =>       $config->database->host,
    'username' =>   $config->database->username,
    'password' =>   $config->database->password
));


// get the mysql server time
$result = $connection->query("SELECT UNIX_TIMESTAMP()");
$result->setFetchMode(Phalcon\Db::FETCH_NUM);
$time = $result->fetch();

// transform it into user-readable value
$date= date("d.m.Y H:i:s", $time[0]);


// initialize security, generate hashes
$security = new \Phalcon\Security();
$secretHash = $security->hash($config->secret->password);
$requestPassword = empty($_GET["password"])?null:$_GET["password"];

// does it match?
$matches = $security->checkHash($requestPassword, $secretHash)?"YES":"NO";


/**
 * Step 3: Display random stuff to user
 */
echo <<<EOF
<pre>
<h1>Welcome on Server1!</h1>
Secret hash:                $secretHash
Your password:              $requestPassword


Your password matches:      <b>$matches</b>


<small>Secret hint: try <a href="?password=TunedIN-secondscreen-tv">this</a>.</small>

===============================================
Berlin, $date
(C) TunedIn Media GmbH, 2013
http://www.tunedin.de/
</pre>
EOF;


// go to ashes
exit;