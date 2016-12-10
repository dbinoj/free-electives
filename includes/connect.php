<?php

//Creating connection to the database
$sql_connect = mysql_connect("localhost","root","") or die ("Could not connect" . mysql_error);
mysql_select_db("fe",$sql_connect);

//Function used to execute the query
function sql_query($query)
{		
	$result = mysql_query($query) or die ("Could not execute query :" . mysql_error());
	return $result;
}



?>
