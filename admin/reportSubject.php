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
                <legend>Report by Subjects</legend>
                <form name="searchForm" action="reportSubject.php" method="post">

                <div id="field">
                    <label style="width:15em;">Select Subject:</label>
                    <?php include("../includes/allSubjects.php");?>

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
            $sub_name = $_POST["subject"];
            if(!empty($sub_name))
            {
            /*$subject_report = "select distinct code, name from subjects";
            $subj_result = mysql_query($subject_report);

            while($subject = mysql_fetch_array($subj_result))
            {*/
            $table_data = "";
            $sname = getSubjectName($sub_name);
            $table_data .= "<fieldset>
                <legend>".$sub_name." - ".$sname."</legend>
                <form >";

            $table_data .= "<table border=1 >
                            <tr>
                                <td>S.No</td><td>Reg.No</td><td>Name</td><td>Choice-1</td><td>Choice - 2</td><td>Department</td>
                            </tr>

                            ";
            $query = "select registration.regno, students.name,registration.choice1, registration.choice2, students.dept from registration, students where (registration.choice1 in (select sid from subjects where code='".$sub_name."') OR registration.choice2 in (select sid from subjects where code='".$sub_name."')) AND students.regno=registration.regno";
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

                $table_data .= "<tr><td>".$count++."</td><td>".$row["regno"]."</td><td>".$row["name"]."</td><td>".getSubject($row["choice1"])."</td><td>".getSubject($row["choice2"])."</td><td>".$row["dept"]."</td></tr>";
                if($dept == " Aero Spac")
                    $aero+=1;
                else if($dept == "Bio Informatics")
                    $bioinfo+=1;
                else if($dept == " Bio Tec")
                    $biotech+=1;
                else if($dept==" Civil En")
                    $civil+=1;
                else if($dept == " CS")
                    $cse+=1;
                else if($dept == " EE")
                    $eee+=1;
                else if($dept == " EC")
                    $ece+=1;
                else if($dept == " EI")
                    $eie+=1;
                else if($dept == " EM")
                    $emt+=1;
                else if($dept == " I")
                    $it+=1;
                else if($dept == " Mec")
                    $mech+=1;
				else if($dept == " Food Processin")
                    $fp+=1;
            }
             $table_data .= "</table>
                            </form>
                            </fieldset>";
             $count_qry = "select sum(Total) from subjects where code='".$sub_name."'";
             $cnt_result = mysql_query($count_qry) or Die("Count Error:".mysql_error());
             $cnt_row = mysql_fetch_array($cnt_result);

             $vaccant = $cnt_row[0] - ($aero+$bioinfo+$biotech+$civil+$cse+$eee+$ece+$eie+$emt+$it+$mech);
             print "
                <fieldset>
                <legend>Statistics - ".$sname."</legend>
                <div id=\"Registration\">
			FusionCharts
		</div>
		<script language=\"JavaScript\">
			var chart1 = new FusionCharts(\"../FusionCharts/Pie3D.swf\", \"Registration\", \"800\", \"400\", \"0\", \"1\");
			chart1.setDataXML(\"<chart bgColor='FAFAFA' bgAlpha='100' enableRotation='1' caption='".$sname."'> \
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
                </fieldset>
           ";

             print $table_data;
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

function getSubjectName($name)
{
    $fname_qry = "select name from subjects where code='".$name."'";
    $result = mysql_query($fname_qry) or Die("subjError:".mysql_error());
    $row=mysql_fetch_array($result);
    return $row[0];
}
include('../includes/footer.php');
?>