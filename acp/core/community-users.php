<?php
/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$tpl = $STYLE->open('acp/community-users.tpl');
if (isset($_GET['user_id'])) {
    $user_id = $secure->clean($_GET['user_id']);
    $tpl = str_replace(array($STYLE->getcode('select', $tpl)), '', $tpl);
    $user_data = $db->fetch("SELECT * FROM accounts WHERE id = '$user_id'");
    if (!$user_data) {
        $system->message(L_ERROR, L_USER_NOT_FOUND, './?s=community&amp;module=users', L_CONTINUE);
    }
    if (isset($_POST['avatar-delete'])) {
        unlink('../img/avatars/' . $user_data['id'] . '.png');
        unlink('../img/avatars/' . $user_data['id'] . '.gif');
        unlink('../img/avatars/' . $user_data['id'] . '.jpg');
        unlink('../img/avatars/' . $user_data['id'] . '.jpeg');
        $system->redirect("./?s=users&user_id=" . $user_data['id'] . "");
    }
    if (isset($_POST['Submit'])) {
        if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['rank']) || !isset($_POST['notes']) || !isset($_POST['signature']) || !isset($_POST['status'])) {
            $system->message(L_ERROR, L_INFORMATION_MISSING, './?s=community&amp;module=users&user_id=' . $user_data['id'] . '', L_CONTINUE);
        }
        $name = $secure->clean($_POST['name']);
        $email = $secure->clean($_POST['email']);
        $rank = $secure->clean($_POST['rank']);
        $notes = $secure->clean($_POST['notes']);
        $signature = $secure->clean($_POST['signature']);
        $status = $secure->clean($_POST['status']);
        if (isset($_POST['password'])) {
            $password = $secure->clean($_POST['password']);
        } else {
            $password = $user_data['password'];
        }
        if ($password == '') {
            $password = $user_data['password'];
        } else {
            $password = md5($password);
        }
        $db->query("UPDATE accounts SET name = '$name', email = '$email' , password = '$password', rank = '$rank', notes = '$notes', signature = '$signature', frozen = '$status' WHERE id = '" . $user_data['id'] . "'");
        $system->redirect('./?s=community&module=users&user_id=' . $user_id . '');
    }
    if ($user_data['frozen'] == '1') {
        $active = '';
        $frozen = 'selected';
    } else {
        $active = 'selected';
        $frozen = '';
    }
    $rank_sql = $db->query("SELECT * FROM ranks");
    $rank_select = '';
    while ($row = mysql_fetch_array($rank_sql)) {
        if ($row['id'] == $user_data['rank']) {
            $selected = 'selected';
        } else {
            $selected = '';
        }
        $rank_select .= '<option value="' . $row['id'] . '" ' . $selected . '>' . $system->present($row['name']) . '</option>';
    }
    $output .= $STYLE->tags($tpl, array(
                "AVI" => $user->avatar($user_data['id'], '../'),
                "EMAIL" => $system->present($user_data['email']),
                "NAME" => $system->present($user_data['name']),
                "IP" => $system->present($user_data['ip']),
                "NOTES" => $system->present($user_data['notes']),
                "SIGNATURE" => $system->present($user_data['signature']),
                "ACTIVE" => $active,
                "FROZEN" => $frozen,
                "RANKS" => $rank_select,
                "L_ENABLED" => L_ENABLED,
                "L_DISABLED" => L_DISABLED,
                "L_NAME" => L_NAME,
                "L_EMAIL" => L_EMAIL,
                "L_STATUS" => L_STATUS,
                "L_PASSWORD" => L_PASSWORD,
                "L_IP" => L_IP,
                "L_RANK" => L_RANK,
                "L_EDIT_ACCOUNT" => L_EDIT_ACCOUNT,
                "L_SUBMIT" => L_SUBMIT,
                "L_SIGNATURE" => L_SIGNATURE,
                "L_NOTES" => L_NOTES,
                "L_DELETE" => L_DELETE
            ));
} else {
    $tpl = str_replace(array($STYLE->getcode('edit', $tpl)), '', $tpl);
    if (isset($_POST['account_select'])) {
        $system->redirect('./?s=community&module=users&user_id=' . $secure->clean($_POST['account_select']) . '');
    }
    if (isset($_POST['searchemail'])) {
        $email = $secure->clean($_POST['email']);
        $user_data = $db->fetch("SELECT * FROM accounts WHERE `email` LIKE '$email'");
        if (!$user_data) {
            $system->message(L_ERROR, L_USER_NOT_FOUND, './?s=community&amp;module=users', L_CONTINUE);
        }

        $user_id = $user_data['id'];
        $system->redirect("./?s=community&module=users&user_id=$user_id", true);
    }
    if (isset($_POST['searchname'])) {
        $name = $secure->clean($_POST['name']);
        $user_data = $db->fetch("SELECT * FROM accounts WHERE name LIKE '$name'");
        if (!$user_data) {
            $system->message(L_ERROR, L_USER_NOT_FOUND, './?scommunity&module==users', L_CONTINUE);
        }
        $user_id = $user_data['id'];
        $system->redirect("./?s=community&module=users&user_id=$user_id", true);
    }
    $account_sql = $db->query("SELECT * FROM accounts ORDER BY name");
    $account_select = '';
    while ($row = mysql_fetch_array($account_sql)) {
        $account_select .= '<option value="' . $row['id'] . '">' . $system->present($row['name']) . '</option>';
    }

    $output .= $STYLE->tags($tpl, array("ACCOUNT_SELECT" => $account_select, "L_SUBMIT" => L_SUBMIT, "L_EMAIL" => L_EMAIL, "L_NAME" => L_NAME, "L_USER" => L_USER, "L_SELECT_USER" => L_SELECT_USER, "L_SEARCH_USERS" => L_SEARCH_USERS));
}
?>