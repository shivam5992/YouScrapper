<?php
$dbc=@mysql_connect('localhost','username','password')OR die('could not connect'. mysql_error());
mysql_select_db('databasename')OR die('could not select database'.mysql_error());
?>