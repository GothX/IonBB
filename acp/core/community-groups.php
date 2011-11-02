<?php
/* 
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$tpl = $STYLE->open('acp/community-groups.tpl');
// Redirect
if ( isset($_POST['Submit']) && isset($_POST['group']))
{
    $system->redirect('./?s=community&module=groups&group='.$secure->clean($_POST['group']));
}
 if ( isset($_POST['add-group']) && isset($_POST['name']) && isset($_POST['colour']) && isset($_POST['description']))
    {
        $name = $secure->clean($_POST['name']);
        $info = $secure->clean($_POST['description']);
        $colour = $secure->clean($_POST['colour']);   
        $db->query("INSERT INTO ".$prefix."_groups (title,info,colour) VALUES('$name','$info','$colour')");
        $system->redirect('./?s=community&module=groups');
    }
if ( isset($_GET['group']))
{
    $group_id = $secure->clean($_GET['group']);
    $tpl = str_replace(array($STYLE->getcode('normal', $tpl)), '', $tpl);
    
    $group_data = $db->fetch("SELECT * FROM ".$prefix."_groups WHERE id = '$group_id'");
    
    // Delete Group
    if ( isset($_POST['delete-group']) )
    {
        if ( $group_id  == '1' || $group_id  == '2' || $group_id == '3' || $group_id  == '4')
        {
            $system->message(L_ERROR,L_GROUP_NO_DELETE,'./?s=community&amp;module=groups&amp;group='.$group_id.'',L_CONTINUE);
        }
        $db->query("UPDATE ".$prefix."_groups_members SET group_id = '2' WHERE group_id = '$group_id'"); 
        $db->query("DELETE FROM ".$prefix."_groups WHERE id = '$group_id'");
        $system->redirect('./?s=groups',true);
    }
    
    if ( isset($_POST['Submit']) && isset($_POST['name']) && isset($_POST['colour']) && isset($_POST['description']))
    {
        $name = $secure->clean($_POST['name']);
        $info = $secure->clean($_POST['description']);
        $colour = $secure->clean($_POST['colour']);
        
        $db->query("UPDATE ".$prefix."_groups SET title = '$name', info = '$info', colour = '$colour' WHERE id = '$group_id'");
        $system->redirect('./?s=community&module=groups&group='.$group_id.'',true);
    }
    
    if ( isset($_POST['add']) && isset($_POST['name']))
    {
        $name = $secure->clean($_POST['name']);
        $user_data = $db->fetch("SELECT * FROM accounts WHERE name LIKE '$name'");
        if ( ! $user_data )
        {
            $system->message(L_ERROR,L_USER_NOT_FOUND,'./?s=community&amp;module=groups&amp;group='.$group_id.'',L_CONTINUE);
        }
        
        $db->query("UPDATE ".$prefix."_groups_members SET group_id = '$group_id' WHERE account_id = '".$user_data['id']."'");
        $system->redirect('./?s=community&module=groups&group='.$group_id.'',true);       
    } 
    if ( isset($_POST['remove']) && isset($_POST['members']))
    {
        $user_id = $secure->clean($_POST['members']);
        $db->query("UPDATE ".$prefix."_groups_members SET group_id = '2' WHERE account_id = '".$user_id."'");
        $system->redirect('./?s=community&module=groups&group='.$group_id.'',true);       
    }
    if ( ! $group_data )
    {
        $system->message(L_ERROR,L_GROUP_NOT_FOUND,'./?s=community&amp;module=groups',L_CONTINUE);
    }
    $members_sql = $db->query("SELECT * FROM " . $prefix . "_groups_members WHERE group_id = '$group_id' ORDER BY id");
    $member_select = '';
    while ($row = mysql_fetch_array($members_sql)) {
            $member_select .= '<option value="' . $row['account_id'] . '">' . $user->name($row['account_id']) . ' ( ' . $user->value($row['account_id'],'email') . ' )</option>';    
    }
    $output .= $STYLE->tags($tpl,array("L_DELETE_GROUP" => L_DELETE_GROUP, "L_GROUP_SETTINGS" => L_GROUP_SETTINGS, "L_ADD_MEMBER" => L_ADD_MEMBER, "L_MEMBERS" => L_MEMBERS, "L_ADD" => L_ADD, "L_REMOVE" => L_REMOVE, "L_SUBMIT" => L_SUBMIT, "L_NAME" => L_NAME, "L_TITLE" => L_TITLE, "L_COLOUR" => L_COLOUR, "L_DESCRIPTION" => L_DESCRIPTION, "GROUP_NAME" => $system->present($group_data['title']),"GROUP_COLOUR" => $system->present($group_data['colour']),"GROUP_DESCRIPTION" => $system->present($group_data['info']), "MEMBERS" => $member_select));
    
} else {
    $tpl = str_replace(array($STYLE->getcode('group', $tpl)), '', $tpl);
    // GROUPS
    $group_sql = $db->query("SELECT * FROM " . $prefix . "_groups ORDER BY id");
    $group_select = '';
    while ($row = mysql_fetch_array($group_sql)) {
        $group_select .= '<option value="' . $row['id'] . '">' . $system->present($row['title']) . '</option>';
    }
    $output .= $STYLE->tags($tpl,array("L_NEW_GROUP" => L_NEW_GROUP, "L_TITLE" => L_TITLE, "L_COLOUR" => L_COLOUR, "L_DESCRIPTION" => L_DESCRIPTION, "L_SELECT_GROUP" => L_SELECT_GROUP, "L_SUBMIT" => L_SUBMIT, "GROUPS" => $group_select));
}
?>