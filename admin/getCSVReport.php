<?php
if(!isset($_REQUEST["id"]))
 die("Illegal Request");
error_reporting(0);
include("../includes/check_session.php");
include("../includes/admin_session.php");
include("../includes/connect.php");
include("../includes/functions.php");
$file = "emptyFile";

if($_REQUEST["id"]==0)
{
    $query = "select registration.regno, students.name, students.dept, students.dept_code, registration.choice1, registration.choice2  from registration, students where students.regno=registration.regno";
$export = sql_query($query) or die ( "Sql error : " . mysql_error( ) );
$file = "Complete_".Time();
}
elseif($_REQUEST["id"]==1 && $_REQUEST["subject"]!='NULL')
{
    $query = "select registration.regno, students.name, students.dept from registration, students where (registration.choice1=(select sid from subjects where code='".$_REQUEST["subject"]."') OR registration.choice2=(select sid from subjects where code='".$_REQUEST["subject"]."')) AND students.regno=registration.regno";
$export = sql_query($query) or die ( "Sql error : " . mysql_error( ) );
$file = $_REQUEST["subject"]."_".Time();
}
elseif($_REQUEST["id"]==2 && $_REQUEST["subject"]!='NULL')
{
$query = "select registration.regno, students.name, students.dept from registration, students where (registration.choice1='".$_REQUEST["subject"]."' OR registration.choice2='".$_REQUEST["subject"]."') AND students.regno=registration.regno";
$export = sql_query($query) or die ( "Sql error : " . mysql_error( ) );
$file = getFilename($_REQUEST["subject"])."_".Time();
}
elseif($_REQUEST["id"]==3 && $_REQUEST["dept"]!='NULL')
{
$query = "select registration.regno, students.name, students.dept from registration, students where registration.regno = students.regno AND students.dept='".$_REQUEST["dept"]."'";
$export = sql_query($query) or die ( "Sql error : " . mysql_error( ) );
$file = $_REQUEST["dept"]."_".Time();
}

$csv_data=array();
while( $row = mysql_fetch_row( $export ) )
{
    $line = '';
    $csv_line=array();
    foreach( $row as $value )
    {
        $csv_val= $value;
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
            
        }
        else
        {
            //$value = str_replace( ':' , '', $value );
            $value = $value.",";
        }
        $line .= $value;
        array_push($csv_line,$csv_val);
    }
	$csv_line[4]=getSubject($csv_line[4]);
	$csv_line[5]=getSubject($csv_line[5]);
    $data .= rtrim( $line,',' ) . "\n";
    array_push($csv_data,$csv_line);
}

$data = str_replace( "\r" , "" , $data );

if ( $data == "" )
{
    $data = "\n(0) Records Found!\n";
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$file.".csv");
header("Pragma: no-cache");
header("Expires: 0");
//print "$header\n$data";
outputCSV($csv_data);

?>