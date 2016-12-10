<?php

session_start();

if(!(isset($_SESSION["userflag"])))
    header("Location: ../");

if($_SESSION["userflag"]==1)
    header('Location: ../admin/');

else if($_SESSION["userflag"]==2)
    header('Location: ../students/');
?>
