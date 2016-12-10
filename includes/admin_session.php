<?php
session_start();
if($_SESSION["userflag"]!=1)
        header("Location: ../");

?>
