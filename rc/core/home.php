<?php

/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$tpl = $STYLE->open('rc/home.tpl');
if (!isset($_GET['view'])) {
    $view = '';
    $code = $STYLE->getcode('report', $tpl);
    $tpl = str_replace($code, '', $tpl);
} else {
    $view = $secure->clean($_GET['view']);
}
if (!isset($_GET['type'])) {
    $type = '';
} else {
    $type = $secure->clean($_GET['type']);
}
if ($view) {
    $pt = '';
    $report = $db->fetch("SELECT * FROM " . $prefix . "_reports WHERE id = '$view' ORDER BY id LIMIT 1;");
    if ($report) {
        $accused = $report['account_id'];
        if (isset($_POST['Close'])) {




            // Close the report taking no action
            if (!isset($_POST['warning'])) {
                $warning = L_NONE;
            } else {
                $warning = $secure->clean($_POST['warning']);
            }

            // Confirm
            if (!isset($_POST['confirmed'])) {
                $system->confirm(L_CONFIRM_CLOSE, L_CONFIRM_CLOSE_MSG, './?view=' . $view . '', array("warning" => $warning, "Close" => ''));
            }

            $db->query("UPDATE " . $prefix . "_reports SET actioned = '1', action_id = '" . $account['id'] . "',  outcome = '" . L_REPORT_CLOSED . "\n\n$warning' WHERE id = '$view';") or die(mysql_error());
            $system->message(L_CLOSED, L_REPORT_CLOSED, './?view=' . $view . '', L_CONTINUE);
        } else
        if (isset($_POST['Submit'])) {
            // Issue a warning to the Accused Account
            if (!isset($_POST['warning'])) {
                $warning = L_NONE;
            } else {
                $warning = $secure->clean($_POST['warning']);
            }

            // Confirm
            if (!isset($_POST['confirmed'])) {
                $system->confirm(L_CONFIRM_WARNING, L_CONFIRM_WARNING_MSG, './?view=' . $view . '', array("warning" => $warning, "Submit" => ''));
            }
            $message = str_replace(array("[WARNING]"), array($warning), L_RESOLUTION_CENTRE_WARNING);
            $warning = L_WARNING_ISSUED . $warning;
            $system->mail($accused, '1', L_WARNING, $message);
            $db->query("UPDATE accounts SET warning = warning+1 WHERE id = '$accused';") or die(mysql_error());
            $db->query("UPDATE " . $prefix . "_reports SET actioned = '1', action_id = '" . $account['id'] . "',  outcome = '$warning' WHERE id = '$view';") or die(mysql_error());
            $system->message(L_WARNED, L_RESOLUTION_CENTRE_WARNED, './?view=' . $view . '', L_CONTINUE);
        } else
        if (isset($_POST['Ban'])) {
            if (!isset($_POST['warning'])) {
                $warning = L_NONE;
            } else {
                $warning = $secure->clean($_POST['warning']);
            }
            // Confirm
            if (!isset($_POST['confirmed'])) {
                $system->confirm(L_CONFIRM_BAN, L_CONFIRM_BAN_MSG, './?view=' . $view . '', array("warning" => $warning, "Ban" => ''));
            }
            $warning = L_BAN_ISSUED . $warning;
            $db->query("UPDATE accounts SET frozen = '1' WHERE id = '$accused';");
            $db->query("UPDATE accounts SET warning = warning+1 WHERE id = '$accused';") or die(mysql_error());
            $db->query("UPDATE " . $prefix . "_reports SET actioned = '1', action_id = '" . $account['id'] . "',  outcome = '$warning' WHERE id = '$view';") or die(mysql_error());
            $system->message(L_BANNED, L_RESOLUTION_CENTRE_BANNED, './?view=' . $view . '', L_CONTINUE);
        } else
        if (isset($_POST['tban'])) {
            if (!isset($_POST['warning'])) {
                $warning = L_NONE;
            } else {
                $warning = $secure->clean($_POST['warning']);
            }
            if (!isset($_POST['tempban'])) {
                $tempban = '0';
            } else {
                $tempban = $secure->clean($_POST['tempban']);
            }
            // Confirm
            if (!isset($_POST['confirmed'])) {
                $system->confirm(L_CONFIRM_TEMPORARY_BAN, L_CONFIRM_TEMPORARY_BAN_MSG, './?view=' . $view . '', array("warning" => $warning, "tempban" => $tempban, "tban" => ''));
            }
            $bantime = time() + $tempban;
            $warning = str_replace('[TIME]', $system->time($bantime), L_TEMPORARY_BAN_ISSUED) . $warning;
            $db->query("UPDATE accounts SET bantime = '$bantime' WHERE id = '$accused';") or die(mysql_error());
            $db->query("UPDATE accounts SET warning = warning+1 WHERE id = '$accused';") or die(mysql_error());
            $db->query("UPDATE " . $prefix . "_reports SET actioned = '1', action_id = '" . $account['id'] . "',  outcome = '$warning' WHERE id = '$view';") or die(mysql_error());
            $system->message(L_TEMPORARY_BAN, str_replace(array('[TIME]'), array($system->time($bantime)), L_RESOLUTION_CENTRE_TEMPORARY_BAN), './?view=' . $view . '', L_CONTINUE);
        } else {
            if ($report['actioned'] == '1') {
                $actioned = $user->name($report['action_id']);
            } else {
                $actioned = L_NO;
            }
            if (!$report['content']) {
                $cont = '';
                $tpl = str_replace($STYLE->getcode('content', $tpl), '', $tpl);
            } else {
                $cont = $report['content'];
            }
            if ($report['actioned'] == '1') {
                $tpl = str_replace($STYLE->getcode('warning', $tpl), '', $tpl);
            } else {
                $tpl = str_replace($STYLE->getcode('outcome', $tpl), '', $tpl);
            }
        }
        $code = $STYLE->getcode('normal', $tpl);
        $tpl = str_replace($code, '', $tpl);
        $code = $STYLE->getcode('report', $tpl);
        $content = '';
        $class = '0';
        $content .= $STYLE->tags($code, array("ACCUSED" => $user->name($report['account_id']),
                    "REPORTER" => $user->name($report['reporter_id']),
                    "REASON" => $system->bbcode($report['reason']),
                    "CONTENT" => $system->bbcode($cont),
                    "OUTCOME" => $system->bbcode($report['outcome']),
                    "WARNINGS" => $user->value($report['account_id'], 'warning'),
                    "DATE" => $system->time($report['date']),
                    "ACTION" => $actioned,
                    "L_DETAILS" => L_DETAILS,
                    "L_CONTENT" => L_CONTENT,
                    "L_REASON" => L_REASON,
                    "L_OUTCOME" => L_OUTCOME,
                    "L_WARNINGS" => L_WARNINGS,
                    "L_ACTIONED" => L_ACTIONED,
                    "L_SEND_WARNING" => L_SEND_WARNING,
                    "L_BAN" => L_BAN,
                    "L_TEMPORARY_BAN" => L_TEMPORARY_BAN,
                    "L_CLOSE" => L_CLOSE,
                    "L_ONE_HOUR" => L_ONE_HOUR,
                    "L_ONE_DAY" => L_ONE_DAY,
                    "L_TWO_DAYS" => L_TWO_DAYS,
                    "L_ONE_WEEK" => L_ONE_WEEK,
                    "L_TWO_WEEKS" => L_TWO_WEEKS));
        $class = 1 - $class;
        $tpl = str_replace($code, $content, $tpl);
    } else {
        $system->message(L_ERROR, L_RESOLUTION_CENTRE_NOT_FOUND, './', L_CONTINUE);
    }
} else {
    // List View
    if ($type == 'closed') {
        $sql = "SELECT * FROM " . $prefix . "_reports WHERE actioned='1'";
        $relay = "./?type=closed";
    } else if ($type == 'abuse') {
        $sql = "SELECT * FROM " . $prefix . "_reports WHERE content = '' AND actioned='0'";
        $relay = "./?type=abuse";
    } else if ($type == 'content') {
        $sql = "SELECT * FROM " . $prefix . "_reports WHERE content != '' AND actioned='0'";
        $relay = "./?type=content";
    } else {
        $sql = "SELECT * FROM " . $prefix . "_reports WHERE actioned='0'";
        $relay = "./";
    }
    $limiter = "10";
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
    $pt = $system->paginate("$sql", "$limiter", "$relay");
    $postsql = $db->query("" . $sql . " ORDER BY id DESC LIMIT $start, $limiter;");
    $code = $STYLE->getcode('row', $tpl);
    $content = '';
    $class = '0';
    while ($row = mysql_fetch_array($postsql)) {

        if (!$row['content']) {
            $type = L_ABUSE;
        } else {
            $type = L_CONTENT;
        }
        $content .= $STYLE->tags($code, array("CLASS" => $class,
                    "ID" => $row['id'],
                    "TYPE" => '<a href="./?view=' . $row['id'] . '" class="normfont">' . $type . ' ' . L_REPORT_AGAINST . ' ' . strip_tags($user->name($row['account_id'])) . '',
                    "ACCOUNT" => $user->name($row['account_id']),
                    "REPORTER" => $user->name($row['reporter_id']),
                    "DATE" => $system->time($row['date'])
                ));
        $class = 1 - $class;
    }
}

if (!$content) {
    $system->page(L_NONE, L_RESOLUTION_CENTRE_NONE);
}
$tpl = str_replace($code, $content, $tpl);
$output .= $STYLE->tags($tpl, array("L_REPORTS" => L_REPORTS, "PAGES" => $pt, "L_TYPE" => L_TYPE, "L_DATE" => L_DATE, "L_ACCOUNT" => L_ACCOUNT, "L_REPORTER" => L_REPORTER, "L_ID" => L_ID));
?>
