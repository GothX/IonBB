<?php
/* 
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$tpl = $STYLE->open('acp/bans.tpl');



$output .= $STYLE->tags($tpl,array("L_BANS" => L_BANS, "L_EMAIL_BANS" => L_EMAIL_BANS, "L_EMAIL_BANS_INFO" => L_EMAIL_BANS_INFO, "L_IP_BANS" => L_IP_BANS, "L_IP_BANS_INFO" => L_IP_BANS_INFO, "L_NAME_BANS" => L_NAME_BANS, "L_NAME_BANS_INFO" => L_NAME_BANS_INFO));
?>
