<?php
session_start();
include("../includes/check_session.php");
include("../includes/admin_session.php");

include('../includes/header.php');
include('../includes/menu.php');
include('../includes/connect.php');

updateTable();
?>
<div id="Content">
    <center>
        <div id="text">
            <?php
            $qry = "select * from graph";
            $result = mysql_query($qry);

            while($row = mysql_fetch_array($result))
            {

                
                $vac = $row[3] - $row[6] +$row[7] +$row[8] +$row[9] +$row[10] +$row[11] +$row[12] +$row[13] +$row[14] +$row[15] +$row[16];
           
           print "
            <fieldset>
                <legend>".$row["code"]." - ".$row["name"]."</legend>
               

                <div id=\"".$row["code"]."\">
			FusionCharts
		</div>
		<script language=\"JavaScript\">
			var chart1 = new FusionCharts(\"../FusionCharts/Pie3D.swf\", \"".$row["name"]."\", \"800\", \"400\", \"0\", \"1\");
			chart1.setDataXML(\"<chart> \
                            <set label='Aerospace' value='".$row[6]."'/> \
                            <set label='Bio Informatics' value='".$row[7]."'/> \
                            <set label='Bio Technology' value='".$row[8]."'/> \
                            <set label='Civil' value='".$row[9]."'/> \
                            <set label='Computer Science' value='".$row[10]."'/> \
                            <set label='Electrical and Electronics' value='".$row[11]."'/> \
                            <set label='Electronics and Instrumentation' value='".$row[12]."'/> \
                            <set label='Electronics and Media' value='".$row[13]."' /> \
                            <set label='Information Technology' value='".$row[14]."' /> \
                            <set label='Mechanical' value='".$row[15]."' /> \
                            <set label='Vaccancy' value='".$vac."' /> \
                            </chart>\");
			chart1.render(\"".$row["code"]."\");
		</script>
                
                

            </fieldset>
           ";
            }
            ?>
  </div>
    </center>
</div>
<?php

function updateTable()
{
   /* $sub_qry = "select distinct code from subjects";
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
            
            $update_qry = "update `graph` set `".substr($dept_row[0],8,-1)."`= '".$row[0]."' where `code` = '".$sub_row[0]."'";
            mysql_query($update_qry) or Die("updateError:".mysql_error());
        }
    }*/
}
include('../includes/footer.php');
?>