<?php
/* 
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$mysql_version = $db->fetch("select version() as version");
$tpl = $STYLE->open('acp/home.tpl');
    $output .= $STYLE->tags($tpl, array(
        "L_PHP_VERSION" => L_PHP_VERSION,
        "L_MYSQL_VERSION" => L_MYSQL_VERSION,
        "L_KAIBB_VERSION" => L_KAIBB_VERSION,
        "L_ADMIN_PANEL" => L_ADMIN_PANEL,
        "MYSQL_VERSION" => $mysql_version['version'],
        "PHP_VERSION" => phpversion(),
        "KAIBB_VERSION" => $system->confdata('version')
        ));
?>
