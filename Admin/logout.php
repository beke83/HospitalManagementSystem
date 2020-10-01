<?php require_once("../include/db_connect.php"); ?>
<?php require_once("../include/Functions.php");?>

<?php
session_start();
session_destroy();
Redirect_to("adminLogin.php");
