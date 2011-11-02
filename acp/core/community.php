<?php

/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$tpl = $STYLE->open('acp/community.tpl');
if (isset($_GET['module'])) {
    $module = $secure->clean($_GET['module']);
} else {
    $module = '';
}
if ($module == 'users') {
    include('./core/community-users.php');
} else if ($module == 'groups') {
    include('./core/community-groups.php');
} else if ($module == 'ranks') {
    include('./core/community-ranks.php');
} else if ($module == 'purge-users') {
    if ( ! isset($_POST['confirmed']))
    {
        $system->confirm(L_CONFIRM_PURGE_USERS,L_CONFIRM_PURGE_USERS_MSG,'./?s=community');
    }
    $result = $db->query("DELETE FROM accounts WHERE activated = '0'");
    $count = mysql_affected_rows();
    $system->message(L_PURGE_USERS, str_replace('[COUNT]', $count, L_PURGE_USERS_MESSAGE) , './?s=community', L_CONTINUE);
} else {
    $output .= $STYLE->tags($tpl, array("L_PURGE_USERS" => L_PURGE_USERS, "L_PURGE_USERS_INFO" => L_PURGE_USERS_INFO, "L_BANS" => L_BANS, "L_BANS_INFO" => L_BANS_INFO, "L_COMMUNITY" => L_COMMUNITY, "L_USERS" => L_USERS, "L_USERS_INFO" => L_USERS_INFO, "L_GROUPS" => L_GROUPS, "L_GROUPS_INFO" => L_GROUPS_INFO, "L_RANKS" => L_RANKS, "L_RANKS_INFO" => L_RANKS_INFO));
}
?>
