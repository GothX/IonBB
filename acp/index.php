<?php
/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
include("../inc/header.php");
require("" . $root . "/lang/$language/admin.php");
$page_title = '<a href="' . $siteaddress . 'acp/" class="normfont">' . L_ADMIN_PANEL . '</a>';
if (!$account) {
    $system->redirect('../');
}
if (!isset($_SESSION['admkeytime'])) {
    $admkeytime = '';
} else {
    $admkeytime = $_SESSION['admkeytime'];
}
// SESSION TIME OUT
$admkey = $system->confdata('admkey');
$clockup = date("YmdHis", time() - date("Z"));
if ($admkeytime < $clockup - 6000) {
    $_SESSION['admkey'] = 'none';
}
// UPDATE ADMKEYTIME
$_SESSION['admkeytime'] = $clockup;
if ($_SESSION['admkey'] == $admkey && $system->group_permission($group_id, 'acp') == '1') {
// Global Menu
    $tpl = $STYLE->open('./acp/menu.tpl');
    $global_menu = $STYLE->getcode('menu', $tpl);
    $tpl = str_replace($global_menu, '', $tpl);
    $global_menu = $STYLE->tags($global_menu, array("L_HOME" => L_HOME, "L_SYSTEM" => L_SYSTEM, "L_COMMUNITY" => L_COMMUNITY, "L_FORUMS" => L_FORUMS, "L_EXIT" => L_EXIT));
    unset($tpl);
    if (!isset($_GET['s'])) {
        $s = '';
    } else {
        $s = $secure->clean($_GET['s']);
    }
    if ($s == 'exit') {
        include("./core/exit.php");
    } else if ($s == 'users') {
        $page_title .= ' / <a href="' . $siteaddress . 'acp/?s=users" class="normfont">' . L_USERS . '</a>';
        include("./core/users.php");
    } else if ($s == 'forums') {
        $page_title .= ' / <a href="' . $siteaddress . 'acp/?s=forums" class="normfont">' . L_FORUMS . '</a>';
        include("./core/forums.php");
    } else if ($s == 'groups') {
        $page_title .= ' / <a href="' . $siteaddress . 'acp/?s=groups" class="normfont">' . L_GROUPS . '</a>';
        include("./core/groups.php");
    } else if ($s == 'ranks') {
        $page_title .= ' / <a href="' . $siteaddress . 'acp/?s=ranks" class="normfont">' . L_RANKS . '</a>';
        include("./core/ranks.php");
    } else if ($s == 'bans') {
        $page_title .= ' / <a href="' . $siteaddress . 'acp/?s=bans" class="normfont">' . L_BANS . '</a>';
        include("./core/bans.php");
    } else if ($s == 'bans-email') {
        $page_title .= ' / <a href="' . $siteaddress . 'acp/?s=bans" class="normfont">' . L_BANS . '</a>';
        include("./core/bans-email.php");
    } else if ($s == 'bans-name') {
        $page_title .= ' / <a href="' . $siteaddress . 'acp/?s=bans" class="normfont">' . L_BANS . '</a>';
        include("./core/bans-name.php");
    } else if ($s == 'bans-ip') {
        $page_title .= ' / <a href="' . $siteaddress . 'acp/?s=bans" class="normfont">' . L_BANS . '</a>';
        include("./core/bans-ip.php");
    } else if ($s == 'community') {
        $page_title .= ' / <a href="' . $siteaddress . 'acp/?s=community" class="normfont">' . L_COMMUNITY . '</a>';
        include("./core/community.php");
    } else if ($s == 'system') {
        $page_title .= ' / <a href="' . $siteaddress . 'acp/?s=system" class="normfont">' . L_SYSTEM . '</a>';
        include("./core/system.php");
    } else if ($s == 'account-settings') {
        $page_title .= ' / <a href="' . $siteaddress . 'acp/?s=system" class="normfont">' . L_SYSTEM . '</a> / ' . L_SETTINGS;
        include("./core/account-settings.php");
    } else {
        $page_title .= ' / <a href="' . $siteaddress . 'acp/" class="normfont">' . L_HOME . '</a>';
        include("./core/home.php");
    }
} else {
    include("./core/login.php");
}
include("../inc/footer.php");
?>
