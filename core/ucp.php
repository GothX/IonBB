<?php

/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$tpl = $STYLE->open('ucp.tpl');
// Generate Global Menu
$global_menu = $STYLE->getcode('menu', $tpl);
$tpl = str_replace($global_menu, '', $tpl);
$global_menu = $STYLE->tags($global_menu, array("L_ACCOUNT" => L_ACCOUNT, "L_SETTINGS" => L_SETTINGS, "L_SIGNATURE" => L_SIGNATURE, "L_AVATAR" => L_AVATAR));
$content = '';
// Define Mode
if (isset($_GET['mode'])) {
    $mode = $secure->clean($_GET['mode']);
} else {
    $mode = '';
}
if ($mode == 'avatar') {
    $tpl = str_replace(array($STYLE->getcode('account', $tpl), $STYLE->getcode('settings', $tpl), $STYLE->getcode('signature', $tpl)), '', $tpl);
    $page_title = $page_title . ' / <a href="./?s=ucp&amp;mode=settings" class="normfont">' . L_AVATAR . '</a>';
    if (isset($_POST['Delete'])) {
        if (file_exists("./img/avatars/" . $account['id'] . ".png")) {
            unlink("./img/avatars/" . $account['id'] . ".png");
        }
        if (file_exists("./img/avatars/" . $account['id'] . ".gif")) {
            unlink("./img/avatars/" . $account['id'] . ".gif");
        }
        if (file_exists("./img/avatars/" . $account['id'] . ".jpg")) {
            unlink("./img/avatars/" . $account['id'] . ".jpg");
        }
        if (file_exists("./img/avatars/" . $account['id'] . ".jpeg")) {
            unlink("./img/avatars/" . $account['id'] . ".jpeg");
        }
        $system->message(L_DELETE, L_AVATAR_DELETE, './?s=ucp&amp;mode=avatar', L_CONTINUE);
    } else if (isset($_POST['Avi'])) {

        // Avatar Upload
        function getExtension($str) {
            $i = strrpos($str, ".");

            if (!$i) {
                return "";
            }

            $l = strlen($str) - $i;
            $ext = substr($str, $i + 1, $l);
            return $ext;
        }

        if (isset($_POST['Avi'])) {
            $image = $_FILES['image']['name'];
            if ($image) {
                $filename = stripslashes($_FILES['image']['name']);
                $extension = getExtension($filename);
                $extension = strtolower($extension);
                // Make sure it is an image
                if ((($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))) {
                    $system->message(L_ERROR, L_AVATAR_UPLOAD_FORMAT, './?s=ucp&amp;mode=avatar', L_CONTINUE);
                }
                // Delete possible existing avatar
                if (file_exists("./img/avatars/" . $account['id'] . ".png")) {
                    unlink("./img/avatars/" . $account['id'] . ".png");
                }
                if (file_exists("./img/avatars/" . $account['id'] . ".gif")) {
                    unlink("./img/avatars/" . $account['id'] . ".gif");
                }
                if (file_exists("./img/avatars/" . $account['id'] . ".jpg")) {
                    unlink("./img/avatars/" . $account['id'] . ".jpg");
                }
                if (file_exists("./img/avatars/" . $account['id'] . ".jpeg")) {
                    unlink("./img/avatars/" . $account['id'] . ".jpeg");
                }
                $image_name = time() . '.' . $extension;
                $newname = "img/avatars/" . $account['id'] . ".$extension";
                $copied = copy($_FILES['image']['tmp_name'], $newname);
                $size = filesize("$newname");
                list($width, $height) = getimagesize("$newname");
                unlink($_FILES['image']['tmp_name']);
            }
            if (!isset($copied)) {
                $system->message(L_ERROR, L_AVATAR_UPLOAD_ERROR, './?s=ucp&amp;mode=avatar', L_CONTINUE);
            } else
            if ($height > $system->confdata('avatar_height') || $width > $system->confdata('avatar_width')) {
                // Prevent Avatar over Dimension size
                unlink("$newname");
                $error_message = str_replace(array("[HEIGHT]", "[WIDTH]"), array($system->confdata('avatar_height'), $system->confdata('avatar_width')), L_AVATAR_UPLOAD_DIMENSION);
                $system->message(L_ERROR, $error_message, './?s=ucp&amp;mode=avatar', L_CONTINUE);
            } else
            if ($size > $system->confdata('avatar_filesize')) {
                // Prevent Avatar over File size
                unlink("$newname");
                $error_message = str_replace("[SIZE]", $system->confdata('avatar_filesize'), L_AVATAR_UPLOAD_SIZE);
                $system->message(L_ERROR, $error_message, './?s=ucp&amp;mode=avatar', L_CONTINUE);
            } else {
                $system->message(L_UPDATED, L_AVATAR_UPDATE, './?s=ucp&amp;mode=avatar', L_CONTINUE);
            }
        }
    } else {
        $tpl = $STYLE->tags($tpl, array("AVATAR" => $user->avatar($account['id']), "L_DELETE" => L_DELETE));
    }
} else if ($mode == 'signature') {
    $tpl = str_replace(array($STYLE->getcode('account', $tpl), $STYLE->getcode('avatar', $tpl), $STYLE->getcode('settings', $tpl)), '', $tpl);
    $page_title = $page_title . ' / <a href="./?s=ucp&amp;mode=signature" class="normfont">' . L_SIGNATURE . '</a>';
    if (isset($_POST['Submit'])) {
        if (isset($_POST['signature'])) {
            $signature = $secure->clean($_POST['signature']);
        } else {
            $signature = '';
        }
        $id = $account['id'];
        $result = $db->query("UPDATE accounts SET signature = '$signature' WHERE id = '$id'");
        if ($result) {
            $system->message(L_UPDATED, L_SIGNATURE_UPDATE, './?s=ucp&amp;mode=signature', L_CONTINUE);
        } else {
            $system->message(L_ERROR, L_SIGNATURE_ERROR, './?s=ucp&amp;mode=signature', L_CONTINUE);
        }
    } else {
        $tpl = $STYLE->tags($tpl, array("L_PREVIEW" => L_PREVIEW, "PREVIEW" => $system->bbcode($account['signature']), "SIGNATURE" => stripslashes($account['signature'])));
    }
} else if ($mode == 'settings') {
    // Account Settings
    $tpl = str_replace(array($STYLE->getcode('account', $tpl), $STYLE->getcode('avatar', $tpl), $STYLE->getcode('signature', $tpl)), '', $tpl);
    $page_title = $page_title . ' / <a href="./?s=ucp&amp;mode=settings" class="normfont">' . L_SETTINGS . '</a>';
    if (isset($_POST['Submit'])) {
        if (!isset($_POST['template'])) {
            $user_template = '';
        } else {
            $user_template = $secure->clean($_POST['template']);
        }
        if (!isset($_POST['timezone'])) {
            $timezone = '';
        } else {
            $timezone = $secure->clean($_POST['timezone']);
        }
        if (!isset($_POST['gender'])) {
            $gender = '';
        } else {
            $gender = $secure->clean($_POST['gender']);
        }
        if (!isset($_POST['location'])) {
            $location = '';
        } else {
            $location = $secure->clean($_POST['location']);
        }
        if (!isset($_POST['emailme'])) {
            $emailme = '';
        } else {
            $emailme = $secure->clean($_POST['emailme']);
        }
        $id = $account['id'];
        $result = $db->query("UPDATE accounts SET tpl = '$user_template' , timezone = '$timezone' , location='$location', gender='$gender', emailme='$emailme' WHERE id='$id'");
        if ($result) {
            $system->message(L_UPDATED, L_ACCOUNT_SETTINGS_UPDATE, './?s=ucp&amp;mode=settings', L_CONTINUE);
        } else {
            $system->message(L_ERROR, L_ACCOUNT_SETTINGS_ERROR, './?s=ucp&amp;mode=settings', L_CONTINUE);
        }
    } else {
        // List Templates
        $user_template = $account['tpl'];
        if (!isset($user_template)) {
            $user_template = $system->confdata('template');
        }
        $template_box = '';
        $directory = @opendir('./tpl/');
        while ($file = readdir($directory)) {
            if ($file != "index.php" && $file != "." && $file != "..") {
                if ($file == $user_template) {
                    $selected = 'selected';
                } else {
                    $selected = '';
                }
                $template_box .= '<option ' . $selected . ' value="' . $file . '">' . $file . '</option>';
            }
        }
        // Current Notification Setting
        if ($account['emailme'] == '1') {
            $notify_no = '';
            $notify_yes = 'selected';
        } else {
            $notify_no = 'selected';
            $notify_yes = '';
        }
        if ($account['gender'] == '1') {
            $male = 'selected';
            $female = '';
            $hidden = '';
        } else if ($account['gender'] == '2') {
            $male = '';
            $female = 'selected';
            $hidden = '';
        } else {
            $male = '';
            $female = '';
            $hidden = 'selected';
        }
        // Timezone Options
        $a = '';
        $b = '';
        $c = '';
        $d = '';
        $e = '';
        $f = '';
        $g = '';
        $h = '';
        $i = '';
        $j = '';
        $k = '';
        $l = '';
        $m = '';
        $n = '';
        $o = '';
        $p = '';
        $q = '';
        $r = '';
        $s = '';
        $t = '';
        $u = '';
        $v = '';
        $w = '';
        $x = '';
        $y = '';
        $bb = '';
        $rr = '';
        $ss = '';
        $sss = '';
        $ww = '';
        $www = '';
        if ($account['timezone'] == '-43200') {
            $a = 'selected';
        } else if ($account['timezone'] == '-39600') {
            $b = 'selected';
        } else if ($account['timezone'] == '-36000') {
            $bb = 'selected';
        } else
        if ($account['timezone'] == '-32400') {
            $c = 'selected';
        } else
        if ($account['timezone'] == '-28800') {
            $d = 'selected';
        } else
        if ($account['timezone'] == '-25200') {
            $e = 'selected';
        } else
        if ($account['timezone'] == '-21600') {
            $f = 'selected';
        } else
        if ($account['timezone'] == '-18000') {
            $g = 'selected';
        } else
        if ($account['timezone'] == '-14000') {
            $h = 'selected';
        } else
        if ($account['timezone'] == '-12200') {
            $i = 'selected';
        } else
        if ($account['timezone'] == '-10400') {
            $j = 'selected';
        } else
        if ($account['timezone'] == '-7200') {
            $k = 'selected';
        } else
        if ($account['timezone'] == '-3600') {
            $l = 'selected';
        } else
        if ($account['timezone'] == '0') {
            $m = 'selected';
        } else
        if ($account['timezone'] == '3600') {
            $n = 'selected';
        } else
        if ($account['timezone'] == '7200') {
            $o = 'selected';
        } else
        if ($account['timezone'] == '10400') {
            $p = 'selected';
        } else
        if ($account['timezone'] == '12200') {
            $q = 'selected';
        } else
        if ($account['timezone'] == '14000') {
            $r = 'selected';
        } else
        if ($account['timezone'] == '16200') {
            $rr = 'selected';
        } else
        if ($account['timezone'] == '18000') {
            $s = 'selected';
        } else
        if ($account['timezone'] == '19800') {
            $ss = 'selected';
        } else
        if ($account['timezone'] == '20700') {
            $sss = 'selected';
        } else
        if ($account['timezone'] == '21600') {
            $t = 'selected';
        } else
        if ($account['timezone'] == '25200') {
            $u = 'selected';
        } else
        if ($account['timezone'] == '28800') {
            $v = 'selected';
        } else
        if ($account['timezone'] == '32400') {
            $w = 'selected';
        } else
        if ($account['timezone'] == '34200') {
            $ww = 'selected';
        } else
        if ($account['timezone'] == '36000') {
            $www = 'selected';
        } else
        if ($account['timezone'] == '39600') {
            $x = 'selected';
        } else
        if ($account['timezone'] == '43200') {
            $y = 'selected';
        }
        $tpl = $STYLE->tags($tpl, array("MALE" => $male, "FEMALE" => $female, "HIDDEN" => $hidden, "NOTIFY_YES" => $notify_yes, "NOTIFY_NO" => $notify_no,
                    "L_NOTIFY" => L_NOTIFY, "L_TEMPLATE" => L_TEMPLATE, "L_LANGUAGE" => L_LANGUAGE, "L_TIMEZONE" => L_TIMEZONE, "L_LOCATION" => L_LOCATION, "L_GENDER" => L_GENDER, "L_MALE" => L_MALE, "L_FEMALE" => L_FEMALE, "L_HIDDEN" => L_HIDDEN, "L_ENABLED" => L_ENABLED, "L_DISABLED" => L_DISABLED,
                    "LOCATION" => stripslashes($account['location']), "TEMPLATE_BOX" => $template_box,
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
                    "L_GMT_PLUS_1200" => L_GMT_PLUS_1200,
                    "a" => $a, "b" => $b, "c" => $c, "d" => $d, "e" => $e, "f" => $f, "g" => $g, "h" => $h, "i" => $i, "j" => $j, "k" => $k, "l" => $l, "m" => $m, "n" => $n, "o" => $o, "p" => $p, "q" => $q, "r" => $r, "s" => $s, "t" => $t, "u" => $u, "v" => $v, "w" => $w, "x" => $x, "y" => $y, "bb" => $bb, "rr" => $rr, "ss" => $ss, "sss" => $sss, "ww" => $ww, "www" => $www));
    }
} else {
    // Account Options
    $tpl = str_replace(array($STYLE->getcode('signature', $tpl), $STYLE->getcode('avatar', $tpl), $STYLE->getcode('settings', $tpl)), '', $tpl);
    $page_title = $page_title . ' / <a href="./?s=ucp" class="normfont">' . L_ACCOUNT . '</a>';
    if (isset($_POST['Submit'])) {
        // Sanitise Input
        if (isset($_POST['name'])) {
            $name = $secure->clean($_POST['name']);
        } else {
            $name = '';
        }
        if (isset($_POST['email'])) {
            $email = $secure->clean($_POST['email']);
        } else {
            $email = '';
        }
        if (isset($_POST['pass'])) {
            $password = md5($secure->clean($_POST['pass']));
        } else {
            $password = '';
        }
        if (isset($_POST['newpass'])) {
            $new_password = $secure->clean($_POST['newpass']);
        } else {
            $new_password = '';
        }
        if (isset($_POST['confirmnewpass'])) {
            $new_password_confirm = $secure->clean($_POST['confirmnewpass']);
        } else {
            $new_password_confirm = '';
        }
        // Ensure New Password is Confirmed
        if ($new_password != $new_password_confirm) {
            $system->message(L_ERROR, L_CONFIRM_PASSWORD_ERROR, './?s=ucp', L_CONTINUE);
        }
        // Prevent Nullifying of Password
        if ($new_password == '') {
            $new_password = $account['password'];
        }
        // Ensure Correct Password
        if ($password != $account['password']) {
            $system->message(L_ERROR, L_PASSWORD_ERROR, './?s=ucp', L_CONTINUE);
        }
        // Ensure Name is not Banned
        if ($secure->verify_name($name) == 'banned') {
            $system->message(L_ERROR, L_NAME_BANNED, './?s=ucp', L_CONTINUE);
        }
        // Ensure name does not already exist
        if ($secure->verify_name($name) == 'exist' && $name != $account['name']) {
            $system->message(L_ERROR, L_NAME_EXIST, './?s=ucp', L_CONTINUE);
        }
        // Only allow if fields are present
        if (isset($name) && isset($password)) {
            $user_id = $account['id'];
            $result = $db->query("UPDATE accounts SET name='$name', password = '$new_password' WHERE id='$user_id'");
            $system->message(L_UPDATED, L_ACCOUNT_UPDATED, './?s=ucp', L_CONTINUE);
        }
    }
    $tpl = $STYLE->tags($tpl, array("NAME" => $account['name'], "EMAIL" => $account['email'], "L_NAME" => L_NAME, "L_EMAIL" => L_EMAIL, "L_PASSWORD" => L_PASSWORD, "L_NEW_PASSWORD" => L_NEW_PASSWORD, "L_NEW_PASSWORD_CONFIRM" => L_NEW_PASSWORD_CONFIRM));
}
$output .= $STYLE->tags($tpl, array("L_ACCOUNT" => L_ACCOUNT, "L_SETTINGS" => L_SETTINGS, "L_SIGNATURE" => L_SIGNATURE, "L_AVATAR" => L_AVATAR, "L_SUBMIT" => L_SUBMIT))
?>
