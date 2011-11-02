<?php
/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$forum = new forum();
$tpl = $STYLE->open('home.tpl');
// Generate Global Menu
$global_menu = $STYLE->getcode('menu', $tpl);
$tpl = str_replace($global_menu, '', $tpl);
$global_menu = $STYLE->tags($global_menu, array("L_SEARCH" => L_SEARCH, "L_NEW_POSTS" => L_NEW_POSTS));
// Sort Style Data
$cat = $STYLE->getcode('category', $tpl);
$for = $STYLE->getcode('row', $tpl);
$break = $STYLE->getcode('break', $tpl);
$category_end = $STYLE->getcode('category_end', $tpl);
$tpl = str_replace(array($break, $for, $category_end), '', $tpl);
$content = '';
$forum_style = '';
$class = '0';
$category_sql = $db->query("SELECT * FROM " . $prefix . "_categories ORDER BY sort");
while ($category_row = mysql_fetch_array($category_sql)) {
    // Check if Category allowed?
    if ($forum->category_permission($category_row['id'], $group_id, 'view') == '1') {
        $forum_sql = $db->query("SELECT * FROM " . $prefix . "_forums WHERE cat_id = " . $category_row['id'] . " AND parent_id = '0'  ORDER BY sort");
        while ($forum_row = mysql_fetch_array($forum_sql)) {
            // Check if forum allowed?
            if ($forum->forum_permission($forum_row['id'], $group_id, 'view') == '1') {
                // Check for Sub Forums
                $subforum = '';
                $sub_forum_sql = $db->query("SELECT * FROM " . $prefix . "_forums WHERE parent_id = '" . $forum_row['id'] . "'");
                $topic_number = '';
                $topic_number = mysql_num_rows($db->query("SELECT * FROM " . $prefix . "_topics WHERE forum_id='" . $forum_row['id'] . "' ORDER BY date DESC;"));
                while ($sub_forum_row = mysql_fetch_array($sub_forum_sql)) {
                    // Check if sub forum allowed?
                    if ($forum->forum_permission($sub_forum_row['id'], $group_id, 'view') == '1') {
                        $subforum_topic_number = mysql_num_rows($db->query("SELECT * FROM " . $prefix . "_topics WHERE forum_id='" . $sub_forum_row['id'] . "' ORDER BY date DESC;"));
                        $topic_number = $topic_number + $subforum_topic_number;
                        $subforum .= '<a href="./?s=viewforum&amp;f=' . $sub_forum_row['id'] . '" class="normfont" style="font-style: italic">' . $system->present($sub_forum_row['name']) . '</a> ';
                    }
                }
                if ($subforum) {
                    $subforum = L_SUBFORUM . ': ' . $subforum . '<br />';
                }
                // Find Moderators
                $moderator_sql = $db->query("SELECT * FROM " . $prefix . "_forums_permission WHERE forum_id = '" . $forum_row['id'] . "' AND moderator = '1' ORDER BY group_id DESC");
                $moderators = '';
                while ($moderator_row = mysql_fetch_array($moderator_sql)) {
                    $moderators .= ' ' . $system->group($moderator_row['group_id']);
                }
                if ($moderators) {
                    $moderators = L_MODERATORS . ': ' . $moderators;
                }
                $topic_sql = $db->query("SELECT * FROM " . $prefix . "_topics WHERE forum_id='" . $forum_row['id'] . "' ORDER BY date DESC;");
                if ($topic_row = mysql_fetch_array($topic_sql)) {
                    $post_sql = $db->fetch("SELECT * FROM " . $prefix . "_posts WHERE topic_id = '" . $topic_row['id'] . "' ORDER BY id DESC LIMIT 1;");
                    $author = $user->name($post_sql['author_id']);
                    $topic = '<a href="./?s=viewtopic&amp;t=' . $topic_row['id'] . '" class="normfont">' . $system->present($topic_row['title']) . '</a><br />' . $author . '<br /> ' . $system->time($topic_row['date']) . '';
                } else {
                    $topic = L_EMPTY;
                }
                if (!$account) {
                    $read = 'read';
                } else {
                    $row = mysql_fetch_array($db->query("SELECT * FROM " . $prefix . "_topics WHERE forum_id = '" . $forum_row['id'] . "' ORDER BY date DESC;"));
                    $timeout = time() - 43200;
                    if ($row['date'] < $timeout) {
                        $read = 'read';
                    } else {
                        ;
                        $read_row = mysql_fetch_array($db->query("SELECT * FROM " . $prefix . "_forums_read WHERE account_id ='" . $account['id'] . "' AND topic_id ='" . $row['id'] . "' AND date > '" . $row['date'] . "' "));

                        if ($read_row) {
                            $read = 'read';
                        } else {
                            $read = 'unread';
                        }
                    }
                }
                $forum_style .= $STYLE->tags($for, array("MODERATORS" => $moderators, "ICON" => $read, "TOPIC" => $topic, "TOPIC_COUNT" => $topic_number, "SUB" => $subforum, "INFO" => $system->bbcode($forum_row['info']), "CLASS" => $class, "FORUM" => '<a href="./?s=viewforum&amp;f=' . $forum_row['id'] . '" class="normfont">' . stripslashes($forum_row['name']) . '</a>'));
            }
            $class = 1 - $class;
        }
        $category_style = $STYLE->tags($cat, array("NAME" => $category_row['name']));
        $content .= $category_style . $forum_style . $category_end . $break;
    }
    $forum_style = '';
}
$user_count = mysql_num_rows($db->query("SELECT id FROM accounts"));
$topic_count = mysql_num_rows($db->query("SELECT id FROM " . $prefix . "_topics"));
$post_count = mysql_num_rows($db->query("SELECT id FROM " . $prefix . "_posts"));
$stats = str_replace(array('[USERS]', '[TOPICS]', '[POSTS]'), array($user_count, $topic_count, $post_count), L_FORUM_STATS);
$tpl = str_replace($cat, $content, $tpl);
$user_online_sql = $db->query("SELECT DISTINCT account_id FROM online WHERE account_id != '-1';");
$users = '';
while ($user_online_row = mysql_fetch_array($user_online_sql)) {
    $users .= $user->name($user_online_row['account_id']) . ' ';
}
if (!$users) {
    $users = L_NONE;
}
$output .= $STYLE->tags($tpl, array("L_STATS" => $stats, "L_FORUM" => L_FORUM, "L_TOPICS" => L_TOPICS, "L_LATEST" => L_LATEST, "L_SUMMARY" => L_SUMMARY, "L_ONLINE" => L_ONLINE, "ONLINE_STATS" => $users));
?>