<?php
/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$tpl = $STYLE->open('./acp/system-extentions.tpl');
if (isset($_POST['submit']) && $_POST['name'] != '') {
    $name = $secure->clean($_POST['name']);
    $db->query("INSERT INTO " . $prefix . "_extensions (value) VALUES ('$name')");
    $system->redirect("./?s=system&module=extentions");
}
if (isset($_POST['delete'])) {
    $id = $secure->clean($_POST['id']);
    $db->query("DELETE FROM " . $prefix . "_extensions WHERE id = '$id'");
    $system->redirect("./?s=system&module=extentions");
}
// GENERATE LIST
$sql = $db->query("SELECT * FROM " . $prefix . "_extensions ORDER BY id");
$class = '0';
$out = '';
while ($row = mysql_fetch_array($sql)) {
    $id = $row['id'];
    $out .= $STYLE->tags($STYLE->getcode('row', $tpl), array("TITLE" => stripslashes($row['value']), "ID" => $id, "CLASS" => $class));
    $class = 1 - $class;
}
$tpl = str_replace($STYLE->getcode('row', $tpl), $out, $tpl);

$output .= $STYLE->tags($tpl, array(
            "L_NAME" => L_NAME,
            "L_DELETE" => L_DELETE,
            "L_EXTENTIONS" => L_EXTENTIONS,
            "L_ADD_EXTENTION" => L_ADD_EXTENTION,
            "L_SUBMIT" => L_SUBMIT,
            "L_ID" => L_ID,
            "L_INFO" => L_INFO,
            "L_OPTIONS" => L_OPTIONS
        ));
?>