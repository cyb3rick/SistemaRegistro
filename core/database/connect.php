<?php

/* 
$connect_error = "Sorry, we're experiencing connection problems.";
mysql_connect("localhost", "g15", "Tiny15Biz") or die(mysql_error());
mysql_select_db("g15") or die(mysql_error()); 
*/

$connect_error = "Sorry, we're experiencing connection problems.";
mysql_connect("localhost", "root", "radical") or die(mysql_error());
mysql_select_db("SistemaRegistro") or die(mysql_error());

?>
