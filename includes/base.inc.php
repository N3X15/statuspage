<?php

if(!file_exists('config.php'))
{
	die('Please configure by renaming includes/config.php.dist to config.php, and then editing the resulting file.');
}
include('config.php');

session_start();

require_once('database.class.php');
$db_conn = new Database($config['db_path']);
$db = $db_conn->sqlite;

require_once('template.inc.php');
require_once('status.class.php');
require_once('facilities.class.php');

?>
