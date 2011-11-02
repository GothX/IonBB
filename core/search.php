<?php

/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$forum = new forum();
$group_id = $user->group($account['id']);
$tpl = $STYLE->open('search.tpl');
$topic_row_tpl = $STYLE->getcode('row', $tpl);
$post_row_tpl = $STYLE->getcode('search_row', $tpl);
$limiter = $system->confdata('topiclimit');
$sql = "SELECT * FROM " . $prefix . "_forums_permission WHERE group_id = '$group_id'";
$result = $db->query("" . $sql . "");
$allowed_forums = "forum_id = '0'";
while ($thisrow = mysql_fetch_array($result)) {
    $forum_id = $thisrow['forum_id'];

    if ($forum->forum_permission($forum_id, $group_id, 'view') == '1') {
        $allowed_forums .= " OR forum_id = '" . $forum_id . "'";
    }
}
if (isset($_GET['mode'])) {
    $mode = $secure->clean($_GET['mode']);
} else {
    $mode = '';
}
if ($mode == 'search') {
    $tpl = str_replace(array($STYLE->getcode('search', $tpl), $STYLE->getcode('new', $tpl)), '', $tpl);
    if (!isset($_GET['term'])) {
        $system->message(L_ERROR, L_INFORMATION_MISSING, './?s=search', L_CONTINUE);
    }
    $term = $secure->clean($_GET['term']);
    $sql = "SELECT * FROM " . $prefix . "_posts WHERE text LIKE '%$term%'";
    $relay = "?s=search&amp;mode=new";
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
    $relay = "?s=search&amp;mode=search&amp;term=$term";
    $paginate = $system->paginate("$sql", "$limiter", "$relay");
    $topic_sql = $db->query("" . $sql . " ORDER BY date DESC LIMIT $start, $limiter;");
    $post_style = '';
    $class = '0';
    while ($topic_row = mysql_fetch_array($topic_sql)) {
        $topic_data = $db->fetch("SELECT * FROM " . $prefix . "_topics WHERE id = '" . $topic_row['topic_id'] . "'");

        if ($forum->forum_permission($topic_data['forum_id'], $group_id, 'view') == '1') {


            $post_style .= $STYLE->tags($post_row_tpl, array(
                        "CLASS" => $class,
                        "TOPIC" => '<a href="./?s=viewtopic&amp;t=' . $topic_data['id'] . '" class="navfont">' . $system->present($topic_data['title']) . '</a>',
                        "TEXT" => $system->bbcode($topic_row['text']),
                        "TOPIC_ID" => $topic_data['id'],
                        "L_VIEW" => L_VIEW
                    ));
            $class = 1 - $class;
        }
    }
    
    if (!$post_style) {
        $system->message(L_ERROR, L_NO_SEARCH_RESULTS, './', L_CONTINUE);
    }
    $tpl = str_replace($post_row_tpl, $post_style, $tpl);
    $output .= $STYLE->tags($tpl, array(
                "PAGINATE" => $paginate,
                "USERS" => $system->viewing($session_location),
                "L_VIEWING" => L_VIEWING
            ));
} else if ($mode == 'new') {
    $timer = time() - 86400;
    $sql = "SELECT * FROM " . $prefix . "_topics WHERE (" . $allowed_forums . ") AND date > '$timer'";
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
    $relay = "?s=search&amp;mode=new";
    $paginate = $system->paginate("$sql", "$limiter", "$relay");
    $topic_sql = $db->query("" . $sql . " ORDER BY sticky DESC, date DESC LIMIT $start, $limiter;");
    $topic_style = '';
    $class = '0';
    $timeout = time() - 43200;
    while ($topic_row = mysql_fetch_array($topic_sql)) {
        if ($account['id']) {
            if ($topic_row['date'] < $timeout) {
                $read = 'read';
            } else {
                $read_status = $db->fetch("SELECT id FROM " . $prefix . "_forums_read WHERE account_id ='" . $account['id'] . "' AND topic_id ='" . $topic_row['id'] . "' AND date > '" . $topic_row['date'] . "'");
                if ($read_status) {
                    $read = 'read';
                } else {
                    $read = 'unread';
                }
            }
        } else {
            $read = 'read';
        }
        if ($topic_row['locked'] == '1') {
            $sticky = 'locked';
        } else {
            if ($topic_row['sticky'] == '2') {
                $sticky = 'announcement';
            } else if ($topic_row['sticky'] == '1') {
                $sticky = 'sticky';
            } else {
                $sticky = 'normal';
            }
        }
        $icon = $sticky . '-' . $read;
        $latest_topic = $db->fetch("SELECT * FROM " . $prefix . "_posts WHERE topic_id = '" . $topic_row['id'] . "' ORDER BY id DESC");
        // Paginate
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
        $pages = $forum->paginate("SELECT * FROM " . $prefix . "_posts WHERE topic_id = '" . $topic_row['id'] . "' ", $system->confdata('postlimit'), '?s=viewtopic&amp;t=' . $topic_row['id'] . '');
        $pnum = mysql_num_rows($db->query($sql));
        $pnum = $pnum - 1;
        $reply_count = mysql_num_rows($db->query("SELECT id FROM " . $prefix . "_posts WHERE topic_id = '" . $topic_row['id'] . "'")) - 1;
        $topic_style .= $STYLE->tags($topic_row_tpl, array(
                    "CLASS" => $class,
                    "PAGES" => $pages,
                    "ICON" => $icon,
                    "TOPIC" => '<a href="./?s=viewtopic&amp;t=' . $topic_row['id'] . '" class="normfont">' . $system->present($topic_row['title']) . '</a>',
                    "AUTHOR" => $user->name($topic_row['author_id']),
                    "REPLIES" => $reply_count,
                    "USER" => $user->name($latest_topic['author_id']),
                    "DATE" => $system->time($latest_topic['date'])));
        $class = 1 - $class;
    }
    if (!$topic_style) {
        $system->message(L_ERROR, L_NO_NEW_POSTS, './', L_CONTINUE);
    }
    $tpl = str_replace($topic_row_tpl, $topic_style, $tpl);
    $tpl = str_replace(array($STYLE->getcode('search', $tpl), $STYLE->getcode('search_results', $tpl)), '', $tpl);
    $output .= $STYLE->tags($tpl, array(
                "PAGINATE" => $paginate,
                "L_FORUM" => L_FORUM,
                "L_TOPIC" => L_TOPIC,
                "L_AUTHOR" => L_AUTHOR,
                "L_LATEST" => L_LATEST,
                "L_REPLIES" => L_REPLIES,
                "USERS" => $system->viewing($session_location),
                "L_VIEWING" => L_VIEWING,
                "L_SUBFORUM" => L_SUBFORUM,
                "L_TOPICS" => L_TOPICS,
                "L_RESULTS" => L_RESULTS
            ));
} else {
    if (isset($_POST['Submit'])) {
        $system->redirect('./?s=search&mode=search&term=' . $secure->clean($_POST['term']));
    }
    $tpl = str_replace(array($STYLE->getcode('new', $tpl), $STYLE->getcode('search_results', $tpl)), '', $tpl);
    $output .= $STYLE->tags($tpl, array(
                "L_SEARCH" => L_SEARCH,
                "L_SUBMIT" => L_SUBMIT
            ));
}
?>
