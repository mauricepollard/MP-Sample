<?php
 
 $link = mysql_connect("localhost", "result", "1Littleme!");
mysql_select_db("result-mysql", $link);

require 'exportcsv.inc.php';
 
$table="EDay_walk_list_A"; // this is the tablename that you want to export to csv from mysql.
 
exportMysqlToCsv($table);
 
?>