<?php
/* 
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$STYLE = new style();
if (!isset($_POST['email'])) {
    $email = '';
} else {
    $email = $secure->clean($_POST['email']);
}

if (!isset($_POST['pass'])) {
    $pass = '';
} else {
    $pass = $secure->clean(md5($_POST['pass']));
}

if (!isset($_POST['ref'])) {
    $ref = '';
} else {
    $ref = $secure->clean($_POST['ref']);
}


if ($email) {
    $emck = $secure->verify_email($email);

    if ($emck == 'exist') {
        $login = $db->fetch("SELECT * FROM accounts WHERE `email` = '$email' AND `password` = '$pass'");
    } else {
        $login = $db->fetch("SELECT * FROM accounts WHERE `name` = '$email' AND `password` = '$pass'");
    }


    if (!$login) {
       $system->message(L_ERROR,L_LOGIN_ERROR,'./',L_CONTINUE);
        } 
        
        if ( $system->group_permission($group_id,'acp') != '1')
        {
            $system->message(L_ERROR,L_PERMISSION_ERROR_AREA,'./',L_CONTINUE);
        }
        
        $email = $login['email'];
        $adm = $system->confdata('admkey');
        $_SESSION['lpip'] = "$lpip";
        $_SESSION['admkey'] = "$adm";
        $_SESSION['admkeytime'] = "$clockup";
        $_SESSION['email'] = "$email";
        $lpip = rand(500, 20000);
        $_SESSION['lpip'] = "$lpip";
        $account_login = $db->query("UPDATE accounts SET lpip = '$lpip', lastlogin = UNIX_TIMESTAMP() WHERE `email` = '$email' AND `password` = '$pass'");

        if (!$account_login) {
            $system->message(L_ERROR,mysql_error(),'./',L_CONTINUE);
        } 

        $ref = str_replace(array("?s=login", "?s=logout"), '', $ref);

        if (isset($ref)) {
            $ref = $ref;
        } else {
            $ref = './';
        }

       $system->message(L_LOGIN,L_LOGIN_ADMIN,'./',L_CONTINUE);
    
} else {

    if (isset($_SERVER['HTTP_REFERER'])) {
        $rurl = parse_url($_SERVER['HTTP_REFERER']);
    } else {
        $rurl = '';
    }


    if (isset($rurl['query'])) {
        $ref = '?' . $rurl['query'];
        $ref = str_replace(array('acc=login', 'acc=register', 'acc=logout'), '', $ref);
    } else {
        $ref = './';
    }

    $tpl = $STYLE->open('login.tpl');
    $output .= $STYLE->tags($tpl, array("REF" => $ref, "L_NAME" => '' . L_NAME . ' / ' . L_EMAIL . '', "L_PASSWORD" => L_PASSWORD, "L_LOSTPASSWORD" => '', "L_LOGIN" => L_LOGIN));
}
?>