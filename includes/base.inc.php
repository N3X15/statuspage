<?php
$cfgFile = dirname(__FILE__) . '/config.php';
if (!file_exists($cfgFile)) {
	die('Please configure by renaming ' . $cfgFile . '.dist to config.php, and then editing the resulting file.');
}
include ('config.php');

session_start();

require_once ('database.class.php');
$db_conn = new Database($config['db_path']);
$db = $db_conn->sqlite;

require_once ('template.inc.php');
require_once ('status.class.php');
require_once ('facilities.class.php');
require_once ('authentication.class.php');

// Helper function, since we're apparently so fond of using indices that may or may not be present.
function getFromArray($arr, $idx, $default = '')
{
	if (!array_key_exists($idx, $arr))
		return $default;
	return $arr[$idx];
}
