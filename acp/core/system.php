<?php
/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
if (isset($_GET['module'])) {
    $module = $secure->clean($_GET['module']);
} else {
    $module = '';
}
if ($module == 'configuration') {
    include('./core/system-configuration.php');
} else if ($module == 'forums') {
    include('./core/system-forums.php');
} else if ($module == 'users') {
    include('./core/system-users.php');
} else if ($module == 'avatars') {
    include('./core/system-avatars.php');
} else if ($module == 'extentions') {
    include('./core/system-extentions.php');
    } else if ($module == 'backup') {
    include('./core/system-backup.php');
} else if ($module == 'clear-read') {
    $db->query("DELETE FROM " . $prefix . "_forums_read");
    $system->message(L_UPDATED, L_READ_EMPTY_MSG, './?s=system', L_CONTINUE);
} else if ($module == 'clear-online') {
    $db->query("DELETE FROM online");
    $system->message(L_UPDATED, L_ONLINE_EMPTY_MSG, './?s=system', L_CONTINUE);
} else if ($module == 'force-logout') {
    $db->query("UPDATE " . $prefix . "_confdata SET value = 'kaibb" . rand(0, 999) . "' WHERE name = 'session'");
    $system->message(L_FORCED_LOGOUT, L_FORCED_LOGOUT_MSG, '../', L_CONTINUE);
} else {
    $tpl = $STYLE->open('acp/system.tpl');
    $output .= $STYLE->tags($tpl, array(
        "L_SYSTEM" => L_SYSTEM, 
        "L_CONFIGURATION" => L_CONFIGURATION, 
        "L_CONFIGURATION_INFO" => L_CONFIGURATION_INFO, 
        "L_FORUM_SETTINGS" => L_FORUM_SETTINGS,
        "L_FORUM_SETTINGS_INFO" => L_FORUM_SETTINGS_INFO,
        "L_USER_SETTINGS" => L_USER_SETTINGS,
        "L_USER_SETTINGS_INFO" => L_USER_SETTINGS_INFO,
        "L_AVATAR_SETTINGS" => L_AVATAR_SETTINGS,
        "L_AVATAR_SETTINGS_INFO" => L_AVATAR_SETTINGS_INFO,
        "L_EXTENTIONS" => L_EXTENTIONS,
        "L_EXTENTIONS_INFO" => L_EXTENTIONS_INFO,
        "L_BACKUP" => L_BACKUP,
        "L_BACKUP_INFO" => L_BACKUP_INFO,
        "L_PURGE_TOPIC_STATUS" => L_PURGE_TOPIC_STATUS,
        "L_PURGE_TOPIC_STATUS_INFO" => L_PURGE_TOPIC_STATUS_INFO,
        "L_FORCE_LOGOUT" => L_FORCE_LOGOUT,
        "L_FORCE_LOGOUT_INFO" => L_FORCE_LOGOUT_INFO,
        "L_PURGE_ONLINE" => L_PURGE_ONLINE,
        "L_PURGE_ONLINE_INFO" => L_PURGE_ONLINE_INFO,
        "L_MAINTANENCE" => L_MAINTANENCE     
        ));
}
?>
