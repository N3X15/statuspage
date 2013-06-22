<?php
require_once ('Savant3.php');
$tpl = new Savant3();
$tpl -> addPath('template', "{$config['app_path']}/templates/");

// Some default things
if (!isset($config['pagetitle']))
	$config['pagetitle'] = 'Network Status';
if (!isset($config['footer_links']))
	$config['footer_links'] = null;
if (!isset($config['textarea']))
	$config['textarea'] = null;
$tpl -> assign('pagetitle', $config['pagetitle']);
$tpl -> assign('footer_links', $config['footer_links']);
$tpl -> assign('textarea', $config['textarea']);

if ($config['smarty_debug'])
	$tpl -> debugging = true;
