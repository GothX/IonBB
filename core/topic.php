<?php

/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$forum = new forum();
$tpl = $STYLE->open('topic.tpl');
// Generate Global Menu
$global_menu = $STYLE->getcode('menu', $tpl);
$tpl = str_replace($global_menu, '', $tpl);
// Find Your Group
$group_id = $user->group($account['id']);

// Find Mode
if (isset($_GET['mode'])) {
    $mode = $secure->clean($_GET['mode']);
} else {
    $mode = '';
}

// Is there a topic id?
if (!isset($_GET['t']) && !isset($tid)) {
    $system->message(L_ERROR, L_TOPIC_ERROR_ID, './', L_CONTINUE);
}

// Get Topic and Forum data
if (isset($tid)) {
    $topic_id = $tid;
} else {
    $topic_id = $secure->clean($_GET['t']);
}
$topic_data = $db->fetch("SELECT * FROM " . $prefix . "_topics WHERE id = '$topic_id'");
$forum_data = $db->fetch("SELECT * FROM " . $prefix . "_forums WHERE id = '" . $topic_data['forum_id'] . "'");
// Generate Page Title
$page_title .=' <a href="./?s=viewforum&amp;f=' . $forum_data['id'] . '" class="normfont">' . $system->present($forum_data['name']) . '</a> / <a href="./?s=viewtopic&amp;t=' . $topic_id . '" class="normfont">' . $system->present($topic_data['title']) . '</a>';
// Is User Watching Topic
$watching = $db->fetch("SELECT * FROM " . $prefix . "_watching WHERE account_id = '" . $account['id'] . "'");
if ($watching) {
    $button = L_UNWATCH;
    $post = 'unwatch';
} else {
    $button = L_WATCH;
    $post = 'watch';
}
// Parse Global Menu
$global_menu = $STYLE->tags($global_menu, array("TOPIC_ID" => $topic_id, "L_REPLY" => L_REPLY, "L_WATCHING" => $button, "WATCHING" => $post));
// Does the topic exist?
if (!$topic_data) {
    $system->message(L_ERROR, L_TOPIC_NOT_FOUND, './', L_CONTINUE);
}

// Mark As Read
$is_read = $db->fetch("SELECT id FROM " . $prefix . "_forums_read WHERE account_id = '" . $account['id'] . "' AND topic_id ='" . $topic_id . "'");
if (!$is_read) {
    $db->query("INSERT INTO " . $prefix . "_forums_read (account_id,topic_id,date) VALUES ('" . $account['id'] . "','$topic_id', UNIX_TIMESTAMP())");
} else {
    $db->query("UPDATE " . $prefix . "_forums_read SET date = UNIX_TIMESTAMP() WHERE account_id = '" . $account['id'] . "' AND topic_id = '" . $topic_id . "'");
}

