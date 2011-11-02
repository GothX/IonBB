<?php
/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$tpl = $STYLE->open('groups.tpl');

if (isset($_GET['view'])) {
    $view = $secure->clean($_GET['view']);
} else {
    $view = '';
}
$limiter = '25';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
if ($page != 1) {
    $start = ($page - 1) * $limiter;
} else {
    $start = 0;
}
if ($view) {
    $tpl = str_replace($STYLE->getcode('normal', $tpl), '', $tpl);
    $group_data = $db->fetch("SELECT * FROM " . $prefix . "_groups WHERE id = '$view'");
    if (!$group_data) {
        $system->message(L_ERROR, L_GROUP_NOT_FOUND, './?s=groups', L_CONTINUE);
    }
    $sql = "SELECT * FROM " . $prefix . "_groups_members WHERE group_id = '$view'";
    $sql_row = $db->query($sql);
    $group_style = '';
    $class = '0';
    while ($row = mysql_fetch_array($sql_row)) {
        $group_style .= $STYLE->tags($STYLE->getcode('row', $tpl), array("CLASS" => $class, "ID" => $row['id'], "NAME" => $user->name($row['account_id']), "JOINED" => $system->time($user->value($row['account_id'], 'joined'))));

        $class = 1 - $class;
    }
    if (!$group_style) {
        $tpl = str_replace($STYLE->getcode('members', $tpl), '', $tpl);
    } else {
        $tpl = str_replace($STYLE->getcode('row', $tpl), $group_style, $tpl);
    }
    $pages = $system->paginate($sql, '10', '?s=groups&view=' . $view . '');
    $tpl = $STYLE->tags($tpl, array("L_MEMBERS" => L_MEMBERS, "L_ID" => L_ID, "L_JOINED" => L_JOINED, "L_NAME" => L_NAME, "L_INFO" => L_INFO, "L_GROUP" => L_GROUP, "GROUP_NAME" => $system->present($group_data['title']), "GROUP_DESCRIPTION" => $system->present($group_data['info'])));
} else {
    $tpl = str_replace($STYLE->getcode('view', $tpl), '', $tpl);
    $sql = "SELECT * FROM " . $prefix . "_groups";
    $sql_row = $db->query($sql);
    $group_style = '';
    $class = '0';
    while ($row = mysql_fetch_array($sql_row)) {
        $group = '<a href="./?s=groups&amp;view=' . $row['id'] . '" class="normfont">' . $system->present($row['title']) . '</a>';
        $group_style .= $STYLE->tags($STYLE->getcode('row', $tpl), array("CLASS" => $class, "ID" => $row['id'], "GROUP" => $group, "INFO" => $system->present($row['info'])));

        $class = 1 - $class;
    }
    $tpl = str_replace($STYLE->getcode('row', $tpl), $group_style, $tpl);
    $pages = $system->paginate($sql, '10', '?s=groups');
    $tpl = $STYLE->tags($tpl, array("L_GROUPS" => L_GROUPS, "L_ID" => L_ID, "L_GROUP" => L_GROUP, "L_INFO" => L_INFO));
}
$output.= $STYLE->tags($tpl, array("PAGINATE" => $pages));
?>