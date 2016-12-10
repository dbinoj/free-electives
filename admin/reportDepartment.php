<?php
session_start();
include("../includes/check_session.php");
include("../includes/admin_session.php");

include('../includes/header.php');
include('../includes/menu.php');
include('../includes/connect.php');

?>
<div id="Content">
    <center>
        <div id="text">
            <fieldset>
                <legend>Report by Department</legend>
                <form name="searchForm" action="reportDepartment.php" method="post">

                <div id="field">
                    <label style="width:15em;">Select Department:</label>
                    <?php include("../includes/allDept.php");?>

                </div>
                                        <br/>
                <div><center><button type="submit" id="submit-go">Get Report</button></center></div>
                </form>
                <script type="text/javascript">
                    var searchvalidator = new Validator("searchForm");
                    searchvalidator.addValidation("subject","dontselect=NULL");

                </script>
            </fieldset>
            <?php
            $dept = $_POST["dept"];
            if(!empty($dept))
            {
                print "<fieldset>
                <legend>".$dept."</legend>
                <form >";

            print "<table border=1 >
                            <tr>
                                <td>S.No</td><td>Reg.No</td><td>Name</td><td>Choice-1</td><td>Choice - 2</td><td>Department</td>
                            </tr>

                            ";
            $query = "select registration.regno, students.name,registration.choice1, registration.choice2, students.dept from registration, students where registration.regno = students.regno AND students.dept='".$dept."'";
            $result = sql_query($query) or die ( "Sql error : " . mysql_error( ) );
            $count=1;
            while($row = mysql_fetch_array($result))
            {

                print "<tr><td>".$count++."</td><td>".$row["regno"]."</td><td>".$row["name"]."</td><td>".getSubject($row["choice1"])."</td><td>".getSubject($row["choice2"])."</td><td>".$row["dept"]."</td></tr>";

            }
             print "</table>
                 </form>
                </fieldset>
                 ";
            }
            ?>


  </div>
    </center>
</div>
<?php

function getSubject($sid)
{
    $fname_qry = "select code from subjects where sid=".$sid;
    $result = mysql_query($fname_qry) or Die("subjError:".mysql_error());
    $row=mysql_fetch_array($result);
    return $row[0];
}


include('../includes/footer.php');
?>