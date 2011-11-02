<?php
/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$tpl = $STYLE->open('activate.tpl');
if (isset($_POST['email']) && isset($_POST['code'])) {
    $email = $secure->clean($_POST['email']);
    $code = $secure->clean($_POST['code']);

    $user_row = $db->fetch("SELECT id FROM accounts WHERE email LIKE '$email'");

    if ($user_row) {
        $system->redirect("./?s=activate&u=" . $user_row['id'] . "&code=$code");
    }
}
if (isset($_GET['u']) && isset($_GET['code'])) {
    $user_id = $secure->clean($_GET['u']);
    $code = $secure->clean($_GET['code']);

    $user_row = $db->fetch("SELECT * FROM accounts WHERE id = '$user_id' AND activation_code = '$code'");

    if ($user_row) {
        $db->query("UPDATE accounts SET activated = '1' , activation_code = '' WHERE id = '$user_id'");

        if ($account) {
            $link = './';
            $link_text = L_CONTINUE;
        } else {
            $link = '?s=login';
            $link_text = L_LOGIN;
        }
        $system->message(L_ACTIVATED, L_ACTIVATION_MESSAGE, $link, $link_text);
    }
    $system->message(L_ERROR, L_ACTIVATION_ERROR, './?s=activate', L_CONTINUE);
}

$output .= $STYLE->tags($tpl, array("L_EMAIL" => L_EMAIL, "L_CODE" => L_CODE, "L_SUBMIT" => L_SUBMIT, "L_ACTIVATION" => L_ACTIVATION, "L_ACTIVATION_REQUIRED_MESSAGE" => L_ACTIVATION_REQUIRED_MSG));
?>