<?php
	include('../includes/base.inc.php');
	include('../includes/authentication.class.php');
	$auth = new Authentication;

	if (isset($_POST['username'], $_POST['password'])) {
		$login = $auth->login($_POST['username'], $_POST['password']);

		if ($login) header('Location: index.php');
		$tpl->assign('error', 'Invalid username or password');
	}

	$tpl->display('_header.tpl.php');
	$tpl->display('login.tpl.php');
	$tpl->display('_footer.tpl.php');
?>
