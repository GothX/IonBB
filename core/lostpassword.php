<?php
/* 
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
if ( isset($_POST['Submit']))
{
    if (isset($_POST['email']))
    {
        $email = $system->clean($_POST['email']);
    } else {
        $email = '';
    }
    $result = $db->fetch("SELECT * FROM accounts WHERE email LIKE '$email");   
    if ( $result )
    {
        $new_password = $secure->password();
        $new_password_clean = md5($new_password);
        $email = $result['email'];
        $db->query("UPDATE accounts SET password = '$new_password_clean' WHERE email = '$email'");
        $email_message = str_replace(array("[NAME]","[PASSWORD]"),array($account['name'],$new_password),L_LOST_PASSWORD_EMAIL);
        $system->email($email,L_LOST_PASSWORD_SUBJECT,$email_message);
        $system->message(L_LOST_PASSWORD,L_LOST_PASSWORD_MESSAGE,'./?s=login',L_LOGIN); 
    } else {
        $system->message(L_ERROR,L_LOST_PASSWORD_ERROR,'./?s=lostpassword',L_CONTINUE);
    }
} else {
    $tpl = $STYLE->open('lostpassword.tpl');
    $output .= $STYLE->tags($tpl,array("L_SUBMIT" => L_SUBMIT,"L_EMAIL" => L_EMAIL, "L_LOST_PASSWORD" => L_LOST_PASSWORD));
}
?>