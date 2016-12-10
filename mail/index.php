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
                <legend>Subjects</legend>
                <form name="mailForm">
                    <div><center><a href="sendMail.php"><button type="submit" id="submit-go">Register</button></a></center></div>
                </form>
            </fieldset>
        </div>
    </center>
</div>
<?php include('../includes/footer.php')?>