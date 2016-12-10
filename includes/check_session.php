<?php
//session_start();
if(!isset($_SESSION)){
 session_start();
}
if(!(isset($_SESSION["userflag"])))
    header("Location: ../");

?>
