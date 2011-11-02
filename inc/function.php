<?php

/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */

class system {

    function current_url() {
        $pageURL = 'http://';
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        return $pageURL;
    }

    function message($title, $message, $linkurl, $link) {
        global $output, $STYLE, $db, $template, $page_title, $global_menu, $account, $user, $system;
        $tpl = $STYLE->open('message.tpl');
        $output .= $STYLE->tags($tpl, array("TITLE" => $title, "MESSAGE" => $message, "LINK" => $linkurl, "LINK-TEXT" => $link));
        include("footer.php");
        echo '<META HTTP-EQUIV="refresh" CONTENT="5;URL=' . $linkurl . '">';
        exit;
    }

    function confirm($title, $message,$link,$vars = '') {
        global $output, $STYLE, $db, $template, $page_title, $global_menu, $account, $user, $system;
        $tpl = $STYLE->open('confirm.tpl');
        
        
$hidden_fields = '';
while (list($key, $val) = each($vars)) {
    $hidden_fields .= '<input type="hidden" name="'.$key.'" value="'.$val.'">';
}
        $output .= $STYLE->tags($tpl, array("TITLE" => $title, "MESSAGE" => $message, "LINK" => $link, "L_CONFIRM" => L_CONFIRM, "L_CANCEL" => L_CANCEL, "HIDDEN_FIELDS" => $hidden_fields));
        include("footer.php");
        exit;
    }

    function page($title, $message) {
        global $output, $STYLE, $db, $template, $page_title, $global_menu, $account, $user, $system;
        $tpl = $STYLE->open('page.tpl');
        $output .= $STYLE->tags($tpl, array("TITLE" => $title, "MESSAGE" => $system->bbcode($message)));
        include("footer.php");
        exit;
    }

    function redirect($url) {
        echo '<script language="javascript">
window.location="' . $url . '";
</script>';
        unset($url);
        exit;
    }

    function confdata($value) {
        global $db, $prefix;
        $result = $db->fetch("SELECT value FROM " . $prefix . "_confdata WHERE name = '$value'");
        return $result['value'];
        unset($result);
    }

    function email($email, $subject, $message) {
        global $system;
        $from = $system->confdata('adminemail');
        $sitename = $system->confdata('sitename');
        $siteaddress = $system->confdata('url') . $system->confdata('path') . '/';
        $message = str_replace(array("[SITENAME]", "[URL]", "[CONTENT]"), array($sitename, $siteaddress, $message), L_EMAIL_WRAP);     
        $message = $system->bbcode($message);
        $headers = 'From: ' . $from . '' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
        mail($email, $subject, $message, $headers);
    }

    function mail($to_id, $from_id, $title, $message) {
        global $db, $prefix;

        $db->query("INSERT INTO " . $prefix . "_mail (to_id,from_id,title,text,date) VALUE ('$to_id','$from_id','$title','$message',UNIX_TIMESTAMP())");
    }

