<?php
// Copyright SQCRM. For licensing, reuse, modification and distribution see license.txt
/**
* MySQL Main configuration page
* Include that file in all the files that will uses PAS objects.
*/

if (isset($GLOBALS['cfg_full_path'])) {
	set_include_path(get_include_path() . PATH_SEPARATOR . $GLOBALS['cfg_full_path']);
	$cfg_project_directory = $GLOBALS['cfg_full_path'];
} else {
	$cfg_project_directory = dirname(__FILE__).'/';
}
$cfg_local_db = 'mysql';
$GLOBALS['cfg_local_db'] = 'mysql';
$cfg_eventcontroler = 'eventcontroler.php';
define("RADRIA_EVENT_CONTROLER", $cfg_eventcontroler);

$cfg_lang = 'us';
// diseable secure events, will show all the parameters of forms and links.
define("RADRIA_EVENT_SECURE", false);
define("RADRIA_LOCAL_DB", $cfg_local_db);

// Change this key. This is the key that authorized event execution coming from not local domain.
$cfg_notrefererequestkey = "XX5X5XC7C5CFF7FC7C65FCD7FGGFD7FR22462" ;

//Radria anonymous usage statistics:
$cfg_radria_stat_usage = true;

// load the env variables for the application
require_once(dirname(__FILE__).'/class/phpdotenv/vendor/autoload.php');
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

if (getenv('DISPLAY_ERRORS') == '1') {
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
}

if (isset($GLOBALS['cfg_full_path'])) {
	if (file_exists($GLOBALS['cfg_full_path'].'includes/extraconfig.inc.php')) {
		include_once($GLOBALS['cfg_full_path'].'includes/extraconfig.inc.php');
	}
} else {
	if (file_exists(dirname(__FILE__).'/includes/extraconfig.inc.php')) {
		include_once(dirname(__FILE__).'/includes/extraconfig.inc.php');
	}
}

$cfg_web_path =  dirname($_SERVER['PHP_SELF']);
if(!preg_match("/\/$/",$cfg_web_path)){
	$cfg_web_path .= "/";
}
session_set_cookie_params(0, $cfg_web_path);
session_start() ;

// include the DB connection file
include_once('dbconn.php');

include(dirname(__FILE__)."/includes/globalvar.inc.php") ;

if (file_exists(dirname(__FILE__)."/includes/extraconfig_postdb.inc.php")) {
	include_once(dirname(__FILE__)."/includes/extraconfig_postdb.inc.php") ;
};
?>