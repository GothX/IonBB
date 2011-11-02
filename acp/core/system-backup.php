<?php

/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$tpl = $STYLE->open('./acp/system-backup.tpl');
// GENERATE BACKUP
if (isset($_POST['generate'])) {

    function backup_tables($host, $user, $pass, $name, $tables = '*') {
        $return = '';
        $link = mysql_connect($host, $user, $pass);
        mysql_select_db($name, $link);

        if ($tables == '*') {
            $tables = array();
            $result = mysql_query('SHOW TABLES');
            while ($row = mysql_fetch_row($result)) {
                $tables[] = $row[0];
            }
        } else {
            $tables = is_array($tables) ? $tables :
                    explode(',', $tables);
        }

        foreach ($tables as $table) {
            $result = mysql_query('SELECT * FROM ' . $table);
            $num_fields = mysql_num_fields($result);
            $return.= 'DROP TABLE ' . $table . ';';
            $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE ' . $table));
            $return.= "\n\n" . $row2[1] . ";\n\n";
            for ($i = 0; $i < $num_fields; $i++) {
                while ($row = mysql_fetch_row($result)) {
                    $return.= 'INSERT INTO ' . $table . ' VALUES(';
                    for ($j = 0; $j < $num_fields; $j++) {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = str_replace("\n", "\\n", $row[$j]);

                        if (isset($row[$j])) {
                            $return.= '"' . $row[$j] . '"';
                        } else {
                            $return.= '""';
                        }


                        if ($j < ($num_fields - 1)) {
                            $return.= ',';
                        }
                    }

                    $return.= ");\n";
                }
            }

            $return.="\n\n\n";
        }
        $handle = fopen('backups/' . date("d-m-Y") . '-' . time() . '-' . $name . '.sql', 'w+');
        fwrite($handle, $return);
        fclose($handle);
    }

    backup_tables($dbhost, $dbuser, $dbpassword, $dbmaster);
    $system->redirect('./?s=system&module=backup');
}
// DELETE BACKUP
if (isset($_POST['delete'])) {
    $delete = $secure->clean($_POST['id']);
    if (file_exists('./backups/' . $delete . '')) {
        unlink('./backups/' . $delete . '');
        $system->redirect('./?s=system&module=backup');
    }
}
$content = '';
$class = '0';
$dir = opendir("backups/");
$files = '';
while (false != ($file = readdir($dir))) {

    if (($file != ".") and ($file != "..") and ($file != "index.php")) {

        $content .= $STYLE->tags($STYLE->getcode('row', $tpl), array("CLASS" => $class, "TITLE" => $file, "OPTIONS" => ''));
        $class = 1 - $class;
    }
}
$tpl = str_replace($STYLE->getcode('row', $tpl), $content, $tpl);
$output .= $STYLE->tags($tpl, array(
            "L_DELETE" => L_DELETE,
            "L_DOWNLOAD" => L_DOWNLOAD,
            "L_GENERATE_BACKUP" => L_GENERATE_BACKUP,
            "L_BACKUP" => L_BACKUP,
            "L_BACKUP_MSG" => L_BACKUP_MSG,
            "L_OPTIONS" => L_OPTIONS));
?>