    function bbcode($string) {
        global $system;
        $siteaddress = $system->confdata('url') . $system->confdata('path') . '/';
        $open = '<div class="quote">';
        $close = '</div>';
        preg_match_all('/\[quote\]/i', $string, $matches);
        $opent = count($matches['0']);
        preg_match_all('/\[\/quote\]/i', $string, $matches);
        $closet = count($matches['0']);
        $unclosed = $opent - $closet;
        for ($i = 0; $i < $unclosed; $i++) {
            $string .= '</div>';
        }

        $string = str_replace('[quote]', $open, $string);

        $string = str_replace('[/quote]', $close, $string);

        $string = stripslashes($string);

        if (preg_match('/\[youtube\](.*?)\[\/youtube\]/is', $string)) {
            $strip = array('http://www.youtube.com/watch?v=');

            $string = str_replace($strip, '', $string);
        }

        $code = array(
            '/\[mad]/is',
            '/\[grin]/is',
            '/\[blink]/is',
            '/\[cool]/is',
            '/\[dry]/is',
            '/\[huh]/is',
            '/\[laugh]/is',
            '/\[ohmy]/is',
            '/\[b\](.*?)\[\/b\]/is',
            '/\[i\](.*?)\[\/i\]/is',
            '/\[u\](.*?)\[\/u\]/is',
            '#\[url=(.*?)\](.*?)\[/url\]#i',
            '/\[img\](.*?)\[\/img\]/is',
            '/\[line\]/is',
            '#\[size=([1-9]|1[0-9]|20)\](.*?)\[/size\]#is',
            '#\[color=\#?([A-F0-9]{3}|[A-F0-9]{6})\](.*?)\[/color\]#is',
            '/\[youtube\](.*?)\[\/youtube\]/is',
            '#\[align=(.*?)\](.*?)\[/align\]#i',
            '#\[spoiler=(.*?)\](.*?)\[/spoiler\]#i',
            '#\n#si'
        );

        $replace = array(
            '<img src="' . $siteaddress . 'img/smiley/mad.gif" border="0" alt="" />',
            '<img src="' . $siteaddress . 'img/smiley/biggrin.gif" border="0" alt="" />',
            '<img src="' . $siteaddress . 'img/smiley/blink.gif" border="0" alt="" />',
            '<img src="' . $siteaddress . 'img/smiley/cool.gif" border="0" alt="" />',
            '<img src="' . $siteaddress . 'img/smiley/dry.gif" border="0" alt="" />',
            '<img src="' . $siteaddress . 'img/smiley/huh.gif" border="0" alt="" />',
            '<img src="' . $siteaddress . 'img/smiley/laugh.gif" border="0" alt="" />',
            '<img src="' . $siteaddress . 'img/smiley/ohmy.gif" border="0" alt="" />',
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<u>$1</u>',
            '<a href="$1" target="_blank">$2</a>',
            '<img src="$1" border="0" alt="" />',
            '<hr>',
            '<span style="font-size: $1px;">$2</span>',
            '<span style="color: #$1;">$2</span>',
            '<iframe title="YouTube video player" width="640" height="385" src="http://www.youtube.com/embed/$1?rel=0" frameborder="0" allowfullscreen></iframe>',
            '<div align="$1">$2</div>',
            '<div style="padding:0px;background-color:#FFFFFF;border:0px solid #d8d8d8;">
	<input type="button" class="formcss" value="View $1" onclick="var container=this.parentNode.getElementsByTagName(\'div\')[0];if(container.style.display!=\'\')  {container.style.display=\'\';this.value=\'Hide $1\';} else {container.style.display=\'none\';this.value=\'View $1\';}" />
	<div style="display:none;word-wrap:break-word;overflow:hidden;"><div class="quote">$2</div></div>
	</div>',
            '<br />'
        );

        $string = preg_replace($code, $replace, $string);






        return $string;
    }

    function time($timestamp, $string = 'j/m/Y, g:i a') {
        global $account;
        $real = $timestamp + $account['timezone'];
        $time = date($string . '', $real);
        return $time;
    }

    function present($string) {
        $string = stripslashes($string);
        return $string;
        unset($string);
    }

    function group($id) {
        global $db, $prefix, $account, $system;

        $result = $db->fetch("SELECT * FROM " . $prefix . "_groups WHERE id = '$id'");
        if ($result) {
            $value = '<a href="./?s=groups&amp;view=' . $id . '" class = "normfont">' . $system->present($result['title']) . '</a>';
        } else {
            $value = L_ERROR;
        }

        return $value;
    }

    function group_permission($id, $value) {
        global $db, $prefix, $account;

        $result = $db->fetch("SELECT * FROM " . $prefix . "_groups WHERE id = '$id'");
        if ($result) {
            $value = $result['' . $value . ''];
        } else {
            $value = L_ERROR;
        }

        return $value;
    }

    function paginate($sql, $amount, $relay) {
        global $db, $page;
        $query = $db->query("$sql");
        $number = mysql_num_rows($query);
        $number_two = $number;
        $count = '0';
        $value = '';
        $final_number = $number / $amount;

        if ($number) {
            $value .='<a href="' . $relay . '" class="pagefont">' . L_FIRST . '</a><font class="pagefont"> | </font>';

            while ($number_two > 0) {
                $number_two-=$amount;
                $count = $count + 1;
                $low = $page - 5;
                $high = $page + 5;
                if ($count > $low && $count < $high) {
                    $value .= '<a href="' . $relay . '&amp;page=' . $count . '" class="pagefont">' . $count . ' </a><font class="pagefont"> | </font>';
                }
            }

            $value .= '<a href="' . $relay . '&amp;page=' . $count . '" class="pagefont">' . L_LAST . '</a>';
        }
        return $value;
    }

    function viewing($location) {
        global $db, $user;
        $user_sql = $db->query("SELECT * FROM online WHERE account_id != '-1' AND location = '$location'");
        $users = '';
        while ($user_row = mysql_fetch_array($user_sql)) {
            $users .= $user->name($user_row['account_id']) . ' ';
        }
        if (!$users) {
            $users = L_NONE;
        }
        return $users;
    }

}

class secure {

    function clean($content) {
        $content = mysql_real_escape_string(htmlspecialchars($content));
        return $content;
    }