// Watch and Unwatch
if (isset($_POST['watch'])) {
    $db->query("INSERT INTO " . $prefix . "_watching (account_id,topic_id) VALUE ('" . $account['id'] . "','" . $topic_id . "')");
    $system->message(L_WATCH, L_WATCH_MESSAGE, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
}
if (isset($_POST['unwatch'])) {
    $db->query("DELETE FROM " . $prefix . "_watching WHERE account_id = '" . $account['id'] . "' AND topic_id = '" . $topic_id . "'");
    $system->message(L_UNWATCH, L_UNWATCH_MESSAGE, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
}


// Are attachments allowed?
if ($forum->forum_permission($forum_data['id'], $group_id, 'upload') == '1') {
    $attachment = 'block';
} else {
    $attachment = 'none';
}

// Process Reputation Action
if ($mode == 'reputation-add') {
    if (isset($_GET['post_id'])) {
        $post_id = $secure->clean($_GET['post_id']);
        $post = $db->fetch("SELECT * FROM " . $prefix . "_posts WHERE id = '" . $post_id . "'");
        $reputation = $db->fetch("SELECT id FROM " . $prefix . "_reputation WHERE account_id = '" . $account['id'] . "' AND post_id = '" . $post_id . "'");
        if ($post && !$reputation) {
            $db->query("UPDATE accounts SET reputation = reputation + 1 WHERE id = '" . $post['author_id'] . "'");
            $db->query("INSERT INTO " . $prefix . "_reputation (account_id,post_id) VALUES (" . $account['id'] . ",$post_id)");
            $system->message(L_REPUTATION, L_REPUTATION_MESSAGE, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
        } else {
            $system->redirect('./?s=viewtopic&t=' . $topic_id . '');
        }
    }
}
if ($mode == 'reputation-remove') {
    if (isset($_GET['post_id'])) {
        $post_id = $secure->clean($_GET['post_id']);
        $post = $db->fetch("SELECT * FROM " . $prefix . "_posts WHERE id = '" . $post_id . "'");
        $reputation = $db->fetch("SELECT id FROM " . $prefix . "_reputation WHERE account_id = '" . $account['id'] . "' AND post_id = '" . $post_id . "'");
        if ($post && !$reputation) {
            $db->query("UPDATE accounts SET reputation = reputation - 1 WHERE id = '" . $post['author_id'] . "'");
            $db->query("INSERT INTO " . $prefix . "_reputation (account_id,post_id) VALUES (" . $account['id'] . ",$post_id)");
            $system->message(L_REPUTATION, L_REPUTATION_MESSAGE, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
        } else {
            $system->redirect('./?s=viewtopic&t=' . $topic_id . '');
        }
    }
}

// Delete Attachment
if ($mode == 'delete_attachment') {
    if (isset($_GET['post_id'])) {
        $post_id = $secure->clean($_GET['post_id']);
        $post = $db->fetch("SELECT * FROM " . $prefix . "_posts WHERE id = '" . $post_id . "'");
        $attachment = $db->fetch("SELECT * FROM " . $prefix . "_attachments WHERE id = '" . $post['attachment'] . "'");
        if ($forum->forum_permission($forum_data['id'], $group_id, 'moderator') != '1' && $account['id'] != $post['author_id']) {
            $system->message(L_ERROR, L_PERMISSION_ERROR_ACTION, './?s=viewtopic&amp;t=' . $topic . '', L_CONTINUE);
        }
        if ($post && $attachment) {
            unlink($attachment['file']);
            $db->query("UPDATE " . $prefix . "_posts SET attachment = '0' WHERE id = '" . $post['id'] . "'");
            $db->query("DELETE FROM " . $prefix . "_attachments WHERE id = '" . $attachment['id'] . "'");
            $system->message(L_DELETED, L_ATTACHMENT_DELETED, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
        } else {
            $system->redirect('./?s=viewtopic&t=' . $topic_id . '');
        }
    }
}

// Is user a moderator?
if ($forum->forum_permission($forum_data['id'], $group_id, 'moderator') == '1') {
    if (isset($_POST['sticky_submit']) && isset($_POST['sticky'])) {
        // Change topic sticky status
        $sticky = $secure->clean($_POST['sticky']);
        $db->query("UPDATE " . $prefix . "_topics SET sticky = '$sticky' WHERE id = '$topic_id'");
        $system->message(L_UPDATED, L_TOPIC_STICKIED, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
    } else if (isset($_POST['move_submit']) && isset($_POST['move'])) {
        // Move Topic
        $move = $secure->clean($_POST['move']);
        $db->query("UPDATE " . $prefix . "_topics SET forum_id = '$move' WHERE id = '$topic_id'");
        $system->message(L_UPDATED, L_TOPIC_MOVED, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
    } else if (isset($_POST['delete_topic'])) {
        
    if ( ! isset($_POST['confirmed']))
    {
        $system->confirm(L_CONFIRM_DELETE_TOPIC, L_CONFIRM_DELETE_TOPIC_MSG, './?s=viewtopic&amp;t=' . $topic_id . '', array("delete_topic" => ''));
    }
    
        // Delete topic data
        $db->query("DELETE FROM " . $prefix . "_posts WHERE topic_id = '$topic_id'");
        $db->query("DELETE FROM " . $prefix . "_forums_read WHERE topic_id = '$topic_id'");
        $db->query("DELETE FROM " . $prefix . "_topics WHERE id = '$topic_id'");
        $system->message(L_DELETED, L_TOPIC_DELETED, './?s=viewforum&amp;f=' . $forum_data['id'] . '', L_CONTINUE);
    } else if (isset($_POST['delete_poll'])) {
        if ( ! isset($_POST['confirmed']))
        {
             $system->confirm(L_CONFIRM_DELETE_POLL, L_CONFIRM_DELETE_POLL_MSG, './?s=viewtopic&amp;t=' . $topic_id . '', 'delete_topic');
        }
        // Delete topic data
        $poll = $db->fetch("SELECT * FROM " . $prefix . "_polls WHERE topic_id = '$topic_id'");
        if (!$poll) {
            $system->message(L_ERROR, L_POLL_DELETED_ERROR, './?s=viewtopic&amp;f=' . $topic_id . '', L_CONTINUE);
        }
        $db->query("DELETE FROM " . $prefix . "_polls WHERE id = '" . $poll['id'] . "'");
        $db->query("DELETE FROM " . $prefix . "_polls_vote WHERE id = '" . $poll['id'] . "'");
        $db->query("DELETE FROM " . $prefix . "_polls_option WHERE id = '" . $poll['id'] . "'");
        $system->message(L_DELETED, L_POLL_DELETED, './?s=viewtopic&amp;f=' . $topic_id . '', L_CONTINUE);
    } else if (isset($_POST['lock'])) {
        // Lock Topic
        $db->query("UPDATE " . $prefix . "_topics SET locked = '1' WHERE id = '$topic_id'");
        $system->message(L_UPDATED, L_TOPIC_LOCKED, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
    } else if (isset($_POST['unlock'])) {
        // Unlock Topic
        $db->query("UPDATE " . $prefix . "_topics SET locked = '0' WHERE id = '$topic_id'");
        $system->message(L_UPDATED, L_TOPIC_UNLOCKED, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
    } else if (isset($_POST['delete_posts'])) {
        // Delete posts data
        if (isset($_POST['checkbox'])) {
            $topic_check = $db->fetch("SELECT * FROM " . $prefix . "_posts WHERE topic_id = '$topic_id' ORDER BY id LIMIT 1;");
            $checkbox = $_POST['checkbox'];
            for ($i = 0; $i < count($checkbox); $i++) {
                $delete_id = $checkbox[$i];
                if ($topic_check['id'] == $delete_id) {
                    $db->query("DELETE FROM " . $prefix . "_topics WHERE id = '$topic_id';");
                    $db->query("DELETE FROM " . $prefix . "_posts WHERE topic_id = '$topic_id';");
                    $db->query("DELETE FROM " . $prefix . "_forums_read WHERE topic_id = '$topic_id';");
                    $topic_delete = '1';
                } else {
                    $db->query("DELETE FROM " . $prefix . "_posts WHERE id = '$delete_id';");
                    $topic_delete = '0';
                }
            }
            if ($topic_delete == '1') {
                $system->message(L_DELETED, L_POSTS_DELETED_TOPIC, './?s=viewtforum&amp;f=' . $forum_data['id'] . '', L_CONTINUE);
            } else {
                $system->message(L_DELETED, L_POSTS_DELETED, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
            }
        } else {
            $system->message(L_ERROR, L_POSTS_DELETED_ERROR, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
        }
    } else {
        // Show the Moderation Panel
        $moderation_status = 'true';
        $forum_list = $db->query("SELECT * FROM " . $prefix . "_forums");
        $forum_list_row = '';
        while ($row = mysql_fetch_array($forum_list)) {
            if ($row['id'] == $forum_data['id']) {
                $select = 'selected';
            } else {
                $select = '';
            }
            $forum_list_row .= '<option value="' . $row['id'] . '" ' . $select . '>' . $system->present($row['name']) . '</option>';
        }
        // Find current topic status
        $announcement = '';
        $sticky = '';
        $normal = '';
        if ($topic_data['sticky'] == '2') {
            $announcement = 'selected';
        } else if ($topic_data['sticky'] == '1') {
            $sticky = 'selected';
        } else {
            $normal = 'selected';
        }
        if ($topic_data['locked'] == '1') {
            $locked = L_UNLOCK;
            $locked_name = 'unlock';
        } else {
            $locked = L_LOCK;
            $locked_name = 'lock';
        }
        $poll = $db->fetch("SELECT * FROM " . $prefix . "_polls WHERE topic_id = '$topic_id'");
        if ($poll) {
            $poll = 'block';
        } else {
            $poll = 'none';
        }
        // Parse Moderation Panel
        $tpl = $STYLE->tags($tpl, array(
                    "MOVE" => $forum_list_row,
                    "L_DELETE_TOPIC" => L_DELETE_TOPIC,
                    "L_DELETE_SELECTED" => L_DELETE_SELECTED,
                    "L_SET" => L_SET,
                    "L_MOVE" => L_MOVE,
                    "L_NORMAL" => L_NORMAL,
                    "L_STICKY" => L_STICKY,
                    "L_ANNOUNCEMENT" => L_ANNOUNCEMENT,
                    "NORMAL" => $normal,
                    "STICKY" => $sticky,
                    "ANNOUNCEMENT" => $announcement,
                    "L_LOCKED" => $locked,
                    "LOCKED" => $locked_name,
                    "POLL" => $poll,
                    "L_DELETE_POLL" => L_DELETE_POLL
                ));
    }
} else {
    // Hide Moderation Panel
    $moderation_status = 'false';
    $tpl = str_replace($STYLE->getcode('moderator', $tpl), '', $tpl);
}
// Is user allowed access?
if ($forum->category_permission($forum_data['cat_id'], $group_id, 'view') != '1' || $forum->forum_permission($forum_data['id'], $group_id, 'view') != '1') {
    $system->message(L_ERROR, L_PERMISSION_ERROR_AREA, './', L_CONTINUE);
}
$post_row_tpl = $STYLE->getcode('row', $tpl);
if ($mode == 'reply') {
    // Prevent Flooding
    if (time() < $account['lastpost'] + $system->confdata('anti_flood')) {
        $system->message(L_ERROR, L_FLOOD_ERROR, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
    }
    // Is it locked?
    if ($topic_data['locked'] == '1') {
        $system->message(L_ERROR, L_TOPIC_LOCKED_ERROR, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
    }
    // Allowed?
    if ($forum->forum_permission($forum_data['id'], $group_id, 'reply') != '1') {
        $system->message(L_ERROR, L_PERMISSION_ERROR_ACTION, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
    }
    if (isset($_POST['Submit'])) {
        $message = $secure->clean($_POST['message']);
        if (!$message) {
            $system->message(L_ERROR, L_INFORMATION_MISSING, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
        }
        if (isset($_FILES['attachment']['name'])) {
            $attachment_id = $forum->attachment($_FILES['attachment']['name'], 'topic', $topic_id);
        } else {
            $attachment_id = '0';
        }
        $result = $db->query("INSERT INTO " . $prefix . "_posts (author_id,topic_id,text,date,attachment)VALUES ('" . $account['id'] . "','$topic_id','$message',UNIX_TIMESTAMP(),'$attachment_id')");
        $db->query("UPDATE " . $prefix . "_topics SET date = UNIX_TIMESTAMP() WHERE id = '$topic_id'");
        // Inform Watching
        $watching = $db->query("SELECT * FROM " . $prefix . "_watching WHERE topic_id = '" . $topic_id . "'");
        while ($watch_row = mysql_fetch_array($watching)) {
            $system->mail($watch_row['account_id'], 1, L_WATCH_TOPIC_TITLE, str_replace('[LINK]', "[url=" . $siteaddress . "/?s=viewtopic&amp;t=" . $topic_id . "]" . $siteaddress . "/?s=viewtopic&amp;t=" . $topic_id . "[/url]", L_WATCH_TOPIC_MESSAGE));
        }
        // Run Event
        $forum->event('reply');
        $system->message(L_SUBMITTED, L_POST_SUBMITTED, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
    } else {
        $tpl = str_replace(array($STYLE->getcode('edit', $tpl), $STYLE->getcode('normal', $tpl), $STYLE->getcode('quote', $tpl), $STYLE->getcode('report', $tpl)), '', $tpl);

      
        
          
    $post_sql = $db->query("SELECT * FROM ".$prefix."_posts WHERE topic_id = '".$topic_id."' ORDER BY id LIMIT 10");
    $post_style = '';
    $class = '0';
    while ($post_row = mysql_fetch_array($post_sql)) {
      
        $post_style .= $STYLE->tags($STYLE->getcode('reply_row',$tpl), array(
                    "CLASS" => $class,            
                    "AUTHOR" => $user->name($post_row['author_id']),
                    "DATE" => $system->time($post_row['date']),
                    "TEXT" => $system->bbcode($post_row['text'])
                   
                ));
        $class = 1 - $class;
    }
    // Parse the template
    $tpl = str_replace($STYLE->getcode('reply_row',$tpl), $post_style, $tpl);
        
        
        
        
        
        
        
        $tpl = $STYLE->tags($tpl, array("L_REPLY" => L_REPLY, "L_TOPIC" => L_TOPIC, "L_SUBMIT" => L_SUBMIT, "ATTACHMENT" => $attachment));
    }
} else if ($mode == 'edit' && isset($_GET['post_id'])) {
    $tpl = str_replace(array($STYLE->getcode('reply', $tpl), $STYLE->getcode('normal', $tpl), $STYLE->getcode('quote', $tpl), $STYLE->getcode('report', $tpl)), '', $tpl);
    $id = $secure->clean($_GET['post_id']);
    $post = $db->fetch("SELECT * FROM " . $prefix . "_posts WHERE id = '$id'");
    $first_post = $db->fetch("SELECT * FROM " . $prefix . "_posts WHERE topic_id = '" . $topic_data['id'] . "' ORDER BY id");
    // Is user allowed to edit?
    if ($account['id'] != $post['author_id'] && $forum->forum_permission($forum_data['id'], $group_id, 'moderator') != '1') {
        $system->message(L_ERROR, L_PERMISSION_ERROR_ACTION, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
    }

    // Does the post exist?
    if (!$post) {
        $system->message(L_ERROR, L_POST_ERROR_MISSING, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
    }

    if (isset($_POST['Submit'])) {
        if (isset($_POST['title'])) {
            if ($id = $first_post['id']) {
                $title = $secure->clean($_POST['title']);
            } else {
                $title = $topic_data['title'];
            }
        } else {
            $title = $topic_data['title'];
        }

        if (isset($_POST['message'])) {
            $message = $secure->clean($_POST['message']);
        } else {
            $message = $post['message'];
        }
        $db->query("UPDATE " . $prefix . "_posts SET text = '$message' WHERE id = '$id'");
        if ($id == $first_post['id']) {
            $db->query("UPDATE " . $prefix . "_topics SET title = '$title' WHERE id = '$topic_id'");
        }
        $system->message(L_UPDATED, L_POST_EDIT, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
    } else {
        if ($id != $first_post['id']) {
            $tpl = str_replace($STYLE->getcode('title', $tpl), '', $tpl);
        }

        $tpl = $STYLE->tags($tpl, array(
                    "TITLE" => $system->present($topic_data['title']),
                    "MESSAGE" => $system->present($post['text']),
                    "L_EDIT" => L_EDIT,
                    "L_SUBMIT" => L_SUBMIT
                ));
    }
} else if ($mode == 'report' && isset($_GET['post_id'])) {
    $tpl = str_replace(array($STYLE->getcode('reply', $tpl), $STYLE->getcode('normal', $tpl), $STYLE->getcode('edit', $tpl), $STYLE->getcode('quote', $tpl)), '', $tpl);
    if (isset($_POST['Submit']) && isset($_GET['post_id'])) {
        $post_id = $secure->clean($_GET['post_id']);
        $reason = $secure->clean($_POST['reason']);
        if (!$reason) {
            $system->message(L_ERROR, L_INFORMATION_MISSING, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
        }
        $post = $db->fetch("SELECT * FROM " . $prefix . "_posts WHERE id = '$post_id'");
        $text = $secure->clean($post['text']);
        $db->query("INSERT INTO " . $prefix . "_reports (account_id,post_id,reporter_id,reason,content,date) VALUE ('" . $post['author_id'] . "','" . $post['id'] . "','" . $account['id'] . "','" . $reason . "','" . $text . "',UNIX_TIMESTAMP())");
        $system->message(L_SUBMITTED, L_REPORT_POST_SUBMITTED, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
    }
    $tpl = $STYLE->tags($tpl, array(
                "L_SUBMIT" => L_SUBMIT,
                "L_REPORT" => L_REPORT
            ));
} else if ($mode == 'quote' && isset($_GET['post_id'])) {
    $tpl = str_replace(array($STYLE->getcode('reply', $tpl), $STYLE->getcode('normal', $tpl), $STYLE->getcode('edit', $tpl), $STYLE->getcode('report', $tpl)), '', $tpl);
    $id = $secure->clean($_GET['post_id']);
    $post = $db->fetch("SELECT * FROM " . $prefix . "_posts WHERE id = '$id'");
    // Is user allowed to edit?
    if ($forum->forum_permission($forum_data['id'], $group_id, 'reply') != '1') {
        $system->message(L_ERROR, L_PERMISSION_ERROR_ACTION, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
    }
    // Does the post exist?
    if (!$post) {
        $system->message(L_ERROR, L_POST_ERROR_MISSING, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
    }
    if (isset($_POST['Submit'])) {
        $message = $secure->clean($_POST['message']);
        if (!$message) {
            $system->message(L_ERROR, L_INFORMATION_MISSING, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
        }
        if ($_FILES['attachment']['name']) {
            $attachment_id = $forum->attachment($_FILES['attachment']['name'], 'topic', $topic_id);
        } else {
            $attachment_id = '0';
        }
        $result = $db->query("INSERT INTO " . $prefix . "_posts (author_id,topic_id,text,date,attachment)VALUES ('" . $account['id'] . "','$topic_id','$message',UNIX_TIMESTAMP(),'$attachment_id')");
        $db->query("UPDATE " . $prefix . "_topics SET date = UNIX_TIMESTAMP() WHERE id = '$topic_id'");
        // Run Event
        $forum->event('quote');
        $system->message(L_SUBMITTED, L_POST_SUBMITTED, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
    } else {
        $tpl = $STYLE->tags($tpl, array(
                    "TITLE" => $system->present($topic_data['title']),
                    "MESSAGE" => $system->present('[quote]' . $post['text'] . '[/quote]'),
                    "L_EDIT" => L_EDIT,
                    "L_SUBMIT" => L_SUBMIT,
                    "L_QUOTE" => L_QUOTE
                ));
    }
} else {
 
    // Remove new topic block from display
    $tpl = str_replace(array($STYLE->getcode('edit', $tpl), $STYLE->getcode('reply', $tpl), $STYLE->getcode('quote', $tpl), $STYLE->getcode('report', $tpl)), '', $tpl);
    
// Poll
    
       $poll = $db->fetch("SELECT * FROM " . $prefix . "_polls WHERE topic_id = '" . $topic_id . "'");
    if ($poll) {
        if (isset($_POST['vote']) && isset($_POST['option'])) {
            $option_id = $secure->clean($_POST['option']);
            $db->query("UPDATE " . $prefix . "_polls_option SET total = total + 1 WHERE id = '$option_id'");
            $db->query("INSERT INTO " . $prefix . "_polls_vote (account_id,poll_id,option_id) VALUE ('" . $account['id'] . "','" . $poll['id'] . "','$option_id')");
            $system->message(L_SUBMITTED, L_VOTE_SUBMITTED, './?s=viewtopic&amp;t=' . $topic_id . '', L_CONTINUE);
        }
        $options = '';
        $poll_vote = $db->fetch("SELECT * FROM " . $prefix . "_polls_vote WHERE poll_id = '" . $poll['id'] . "' AND account_id = '" . $account['id'] . "'");
        $option_sql = $db->query("SELECT * FROM " . $prefix . "_polls_option WHERE poll_id = '" . $poll['id'] . "'");
        if ($poll_vote || !$account) {
            while ($row = mysql_fetch_array($option_sql)) {
                if ($row['total'] > 200) {
                    $pixels = 200;
                } else {
                    $pixels = $row['total'];
                }
                $options .= '<tr><td>' . $system->present($row['value']) . '</td><td><div class="globaltab" style=" width: ' . $pixels . 'px"></div></td><td> ( ' . $system->present($row['total']) . ' )</td></tr>';
            }
        } else {
            while ($row = mysql_fetch_array($option_sql)) {
                $options .= '<tr><td>' . $system->present($row['value']) . '</td><td><input type="radio" name="option" value="' . $row['id'] . '"></td></tr>';
            }

            $options .= '<tr><td colspan="2"><INPUT TYPE="submit" value ="' . L_SUBMIT . '" class="formcss" name="vote"  style="width: 80px"></td></tr>';
        }
        $poll_style = $STYLE->tags($STYLE->getcode('poll', $tpl), array(
                    "L_POLL" => L_POLL, "QUESTION" => $system->present($poll['question']), "OPTIONS" => $options
                ));
        $tpl = str_replace($STYLE->getcode('poll', $tpl), $poll_style, $tpl);
    } else {
        $tpl = str_replace(array($STYLE->getcode('poll', $tpl), $STYLE->getcode('poll_result', $tpl)), '', $tpl);
    }



// Paginate
    $limiter = $system->confdata('postlimit');
    $sql = "SELECT * FROM " . $prefix . "_posts WHERE topic_id = '$topic_id' ";
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
    $relay = "?s=viewtopic&amp;t=$topic_id";
    $paginate = $system->paginate("$sql", "$limiter", "$relay");
    // Generate Post's
    $post_sql = $db->query("" . $sql . " ORDER BY id LIMIT $start, $limiter;");
    $post_style = '';
    $class = '0';
    while ($post_row = mysql_fetch_array($post_sql)) {
        $post_style_tpl = $post_row_tpl;
        if ($moderation_status == 'true') {
            $check_box = '<input name="checkbox[]" type="checkbox" id="checkbox[]" value="' . $post_row['id'] . '">';
        } else {
            $check_box = '';
        }
        // Change Post Buttons
        $reputation = $db->fetch("SELECT id FROM " . $prefix . "_reputation WHERE account_id = '" . $account['id'] . "' AND post_id = '" . $post_row['id'] . "'");
        if ($account['id'] == $post_row['author_id'] || !$account || $reputation) {
            $post_style_tpl = str_replace($STYLE->getcode('rep', $post_style_tpl), '', $post_style_tpl);
        }
        if ($account['id'] != $post_row['author_id'] && $forum->forum_permission($forum_data['id'], $group_id, 'moderator') != '1') {
            $post_style_tpl = str_replace($STYLE->getcode('authorbutton', $post_style_tpl), '', $post_style_tpl);
        }
        if ($account['id'] != $post_row['author_id'] && $forum->forum_permission($forum_data['id'], $group_id, 'moderator') != '1' || !$post_row['attachment']) {
            $post_style_tpl = str_replace($STYLE->getcode('attachbutton', $post_style_tpl), '', $post_style_tpl);
        }
        if ($post_row['attachment'] != '0') {
            $attachment = $db->fetch("SELECT * FROM " . $prefix . "_attachments WHERE id = '" . $post_row['attachment'] . "'");
            $message = $post_row['text'] . '<br /><div class="attachment"><font class="normfont">' . L_ATTACHMENT . '</font><br /><a href="' . $attachment['file'] . '" class="normfont">' . str_replace('uploads/', '', $attachment['file']) . '</a></div>';
        } else {
            $message = $post_row['text'];
        }
        // Parse the post
        $user_data = $db->fetch("SELECT * FROM accounts WHERE id = '" . $post_row['author_id'] . "'");
        $post_style .= $STYLE->tags($post_style_tpl, array(
                    "CLASS" => $class,
                    "BOX" => $check_box,
                    "AUTHOR" => $user->name($post_row['author_id']),
                    "AUTHOR_ID" => $post_row['author_id'],
                    "AVATAR" => $user->avatar($post_row['author_id']),
                    "RANK" => $user->rank($post_row['author_id']),
                    "ID" => $system->present($post_row['id']),
                    "DATE" => $system->time($post_row['date']),
                    "TEXT" => $system->bbcode($message),
                    "SIGNATURE" => $system->bbcode($user_data['signature']),
                    "POSTCOUNT" => $system->present($user_data['postcount']),
                    "STATUS" => $user->status($user_data['id']),
                    "REPUTATION" => $system->present($user_data['reputation'])
                ));
        $class = 1 - $class;
    }
    // Parse the template
    $tpl = str_replace($post_row_tpl, $post_style, $tpl);
    $tpl = $STYLE->tags($tpl, array(
                "PAGINATE" => $paginate,
                "T" => $topic_id,
                "L_FORUM" => L_FORUM,
                "FORUM_NAME" => $system->present($forum_data['name']),
                "TOPIC_NAME" => $system->present($topic_data['title']),
                "L_POSTS" => L_POSTS,
                "L_REPUTATION" => L_REPUTATION,
                "L_STATUS" => L_STATUS,
                "L_REP" => L_REP,
                "L_PROFILE" => L_PROFILE,
                "L_MAIL" => L_SEND_MAIL,
                "L_QUOTE" => L_QUOTE,
                "L_REPORT" => L_REPORT,
                "L_EDIT" => L_EDIT,
                "L_VIEWING" => L_VIEWING,
                "L_DELETE_ATTACHMENT" => L_DELETE_ATTACHMENT,
                "USERS" => $system->viewing($session_location)
            ));
}
$output .= $tpl;
?>