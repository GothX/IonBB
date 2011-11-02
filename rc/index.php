<?php

/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
include("../inc/header.php");
require("" . $root . "/lang/$language/resolution_centre.php");
$page_title = '<a href="' . $siteaddress . 'rc/" class="normfont">' . L_RESOLUTION_CENTRE . '</a>';
if ($system->group_permission($group_id, 'rc') != '1') {
    $system->redirect('../');
}
// Global Menu
$tpl = $STYLE->open('./rc/menu.tpl');
$global_menu = $STYLE->getcode('menu', $tpl);
$tpl = str_replace($global_menu, '', $tpl);
$global_menu = $STYLE->tags($global_menu, array("L_ALL" => L_ALL, "L_ABUSE" => L_ABUSE, "L_CONTENT" => L_CONTENT, "L_CLOSED" => L_CLOSED));
unset($tpl);
include("./core/home.php");
include("../inc/footer.php");
?>
