<?php require_once("../include/db_connect.php"); ?>
<?php require_once("../include/session.php"); ?> 
<?php

function Redirect_to($New_Location)
{
    header("Location:" . $New_Location);
    exit;
}

function Login_Attempt($Username, $Password)
{
    global $Connection;
    $Query = "SELECT * FROM admins_tbl 
        WHERE username='$Username' AND password = '$Password'";
    $Execute =  mysqli_query($Connection, $Query);
    if ($admin = mysqli_fetch_assoc($Execute)) {
        return $admin;
    } else {
        return null;
    }
}

function Login()
{
    if (isset($_SESSION["id"])) {
        return true;
    }
}

function confirm_login()
{
    if (!Login()) {
        $_SESSION["ErrorMessage"] = "Login Required!";
        Redirect_to("adminLogin.php");
    }
}

function confirm_patient_login()
{
    if (!Login()) {
        $_SESSION["ErrorMessage"] = "Login Required!";
        Redirect_to("patientLogin.php");
    }
}

function confirm_doctor_login()
{
    if (!Login()) {
        $_SESSION["ErrorMessage"] = "Login Required!";
        Redirect_to("doctorLogin.php");
    }
}

function randomString(){
    $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    echo substr(str_shuffle($permitted_chars), 0, 8);
}


?>