<?php
/* 
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
if (!$account)
{
    if ( isset($_POST['submit']))
    {
        if ( !isset($_POST['email']) ){
             $email = '';
        } else {
             $email = $secure->clean($_POST['email']);
        }

        if ( !isset($_POST['pass']) ){
            $pass = '';
        } else {
            $pass = $secure->clean(md5($_POST['pass']));
        }

        if ( !isset($_POST['ref']) ){
            $ref = '';
        } else {
            $ref = $secure->clean($_POST['ref']);
        }

        if ( $email && $pass )
        {
            // CHECK EMAIL AND DEFINE LOGIN SQL
            $check_email = $secure->verify_email($email);
            if ($check_email == 'exist')
            {
                $login = $db->fetch("SELECT email FROM accounts WHERE `email` = '$email' AND `password` = '$pass'");
            } else {
                $login = $db->fetch("SELECT email FROM accounts WHERE `name` LIKE '$email' AND `password` = '$pass'");
                $email = $login['email'];
            }

            if ( ! $login )
            {
                $system->message(L_ERROR,L_LOGIN_ERROR,'./?s=login',L_CONTINUE);
            } else {
                $_SESSION['email'] = $login['email'];
                $lpip = rand(500,20000);
                $_SESSION['lpip'] = "$lpip";
                $update = $db->query("UPDATE accounts SET lpip = '$lpip', lastlogin = UNIX_TIMESTAMP() WHERE `email` = '$email' AND `password` = '$pass'");
                $ref = str_replace(array("?s=login","?s=logout","?s=register"),'',$ref);

                if ( isset($ref)){
                   $ref = $ref;
                } else {
                   $ref = './';
                }

                // LOGGED IN MESSAGE
                $system->message(L_LOGIN,L_LOGIN_MESSAGE,$ref,L_CONTINUE);
                $system->redirect('./');
            }



        } else {
            // ERROR MESSAGE FOR NO DETAILS PROVIDED
            $system->message(L_ERROR,L_LOGIN_ERROR,'./?s=login',L_CONTINUE);
        }

    } else {
        // LOGIN FORM
        if (isset($_SERVER['HTTP_REFERER'])){
            $referer = parse_url($_SERVER['HTTP_REFERER']);
        if ( isset($referer['query'])){
            $referer = '?'.$referer['query'];
            $referer = str_replace(array('acc=login','acc=register','acc=logout'),'',$referer);
        } else{
            $referer = './';
        }
        } else{
            $referer = './';
        }
        $tpl = $STYLE->open('login.tpl');
        $output .= $STYLE->tags($tpl,array("REF" => $referer, "L_NAME" => ''.L_NAME.' / '.L_EMAIL.'', "L_PASSWORD" => L_PASSWORD, "L_LOSTPASSWORD" => L_PASSWORD_LOST_LINK, "L_LOGIN" => L_LOGIN));
    }
}


?>
