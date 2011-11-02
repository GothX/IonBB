<?php
/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$tpl = $STYLE->open('acp/community-ranks.tpl');
if (isset($_GET['edit'])) {
    $tpl = str_replace($STYLE->getcode('ranks', $tpl), '', $tpl);

    $rank_data = $db->fetch("SELECT * FROM ranks WHERE id = '" . $secure->clean($_GET['edit']) . "'");
    if (!$rank_data) {
        $system->message(L_ERROR, L_RANK_NOT_FOUND, './?s=community&amp;module=ranks', L_CONTINUE);
    }
    if (isset($_POST['Submit'])) {
        $name = $secure->clean($_POST['name']);
        $special = $secure->clean($_POST['special']);
        $postcount = $secure->clean($_POST['postcount']);
        $db->query("UPDATE ranks SET name = '$name', special = '$special', count = '$postcount' WHERE id = '" . $secure->clean($_GET['edit']) . "'");
        $system->redirect('./?s=community&module=ranks');
    }
    if ($rank_data['special'] == '1') {
        $special = 'selected';
        $normal = '';
    } else {
        $special = '';
        $normal = 'selected';
    }
    $output .= $STYLE->tags($tpl, array(
                "ID" => $rank_data['id'],
                "L_NAME" => L_NAME,
                "L_EDIT_RANK" => L_EDIT_RANK,
                "L_SPECIAL" => L_SPECIAL,
                "L_POSTS" => L_POSTS,
                "L_SUBMIT" => L_SUBMIT,
                "NAME" => $system->present($rank_data['name']),
                "POSTCOUNT" => $system->present($rank_data['count']),
                "NORMAL" => $normal,
                "SPECIAL" => $special));
} else {
    if (isset($_POST['edit'])) {
        $id = $secure->clean($_POST['id']);
        $system->redirect("./?s=community&module=ranks&edit=$id");
    }
    $tpl = str_replace($STYLE->getcode('edit', $tpl), '', $tpl);

    if (isset($_POST['newrank'])) {
        $name = $secure->clean($_POST['name']);
        $special = $secure->clean($_POST['special']);
        $postcount = $secure->clean($_POST['postcount']);
        $db->query("INSERT INTO ranks (name,special,count)
VALUES ('$name','$special','$postcount')");
        $system->redirect("./?s=community&module=ranks");
    }

// DELETE RANK
    if (isset($_POST['delete'])) {
        $delete_id = $secure->clean($_POST['id']);
        $db->query("DELETE FROM ranks WHERE id = '$delete_id'");
        $system->redirect("./?s=community&module=ranks");
    }
    $out = '';
    $rank_sql = $db->query("SELECT * FROM ranks ORDER BY special DESC,count DESC,id;");
    $class = 0;
    while ($row = mysql_fetch_array($rank_sql)) {
        if ($row['special'] == '0') {
            $info = str_replace("[count]", $row['count'], L_RANK_POST_COUNT);
        } else {
            $info = '';
        }
        $out .= $STYLE->tags($STYLE->getcode('row', $tpl), array("TITLE" => stripslashes($row['name']), "INFO" => $info, "ID" => $row['id'], "CLASS" => $class));
        $class = 1 - $class;
    }
    $tpl = str_replace($STYLE->getcode('row', $tpl), $out, $tpl);
    $output .= $STYLE->tags($tpl, array("L_ID" => L_ID, "L_INFO" => L_INFO, "L_OPTIONS" => L_OPTIONS,  "L_RANKS" => L_RANKS, "L_ADD_RANK" => L_ADD_RANK, "L_NAME" => L_NAME, "L_SPECIAL" => L_SPECIAL, "L_POSTS" => L_POSTS, "L_SUBMIT" => L_SUBMIT, "L_EDIT" => L_EDIT, "L_DELETE" => L_DELETE, "L_YES" => L_YES, "L_NO" => L_NO));
}
?>