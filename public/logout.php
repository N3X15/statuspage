<?php
	include('../includes/base.inc.php');
	$auth = new Authentication;

	$auth->logout();
	header('Location: index.php');
?>
