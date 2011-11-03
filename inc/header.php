<?php
	require("db.php");
	require("function.php");
	$system = new system();
	$secure = new secure();
	$user = new user();
	include("config.php");
	$db = new db();
	$db->connect($dbhost, $dbuser, $dbpassword, $dbmaster);
	session_name($system->confdata('session'));
	session_start();
	date_default_timezone_set('UTC');
	if (!isset($_SESSION['email'])) {
		$email = '';
	} else {
		$email = $_SESSION['email'];
	}
	if (!isset($_SESSION['lpip'])) {
		$lpip = '';
	} else {
		$lpip = $_SESSION['lpip'];
	}
	$account = $db->fetch("SELECT * FROM accounts WHERE email = '$email' AND lpip = '$lpip'");
	$url = $system->confdata('url');
	$path = $system->confdata('path');
	if ($path) {
		$siteaddress = "$url/$path/";
	} else {
		$siteaddress = "$url/";
	}
	$document_root = $_SERVER['DOCUMENT_ROOT'];
	$root = "$document_root/$path";
	$session_location = $_SERVER['REQUEST_URI'];
	$session_id = session_id();
	$ip = $_SERVER['REMOTE_ADDR'];
	if ($account['id']) {
		$id = $account['id'];
	} else {
		$id = '-1';
	}
	$db->query("DELETE FROM online WHERE session= '$session_id';");
	$db->query("INSERT INTO online ( time, account_id , session , ip , location ) VALUES  (unix_timestamp(), '$id' , '$session_id' , '$ip','$session_location' );");
	$db->query("DELETE FROM online WHERE time < unix_timestamp()-90;");
	if ($account['tpl'] && $system->confdata('usertemplate') == '1') {
		$template = $account['tpl'];
		if (file_exists("$root/tpl/$template/header.tpl")) {
			$template = $template;
		} else {
			$template = $system->confdata('template');
		}
	} else {
		$template = $system->confdata('template');
	}
	require("parser.php");
	$STYLE = new style();
	$language = $system->confdata('language');
	require("" . $root . "/lang/$language/index.php");
	$output = '';
	$tpl = $STYLE->open('header.tpl');
	if ($account) {
		$mail = mysql_num_rows($db->query("SELECT id FROM " . $prefix . "_mail WHERE to_id = '" . $account['id'] . "' AND marked = '0'"));
		$mail = str_replace('[MAIL]', $mail, L_PANEL_MAIL);
		//$panel = '' . L_USER . ': ' . $user->name($account['id']) . ' ' . L_GROUP . ': ' . $system->group($user->group($account['id'])) . ' ' . L_TIME . ': ' . $system->time(time(), 'g:i a') . ' | <a href="' . $siteaddress . '?s=mail" class="normfont">' . $mail . '</a>';
		$panel = "<div style='float:right'><a href='{URL}?s=ucp'>{L_ACCOUNT}</a> &middot; <a href='{$siteaddress}?s=mail'>{$mail}</a></div>".$user->name($account['id'])." ( <a href='{URL}?s=logout'>{L_LOGOUT}{ACP}</a> )";
		$tpl = $STYLE->tags($tpl, array("PANEL" => $panel));
	} 
	if ($system->group_permission($user->group($account['id']), 'acp') == '1') {
		$admin_link = '&middot; <a href="' . $url . 'acp/" class="normfont">' . L_ADMIN_PANEL . '</a>';
	} else {
		$admin_link = '';
	}
	$output .= $STYLE->tags($tpl, array("L_HOME" => L_HOME, "L_REGISTER" => L_REGISTER, "L_MAIL" => L_MAIL, "L_LOGIN" => L_LOGIN, "L_LOGOUT" => L_LOGOUT, "L_ACCOUNT" => L_ACCOUNT, "L_GUEST" => L_GUEST, "ACP" => $admin_link));
	$user_ip = $secure->clean($_SERVER['REMOTE_ADDR']);
	$ban_sql = $db->fetch("SELECT * FROM " . $prefix . "_banlist WHERE value = '$user_ip'");
	if ($ban_sql) {
		$system->page(L_BANNED, L_BANNED_IP);
	}
	$group_id = $user->group($account['id']);
	if ($system->confdata('siteclosed') == '1' && $system->group_permission($user->group($account['id']), 'acp') != '1') {
		$system->page(L_CLOSED, L_SITE_CLOSED);
	}
	if ($account['bantime'] > time()) {
		$system->page(L_TEMPORARY_BAN, str_replace('[TIME]', $system->time($account['bantime']), L_TEMPORARY_BAN_MSG));
	}
	$current_url= preg_replace('/^([^&]*).*$/', '$1', str_replace(array($siteaddress),'',$system->current_url()));
	if ( $system->confdata('activation') == '1' && $account && $account['activated'] != '1' && $current_url != '?s=activate' && $current_url != '?s=logout') {
		$system->redirect("".$siteaddress."?s=activate&u=".$account['id']."");
	}
?>
