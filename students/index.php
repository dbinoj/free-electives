<?php
session_start();
include("../includes/check_session.php");
include('../includes/header.php');
include('../includes/connect.php');
require('../includes/functions.php');

check_done();

function check_done()
{
    /*
     * Checking if the user already registered
     */
    $mysql_query = "SELECT * FROM registration WHERE regno = '".$_SESSION["username"]."'";
	$result = sql_query($mysql_query) or Die();
	if(mysql_num_rows($result)!=0)
	{
            $row=mysql_fetch_array($result);
            ?>
            <div id="Content">
                    <center>
                        <div id="text">
                <form>
                <div id="regno">
                    <label style="float:none;"><?php echo $_SESSION["username"]?></label>
                    </div>
                    <br/>
                <div id="status">
                    <label style="float:none;"><?php echo "You have Already registered";?></label>
                    </div>
                    <br/>
                    <div id="subjects">
                    <label style="float:none;"><?php echo getSelectedSubjects()?></label>
                    </div>
		<br/>
        <a href="../?id=logout"><div>
    <center><button id="submit-go" >Logout</button></center>
    </div></a>
                    </form>
                    </div>
    </center>
</div>
	<?php

        }
        else
            register();
}
?>
<script type="text/javascript" >
    $().ready(function() {

        
        $("#lchoice").hide();
       
       $("#Theory").click(function () {
                $("#tchoice").show();
                $("#lchoice").hide();
    });

        $("#Lab").click(function () {
                $("#tchoice").hide();
                $("#lchoice").show();
    });

    document.getElementByID("#Theory").setAttribute("checked","checked");
        document.getElementByID("#lchoice").setAttribute("selectedIndex",0);
        document.getElementByID("#tchoice").setAttribute("selectedIndex",0);

        
        
    });

    $("#regForm").submit(function(){

                        var sel = $("#Theory").attr("checked");

           if(sel == true)
               {
                   var ch1 = $("#tchoice1").val();
                   var ch2 = $("#tchoice2").val();

                   if(ch1=='NULL' || ch2 == 'NULL')
                       {
                           alert("Selection cannot be empty");
                           return false;
                       }

               }
               else
                   {
                       var sel2 = $("#Lab").attr("checked");
                       if(sel2 == true)
                   {
                   var ch1 = $("#lchoice1").val();
                   var ch2 = $("#lchoice2").val();

                   if(ch1=='NULL' || ch2 == 'NULL')
                       {
                           alert("Selection cannot be empty");
                           return false;
                       }
                   }
                   }
           var al =  confirm("Are you Sure?");
           if (al==true)
               {
            this.submit();
               }
               else
                   return false;
        }

    );
    
    </script>



<?php 
/*
 * Printing the Registration form
 */
function register(){


?>
<div id="Content">
    <center>
        <div id="text">
            <fieldset>
                <legend>Registration</legend>
                <form name="regForm" action="register.php" method="post" id="regForm">
                    <div id="regno">
                                <label for="regno"> Register Number</label>
				<input type="text" id="regno" tabindex="2" name="regno" value="<?php echo $_SESSION["username"];?>" readonly="true">
                        </div>

                        <div id="department">
                                <label for="department">Department</label>
                                <input type="text" name="department" value="<?php echo $_SESSION["dept_name"]?>" readonly="true">
                        </div>

                        <div id="elec-choice">
                            <label>Elective Choice</label>
                            <input type="radio" id="Theory" name="echoice" style="width:3em;"value="theory" checked="checked">Theory
                        </div>
                        <!--Theory Subjects-->
                        <div id="tchoice">
                            <div id="ch1">
                            <label>Theory Choice 1</label>
                             <?php
                             /*Dropdown list for Slot A subjects*/
                             include('../includes/GroupA.php');
                             ?>
                            </div>
                            <div id="ch2">
                                <label>Theory Choice 2</label>
                             <?php
                             /*Dropdown list for Slot B subjects*/
                             include('../includes/GroupB.php');
                             ?>
                                </div>
                        </div>
                        <!--Theory Subjects-->
                       <!-- <div id="lchoice">
                            <div id="ch1">
                            <label>Lab Choice 1</label>
                             <?php
                             /*Dropdown list for Slot C subjects*/
                            // include('../includes/GroupC.php');
                             ?>
                            </div>
                            <div id="ch2">
                                <label>Lab Choice 2</label>
                             <?php
                             /*Dropdown list for Slot D subjects*/
                             //include('../includes/GroupD.php');
                             ?>
                                </div>
                        </div>-->
                      <br/>
                    <div><center><button type="submit" id="submit-go">Register</button></center></div>
                </form>
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
            </fieldset>
             </div>
    </center>
</div>
<?php
}

function getSelectedSubjects(){
    $ss_query = "select name from subjects where sid = (select choice1 from registration where regno='".$_SESSION["username"]."') UNION select name from subjects where sid = (select choice2 from registration where regno='".$_SESSION["username"]."')";
    $result = mysql_query($ss_query) or Die("SSError:".mysql_erro());
    $sub1 = mysql_fetch_array($result);
    $sub2 = mysql_fetch_array($result);
    $subj .= "<strong>".$sub1[0]."</strong> <br/> & <br/> <strong>".$sub2[0]."</strong>";

    return $subj;
}

include('../includes/footer.php');
?>
