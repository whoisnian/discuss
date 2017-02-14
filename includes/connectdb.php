<?php

$con = mysql_connect("localhost","user","passwd");
if(!$con){
	die('Could not connect: '.mysql_error());
}
mysql_select_db("discuss",$con);

?>
