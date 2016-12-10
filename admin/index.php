<?php
/* include header
 * Check Admin Session
 * include menu or redirect
 *
 */

include("../includes/check_session.php");
include("../includes/admin_session.php");

include('../includes/header.php');
include('../includes/menu.php');
include('../includes/connect.php');


?>
<div id="title">Statistics</div>
<div id="Content">
    <center>
        <div id="text">
            <fieldset>
                <legend>Registration</legend>
                <?php

                    $count_qry = "select count(id) from registration UNION select max(sno) from students";
                    $result = mysql_query($count_qry);
                    $reg = mysql_fetch_array($result);
                    $tot = mysql_fetch_array($result);
                   
                     echo "<div id=\"chart1div\">
			FusionCharts
		</div>
		<script language=\"JavaScript\">
			var chart1 = new FusionCharts(\"../FusionCharts/Column3D.swf\", \"Registration\", \"400\", \"300\", \"0\", \"1\");
			chart1.setDataXML(\"<chart bgColor='FAFAFA' bgAlpha='100' caption='Registration Details'><set label='Registered' value='".$reg[0]."' /><set label='Unregistered' value='".($tot[0] - $reg[0])."' /><set label='Total' value='".$tot[0]."' /></chart>\");
                        //chart1.setTransparent(true);
                         chart1.addParam(\"WMode\", \"Transparent\");
			chart1.render(\"chart1div\");
		</script>
                ";
                    

                ?>
                </fieldset>
            <fieldset>
                <legend>Subjects</legend>
                <form>
                <?php
                $avail_qry = "select * from subjects";
                        $result = mysql_query($avail_qry);
                        print "<table border=1 >
                            <tr>
                                <td>S.No</td><td>Subject Name</td><td>Code</td><td>Availability</td>
                            </tr>

                            ";
                        while($row = mysql_fetch_array($result))
                        {
                            print "<tr><td>".$row["sid"]."</td><td>".$row["name"]."</td><td>".$row["code"]."</td><td>".$row["availability"]."</td></tr>";
                        }
                         print "</table>";
                         ?>
                </form>
            </fieldset>
        </div>
    </center>
</div>
<?php include('../includes/footer.php')?>