<?php

/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */

class db {

    var $host = NULL;
    var $username = NULL;
    var $password = NULL;
    var $dbmaster = NULL;
    var $dbslave = NULL;
    var $db = NULL;

    function connect($host, $username, $password, $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        $this->db = mysql_connect($this->host, $this->username, $this->password);
        mysql_select_db($database);
        if (mysql_select_db($database) == FALSE) {
            echo '<script language="javascript">
window.location="./install/";
</script>';
        }
    }

    function query($query) {
        $sql = mysql_query($query, $this->db) or die(mysql_error());
        return $sql;
        mysql_free_result($sql);
    }

    function fetch($query) {
        $sql = mysql_fetch_array(mysql_query($query, $this->db));
        return $sql;
        mysql_free_result($sql);
    }

    function close() {
        mysql_close($this->db);
    }

}

?>
