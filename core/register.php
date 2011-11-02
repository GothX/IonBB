<?php

/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$tpl = $STYLE->open('register.tpl');
// Is Registration Open?
if ($system->confdata('userreg') != '1') {
    $system->page(L_ERROR, L_REGISTERATION_CLOSED);
}
if (isset($_POST['Submit'])) {
    if (isset($_POST['regname'])) {
        $name = $secure->clean($_POST['regname']);
    } else {
        $name = '';
    }
    if (isset($_POST['regemail'])) {
        $email = $secure->clean($_POST['regemail']);
    } else {
        $email = '';
    }
    if (isset($_POST['timezone'])) {
        $timezone = $secure->clean($_POST['timezone']);
    } else {
        $timezone = '';
    }
    if (isset($_POST['location'])) {
        $location = $secure->clean($_POST['location']);
    } else {
        $location = '';
    }
    if (isset($_POST['gender'])) {
        $gender = $secure->clean($_POST['gender']);
    } else {
        $gender = '';
    }
    if (isset($_POST['password'])) {
        $new_password = $secure->clean($_POST['password']);
    } else {
        $new_password = '';
    }
    if (isset($_POST['confirm_password'])) {
        $new_password_confirm = $secure->clean($_POST['confirm_password']);
    } else {
        $new_password_confirm = '';
    }

    if (isset($_POST['captcha'])) {
        $captcha = $secure->clean($_POST['captcha']);
    } else {
        $captcha = '';
    }
    // Check Captcha
    if (md5($captcha) != $_SESSION['captcha']) {
        $system->message(L_ERROR, L_CAPTCHA_ERROR, './?s=register', L_CONTINUE);
    }
    // Ensure New Password is Confirmed
    if ($new_password != $new_password_confirm) {
        $system->message(L_ERROR, L_CONFIRM_PASSWORD_ERROR, './?s=register', L_CONTINUE);
    }
    // Prevent Nullifying of Password
    if ($new_password == '') {
        $system->message(L_ERROR, L_INFORMATION_MISSING, './?s=register', L_CONTINUE);
    }
    // Generate ACTIVATION_CODE
    $activation_code = $secure->password();
    // Check if fields are blank
    if (!isset($name)) {
        $system->message(L_ERROR, L_REGISTER_ERROR_NAME, '?s=register', L_CONTINUE);
    }
    if (!isset($email)) {
        $system->message(L_ERROR, L_REGISTER_ERROR_EMAIL, '?s=register', L_CONTINUE);
    }
    if (!isset($email)) {
        $system->message(L_ERROR, L_REGISTER_ERROR_PASSWORD, '?s=register', L_CONTINUE);
    }
    // Check if black listed or false
    if ($secure->verify_name($name) == 'exist') {
        $system->message(L_ERROR, L_REGISTER_ERROR_NAME_EXISTS, '?s=register', L_CONTINUE);
    }
    // Ensure Name is not Banned
    if ($secure->verify_name($name) == 'banned') {
        $system->message(L_ERROR, L_NAME_BANNED, './?s=ucp', L_CONTINUE);
    }
    if ($secure->verify_email($email) == 'exist') {
        $system->message(L_ERROR, L_REGISTER_ERROR_EMAIL_EXISTS, '?s=register', L_CONTINUE);
    }
    if ($secure->verify_email($email) == 'false') {
        $system->message(L_ERROR, L_REGISTER_ERROR_EMAIL_FALSE, '?s=register', L_CONTINUE);
    }
    if ($secure->verify_email($email) == 'banned') {
        $system->message(L_ERROR, L_REGISTER_ERROR_EMAIL_BANNED, '?s=register', L_CONTINUE);
    }
    // Create This Account
    $new_password = md5($new_password);
    $ip = $secure->clean($_SERVER['REMOTE_ADDR']);
    if ($system->confdata('activation') == '1') {
        $activated = '0';
    } else {
        $activated = '1';
    }
    $insert_user = $db->query("INSERT INTO accounts (name, email, password, ip , joined, lastlogin, gender, location, activation_code, activated) VALUES ('$name', '$email' , '$new_password', '$ip' , UNIX_TIMESTAMP(), UNIX_TIMESTAMP(),'$gender','$location','$activation_code','$activated')");
    $get_user = $db->fetch("SELECT * FROM accounts WHERE ip = '$ip' ORDER BY id DESC LIMIT 1") or die(mysql_error());
    $permission_group = $db->query("INSERT INTO " . $prefix . "_groups_members (account_id,group_id) VALUES ('" . $get_user['id'] . "','2')");
    if ($system->confdata('activation') == '1') {
        $email_message = str_replace(array('[USER]', '[URL]', '[UID]', '[ACTIVATION_CODE]'), array($name, $siteaddress . '?s=activate&u=' . $get_user['id'] . '&code=' . $activation_code, $get_user['id'], $activation_code), L_REGISTER_EMAIL);
        $system->email($email, L_REGISTER_SUBJECT, $email_message);
    }
    $system->message(L_REGISTER, L_REGISTER_MESSAGE, './?s=login', L_LOGIN);
} else {
    // Show Registration Form
    $output .= $STYLE->tags($tpl, array("L_CAPTCHA" => L_CAPTCHA, "TOS" => $system->confdata('tos'), "L_PASSWORD" => L_PASSWORD, "L_CONFIRM_PASSWORD" => L_CONFIRM_PASSWORD, "L_NAME" => L_NAME, "L_EMAIL" => L_EMAIL, "L_MALE" => L_MALE, "L_FEMALE" => L_FEMALE, "L_HIDDEN" => L_HIDDEN, "L_TIMEZONE" => L_TIMEZONE, "L_GENDER" => L_GENDER, "L_LOCATION" => L_LOCATION, "L_SUBMIT" => L_SUBMIT, "L_ACC_DETAILS" => L_ACCOUNT_DETAILS, "L_PROFILE_DETAILS" => L_PROFILE_DETAILS, "L_AGREEMENT_STATEMENT" => L_AGREEMENT_STATEMENT, "L_AGREEMENT" => L_AGREEMENT,
                "L_GMT_MINUS_1200" => L_GMT_MINUS_1200,
                "L_GMT_MINUS_1100" => L_GMT_MINUS_1100,
                "L_GMT_MINUS_1000" => L_GMT_MINUS_1000,
                "L_GMT_MINUS_900" => L_GMT_MINUS_900,
                "L_GMT_MINUS_800" => L_GMT_MINUS_800,
                "L_GMT_MINUS_700" => L_GMT_MINUS_700,
                "L_GMT_MINUS_600" => L_GMT_MINUS_600,
                "L_GMT_MINUS_500" => L_GMT_MINUS_500,
                "L_GMT_MINUS_400" => L_GMT_MINUS_400,
                "L_GMT_MINUS_330" => L_GMT_MINUS_330,
                "L_GMT_MINUS_300" => L_GMT_MINUS_300,
                "L_GMT_MINUS_200" => L_GMT_MINUS_200,
                "L_GMT_MINUS_100" => L_GMT_MINUS_100,
                "L_GMT_000" => L_GMT_000,
                "L_GMT_PLUS_100" => L_GMT_PLUS_100,
                "L_GMT_PLUS_200" => L_GMT_PLUS_200,
                "L_GMT_PLUS_300" => L_GMT_PLUS_300,
                "L_GMT_PLUS_330" => L_GMT_PLUS_330,
                "L_GMT_PLUS_400" => L_GMT_PLUS_400,
                "L_GMT_PLUS_430" => L_GMT_PLUS_430,
                "L_GMT_PLUS_500" => L_GMT_PLUS_500,
                "L_GMT_PLUS_530" => L_GMT_PLUS_530,
                "L_GMT_PLUS_545" => L_GMT_PLUS_545,
                "L_GMT_PLUS_600" => L_GMT_PLUS_600,
                "L_GMT_PLUS_700" => L_GMT_PLUS_700,
                "L_GMT_PLUS_800" => L_GMT_PLUS_800,
                "L_GMT_PLUS_900" => L_GMT_PLUS_900,
                "L_GMT_PLUS_930" => L_GMT_PLUS_930,
                "L_GMT_PLUS_1000" => L_GMT_PLUS_1000,
                "L_GMT_PLUS_1100" => L_GMT_PLUS_1100,
                "L_GMT_PLUS_1200" => L_GMT_PLUS_1200
            ));
}
?>