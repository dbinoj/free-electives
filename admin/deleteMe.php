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

                <table border=1>
                            <tr>
                                <td>S.No</td><<td>Name</td><td>Availability</td><td>Price</td><td>Quantity</td><td></td>
                            </tr>
                            <tr>
                                <td>1</td><td>Shirt</td><td>20</td><td>300</td><td><input type="text"></td><td><input type="button" value="Add to Cart"></td>
                            </tr>
                            <tr>
                                <td>2</td><td>Tie</td><td>40</td><td>150</td><td><input type="text"></td><td><input type="button" value="Add to Cart"></td>
                            </tr>
                            <tr>
                                <td>3</td><td>Tshirt</td><td>30</td><td>120</td><td><input type="text"></td><td><input type="button" value="Add to Cart"></td>
                            </tr>
                            <tr>
                                <td>4</td><td>Shoes</td><td>20</td><td>1000</td><td><input type="text"></td><td><input type="button" value="Add to Cart"></td>
                            </tr>
                            <tr>
                                <td>5</td><td>Watch</td><td>10</td><td>1300</td><td><input type="text"></td><td><input type="button" value="Add to Cart"></td>
                            </tr>
                            </table>
                                        <br/>
                <div><center><button type="submit" id="submit-go">Get Report</button></center></div>
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



?>