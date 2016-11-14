<?php
$con = mysql_connect("localhost","root","");
$sel = mysql_select_db("water", $con);
if (!$con){
die ("NOT CONNECTING");
}

?>