    function verify_email($email) {
        global $prefix, $db;
        $email_check = strstr($email, '@');
        $ban_sql = $db->fetch("SELECT id FROM " . $prefix . "_banlist WHERE value LIKE '$email_check'");
        if ($ban_sql) {
            $check = 'banned';
        } else if (preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i", $email)) {
            $email_sql = $db->fetch("SELECT id FROM accounts WHERE email LIKE '$email'");
            if ($email_sql) {
                $check = "exist";
            } else {
                $check = "true";
            }
        } else {
            $check = "false";
        }

        return $check;
        unset($email, $email_sql, $check);
    }

    function verify_name($name) {
        global $prefix, $db;
        $name = $this->clean($name);
        $name_sql = $db->fetch("SELECT id FROM accounts WHERE name LIKE '$name'");
        $ban_sql = $db->fetch("SELECT id FROM " . $prefix . "_banlist WHERE value LIKE '$name'");
        if ($ban_sql) {
            $check = 'banned';
        } else if ($name_sql) {
            $check = 'exist';
        } else {
            $check = 'false';
        }

        return $check;
        unset($name, $name_sql, $check);
    }

    function password() {

        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double) microtime() * 1000000);
        $i = 0;
        $pass = '';
        while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
        return $pass;
    }

}

class user {

    function avatar($id, $path = './') {
        global $system, $siteaddress;
        if ($system->confdata('avatar') == '0') {
            $avatar = '';
        } else {
            $file = $path . "img/avatars/" . $id . "";
            $avatar_url = '' . $siteaddress . '/img/avatars/' . $id . '';
            if (file_exists("$file.png")) {
                $avatar = '<img src="' . $avatar_url . '.png" alt=""/>';
            } else
            if (file_exists("$file.gif")) {
                $avatar = '<img src="' . $avatar_url . '.gif" alt=""/>';
            } else
            if (file_exists("$file.jpg")) {
                $avatar = '<img src="' . $avatar_url . '.jpg" alt=""/>';
            } else
            if (file_exists("$file.jpeg")) {
                $avatar = '<img src="' . $avatar_url . '.jpeg" alt=""/>';
            } else {
                $avatar = '<img src="' . $siteaddress . '/img/default-avatar.png" alt=""/>';
            }
        }
        return $avatar;
        unset($avatar);
    }

    function name($id) {
        global $db, $siteaddress, $prefix;
        $result = $db->fetch("SELECT name FROM accounts WHERE id = '$id'");
        if ($result) {
            $username = $result['name'];
        } else {
            $username = L_GUEST;
        }
        $result = $db->fetch("SELECT group_id FROM " . $prefix . "_groups_members WHERE account_id = '$id'");
        if ($result) {
            $css = $db->fetch("SELECT colour FROM " . $prefix . "_groups WHERE id = '" . $result['group_id'] . "'");
            $css = $css['colour'];
        } else {
            $css = '#000';
        }
        $username = '<a href="' . $siteaddress . '?s=profile&amp;user=' . $id . '" class="normfont" style="color:' . $css . '; font-weight:bold;">' . $username . '</a>';
        return $username;
        unset($username);
    }

    function status($user_id) {
        global $db;
        $result = $db->fetch("SELECT id FROM online WHERE account_id = '$user_id'");

        if ($result) {
            $status = L_ONLINE;
        } else {
            $status = L_OFFLINE;
        }

        return $status;
    }

    function rank($user_id) {
        global $db;
        $result = $db->fetch("SELECT rank FROM accounts WHERE id = '$user_id'");

        if ($result['rank'] == '0') {
            // Post Inctement Rank
            $user_data = $db->fetch("SELECT postcount FROM accounts WHERE id = '$user_id'");
            $limit = $user_data['postcount'] + 1;
            $rank = $db->fetch("SELECT name FROM ranks WHERE special = '0' AND count < '$limit'");
        } else {
            $rank = $db->fetch("SELECT name FROM ranks WHERE id = '" . $result['rank'] . "'");
        }
        if ($rank) {
            $user_rank = $rank['name'];
        } else {
            $user_rank = L_GUEST;
        }
        return $user_rank;
        unset($user_rank, $user_data, $rank, $result);
    }

    function gender($user_id) {
        global $db;
        $result = $db->fetch("SELECT gender FROM accounts WHERE id = '$user_id'");
        if ($result) {
            if ($result['gender'] == '1') {
                $gender = L_MALE;
            } else if ($result['gender'] == '2') {
                $gender = L_FEMALE;
            } else {
                $gender = L_HIDDEN;
            }
        } else {
            $gender = L_HIDDEN;
        }
        return $gender;
    }

