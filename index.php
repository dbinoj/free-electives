<?php
include("./includes/connect.php");
session_start();

if(isset($_REQUEST["id"]) && strcmp($_REQUEST["id"],"logout")==0)
{
    unset($_SESSION["username"]);
    unset($_SESSION["userflag"]);
    unset($_SESSION["dept"]);
    session_destroy();
    header("Location: ./");
}
if (isset($_SESSION["userflag"]))
{
if($_SESSION["userflag"]==1)
    header('Location: ./admin/');
else if($_SESSION["userflag"]==2)
    header('Location: ./students/');
}

if(isset($_POST["UserID"]) && isset($_POST["Password"])) {
	$uname = trim($_POST["UserID"]);
	$pass = trim($_POST["Password"]);
}

if(empty($uname)||empty($pass))
{
?>
<html>
<head>
<title>Free Electives</title>
        <link rel="stylesheet" type="text/css" href="css/screen.css">
	<link rel="stylesheet" type="text/css" href="css/dropdown.css">
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
	<script type="text/javascript" src="js/helpers.js"></script>
	<script type="text/javascript" src="js/validator.js"></script>
</head>
<body onload="document.loginForm.UserID.focus()">
    <div id="title" style="padding-top:8%;">Free Electives Registration</div>
    <div><center>Login With Seraph Authentication Credentials</center></div>
    <div id="content">
        <center>
            <form action="index.php" method="post" name="loginForm">
                   <fieldset>
                       <div id="fields" style="padding:10%;">
                        <table>
                           <div>
                                <tr>
                                   <td align="center"> <label for="name" style="float:none;">Register Number:</label></td>
                                   <td><input type="text" id="UserID" tabindex="1" name="UserID"></td>
                                </tr>
                           </div>
                           <div>
                                 <tr>
                                    <td align="center"><label for="pass" style="float:none;">Password</label></td>
                                    <td><input type="password" id="Password" tabindex="2" name="Password"></td>
                                </tr>
                           </div>
                       </table>
                        <div style="padding:10px;">
                             <input type="submit" value="Login" style="width:5em;margin-right:10px;">
                             <input type="reset" value="Reset" style="width:5em;">
                        </div>
                        </div>
                  </fieldset>
            </form>
    <script type="text/javascript">
        var frmvalidator = new Validator("loginForm");
        frmvalidator.addValidation("UserID", "req");
        frmvalidator.addValidation("Password", "req");
        </script>
</center>
</div>
<?php
}
else
{
    $auth = authenticate();
    if($auth > 0)
    {
        if($auth==1){
            $_SESSION["username"]=$uname;
            $_SESSION["userflag"]=1;
            header('Location:./admin/');
        }
        else if($auth==2)
        {
            $_SESSION["username"]=strtoupper($uname);
            $_SESSION["userflag"]=2;
           $_SESSION["dept"]=getDept($uname);
            header('Location:./students/');
        }
        else
            header('Location:./');
    }
    else
    {?>
    <html>
<head>
<title>Free Electives Registration</title>
        <link rel="stylesheet" type="text/css" href="css/screen.css">
	<link rel="stylesheet" type="text/css" href="css/dropdown.css">
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
	<script type="text/javascript" src="js/helpers.js"></script>
	<script type="text/javascript" src="js/validator.js"></script>
</head>
<body onload="document.loginForm.UserID.focus()">
    <div id="title" style="padding-top:8%;">Free Electives Registration</div>
    
    <div id="content">
        <center>
            <form action="index.php" method="post" name="loginForm">
                   <fieldset>
                       <div id="fields" style="padding:10%;">
                        <table>
                           <div>
                                <tr>
                                   <td align="center"> <label for="name" style="float:none;">Register Number:</label></td>
                                   <td><input type="text" id="UserID" tabindex="1" name="UserID"></td>
                                </tr>
                           </div>
                           <div>
                                 <tr>
                                    <td align="center"><label for="pass" style="float:none;">Password</label></td>
                                    <td><input type="password" id="Password" tabindex="2" name="Password"></td>
                                </tr>
                           </div>
                       </table>
                        <div style="padding:10px;">
                             <input type="submit" value="Login" style="width:5em;margin-right:10px;">
                             <input type="reset" value="Reset" style="width:5em;">
                        </div>
                           <div style="color:red;">
                               Invalid UserID or Password
                               
                           </div>
                        </div>
                  </fieldset>
            </form>
    <script type="text/javascript">
        var frmvalidator = new Validator("loginForm");
        frmvalidator.addValidation("UserID", "req");
        frmvalidator.addValidation("Password", "req");
        
        </script>
</center>
</div>
<?php

}


}
function getDept($uname)
{
    $dept_qry = "select dept_code, dept from students where regno = '".mysql_real_escape_string($uname)."'";
    $result = sql_query($dept_qry);
    $row = mysql_fetch_array($result);
    $_SESSION["dept_name"]=$row[1];
    return $row[0];
}


function authenticate()
{
       $stu_query = "SELECT * FROM students WHERE regno = '".mysql_real_escape_string($_POST["UserID"])."'";
        $result = mysql_query($stu_query);
        $row = mysql_fetch_array($result);

        if(mysql_num_rows($result)!=0)
        {

            $ldap=ldap_connect("zion.karunya.edu");
            if (@ldap_bind($ldap,$_POST["UserID"]."@karunya.edu",$_POST["Password"]))
            {
                return 2;

            }
                return 0;

        }

        else
        {

              $staff_query = "SELECT * FROM staff WHERE name = '".mysql_real_escape_string($_POST["UserID"])."' AND password = MD5('".$_POST["Password"]."')";
              $result2 = mysql_query($staff_query);
              $row = mysql_fetch_array($result2);

                if(mysql_num_rows($result2)!=0){

                    return 1;
                }
        }

        return 0;

}

include("includes/footer.php")
?>
