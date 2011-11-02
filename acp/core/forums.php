<?php

/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$tpl = $STYLE->open('acp/forums.tpl');
$cat = $STYLE->getcode('category', $tpl);
$for = $STYLE->getcode('row', $tpl);
$out = '';
// ADMIN MENU
$tpl = $STYLE->tags($tpl, array("L_ADD_FORUM" => L_ADD_FORUM, "L_ADD_CATEGORY" => L_ADD_CATEGORY));
$forum = new forum();
if (isset($_GET['mode'])) {
    $mode = $secure->clean($_GET['mode']);
} else {
    $mode = '';
}
// Redirects
if (isset($_POST['edit-category']) && isset($_POST['id'])) {
    $system->redirect('./?s=forums&mode=edit-category&id=' . $secure->clean($_POST['id']) . '');
}
if (isset($_POST['edit-forum']) && isset($_POST['id'])) {
    $system->redirect('./?s=forums&mode=edit-forum&id=' . $secure->clean($_POST['id']) . '');
}
if (isset($_POST['forum-permission']) && isset($_POST['id'])) {
    $system->redirect('./?s=forums&mode=forum-permission&id=' . $secure->clean($_POST['id']) . '');
}
if (isset($_POST['category-permission']) && isset($_POST['id'])) {
    $system->redirect('./?s=forums&mode=category-permission&id=' . $secure->clean($_POST['id']) . '');
}
if ($mode == 'forum-permission' && isset($_GET['id'])) {
    $tpl = str_replace(array($STYLE->getcode('category-permission', $tpl), $STYLE->getcode('normal', $tpl), $STYLE->getcode('new-category', $tpl), $STYLE->getcode('new-forum', $tpl), $STYLE->getcode('edit-category', $tpl), $STYLE->getcode('edit-forum', $tpl)), '', $tpl);
    $id = $secure->clean($_GET['id']);
    $forum_data = $db->fetch("SELECT * FROM ".$prefix."_forums WHERE id = '$id'");
    if (isset($_POST['edit']) && isset($_POST['current-groups'])) {
        $system->redirect('./?s=forums&mode=forum-permission&id=' . $id . '&edit=' . $secure->clean($_POST['current-groups']) . '');
    }
    if (isset($_GET['edit'])) {
        $edit_id = $secure->clean($_GET['edit']);
        $tpl = str_replace(array($STYLE->getcode('groups', $tpl)), '', $tpl);
        $group_data = $db->fetch("SELECT * FROM " . $prefix . "_forums_permission WHERE group_id = '$edit_id' AND forum_id = '$id'");
        if (!$group_data) {
            $system->message(L_ERROR, L_PERMISSION_GROUP_NOT_FOUND, './?s=forums&amp;mode=forum-permission&amp;id=' . $id . '', L_CONTINUE);
        }
        if (isset($_POST['Submit'])) {
            if (!isset($_POST['post']) || !isset($_POST['reply']) || !isset($_POST['poll']) || !isset($_POST['upload']) || !isset($_POST['moderator'])) {
                $system->message(L_ERROR, L_INFORMATION_MISSING, './?s=forums&amp;mode=forum-permission&amp;id=' . $id . '', L_CONTINUE);
            }
            $post = $secure->clean($_POST['post']);
            $reply = $secure->clean($_POST['reply']);
            $poll = $secure->clean($_POST['poll']);
            $upload = $secure->clean($_POST['upload']);
            $moderator = $secure->clean($_POST['moderator']);

            $db->query("UPDATE " . $prefix . "_forums_permission SET post = '$post', reply = '$reply', poll = '$poll', upload = '$upload', moderator = '$moderator' WHERE group_id = '$edit_id' AND forum_id = '$id'");
            $system->redirect('./?s=forums&mode=forum-permission&id=' . $id . '', true);
        }
        if ($group_data['post'] == '1') {
            $postyes = 'selected';
            $postno = '';
        } else {
            $postyes = '';
            $postno = 'selected';
        }
        if ($group_data['reply'] == '1') {
            $replyyes = 'selected';
            $replyno = '';
        } else {
            $replyyes = '';
            $replyno = 'selected';
        }
        if ($group_data['poll'] == '1') {
            $pollyes = 'selected';
            $pollno = '';
        } else {
            $pollyes = '';
            $pollno = 'selected';
        }
        if ($group_data['upload'] == '1') {
            $uploadyes = 'selected';
            $uploadno = '';
        } else {
            $uploadyes = '';
            $uploadno = 'selected';
        }
        if ($group_data['moderator'] == '1') {
            $moderatoryes = 'selected';
            $moderatorno = '';
        } else {
            $moderatoryes = '';
            $moderatorno = 'selected';
        }
        $tpl = $STYLE->tags($tpl, array(
                    "POSTYES" => $postyes,
                    "POSTNO" => $postno,
                    "REPLYYES" => $replyyes,
                    "REPLYNO" => $replyno,
                    "POLLYES" => $pollyes,
                    "POLLNO" => $pollno,
                    "UPLOADYES" => $uploadyes,
                    "UPLOADNO" => $uploadno,
                    "MODERATORYES" => $moderatoryes,
                    "MODERATORNO" => $moderatorno,
                    "L_ENABLED" => L_ENABLED,
                    "L_DISABLED" => L_DISABLED,
                    "L_POST" => L_POST,
                    "L_REPLY" => L_REPLY,
                    "L_POLL" => L_POLL,
                    "L_UPLOAD" => L_UPLOAD,
                    "L_MODERATOR" => L_MODERATOR,
                    "L_SUBMIT" => L_SUBMIT,
                    "L_PERMISSIONS" => L_PERMISSIONS
                ));
    } else {
        $tpl = str_replace(array($STYLE->getcode('group-edit', $tpl)), '', $tpl);
    }
    $group_sql = $db->query("SELECT * FROM " . $prefix . "_groups ORDER BY id");
    $all_select = '';
    $current_select = '';
    $allowed = '';
    while ($row = mysql_fetch_array($group_sql)) {
        if (!$forum->forum_permission($id, $row['id'], 'view')) {
            $all_select .= '<option value="' . $row['id'] . '">' . $system->present($row['title']) . '</option>';
        } else {
            $allowed .= '[ View ]';
            if ($forum->forum_permission($id, $row['id'], 'post')) {
                $allowed .= ' [ Post ]';
            }
            if ($forum->forum_permission($id, $row['id'], 'reply')) {
                $allowed .= ' [ Reply ]';
            }
            if ($forum->forum_permission($id, $row['id'], 'poll')) {
                $allowed .= ' [ Poll ]';
            }
            if ($forum->forum_permission($id, $row['id'], 'upload')) {
                $allowed .= ' [ Upload ]';
            }
            if ($forum->forum_permission($id, $row['id'], 'moderator')) {
                $allowed .= ' [ Moderate ]';
            }
            $current_select .= '<option value="' . $row['id'] . '">' . $system->present($row['title']) . ' - ' . $allowed . '</option>';
        }
        $allowed = '';
    }
    // Add to Allowed
    if (isset($_POST['add']) && isset($_POST['all-groups']) && isset($_POST['level'])) {
        $group = $_POST['all-groups'];
        
        if ( $_POST['level'] == '1' || $group == '1')
        {
            $view = '1';
            $post = '0';
            $reply='0';
            $poll = '0';
            $upload = '0';
            $moderator = '0';
        } else if ( $_POST['level'] == '2' )
        {
            $view = '1';
            $post = '1';
            $reply='1';
            $poll = '0';
            $upload = '0';
            $moderator = '0';
        } else if ( $_POST['level'] == '3' )
        {
            $view = '1';
            $post = '1';
            $reply='1';
            $poll = '1';
            $upload = '1';
            $moderator = '0';
        } else if ( $_POST['level'] == '4' )
        {
            $view = '1';
            $post = '1';
            $reply='1';
            $poll = '1';
            $upload = '1';
            $moderator = '1';
        }
        $db->query("INSERT INTO " . $prefix . "_forums_permission (group_id,forum_id,view,post,reply,poll,upload,moderator) VALUES ('" . $group . "','" . $id . "','$view','$post','$reply','$poll','$upload','$moderator')");
        $system->redirect('./?s=forums&mode=forum-permission&id=' . $id . '', true);
    }
    // Remove from Allowed
    if (isset($_POST['remove']) && isset($_POST['current-groups'])) {
        $group = $_POST['current-groups'];
        $db->query("DELETE FROM " . $prefix . "_forums_permission WHERE group_id = '$group' AND forum_id = '$id'");
        $system->redirect('./?s=forums&mode=forum-permission&id=' . $id . '', true);
    }
    $output .= $STYLE->tags($tpl, array("L_LIMITED" => L_LIMITED, "L_NORMAL" => L_NORMAL, "L_FULL" => L_FULL, "L_MODERATOR" => L_MODERATOR, "L_EDIT" => L_EDIT, "ALL_GROUPS" => $all_select, "CURRENT_GROUPS" => $current_select, "L_ADD" => L_ADD, "L_REMOVE" => L_REMOVE, "L_GROUP_LIST" => L_GROUP_LIST, "L_CURRENT_GROUPS" => L_CURRENT_GROUPS, "FORUM_NAME" => $system->present($forum_data['name'])));
} else
if ($mode == 'category-permission' && isset($_GET['id'])) {
    $tpl = str_replace(array($STYLE->getcode('forum-permission', $tpl), $STYLE->getcode('normal', $tpl), $STYLE->getcode('new-category', $tpl), $STYLE->getcode('new-forum', $tpl), $STYLE->getcode('edit-category', $tpl), $STYLE->getcode('edit-forum', $tpl)), '', $tpl);
    $id = $secure->clean($_GET['id']);
    $category_data = $db->fetch("SELECT * FROM " . $prefix . "_categories WHERE id = '$id'");
    $group_sql = $db->query("SELECT * FROM " . $prefix . "_groups ORDER BY id");
    $all_select = '';
    $current_select = '';
    while ($row = mysql_fetch_array($group_sql)) {
        if (!$forum->category_permission($id, $row['id'], 'view')) {
            $all_select .= '<option value="' . $row['id'] . '">' . $system->present($row['title']) . '</option>';
        } else {
            $current_select .= '<option value="' . $row['id'] . '">' . $system->present($row['title']) . '</option>';
        }
    }
    // Add to Allowed
    if (isset($_POST['add']) && isset($_POST['all-groups'])) {

        $group = $_POST['all-groups'];
        $db->query("INSERT INTO " . $prefix . "_categories_permission (group_id,category_id,view) VALUES ('" . $group . "','" . $id . "','1')");
        $system->redirect('./?s=forums&mode=category-permission&id=' . $id . '', true);
    }
    // Remove from Allowed
    if (isset($_POST['remove']) && isset($_POST['current-groups'])) {
        $group = $_POST['current-groups'];
        $db->query("DELETE FROM " . $prefix . "_categories_permission WHERE group_id = '$group' AND category_id = '$id'");
        $system->redirect('./?s=forums&mode=category-permission&id=' . $id . '', true);
    }
    $output .= $STYLE->tags($tpl, array("ALL_GROUPS" => $all_select, "CURRENT_GROUPS" => $current_select, "L_ADD" => L_ADD, "L_REMOVE" => L_REMOVE, "L_GROUP_LIST" => L_GROUP_LIST, "L_CURRENT_GROUPS" => L_CURRENT_GROUPS, "CATEGORY_NAME" => $system->present($category_data['name'])));
} else if ($mode == 'new-forum') {
    $tpl = str_replace(array($STYLE->getcode('forum-permission', $tpl), $STYLE->getcode('category-permission', $tpl), $STYLE->getcode('normal', $tpl), $STYLE->getcode('new-category', $tpl), $STYLE->getcode('edit-category', $tpl), $STYLE->getcode('edit-forum', $tpl)), '', $tpl);
    if (isset($_POST['Submit'])) {
        if (isset($_POST['name'])) {
            $name = $secure->clean($_POST['name']);
        } else {
            $name = '';
        }
        if (isset($_POST['category'])) {
            $category = $secure->clean($_POST['category']);
        } else {
            $category = '';
        }
        if (isset($_POST['parent'])) {
            $parent = $secure->clean($_POST['parent']);
        } else {
            $parent = '';
        }
        if (isset($_POST['info'])) {
            $info = $secure->clean($_POST['info']);
        } else {
            $info = '';
        }
        if (!$name || !$info || !$category || $parent == '') {
            $system->message(L_ERROR, L_INFORMATION_MISSING, './?s=forums&amp;mode=new-forum', L_CONTINUE);
        }
        if ($parent != '0') {
            $parent_forum = $db->fetch("SELECT * FROM " . $prefix . "_forums WHERE id = '$parent'");
            $category = $parent_forum['cat_id'];
        }
        $second = $db->fetch("SELECT * FROM " . $prefix . "_forums WHERE cat_id = '$category' ORDER BY sort DESC LIMIT 1;");
        $sort = $second['sort'] + 1;
        $db->query("INSERT INTO " . $prefix . "_forums (name, cat_id, info, parent_id, sort)
VALUES ('$name','$category','$info', '$parent', '$sort')");
        $system->message(L_SUBMITTED, L_ADMIN_FORUM_ADDED, './?s=forums', L_CONTINUE);
    }
    // Categories List
    $category_sql = $db->query("SELECT * FROM " . $prefix . "_categories ORDER BY sort");
    $category_select = '';
    while ($row = mysql_fetch_array($category_sql)) {
        $category_select .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
    // Forums List
    $forum_sql = $db->query("SELECT * FROM " . $prefix . "_forums WHERE parent_id = '0' ORDER BY sort");
    $forum_select = '<option value="0">' . L_NONE . '</option>';
    while ($row = mysql_fetch_array($forum_sql)) {
        $forum_select .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
    $output .= $STYLE->tags($tpl, array("CATEGORIES" => $category_select, "FORUMS" => $forum_select, "L_ADD_FORUM" => L_ADD_FORUM, "L_NAME" => L_NAME, "L_INFO" => L_INFO, "L_CATEGORY" => L_CATEGORY, "L_PARENT" => L_PARENT, "L_SUBMIT" => L_SUBMIT, "L_ENABLED" => L_ENABLED, "L_DISABLED" => L_DISABLED));
} else if ($mode == 'new-category') {
    $tpl = str_replace(array($STYLE->getcode('forum-permission', $tpl), $STYLE->getcode('category-permission', $tpl), $STYLE->getcode('normal', $tpl), $STYLE->getcode('new-forum', $tpl), $STYLE->getcode('edit-forum', $tpl), $STYLE->getcode('edit-category', $tpl)), '', $tpl);
    if (isset($_POST['Submit'])) {
        if (isset($_POST['name'])) {
            $name = $secure->clean($_POST['name']);
        } else {
            $name = '';
        }
        if (!$name) {
            $system->message(L_ERROR, L_INFORMATION_MISSING, './?s=forums&amp;mode=new-category', L_CONTINUE);
        }
        $second = $db->fetch("SELECT * FROM " . $prefix . "_categories ORDER BY sort DESC LIMIT 1;");
        $sort = $second['sort'] + 1;
        $db->query("INSERT INTO " . $prefix . "_categories (name, sort)
VALUES ('$name','$sort')");
        $system->message(L_SUBMITTED, L_ADMIN_CATEGORY_ADDED, './?s=forums', L_CONTINUE);
    }
    $output .= $STYLE->tags($tpl, array("L_SUBMIT" => L_SUBMIT, "L_ADD_CATEGORY" => L_ADD_CATEGORY, "L_NAME" => L_NAME));
} else if ($mode == 'edit-category') {
    $tpl = str_replace(array($STYLE->getcode('forum-permission', $tpl), $STYLE->getcode('category-permission', $tpl), $STYLE->getcode('normal', $tpl), $STYLE->getcode('edit-forum', $tpl), $STYLE->getcode('new-category', $tpl), $STYLE->getcode('new-forum', $tpl)), '', $tpl);

    if (isset($_GET['id'])) {
        $id = $secure->clean($_GET['id']);
    } else {
        $system->message(L_ERROR, L_ID_MISSING, './?s=forums', L_CONTINUE);
    }
    if (isset($_POST['Submit'])) {
        if (!isset($_POST['name'])) {
            $system->message(L_ERROR, L_INFORMATION_MISSING, './?s=forums', L_CONTINUE);
        }
        $name = $secure->clean($_POST['name']);
        $db->query("UPDATE " . $prefix . "_categories SET name = '$name' WHERE id = '$id'");
        $system->redirect('./?s=forums', true);
    }
    $category = $db->fetch("SELECT * FROM " . $prefix . "_categories WHERE id = '$id'");
    $output .= $STYLE->tags($tpl, array("L_NAME" => L_NAME, "L_SUBMIT" => L_SUBMIT, "L_EDIT_CATEGORY" => L_EDIT_CATEGORY, "NAME" => $system->present($category['name'])));
} else if ($mode == 'edit-forum') {
    $tpl = str_replace(array($STYLE->getcode('forum-permission', $tpl), $STYLE->getcode('category-permission', $tpl), $STYLE->getcode('normal', $tpl), $STYLE->getcode('new-category', $tpl), $STYLE->getcode('edit-category', $tpl), $STYLE->getcode('new-forum', $tpl)), '', $tpl);
    if (isset($_GET['id'])) {
        $id = $secure->clean($_GET['id']);
    } else {
        $system->message(L_ERROR, L_ID_MISSING, './?s=forums', L_CONTINUE);
    }
    if (isset($_POST['Submit'])) {
        if (isset($_POST['name'])) {
            $name = $secure->clean($_POST['name']);
        } else {
            $name = '';
        }
        if (isset($_POST['category'])) {
            $category = $secure->clean($_POST['category']);
        } else {
            $category = '';
        }
        if (isset($_POST['parent'])) {
            $parent = $secure->clean($_POST['parent']);
        } else {
            $parent = '';
        }
        if (isset($_POST['info'])) {
            $info = $secure->clean($_POST['info']);
        } else {
            $info = '';
        }
        if (!$name || !$info || !$category || $parent == '') {
            $system->message(L_ERROR, L_INFORMATION_MISSING, './?s=forums&amp;mode=new-forum', L_CONTINUE);
        }
        if ($parent != '0') {
            $parent_forum = $db->fetch("SELECT * FROM " . $prefix . "_forums WHERE id = '$parent'");
            $category = $parent_forum['cat_id'];
        }
        $db->query("UPDATE " . $prefix . "_forums SET name = '$name', cat_id = '$category', info = '$info', parent_id = '$parent' WHERE id = '$id'");
        $system->redirect('./?s=forums', true);
    }
    $forum = $db->fetch("SELECT * FROM " . $prefix . "_forums WHERE id = '$id'");
    if (!$forum) {
        $system->message(L_ERROR, L_FORUM_NOT_FOUND, './?s=forums', L_CONTINUE);
    }
    // Categories List
    $category_sql = $db->query("SELECT * FROM " . $prefix . "_categories ORDER BY sort");
    $category_select = '';
    while ($row = mysql_fetch_array($category_sql)) {
        if ($row['id'] == $forum['cat_id']) {
            $checked = 'selected';
        } else {
            $checked = '';
        }
        $category_select .= '<option value="' . $row['id'] . '" ' . $checked . '>' . $row['name'] . '</option>';
    }
    // Forums List
    $forum_sql = $db->query("SELECT * FROM " . $prefix . "_forums WHERE parent_id = '0' ORDER BY sort");
    $forum_select = '<option value="0">' . L_NONE . '</option>';
    while ($row = mysql_fetch_array($forum_sql)) {
        if ($row['id'] == $forum['parent_id']) {
            $checked = 'selected';
        } else {
            $checked = '';
        }
        $forum_select .= '<option value="' . $row['id'] . '" ' . $checked . '>' . $row['name'] . '</option>';
    }
    $output .= $STYLE->tags($tpl, array("NAME" => $system->present($forum['name']), "INFO" => $system->present($forum['info']), "CATEGORIES" => $category_select, "FORUMS" => $forum_select, "L_EDIT_FORUM" => L_EDIT_FORUM, "L_NAME" => L_NAME, "L_INFO" => L_INFO, "L_CATEGORY" => L_CATEGORY, "L_PARENT" => L_PARENT, "L_SUBMIT" => L_SUBMIT, "L_ENABLED" => L_ENABLED, "L_DISABLED" => L_DISABLED));
} else {
    $tpl = str_replace(array($STYLE->getcode('forum-permission', $tpl), $STYLE->getcode('category-permission', $tpl), $STYLE->getcode('new-forum', $tpl), $STYLE->getcode('new-category', $tpl), $STYLE->getcode('edit-forum', $tpl), $STYLE->getcode('edit-category', $tpl)), '', $tpl);
    //// Empty Forum
    if (isset($_POST['empty'])) {
        $d = $secure->clean($_POST['id']);
        $postsql = $db->query("SELECT * FROM " . $prefix . "_topics WHERE forum_id = '$d';");
        $class = 0;
        while ($row = mysql_fetch_array($postsql)) {
            $id = $row['id'];
            $db->query("DELETE FROM " . $prefix . "_posts WHERE topic_id = '$id'");
            $db->query("DELETE FROM " . $prefix . "_forums_read WHERE topic_id = '$id'");
        }
        $db->query("DELETE FROM " . $prefix . "_topics WHERE forum_id = '$d'");
        $system->redirect("?s=forums", true);
    }
    //// SORT CATEGORY
    if (isset($_POST['catup'])) {
        $up = $secure->clean($_POST['id']);
        $forum = $db->fetch("SELECT * FROM " . $prefix . "_categories WHERE id = $up;");
        $sort = $forum['sort'];
        $second = $db->fetch("SELECT * FROM " . $prefix . "_categories WHERE sort < '$sort' ORDER BY sort DESC LIMIT 1;");
        if ($second) {
            $secondid = $second['id'];
            $secondsort = $second['sort'];
            $db->query("UPDATE " . $prefix . "_categories SET sort = '$sort' WHERE id = '$secondid';");
            $db->query("UPDATE " . $prefix . "_categories SET sort = '$secondsort' WHERE id = '$up';");
        }
        $system->redirect("?s=forums");
    }
    if (isset($_POST['catdown'])) {
        $down = $secure->clean($_POST['id']);
        $forum = $db->fetch("SELECT * FROM " . $prefix . "_categories WHERE id = $down;");
        $sort = $forum['sort'];
        $second = $db->fetch("SELECT * FROM " . $prefix . "_categories WHERE sort > '$sort' ORDER BY sort LIMIT 1;");
        if ($second) {
            $secondid = $second['id'];
            $secondsort = $second['sort'];
            $db->query("UPDATE " . $prefix . "_categories SET sort = '$sort' WHERE id = '$secondid';");
            $db->query("UPDATE " . $prefix . "_categories SET sort = '$secondsort' WHERE id = '$down';");
        }
        $system->redirect("?s=forums");
    }
    // DELETE CATEGORY
    if (isset($_POST['catdel'])) {
        $d = $secure->clean($_POST['id']);
        $db->query("DELETE FROM " . $prefix . "_categories WHERE id = '$d'");
        $forum = $db->fetch("SELECT * FROM " . $prefix . "_forums WHERE cat_id = '$d';");
        if ($forum) {
            $id = $forum['id'];
            $postsql = $db->query("SELECT * FROM " . $prefix . "_topics WHERE forum_id = '$id';");
            while ($row = mysql_fetch_array($postsql)) {
                $id = $row['id'];
                $db->query("DELETE FROM " . $prefix . "_posts WHERE topic_id = '$id'");
            }
            $db->query("DELETE FROM " . $prefix . "_topics WHERE forum_id = '$d'");
            $db->query("DELETE FROM " . $prefix . "_forums WHERE cat_id = '$d'");
        }
        $system->redirect("?s=forums", true);
    }
    //// SORT FORUM
    if (isset($_POST['up'])) {
        $up = $secure->clean($_POST['id']);
        $forum_data = $db->fetch("SELECT * FROM " . $prefix . "_forums WHERE id = $up;");
        $sort = $forum_data['sort'];
        $cat = $forum_data['cat_id'];
        if ($sort != '0' && $sort != '1') {
            $new_sort = $sort - 1;
            $second = $db->fetch("SELECT * FROM " . $prefix . "_forums WHERE sort < '$sort' AND cat_id = '$cat' ORDER BY sort DESC LIMIT 1;");
            if ($second) {
                $new_sort = $forum_data['sort'] - 1;
                $db->query("UPDATE " . $prefix . "_forums SET sort = '$new_sort' WHERE id = '$up';");
                $second_new_sort = $second['sort'] + 1;
                $second_result = $db->query("UPDATE " . $prefix . "_forums SET sort = '$second_new_sort' WHERE id = '" . $second['id'] . "';");
            }
        }
        $system->redirect('./?s=forums');
    }
    if (isset($_POST['down'])) {
        $down = $secure->clean($_POST['id']);
        $forum_data = $db->fetch("SELECT * FROM " . $prefix . "_forums WHERE id = $down;");
        $sort = $forum_data['sort'];
        $cat = $forum_data['cat_id'];
        if ($sort != '0' && $sort != '1') {
            $second = $db->fetch("SELECT * FROM " . $prefix . "_forums WHERE sort > '$sort' AND cat_id = '$cat' ORDER BY sort LIMIT 1;");
            if ($second) {
                $new_sort = $forum_data['sort'] + 1;
                $db->query("UPDATE " . $prefix . "_forums SET sort = '" . $second['sort'] . "' WHERE id = '$down';");
                $second_new_sort = $second['sort'] - 1;
                $second_result = $db->query("UPDATE " . $prefix . "_forums SET sort = '" . $forum_data['sort'] . "' WHERE id = '" . $second['id'] . "';");
            }
        }
        $system->redirect('./?s=forums');
    }
    // DELETE FORUM
    if (isset($_POST['delete'])) {
        $d = $secure->clean($_POST['id']);
        $db->query("DELETE FROM " . $prefix . "_forums WHERE id = '$d'");
        $postsql = $db->query("SELECT * FROM " . $prefix . "_topics WHERE forum_id = '$d';");
        $class = 0;
        while ($row = mysql_fetch_array($postsql)) {
            $id = $row['id'];
            $db->query("DELETE FROM " . $prefix . "_posts WHERE topic_id = '$id'");
        }
        $db->query("DELETE FROM " . $prefix . "_topics WHERE forum_id = '$d'");
        $system->redirect("?s=forums", true);
    }
    //// GENERATE LIST
    $sql = $db->query("SELECT * FROM " . $prefix . "_categories ORDER BY sort");
    while ($catrow = mysql_fetch_array($sql)) {
        $id = $catrow['id'];
        $out .= $STYLE->tags($cat, array("TITLE" => $system->present($catrow['name']), "ID" => $id));
        $postsql = $db->query("SELECT * FROM  " . $prefix . "_forums WHERE cat_id = '$id' ORDER BY sort;");
        $class = 0;
        while ($row = mysql_fetch_array($postsql)) {
            $title = '<a href="../?area=forum&amp;s=forum&amp;f=' . $row['id'] . '" class="normfont" target="_blank">' . stripslashes($row['name']) . '</a>';
            $out .= $STYLE->tags($for, array("TITLE" => $title, "ID" => $row['id'], "INFO" => $system->bbcode($row['info']), "CLASS" => $class));
            $class = 1 - $class;
        }
    }
    $tpl = str_replace($cat, '', $tpl);
    $tpl = str_replace($for, $out, $tpl);
    $output .= $STYLE->tags($tpl, array("L_PERMISSIONS" => L_PERMISSIONS, "L_UP" => L_UP, "L_DOWN" => L_DOWN, "L_DELETE" => L_DELETE, "L_EDIT" => L_EDIT, "L_EMPTY" => L_EMPTY));
}
?>