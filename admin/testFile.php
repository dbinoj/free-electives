<?php
include('../includes/connect.php');

updateTable();
function updateTable()
{
    $sub_qry = "select distinct code from subjects";
    $sub_result = mysql_query($sub_qry);
    while($sub_row = mysql_fetch_array($sub_result))
    {
        $dept_qry = "select distinct dept from students";
        $dept_result = mysql_query($dept_qry);

        while($dept_row = mysql_fetch_array($dept_result))
        {
            $query = "select count(registration.regno) from registration, students where (registration.choice1 in (select sid from subjects where code='".$sub_row[0]."') OR registration.choice2 in (select sid from subjects where code='".$sub_row[0]."')) AND students.dept ='".$dept_row[0]."' AND students.regno=registration.regno";
            $qry_result = mysql_query($query) or Die("select Error:".mysql_error());
            $row = mysql_fetch_array($qry_result);
            echo $row[0];
            $update_qry = "update `graph` set `".substr($dept_row[0],8,-1)."`= '".$row[0]."' where `code` = '".$sub_row[0]."'";
            mysql_query($update_qry) or Die("updateError:".mysql_error());
        }
    }
}

    ?>