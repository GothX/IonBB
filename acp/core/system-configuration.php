<?php

/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$tpl = $STYLE->open('./acp/system-configuration.tpl');
if (isset($_POST['submit'])) {
    if (!isset($_POST['metainfo'])) {
        $metainfo = '';
    } else {
        $metainfo = $secure->clean($_POST['metainfo']);
    }
    if (!isset($_POST['metakeywords'])) {
        $metakeywords = '';
    } else {
        $metakeywords = $secure->clean($_POST['metakeywords']);
    }
    if (!isset($_POST['session_name'])) {
        $session_name = '';
    } else {
        $session_name = $secure->clean($_POST['session_name']);
    }
    if (!isset($_POST['admin_email'])) {
        $admin_email = '';
    } else {
        $admin_email = $secure->clean($_POST['admin_email']);
    }
    if (!isset($_POST['sitestatus'])) {
        $sitestatus = '';
    } else {
        $sitestatus = $secure->clean($_POST['sitestatus']);
    }
    if (!isset($_POST['name'])) {
        $name = '';
    } else {
        $name = $secure->clean($_POST['name']);
    }
    if (!isset($_POST['url'])) {
        $url = '';
    } else {
        $url = $secure->clean($_POST['url']);
    }
    if (!isset($_POST['path'])) {
        $path = '';
    } else {
        $path = $secure->clean($_POST['path']);
    }
    if (!isset($_POST['template'])) {
        $template = '';
    } else {
        $template = $secure->clean($_POST['template']);
    }
    if (!isset($_POST['tos'])) {
        $tos = '';
    } else {
        $tos = $secure->clean($_POST['tos']);
    }
    if (!isset($_POST['facebook_like'])) {
        $facebook_like = '';
    } else {
        $facebook_like = $secure->clean($_POST['facebook_like']);
    }
    if (!isset($_POST['rss'])) {
        $rss = '';
    } else {
        $rss = $secure->clean($_POST['rss']);
    }
    if (preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i", $admin_email)) {
        $db->query("UPDATE " . $prefix . "_confdata SET value='$admin_email' WHERE name = 'adminemail'");
    }
    $db->query("UPDATE " . $prefix . "_confdata SET value='$name' WHERE name = 'sitename'");
    $db->query("UPDATE " . $prefix . "_confdata SET value='$url' WHERE name = 'url'");
    $db->query("UPDATE " . $prefix . "_confdata SET value='$path' WHERE name = 'path'");
    $db->query("UPDATE " . $prefix . "_confdata SET value='$template' WHERE name = 'template'");
    $db->query("UPDATE " . $prefix . "_confdata SET value='$sitestatus' WHERE name = 'siteclosed'");
    $db->query("UPDATE " . $prefix . "_confdata SET value='$session_name' WHERE name = 'session'");
    $db->query("UPDATE " . $prefix . "_confdata SET value='$metainfo' WHERE name = 'meta_info'");
    $db->query("UPDATE " . $prefix . "_confdata SET value='$metakeywords' WHERE name = 'meta_keywords'");
    $db->query("UPDATE " . $prefix . "_confdata SET value='$facebook_like' WHERE name = 'facebook_like'");
    $db->query("UPDATE " . $prefix . "_confdata SET value='$tos' WHERE name = 'tos'");
    $db->query("UPDATE " . $prefix . "_confdata SET value='$rss' WHERE name = 'rss'");
    $system->redirect("./?s=system&module=configuration", true);
}

if ($system->confdata('userreg') == '1') {
    $ryes = 'selected';
    $rno = '';
} else {
    $rno = 'selected';
    $ryes = '';
}
if ($system->confdata('siteclosed') == '1') {
    $syes = 'selected';
    $sno = '';
} else {
    $sno = 'selected';
    $syes = '';
}
if ($system->confdata('iplock') == '1') {
    $ipyes = 'selected';
    $ipno = '';
} else {
    $ipno = 'selected';
    $ipyes = '';
}
if ($system->confdata('showpass') == '1') {
    $spyes = 'selected';
    $spno = '';
} else {
    $spno = 'selected';
    $spyes = '';
}
if ($system->confdata('usertemplate') == '1') {
    $utyes = 'selected';
    $utno = '';
} else {
    $utno = 'selected';
    $utyes = '';
}
if ($system->confdata('avatar') == '1') {
    $avyes = 'selected';
    $avno = '';
} else {
    $avno = 'selected';
    $avyes = '';
}
if ($system->confdata('facebook_like') == '1') {
    $fbyes = 'selected';
    $fbno = '';
} else {
    $fbno = 'selected';
    $fbyes = '';
}

if ($system->confdata('rss') == '1') {
    $rssyes = 'selected';
    $rssno = '';
} else {
    $rssno = 'selected';
    $rssyes = '';
}
$directory = @opendir('../tpl/');
$template_box = '';
while ($file = readdir($directory)) {
    if ($file != "index.php" && $file != "." && $file != "..") {
        if ($file == $system->confdata('template')) {
            $selected = 'selected';
        } else {
            $selected = '';
        }
        $template_box .= '<option ' . $selected . ' value="' . $file . '">' . $file . '</option>';
    }
}
$output .= $STYLE->tags($tpl, array(
            "SYES" => $syes, "SNO" => $sno,
            "FBYES" => $fbyes, "FBNO" => $fbno,
            "RSSYES" => $rssyes, "RSSNO" => $rssno,
            "SITET" => $template_box,
            "SITEP" => $system->confdata('path'),
            "SITEU" => $system->confdata('url'),
            "TOS" => $system->confdata('tos'),
            "SITEN" => $system->confdata('sitename'),
            "SESSION_NAME" => $system->confdata('session'),
            "ADMIN_EMAIL" => $system->confdata('adminemail'),
            "METAINFO" => $system->confdata('meta_info'),
            "METAKEYWORDS" => $system->confdata('meta_keywords'),
            "L_FACEBOOK_BUTTON" => L_FACEBOOK_BUTTON,
            "L_NAME" => L_NAME,
            "L_URL" => L_URL,
            "L_PATH" => L_PATH,
            "L_TEMPLATE" => L_TEMPLATE,
            "L_SESSION" => L_SESSION,
            "L_ADMIN_EMAIL" => L_ADMIN_EMAIL,
            "L_STATUS" => L_STATUS,
            "L_DESCRIPTION" => L_DESCRIPTION,
            "L_KEYWORDS" => L_KEYWORDS,
            "L_TOS" => L_TERMS_OF_SERVICE,
            "L_SUBMIT" => L_SUBMIT,
            "L_ENABLED" => L_ENABLED,
            "L_DISABLED" => L_DISABLED,
            "L_CONFIGURATION" => L_CONFIG,
            "L_RSS" => L_RSS
        ));
?>