<html lang="en">
<head>
	<title>Free Electives Registration</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="../css/screen.css">
	<link rel="stylesheet" type="text/css" href="../css/dropdown.css">
        <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
	<script type="text/javascript" src="../js/helpers.js"></script>
	<script type="text/javascript" src="../js/validator.js"></script>
</head>
<body>

    <div id="header">
    <center></center>
</div>
     <div id="content">
     <center>
<?php
/* 
 * Session and connectivity includes
 */
include("../includes/check_session.php");

include("../includes/connect.php");

/*Check if any of the post parameters are empty*/
if(checkEmpty()){
    
    fun_end();
    Die();
}

$type = $_POST["echoice"];
$fchoice=0;
$schoice=0;
if($type == 'theory')
{
    $fchoice = $_POST["tchoice1"];
    $schoice = $_POST["tchoice2"];
    $choice1 = getSubject($fchoice);
    $choice2 = getSubject($schoice);
    
}
/*
else if($type == 'lab')
{
    $fchoice = $_POST["lchoice1"];
    $schoice = $_POST["lchoice2"];
    $choice1 = getSubject($fchoice);
    $choice2 = getSubject($schoice);
}
*/


if(checkValid($choice1, $choice2, $fchoice, $schoice)){
    
    fun_end();
    Die();
}

if(checkAvailable($fchoice, $schoice)){

    fun_end();
    Die();
}

if(updateData($fchoice, $schoice))
{
   fun_end();
    Die();
}
else{
    fun_success();
    Die();
}


function updateData($fch, $sch){

    $update_qry = "call update_avail('".$_SESSION["username"]."',".$fch.",".$sch.",@".$_SESSION["username"].")";
    
    mysql_query($update_qry) or Die("Error Check:".mysql_error());
    $result_qry = "select @".$_SESSION["username"];
    $result=mysql_query($result_qry);
    $row = mysql_fetch_array($result);
    
    if($row[0]==1)
    {
        print "Registered Successfully";
        return false;
    }
    else{
        print "Registration failed Try again";
        return true;
    }
}

/*Check if any of the user input is empty*/
function checkEmpty(){
    if($_REQUEST["echoice"] == "theory"){
        $chc1 = $_REQUEST["tchoice1"];
        $chc2 = $_REQUEST["tchoice2"];
        
        if($chc1=='NULL' || $chc2 == 'NULL'){
            print "Empty Fields Not Allowed";
            return true;
        }
        else{
            
            return false;
        }
    }

}

/*
 * Check if both the selected subjects are lab or theory
 * That is either A&B or C&D
 */
function checkValid($ch1, $ch2, $fch, $sch)
{
    
    if($ch1 == $ch2)
    {
        print "Selecting Same subjects not allowed";
        return true;
    }

    return false;
}

function checkAvailable($fchoice, $schoice)
{
       $avail_qry = "select min(availability) from subjects where sid in (".$fchoice.",".$schoice.")";
       $result = mysql_query($avail_qry);
       $row = mysql_fetch_array($result);

       if($row[0]<=0){
           print "One or more of the Selected subjects unavailable : ".$row[0];
           return true;
       }
       else
           return false;

}

/*
 * Get the subject name for a given Subject ID
 */
function getSubject($sid){

    $subj_qry = "select code from subjects where sid = ".$sid;
    $result = mysql_query($subj_qry) or Die("Error subj:".mysql_error());
    $row = mysql_fetch_array($result);
    
    return $row[0];
}

/*
 * Function called when any of the given conditions fails
 */
function fun_end()
{
    ?>

</center>
         <br/>
         <a href="./"><div>
    <center><button id="submit-go" >Back</button></center>
    </div></a>
 </div>
<?php

include("../includes/footer.php");
}

/*
 * Function called when registration succedes
 */
function fun_success()
{
    ?>

</center>
         <br/>
         <a href="../?id=logout"><div>
    <center><button id="submit-go" >Logout</button></center>
    </div></a>
 </div>
<?php

include("../includes/footer.php");

}

?>
