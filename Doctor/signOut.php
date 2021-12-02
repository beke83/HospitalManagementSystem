<?php require_once("../include/session.php"); ?>
<?php require_once("../include/Functions.php"); ?>
<?php

$_SESSION["id"] =  null;
//kill a session
session_destroy();
Redirect_to("doctorLogin.php");

?>