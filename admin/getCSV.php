<?php
if(!isset($_GET["id"]))
 die("Illegal Request: 0x000");
error_reporting(0);
include("../includes/check_session.php");
include("../includes/admin_session.php");
include("../includes/connect.php");
include("../includes/functions.php");

if($_GET["id"]=="dept")	{
$dept = $_POST["dept"];
            if(!empty($dept))
            {
            $query = "select registration.regno, students.name, registration.choice1, registration.choice2, students.dept from registration, students where registration.regno = students.regno AND students.dept='".$dept."'";
            $result = sql_query($query) or die ( "Sql error : " . mysql_error( ) );
			$deptData=array();
            while($row = mysql_fetch_array($result))
            {
                $row["choice1"]=getSubject($row["choice1"]);
				$row["choice2"]=getSubject($row["choice2"]);
				$row =  array_remove_key($row, "0", "1", "2", "3", "4");
				array_push($deptData,$row);
            }
			$file = $_REQUEST["dept"]."_".Time();
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=".$file.".csv");
			header("Pragma: no-cache");
			header("Expires: 0");
			outputCSV($deptData);
            }
            
}
elseif($_GET["id"]=="subj")	{
$sub_id = $_POST["subject"];
            if(!empty($sub_id))
			{
			$query = "select registration.regno, students.name,registration.choice1, registration.choice2, students.dept from registration, students where (registration.choice1='".$sub_id."' OR registration.choice2='".$sub_id."') AND students.regno=registration.regno";
            $result = sql_query($query) or die ( "Sql error : " . mysql_error( ) );
			$subjData=array();
            while($row = mysql_fetch_array($result))
			{
				$row =  array_remove_key($row, "0", "1", "2", "3", "4", "choice1", "choice2");
				array_push($subjData,$row);
			}
			$file = getSubject($_REQUEST["subject"])."_".Time();
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=".$file.".csv");
			header("Pragma: no-cache");
			header("Expires: 0");
			outputCSV($subjData);
			}
}
else
	die("Illegal Request: 0x010");
//PHP Tag not closed intentionally to prevent tailing space issues.