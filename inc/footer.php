<?php
/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
// PARSE STYLE
$tpl = $STYLE->open('footer.tpl');
$output .= $STYLE->tags($tpl, array("TPL" => $template));
if (!isset($page_title)) {
    $page_title = L_HOME;
}
if (!isset($global_menu)) {
    $global_menu = '';
}
$system = new system();
$version = $system->confdata('version');
$sitename = $system->confdata('sitename');
$url = $system->confdata('url') . '/' . $system->confdata('path') . '/';
if ($system->group_permission($user->group($account['id']), 'acp') == '1') {
    $admin_link = '<a href="' . $url . 'acp/" class="normfont">' . L_ADMIN_PANEL . '</a> |';
} else {
    $admin_link = '';
}
if ($system->group_permission($user->group($account['id']), 'rc') == '1') {
    $rc_link = '<a href="' . $url . 'rc/" class="normfont">' . L_RESOLUTION_CENTRE . '</a> |';
} else {
    $rc_link = '';
}
$report = '<a href="' . $url . '?s=report" class="normfont">' . L_REPORT . '</a> | ';
$tos = ' <a href="' . $url . '?s=tos" class="normfont">' . L_TERMS_OF_SERVICE . '</a>';
$groups = '<a href="' . $url . '?s=groups" class="normfont">' . L_GROUPS . '</a> | ';
$output = $STYLE->tags($output, array("URL" => $url, "REPORT" => $report, "TOS" => $tos, "GROUPS" => $groups, "L_POWERED_BY" => L_POWERED_BY, "RC" => $rc_link, "ACP" => $admin_link, "GLOBAL_MENU" => $global_menu, "AREA" => $page_title, "SITELINK" => '<a href="' . $url . '" class="normfont">' . $sitename . '</a>', "PAGETITLE" => '' . $sitename . ' - ' . strip_tags($page_title) . ' - ' . L_POWERED_BY . ' ' . $version . '', "VERSION" => $version));
if (!$account) {
    $output = preg_replace('/\<!-- BEGIN logged_in -->(.*?)\<!-- END logged_in -->/is', '', $output);
} else {
    $output = preg_replace('/\<!-- BEGIN logged_out -->(.*?)\<!-- END logged_out -->/is', '', $output);
}
// FaceBook Like
if ( $system->confdata('facebook_like') != '1')
{
    $output = preg_replace('/\<!-- BEGIN facebook_like -->(.*?)\<!-- END facebook_like -->/is', '', $output);
}
// RSS
if ( $system->confdata('rss') != '1')
{
    $output = preg_replace('/\<!-- BEGIN rss -->(.*?)\<!-- END rss -->/is', '', $output);
}
print $output;
$STYLE->close();
$db->close();
?>
