<?php

/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$tpl = $STYLE->open('mail.tpl');
$limiter = $system->confdata('topiclimit');
// Generate Global Menu
$global_menu = $STYLE->getcode('menu', $tpl);
$tpl = str_replace($global_menu, '', $tpl);
$global_menu = $STYLE->tags($global_menu, array("L_INBOX" => L_INBOX, "L_SENTBOX" => L_SENTBOX, "L_NEW" => L_NEW_MAIL));
if (isset($_GET['mode'])) {
    $mode = $secure->clean($_GET['mode']);
} else {
    $mode = '';
}
if ($mode == 'view') {
    if (!isset($_GET['m'])) {
        $system->message(L_ERROR, L_MAIL_ERROR_ID, './?s=mail', L_CONTINUE);
    }
    $tpl = str_replace(array($STYLE->getcode('new', $tpl), $STYLE->getcode('normal', $tpl)), '', $tpl);
    $mail_id = $secure->clean($_GET['m']);
    $mail = $db->fetch("SELECT * FROM " . $prefix . "_mail WHERE id = '$mail_id'");
    // Update Page Title
    $page_title .= ' / <a href="./?s=mail&amp;mode=view&amp;m=' . $mail_id . '" class="normfont">' . $system->present($mail['title']) . '</a>';
    if (!$mail) {
        $system->message(L_ERROR, L_MAIL_ERROR_MISSING, './?s=mail', L_CONTINUE);
    }
    if (!$mail['to_id'] == $account['id'] && $mail['from_id'] == $account['id']) {
        $system->message(L_ERROR, L_MAIL_ERROR_PERMISSION, './?s=mail', L_CONTINUE);
    }
    // Hide Reply from Author
    if ($mail['to_id'] != $account['id']) {
        $tpl = str_replace($STYLE->getcode('reply', $tpl), '', $tpl);
    }
    // Mark As Read
    if ($mail['to_id'] == $account['id'] && $mail['marked'] == '0') {

        $result = $db->query("UPDATE " . $prefix . "_mail SET marked = '1' WHERE id = '$mail_id';");
    }
    if ($mail['to_id'] != $account['id']) {
        $author_id = $mail['to_id'];
    } else {
        $author_id = $mail['from_id'];
    }
    // Send Reply
    if (isset($_POST['Submit']) && isset($_POST['message'])) {
        $system->mail($mail['from_id'], $account['id'], $system->present($mail['title']), $secure->clean($_POST['message']));
        $system->message(L_MAIL, L_MAIL_REPLY, './?s=mail', L_CONTINUE);
    }
    $output .= $STYLE->tags($tpl, array("AVATAR" => $user->avatar($author_id),
                "AUTHOR" => $user->name($author_id),
                "TEXT" => $system->bbcode($mail['text']),
                "RANK" => $user->rank($author_id),
                "STATUS" => $user->status($author_id),
                "ID" => $system->present($mail_id),
                "DATE" => $system->time($mail['date']),
                "TITLE" => $system->present($mail['title']),
                "L_SUBMIT" => L_SUBMIT,
                "L_REPLY" => L_REPLY,
                "L_STATUS" => L_STATUS
            ));
} else if ($mode == 'new') {
    $page_title .= ' / <a href="./?s=mail&amp;mode=new" class="normfont">' . L_NEW_MAIL . '</a>';
    $tpl = str_replace(array($STYLE->getcode('normal', $tpl), $STYLE->getcode('view', $tpl)), '', $tpl);
    if (isset($_POST['Submit'])) {
        // Is Everything Present?
        if (!isset($_POST['title']) || !isset($_POST['message']) || !isset($_POST['user'])) {
            $system->message(L_ERROR, L_INFORMATION_MISSING, './?s=mail', L_CONTINUE);
        }
        // Nothing is Blank
        if ($_POST['title'] == '' || $_POST['message'] == '' || $_POST['user'] == '') {
            $system->message(L_ERROR, L_INFORMATION_MISSING, './?s=mail', L_CONTINUE);
        }
        // Find User
        $user_account = $db->fetch("SELECT * FROM accounts WHERE name LIKE '" . $secure->clean($_POST['user']) . "'");

        if (!$user_account) {
            $system->message(L_ERROR, L_USER_NOT_FOUND, './?s=mail', L_CONTINUE);
        }

        $system->mail($user_account['id'], $account['id'], $secure->clean($_POST['title']), $secure->clean($_POST['message']));
        $system->message(L_SENT, L_MAIL_SENT, './?s=mail', L_CONTINUE);
    }
    if (isset($_GET['user'])) {
        $username = strip_tags($user->name($secure->clean($_GET['user'])));
    } else {
        $username = '';
    }
    $output .= $STYLE->tags($tpl, array("L_SUBMIT" => L_SUBMIT, "L_USER" => L_USER, "L_NEW_MAIL" => L_NEW_MAIL, "L_TITLE" => L_TITLE, "USERNAME" => $username
            ));
} else {
    $tpl = str_replace(array($STYLE->getcode('new', $tpl), $STYLE->getcode('view', $tpl)), '', $tpl);
    if (isset($_POST['delete']) && isset($_POST['checkbox'])) {
        $checkbox = $_POST['checkbox'];
        for ($i = 0; $i < count($checkbox); $i++) {
            $delete_id = $checkbox[$i];
            $result = $db->query("DELETE FROM " . $prefix . "_mail WHERE id = '$delete_id' AND to_id = '" . $account['id'] . "'");
        }
        $system->message(L_DELETED, L_MAIL_SELECTED_DELETED, './?s=mail', L_CONTINUE);
    }
    if ($mode == 'sent') {
        $page_title .= ' / <a href="./?s=mail&amp;mode=sent" class="normfont">' . L_SENTBOX . '</a>';
        $tpl = str_replace($STYLE->getcode('delete', $tpl), '', $tpl);
        $sql = "SELECT * FROM " . $prefix . "_mail WHERE from_id = '" . $account['id'] . "'";
        $relay = "?s=mail";
        $title = L_SENTBOX;
        $to_from = L_TO;
        $box = 'sent';
    } else {
        $page_title .= ' / <a href="./?s=mail" class="normfont">' . L_INBOX . '</a>';
        $sql = "SELECT * FROM " . $prefix . "_mail WHERE to_id = '" . $account['id'] . "'";
        $relay = "?s=mail";
        $title = L_INBOX;
        $to_from = L_FROM;
        $box = 'from';
    }
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
    $paginate = $system->paginate("$sql", "$limiter", "$relay");
    $mail_sql = $db->query("" . $sql . " ORDER BY id DESC LIMIT $start, $limiter;");
    $mail_style = '';
    $class = '0';
    $mail_tpl = $STYLE->getcode('row', $tpl);
    while ($mail_row = mysql_fetch_array($mail_sql)) {
        if ($mail_row['marked'] == '1') {
            $icon = 'normal-read';
        } else {
            $icon = 'normal-unread';
        }
        if ($box == 'sent') {
            $author = $user->name($mail_row['to_id']);
        } else {
            $author = $user->name($mail_row['from_id']);
        }
        $mail_style .= $STYLE->tags($mail_tpl, array("ID" => $mail_row['id'], "ICON" => $icon, "CLASS" => $class, "TITLE" => '<a href="./?s=mail&amp;mode=view&amp;m=' . $mail_row['id'] . '" class="normfont">' . $system->present($mail_row['title']) . '</a>', "DATE" => $system->time($mail_row['date']), "AUTHOR" => $author));

        $class = 1 - $class;
    }
    $tpl = str_replace($mail_tpl, $mail_style, $tpl);
    if (!$mail_style) {
        $system->page(L_EMPTY, L_MAIL_EMPTY);
    }
    $output .= $STYLE->tags($tpl, array("PAGES" => $paginate, "L_TITLE" => $title, "L_TO_FROM" => $to_from, "L_DATE" => L_DATE, "L_MESSAGE" => L_MESSAGE, "L_DELETE" => L_DELETE));
}
?>