    function group($id) {
        global $db, $prefix, $account;

        if (isset($account['id'])) {
            $result = $db->fetch("SELECT * FROM " . $prefix . "_groups_members WHERE account_id = '$id'");
            if ($result) {
                $value = $result['group_id'];
            } else {
                $value = '2';
            }
        } else {
            $value = '1';
        }
        return $value;
    }

    function value($id, $value) {
        global $db, $prefix, $account;
        $result = $db->fetch("SELECT * FROM accounts WHERE id = '$id'");
        $value = $result['' . $value . ''];
        return $value;
    }

}

class forum {

    function forum_permission($forum_id, $group_id, $value) {
        global $db, $prefix;
        $result = $db->fetch("SELECT " . $value . " FROM " . $prefix . "_forums_permission WHERE forum_id = '$forum_id' AND group_id = '$group_id'");
        if ($result) {
            $value = $result['' . $value . ''];
        } else {
            $value = '0';
        }
        return $value;
    }

    function category_permission($category_id, $group_id, $value) {
        global $db, $prefix;
        $result = $db->fetch("SELECT " . $value . " FROM " . $prefix . "_categories_permission WHERE category_id = '$category_id' AND group_id = '$group_id'");
        if ($result) {
            $value = $result['' . $value . ''];
        } else {
            $value = '0';
        }
        return $value;
    }

    function event($event) {
        global $db, $account;
        if ($event == 'newtopic' || $event == 'reply' || $event == 'quote') {
            $db->query("UPDATE accounts SET postcount = postcount + 1 , lastpost = UNIX_TIMESTAMP() WHERE id = '" . $account['id'] . "'");
        }
    }

    function paginate($sql, $amount, $relay) {
        global $page, $db;
        $query = $db->query("$sql");
        $num = mysql_num_rows($query);
        $num2 = $num;
        $count = 0;
        $pagestext = '';
        $final = $num / $amount;

        if ($num > $amount) {
            $pagestext .= '<br /><a href="' . $relay . '" class="normfont">< </a><font class="normfont">| </font>';
            while ($num2 > 0) {
                $num2-=$amount;
                $count++;
                $low = $page - 5;
                $high = $page + 5;

                if ($count > $low && $count < $high) {
                    $pagestext .= '<a href="' . $relay . '&amp;page=' . $count . '" class="normfont">' . $count . '</a><font class="normfont"> | </font>';
                }
            }

            $pagestext .= '<a href="' . $relay . '&amp;page=' . $count . '" class="normfont">> </a>';
        }

        return $pagestext;
    }

    function attachment($file, $area, $id) {
        global $db, $forum, $system, $prefix, $account, $forum_data, $group_id;

        if ($area == 'forum') {
            $link = './?s=viewforum&amp;f=' . $id . '';
        } else {
            $link = './?s=viewtopic&amp;t=' . $id . '';
        }

        if ($forum->forum_permission($forum_data['id'], $group_id, 'upload') != '1') {
            $system->message(L_ERROR, L_PERMISSION_ERROR_ACTION, $link, L_CONTINUE);
        }

        $filename = stripslashes($file);

        // Get Extention
        $i = strrpos($filename, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($filename) - $i;
        $extension = substr($filename, $i + 1, $l);


        $extension = strtolower($extension);

        $ext = $db->fetch("SELECT * FROM " . $prefix . "_extensions WHERE value LIKE '" . $extension . "' ;");

        // Is Extention Allowed
        if (!$ext) {
            $system->message(L_ERROR, L_ATTACHMENT_ERROR_EXTENTION, $link, L_CONTINUE);
        }

        $newname = "uploads/" . $account['id'] . "-" . time() . "--$filename";
        $copied = copy($_FILES['attachment']['tmp_name'], $newname);
        $size = filesize($newname);

        if ($size > $system->confdata('attach_filesize')) {
            unlink("$newname");
            $system->message(L_ERROR, L_ATTACHMENT_ERROR_FILESIZE, $link, L_CONTINUE);
        }

        if (!$copied) {
            unlink("$newname");
            $system->message(L_ERROR, L_ATTACHMENT_ERROR, $link, L_CONTINUE);
        }



        $db->query("INSERT INTO " . $prefix . "_attachments (account_id,file,date) VALUES ('" . $account['id'] . "','$newname',UNIX_TIMESTAMP())");

        $attachment = $db->fetch("SELECT * FROM " . $prefix . "_attachments WHERE account_id = '" . $account['id'] . "' ORDER BY date DESC LIMIT 1 ;");
        $attachment_id = $attachment['id'];
        return $attachment_id;
    }

}

?>
