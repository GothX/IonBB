<?php

/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$tpl = $STYLE->open('acp/ban.tpl');
$relay = "./?s=bans-ip";
$page_title .=' / ' . L_IP;
$type = '2';
$tpl = str_replace($STYLE->getcode('edit', $tpl), '', $tpl);
if (isset($_POST['Submit'])) {
    $value = $secure->clean($_POST['value']);
    $db->query("INSERT INTO " . $prefix . "_banlist (value,type)
VALUES ('$value','$type')");
    $system->redirect($relay, true);
}
if (isset($_POST['delete'])) {
    $delete_id = $secure->clean($_POST['id']);
    $db->query("DELETE FROM " . $prefix . "_banlist WHERE id = '$delete_id'");
    $system->redirect($relay, true);
}
$out = '';
$limiter = '20';
$sql = "SELECT * FROM " . $prefix . "_banlist WHERE type = '$type'";
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
// Generate Results
$row_sql = $db->query("" . $sql . " ORDER BY id LIMIT $start, $limiter;");
$class = 0;
while ($row = mysql_fetch_array($row_sql)) {
    $out .= $STYLE->tags($STYLE->getcode('row', $tpl), array("TITLE" => $system->present($row['value']), "ID" => $row['id'], "CLASS" => $class));
    $class = 1 - $class;
}
if (!$out) {
    $tpl = str_replace($STYLE->getcode('list', $tpl), '', $tpl);
}
$tpl = str_replace($STYLE->getcode('row', $tpl), $out, $tpl);
$output .= $STYLE->tags($tpl, array(
            "PAGES" => $paginate,
            "L_ADD_BAN" => L_ADD_BAN,
            "L_SUBMIT" => L_SUBMIT,
            "L_DELETE" => L_DELETE,
            "L_ID" => L_ID,
            "L_INFO" => L_INFO,
            "L_OPTIONS" => L_OPTIONS,
            "L_BANS" => L_BANS));
?>
