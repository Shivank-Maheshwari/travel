<?php
if (!$mysqli = mysql_connect('localhost', 'root', 'NO')) {
    echo 'Could not connect to mysql';
    exit;
}

if (!mysql_select_db('cake', $mysqli)) {
    echo 'Could not select database';
    exit;
}
?>