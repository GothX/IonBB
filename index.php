<?php

/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
require("./inc/header.php");

// Installed Check
if(!file_exists("./inc/config.php"))
{
    echo '<script language="javascript">
window.location="./install/";
</script>';
}

$page_title = '';
require("" . $root . "/lang/$language/forum.php");
if (isset($_GET['s'])) {
    $section = $secure->clean($_GET['s']);
} else {
    $section = '';
}

// Topic Short Url
if (isset($_GET['topic'])) {
    $tid = $secure->clean($_GET['topic']);
    include("./core/topic.php");
} else if ($section == 'login' && !$account['id']) {
    $page_title = '<a href="' . $siteaddress . '?s=login" class="normfont">' . L_LOGIN . '</a>';
    include("./core/login.php");
} else if ($section == 'logout' && $account['id']) {
    $page_title = '<a href="' . $siteaddress . '?s=logout" class="normfont">' . L_LOGOUT . '</a>';
    include("./core/logout.php");
} else if ($section == 'register' && !$account['id']) {
    $page_title = '<a href="' . $siteaddress . '?s=register" class="normfont">' . L_REGISTER . '</a>';
    include("./core/register.php");
    } else if ($section == 'activate') {
    $page_title = '<a href="' . $siteaddress . '?s=activate" class="normfont">' . L_ACTIVATION . '</a>';
    include("./core/activate.php");
} else if ($section == 'ucp' && $account['id']) {
    $page_title = '<a href="' . $siteaddress . '?s=ucp" class="normfont">' . L_USER_CONTROL_PANEL . '</a>';
    include("./core/ucp.php");
} else if ($section == 'lostpassword' && !$account['id']) {
    $page_title = '<a href="' . $siteaddress . '?s=lostpassword" class="normfont">' . L_LOST_PASSWORD . '</a>';
    include("./core/lostpassword.php");
} else if ($section == 'profile') {
    $page_title = '<a href="' . $siteaddress . '?s=profile&amp;user=' . $account['id'] . '" class="normfont">' . L_PROFILE . '</a>';
    include("./core/profile.php");
} else if ($section == 'groups') {
    $page_title = '<a href="' . $siteaddress . '?s=groups" class="normfont">' . L_GROUPS . '</a>';
    include("./core/groups.php");
} else if ($section == 'viewtopic') {
    include("./core/topic.php");
} else if ($section == 'viewforum') {
    include("./core/forum.php");
} else if ($section == 'report') {
    $page_title = '<a href="' . $siteaddress . '?s=report" class="normfont">' . L_REPORT . '</a>';
    include("./core/report.php");
} else if ($section == 'search') {
    $page_title = '<a href="' . $siteaddress . '?s=search" class="normfont">' . L_SEARCH . '</a>';
    include("./core/search.php");
} else if ($section == 'mail' && $account) {
    $page_title = '<a href="' . $siteaddress . '?s=mail" class="normfont">' . L_MAIL . '</a>';
    include("./core/mail.php");
} else if ($section == 'tos') {
    $page_title = '<a href="' . $siteaddress . '?s=pos" class="normfont">' . L_TERMS_OF_SERVICE . '</a>';
    $system->page(L_TERMS_OF_SERVICE, $system->confdata('tos'));
} else {
    $page_title = '<a href="' . $siteaddress . '" class="normfont">' . L_HOME . '</a>';
    include('./core/home.php');
}
require("./inc/footer.php");
?>
