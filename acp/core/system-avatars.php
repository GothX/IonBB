<?php

/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$tpl = $STYLE->open('./acp/system-avatars.tpl');
if (isset($_POST['submit'])) {
    if (isset($_POST['avatar_filesize'])) {
        $avatar_filesize = $secure->clean($_POST['avatar_filesize']);
    } else {
        $avatar_filesize = '';
    }
    if (isset($_POST['avatar_height'])) {
        $avatar_height = $secure->clean($_POST['avatar_height']);
    } else {
        $avatar_height = '';
    }
    if (isset($_POST['avatar_width'])) {
        $avatar_width = $secure->clean($_POST['avatar_width']);
    } else {
        $avatar_width = '';
    }
    if (isset($_POST['avatar'])) {
        $avatars = $secure->clean($_POST['avatar']);
    } else {
        $avatars = '';
    }
    $db->query("UPDATE " . $prefix . "_confdata SET value = ' $avatar_filesize' WHERE name = 'avatar_filesize'");
    $db->query("UPDATE " . $prefix . "_confdata SET value = '$avatar_height' WHERE name = 'avatar_height'");
    $db->query("UPDATE " . $prefix . "_confdata SET value = '$avatar_width' WHERE name = 'avatar_width'");
    $db->query("UPDATE " . $prefix . "_confdata SET value = '$avatars' WHERE name = 'avatar'");
    $system->redirect("./?s=system&module=avatars", true);
}
if ($system->confdata('avatar') == '1') {
    $avyes = 'selected';
    $avno = '';
} else {
    $avno = 'selected';
    $avyes = '';
}
$output .= $STYLE->tags($tpl, array(
            "AVYES" => $avyes,
            "AVNO" => $avno,
            "FILESIZE" => $system->confdata('avatar_filesize'),
            "HEIGHT" => $system->confdata('avatar_height'),
            "WIDTH" => $system->confdata('avatar_width'),
            "L_SUBMIT" => L_SUBMIT,
            "L_ENABLED" => L_ENABLED,
            "L_DISABLED" => L_DISABLED,
            "L_AVATAR_SETTINGS" => L_AVATAR_SETTINGS,
            "L_AVATARS" => L_AVATARS,
            "L_AVATARS_MSG" => L_AVATARS_MSG,
            "L_FILESIZE" => L_FILESIZE,
            "L_FILESIZE_MSG" => L_FILESIZE_MSG,
            "L_HEIGHT" => L_HEIGHT,
            "L_HEIGHT_MSG" => L_HEIGHT_MSG,
            "L_WIDTH" => L_WIDTH,
            "L_WIDTH_MSG" => L_WIDTH_MSG
        ));
?>