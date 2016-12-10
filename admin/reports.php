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
                <legend>Report By Subject</legend>
                <form name="searchForm" action="getCSVReport.php?id=1" method="post">

                <div id="field">
                    <label style="width:15em;">Select Subject:</label>
                    <?php include("../includes/allSubjects.php");?>

                </div>
                                        <br/>
                <div><center><button type="submit" id="submit-go">Submit</button></center></div>
                </form>
                <script type="text/javascript">
                    var searchvalidator = new Validator("searchForm");
                    searchvalidator.addValidation("subject","dontselect=NULL");
                    
                </script>
            </fieldset>
            <fieldset>
                <legend>Report By Subject and Slot</legend>
                <form name="searchForm2" action="getCSVReport.php?id=2" method="post">

                <div id="field">
                    <label style="width:15em;">Select Subject:</label>
                    <?php include("../includes/idSubjects.php");?>

                </div>
                                        <br/>
                <div><center><button type="submit" id="submit-go">Get Report</button></center></div>
                </form>
                <script type="text/javascript">
                    var searchvalidator = new Validator("searchForm2");
                    searchvalidator.addValidation("subject","dontselect=NULL");
                    
                </script>
            </fieldset>
            <fieldset>
                <legend>Report by Department</legend>
                <form name="searchForm3" action="getCSVReport.php?id=3" method="post">

                <div id="field">
                    <label style="width:15em;">Select Department:</label>
                    <?php include("../includes/allDept.php");?>

                </div>
                    
                    

                    <br/>
                <div><center><button type="submit" id="submit-go">Get Report</button></center></div>
                </form>
                <script type="text/javascript">
                    var searchvalidator = new Validator("searchForm3");
                    searchvalidator.addValidation("dept","dontselect=NULL");
                    
                </script>
            </fieldset>
  </div>
    </center>
</div>
<?php

include('../includes/footer.php');
?>