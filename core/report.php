<?php
/* 
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$tpl = $STYLE->open('report.tpl');
if (isset($_POST['Submit'])) {
    $reason = $secure->clean($_POST['reason']);
    $name = $secure->clean($_POST['user']);
    if (!$reason || !$name) {
        $system->message(L_ERROR, L_INFORMATION_MISSING, './', L_CONTINUE);
    }
    $user_data = $db->fetch("SELECT * FROM accounts WHERE name LIKE '$name';");
    if (!$user_data) {
        $system->message(L_ERROR, L_REPORT_ERROR, './', L_CONTINUE);
    }
    $db->query("INSERT INTO " . $prefix . "_reports (account_id,reporter_id,reason,date) VALUE ('" . $user_data['id'] . "','" . $account['id'] . "','" . $reason . "',UNIX_TIMESTAMP())");
    $system->message(L_SUBMITTED, L_REPORT_SUBMITTED, './', L_CONTINUE);
}
$output .= $STYLE->tags($tpl, array("L_REPORT" => L_REPORT, "L_SUBMIT" => L_SUBMIT, "L_USER" => L_USER));
?>
