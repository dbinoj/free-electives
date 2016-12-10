<?php
function checkDep($chkdept)
{
    if($chkdept==$_SESSION["dept"])
        return false;
    else
        return true;
}

function getSchool($dept)
{
    if($dept=='CSE' || $dept=='IT')
        return 'CST';
    else if($dept=='ECE' || $dept=='EEE' || $dept=='EIE')
        return 'ESC';
}

function print_ar($array){
  echo "<pre>";
  print_r($array);
  echo "</pre>\n";
}

function getSubject($sid)
{
    $fname_qry = "select code from subjects where sid=".$sid;
    $result = mysql_query($fname_qry) or Die("subjError:".mysql_error());
    $row=mysql_fetch_array($result);
    return $row[0];
}


function array_remove_key ()
{
  $args  = func_get_args();
  return array_diff_key($args[0],array_flip(array_slice($args,1)));
}

function getFileName($sid){
    $fname_qry = "select code, slot from subjects where sid=".$_REQUEST["subject"];
    $result = mysql_query($fname_qry);
    $row = mysql_fetch_array($result);

    return $row[0]."_".$row[1];

}


function outputCSV($data) {
    $outstream = fopen("php://output", 'w');
    function __outputCSV(&$vals, $key, $filehandler) {
        fputcsv($filehandler, $vals); // add parameters if you want
    }
    array_walk($data, '__outputCSV', $outstream);
    fclose($outstream);
}

?>