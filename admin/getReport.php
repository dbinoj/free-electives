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
                <legend>Seat Statistics</legend>
                <?php /*
                $table_data = "";
                    $table_data .= "<table border=1 >
                            <tr>
                                <td>S.No</td><td>Reg.No</td><td>Name</td><td>Choice-1</td><td>Choice - 2</td><td>Department</td>
                            </tr>

                            ";
							*/
            $query = "select registration.regno, students.name,registration.choice1, registration.choice2, students.dept from registration, students where students.regno=registration.regno";
            $result = sql_query($query) or die ( "Sql error : " . mysql_error( ) );
            $count=1;
            $aero=0;
            $bioinfo=0;
            $biotech=0;
            $civil=0;
            $cse=0;
            $eee=0;
            $ece=0;
            $eie=0;
            $emt=0;
            $it=0;
			$fp=0;
            $mech=0;
            while($row = mysql_fetch_array($result))
            {
                $dept = substr($row["dept"],8,-1);

              //  $table_data .= "<tr><td>".$count++."</td><td>".$row["regno"]."</td><td>".$row["name"]."</td><td>".getSubject($row["choice1"])."</td><td>".getSubject($row["choice2"])."</td><td>".$dept."</td></tr>";
                if($dept == " Aero Spac")
                    $aero+=2;
                else if($dept == "Bio Informatics")
                    $bioinfo+=2;
                else if($dept == " Bio Tec")
                    $biotech+=2;
                else if($dept==" Civil En")
                    $civil+=2;
                else if($dept == " CS")
                    $cse+=2;
                else if($dept == " EE")
                    $eee+=2;
                else if($dept == " EC")
                    $ece+=2;
                else if($dept == " EI")
                    $eie+=2;
                else if($dept == " EM")
                    $emt+=2;
                else if($dept == " I")
                    $it+=2;
                else if($dept == " Mec")
                    $mech+=2;
				else if($dept == " Food Processin")
                    $fp+=2;
            }
           //  $table_data .= "</table>";
             $count_qry = "select sum(availability) from subjects";
             $cnt_result = mysql_query($count_qry) or Die("Count Error:".mysql_error());
             $cnt_row = mysql_fetch_array($cnt_result);

             $vaccant = $cnt_row[0];
             print "

                <div id=\"Registration\">
			FusionCharts
		</div>
		<script language=\"JavaScript\">
			var chart1 = new FusionCharts(\"../FusionCharts/Pie3D.swf\", \"Registration\", \"800\", \"400\", \"0\", \"1\");
			chart1.setDataXML(\"<chart bgColor='FAFAFA' bgAlpha='100' enableRotation='1'> \
                            <set label='Aerospace' value='".$aero."'/> \
                            <set label='Bio Informatics' value='".$bioinfo."'/> \
                            <set label='Bio Technology' value='".$biotech."'/> \
                            <set label='Civil' value='".$civil."'/> \
                            <set label='Computer Science' value='".$cse."'/> \
                            <set label='Electrical and Electronics' value='".$eee."'/> \
                            <set label='Electronics and Communication' value='".$ece."'/> \
                            <set label='Electronics and Instrumentation' value='".$eie."'/> \
                            <set label='Electronics and Media' value='".$emt."' /> \
                            <set label='Information Technology' value='".$it."' /> \
                            <set label='Mechanical' value='".$mech."' /> \
							<set label='Food Processing' value='".$fp."' /> \
                            <set label='Vaccancy' value='".$vaccant."' /> \
                            </chart>\");
			chart1.render(\"Registration\");
		</script>

           ";
                ?>
                </fieldset>
            <fieldset>
                <legend>Generate CSV Reports</legend>
                <form name="searchForm2" action="getCSVReport.php?id=0" method="post">
            <?php
            //    print $table_data;
            ?>
                    <br/>
            <div><center><button type="submit" id="submit-go">Complete Report</button></center></div>
                    </form>
					
					<form name="deptForm" action="getCSV.php?id=dept" method="post">

                <div id="field">
                    <label style="width:15em;">Department:</label>
                    <?php include("../includes/allDept.php");?>

                </div>
                                        <br/>
                <div><center><button type="submit" id="submit-go">Department Report</button></center></div>
                </form>
				                <form name="subjForm" action="getCSV.php?id=subj" method="post">

                <div id="field">
                    <label style="width:15em;">Subject:</label>
                    <?php include("../includes/idSubjects.php");?>

                </div>
                                        <br/>
                <div><center><button type="submit" id="submit-go">Subject Report</button></center></div>
                </form>
            

                </fieldset>
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