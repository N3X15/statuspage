<?php
include ('../includes/base.inc.php');
$auth = new Authentication;

$error = '';
if (isset($_POST['username'], $_POST['password'])) {
	$login = $auth->login($_POST['username'], $_POST['password']);

	if ($login) {
		header('Location: index.php');
	} else {
		$error = 'Invalid username or password';
	}
}
$tpl->assign('error', $error);

$tpl->display('_header.tpl.php');
$tpl->display('login.tpl.php');
$tpl->display('_footer.tpl.php');
?>
