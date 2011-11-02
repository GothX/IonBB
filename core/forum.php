<?php

/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$forum = new forum();
$tpl = $STYLE->open('forum.tpl');
// Generate Global Menu
$global_menu = $STYLE->getcode('menu', $tpl);
$tpl = str_replace($global_menu, '', $tpl);
// Find Your Group
$group_id = $user->group($account['id']);
// Get Mode
if (isset($_GET['mode'])) {
    $mode = $secure->clean($_GET['mode']);
} else {
    $mode = '';
}
if (!isset($_GET['f'])) {
    $system->message(L_ERROR, L_FORUM_ERROR_ID, './', L_CONTINUE);
}
$forum_id = $secure->clean($_GET['f']);
$global_menu = $STYLE->tags($global_menu, array("FORUM_ID" => $forum_id, "L_NEW" => L_NEW_TOPIC));
$forum_data = $db->fetch("SELECT * FROM " . $prefix . "_forums WHERE id = '$forum_id'");
$page_title .= ' <a href="' . $siteaddress . '?s=viewforum&amp;f=' . $forum_id . '" class="normfont">' . $system->present($forum_data['name']) . '</a>';
if (!$forum_data) {
    $system->message(L_ERROR, L_FORUM_NOT_FOUND, './', L_CONTINUE);
}
// Check if Allowed
if ($forum->category_permission($forum_data['cat_id'], $group_id, 'view') != '1' || $forum->forum_permission($forum_data['id'], $group_id, 'view') != '1') {
    $system->message(L_ERROR, L_PERMISSION_ERROR_AREA, './', L_CONTINUE);
}
$topic_row_tpl = $STYLE->getcode('row', $tpl);
if ($mode == 'new') {
    // Prevent Flooding
    if (time() < $account['lastpost'] + $system->confdata('anti_flood')) {
        $system->message(L_ERROR, L_FLOOD_ERROR, './?s=viewforum&amp;f=' . $forum_id . '', L_CONTINUE);
    }

    if ($forum->forum_permission($forum_data['id'], $group_id, 'post') != '1') {
        $system->message(L_ERROR, L_PERMISSION_ERROR_ACTION, './', L_CONTINUE);
    }
    if (isset($_POST['Submit'])) {
        // Sanitise Input
        if (isset($_POST['title'])) {
            $title = $secure->clean($_POST['title']);
        } else {
            $title = '';
        }
        if (isset($_POST['message'])) {
            $message = $secure->clean($_POST['message']);
        } else {
            $message = '';
        }
        // Insert Topic
        if (!$title || !$message) {
            $system->message(L_ERROR, L_INFORMATION_MISSING, './?s=viewforum&amp;f=' . $forum_id . '', L_CONTINUE);
        }

        // Attachment
        if (isset($_FILES['attachment']['name']) && $forum->forum_permission($forum_data['id'], $group_id, 'upload') == '1') {
            $attachment_id = $forum->attachment($_FILES['attachment']['name'], 'forum', $forum_id);
        } else {
            $attachment_id = '0';
        }

        $insert_topic = $db->query("INSERT INTO " . $prefix . "_topics (author_id,title,forum_id,date) VALUES ('" . $account['id'] . "','$title','$forum_id',UNIX_TIMESTAMP())");
        $select_topic = $db->fetch("SELECT * FROM " . $prefix . "_topics WHERE author_id = '" . $account['id'] . "' ORDER BY id DESC") or die(mysql_error());
        $topic_id = $select_topic['id'];
        $insert_post = $db->query("INSERT INTO " . $prefix . "_posts (author_id,text,topic_id,date,attachment) VALUES ('" . $account['id'] . "', '$message', '$topic_id',UNIX_TIMESTAMP(),'$attachment_id')");

        if ($forum->forum_permission($forum_data['id'], $group_id, 'poll') == '1' && $_POST['question'] && $_POST['option1'] && $_POST['option2']) {



            $question = $secure->clean($_POST['question']);

            $db->query("INSERT INTO " . $prefix . "_polls (topic_id,question) VALUE ('$topic_id','$question')");
            $poll = $db->fetch("SELECT * FROM " . $prefix . "_polls WHERE topic_id = '$topic_id'");

            if (isset($_POST['option1']) && $_POST['option1'] != '') {
                $option = $secure->clean($_POST['option1']);
                $db->query("INSERT INTO " . $prefix . "_polls_option (poll_id,value) VALUE ('" . $poll['id'] . "','$option')");
            }

            if (isset($_POST['option2']) && $_POST['option2'] != '') {
                $option = $secure->clean($_POST['option2']);
                $db->query("INSERT INTO " . $prefix . "_polls_option (poll_id,value) VALUE ('" . $poll['id'] . "','$option')");
            }

            if (isset($_POST['option3']) && $_POST['option3'] != '') {
                $option = $secure->clean($_POST['option3']);
                $db->query("INSERT INTO " . $prefix . "_polls_option (poll_id,value) VALUE ('" . $poll['id'] . "','$option')");
            }
            if (isset($_POST['option4']) && $_POST['option4'] != '') {
                $option = $secure->clean($_POST['option4']);
                $db->query("INSERT INTO " . $prefix . "_polls_option (poll_id,value) VALUE ('" . $poll['id'] . "','$option')");
            }
            if (isset($_POST['option5']) && $_POST['option5'] != '') {
                $option = $secure->clean($_POST['option5']);
                $db->query("INSERT INTO " . $prefix . "_polls_option (poll_id,value) VALUE ('" . $poll['id'] . "','$option')");
            }
        }
        // Run Event
        $forum->event('newtopic');
        $system->message(L_SUBMITTED, L_TOPIC_SUBMITTED, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
    } else {
        // Only Show New Topic
        $tpl = str_replace($STYLE->getcode('normal', $tpl), '', $tpl);
        // Display Attachment Form
        if ($forum->forum_permission($forum_data['id'], $group_id, 'upload') == '1') {
            $attachment = 'block';
        } else {
            $attachment = 'none';
        }

        // Display Poll Form
        if ($forum->forum_permission($forum_data['id'], $group_id, 'poll') == '1') {
            $poll = 'block';
        } else {
            $poll = 'none';
        }
      
        $tpl = $STYLE->tags($tpl, array("L_NEW_TOPIC" => L_NEW_TOPIC, "L_TITLE" => L_TITLE, "L_SUBMIT" => L_SUBMIT, "ATTACHMENT" => $attachment, "POLL" => $poll, "L_ATTACHMENT" => L_ATTACHMENT, "L_QUESTION" => L_QUESTION, "L_OPTION" => L_OPTION, "L_POLL" => L_POLL));
    }
} else {
    // Remove new topic block from display
    $tpl = str_replace($STYLE->getcode('newtopic', $tpl), '', $tpl);
    // GENERATE SUBFORUM
    $subforum_exist = $db->fetch("SELECT * FROM " . $prefix . "_forums WHERE parent_id = '$forum_id'");
    $class = '0';
    if ($subforum_exist) {
        $sub_forum_sql = $db->query("SELECT * FROM " . $prefix . "_forums WHERE parent_id = '" . $forum_data['id'] . "'");
        $forum_style = '';
        while ($sub_forum_row = mysql_fetch_array($sub_forum_sql)) {
            // Check if forum allowed?
            if ($forum->forum_permission($forum_data['id'], $group_id, 'view') == '1') {
                // Check for Sub Forums
                $subforum = '';
                $sub_forum_sql = $db->query("SELECT * FROM " . $prefix . "_forums WHERE parent_id = '" . $sub_forum_row['id'] . "'");
                $topic_number = '';
                $topic_number = mysql_num_rows($db->query("SELECT * FROM " . $prefix . "_topics WHERE forum_id='" . $sub_forum_row['id'] . "' ORDER BY date DESC;"));
                $topic_sql = $db->query("SELECT * FROM " . $prefix . "_topics WHERE forum_id='" . $sub_forum_row['id'] . "' ORDER BY date DESC;");
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
                    $row = mysql_fetch_array($db->query("SELECT * FROM " . $prefix . "_topics WHERE forum_id = '" . $sub_forum_row['id'] . "' ORDER BY date DESC;"));
                    $timeout = time() - 43200;
                    if ($row['date'] < $timeout) {
                        $read = 'read';
                    } else {
                        $read_row = mysql_fetch_array($db->query("SELECT * FROM " . $prefix . "_forums_read WHERE account_id ='" . $account['id'] . "' AND topic_id ='" . $row['id'] . "' AND date > '" . $row['date'] . "' "));
                        if ($read_row) {
                            $read = 'read';
                        } else {
                            $read = 'unread';
                        }
                    }
                }
            }
            
            
            
                // Find Moderators
                $moderator_sql = $db->query("SELECT * FROM " . $prefix . "_forums_permission WHERE forum_id = '" . $sub_forum_row['id'] . "' AND moderator = '1'");
                $moderators = '';
                while ($moderator_row = mysql_fetch_array($moderator_sql)) {
                    $moderators .= ' '.$system->group($moderator_row['group_id']);
                }

                if ($moderators) {
                    $moderators = L_MODERATORS . ': ' . $moderators;
                }
            
            
            
            $forum_style .= $STYLE->tags($STYLE->getcode('subrow', $tpl), array("MODERATORS" => $moderators, "CLASS" => $class, "ICON" => $read, "TOPIC" => $topic, "TOPIC_COUNT" => $topic_number, "SUB" => $subforum, "INFO" => $system->bbcode($sub_forum_row['info']), "CLASS" => $class, "FORUM" => '<a href="./?s=viewforum&amp;f=' . $sub_forum_row['id'] . '" class="normfont">' . stripslashes($sub_forum_row['name']) . '</a>'));
            $class = 1 - $class;
        }
        $tpl = str_replace($STYLE->getcode('subrow', $tpl), $forum_style, $tpl);
    } else {
        // Remove SubForum block from display
        $tpl = str_replace($STYLE->getcode('subforum', $tpl), '', $tpl);
    }
    // GENERATE TOPIC ROWS
    $limiter = $system->confdata('topiclimit');
    $sql = "SELECT * FROM " . $prefix . "_topics WHERE forum_id = '$forum_id' ";
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
    $relay = "?s=viewforum&amp;f=$forum_id";
    $paginate = $system->paginate("$sql", "$limiter", "$relay");
    $topic_sql = $db->query("" . $sql . " ORDER BY sticky DESC, date DESC LIMIT $start, $limiter;");
    $topic_style = '';
    $class = '0';
    $timeout = time() - 43200;

    if (!$topic_sql) {
        if ($forum->forum_permission($forum_data['id'], $group_id, 'post') == '1') {
            $link_text = L_NEW_TOPIC;
            $link_url = './?s=viewforum&amp;f' . $topic_id . '';
        } else {
            $link_text = L_CONTINUE;
            $link_url = './';
        }
        $system->message(L_EMPTY, L_FORUM_EMPTY, $link_url, $link_text);
    }
    while ($topic_row = mysql_fetch_array($topic_sql)) {

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


        // Find Topic Status
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

                if ($reply_count + 1 > $system->confdata('hottopic')) {
                    $hot = "hot-";
                } else {
                    $hot = '';
                }

                $sticky = $hot . 'normal';
            }
        }
        $icon = $sticky . '-' . $read;


        $find_poll = $db->fetch("SELECT id FROM " . $prefix . "_polls WHERE topic_id ='" . $topic_row['id'] . "'");
        if ($find_poll) {
            $poll = ' [ ' . L_POLL . ' ] ';
        } else {
            $poll = '';
        }

        $topic_style .= $STYLE->tags($topic_row_tpl, array(
                    "CLASS" => $class,
                    "PAGES" => $pages,
                    "ICON" => $icon,
                    "TOPIC" => $poll . '<a href="./?s=viewtopic&amp;t=' . $topic_row['id'] . '" class="normfont">' . $system->present($topic_row['title']) . '</a>',
                    "AUTHOR" => $user->name($topic_row['author_id']),
                    "REPLIES" => $reply_count,
                    "USER" => $user->name($latest_topic['author_id']),
                    "DATE" => $system->time($latest_topic['date'])));
        $class = 1 - $class;
    }


    // Message for empty forum
    if ($topic_style == '') {
        if ($forum->forum_permission($forum_data['id'], $group_id, 'post') == '1') {
            $link_text = L_NEW_TOPIC;
            $link_url = './?s=viewforum&amp;f=' . $forum_id . '&amp;mode=new';
        } else {
            $link_text = L_CONTINUE;
            $link_url = './';
        }
        $system->message(L_EMPTY, L_FORUM_EMPTY, $link_url, $link_text);
    }



    // Generate the Display
    $tpl = str_replace($topic_row_tpl, $topic_style, $tpl);
    $tpl = $STYLE->tags($tpl, array(
                "PAGINATE" => $paginate,
                "L_FORUM" => L_FORUM,
                "FORUM_ID" => $forum_id,
                "FORUM_NAME" => $system->present($forum_data['name']),
                "L_TOPIC" => L_TOPIC,
                "L_AUTHOR" => L_AUTHOR,
                "L_LATEST" => L_LATEST,
                "L_REPLIES" => L_REPLIES,
                "USERS" => $system->viewing($session_location),
                "L_VIEWING" => L_VIEWING,
                "L_SUBFORUM" => L_SUBFORUM,
                "L_TOPICS" => L_TOPICS
            ));
}
$output .= $tpl;
?>
