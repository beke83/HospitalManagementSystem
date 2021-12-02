<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_doctor_login();
?>

<?php
if (isset($_POST['submit'])) {
    $Firstname = mysqli_real_escape_string($db_connect, $_POST["firstname"]);
    $Lastname = mysqli_real_escape_string($db_connect, $_POST["lastname"]);
    $Gender = mysqli_real_escape_string($db_connect, $_POST["gender"]);
    $DOB = mysqli_real_escape_string($db_connect, $_POST["dob"]);
    $BloodGroup = mysqli_real_escape_string($db_connect, $_POST["bloodGroup"]);
    $Address = mysqli_real_escape_string($db_connect, $_POST["address"]);
    $City = mysqli_real_escape_string($db_connect, $_POST["city"]);
    $PhoneNumber = mysqli_real_escape_string($db_connect, $_POST["phoneNumber"]);
    $EmailAddress = mysqli_real_escape_string($db_connect, $_POST["emailAddress"]);
    $Password = mysqli_real_escape_string($db_connect, $_POST["password"]);
    $ConfirmPassword = mysqli_real_escape_string($db_connect, $_POST["confirmPassword"]);
    $Status = mysqli_real_escape_string($db_connect, $_POST["status"]);

    date_default_timezone_set("Africa/Lagos");
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
    $DateTime;

    $dt = date("Y-m-d");
    $tim = date("H:i:s");

    if (isset($_GET['editid'])) {
        $query = "UPDATE patient_tbl SET firstname='$_POST[firstname]',lastname='$_POST[lastname]',gender='$_POST[gender]', dob='$_POST[dob]',bloodGroup='$_POST[bloodGroup]', address='$_POST[address]', city='$_POST[city]', 
         phoneNumber='$_POST[phoneNumber]',emailAddress='$_POST[emailAddress]', password='$_POST[password]', confirmPassword='$_POST[confirmPassword]', status='$_POST[status]' WHERE id='$_GET[editid]'";
        if ($Execute = mysqli_query($db_connect, $query)) {

            $_SESSION["SuccessMessage"] = "Record Updated";
            Redirect_to("viewPatient.php");
        } else {

            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("viewPatient.php");
        }
    } else if (
        empty($Firstname) || empty($Lastname) || empty($Gender) || empty($DOB) || empty($BloodGroup) || empty($Address) || empty($PhoneNumber)
        || empty($EmailAddress) || empty($Password) || empty($ConfirmPassword) || empty($Status)
    ) {
        $_SESSION["ErrorMessage"] = "All Field must be Filled";
        Redirect_to("addPatient.php");
    } else if ($Password != $ConfirmPassword) {
        $_SESSION["ErrorMessage"] = "Password does'not match";
        Redirect_to("addPatient.php");
    } else {
        global $db_connect;
        $query = "INSERT INTO patient_tbl(firstname,lastname,gender,dob,bloodGroup,address,city,phoneNumber,emailAddress,password,confirmPassword,status,dateAdmitted,timeAdmitted)
        VALUES('$Firstname','$Lastname', '$Gender', '$DOB', '$BloodGroup', '$Address', '$City', '$PhoneNumber', '$EmailAddress', '$Password', '$ConfirmPassword', '$Status','$dt','$tim')";

        $Execute = mysqli_query($db_connect, $query);

        /* if ($Execute) {
            $_SESSION["SuccessMessage"] = "Record Saved";
            Redirect_to("addPatient.php");
        } else {
            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("addPatient.php");
        }*/

        if ($Execute) {

            require '../mailer/PHPMailerAutoload.php';
            require '../mailer/credentials.php';

            $mail = new PHPMailer;

            $mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = EMAIL;                 // SMTP username
            $mail->Password = PASS;                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom(EMAIL, 'HMS');
            $mail->addAddress($_POST['emailAddress']);     // Add a recipient
            $mail->addReplyTo(EMAIL);

            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = "Admin Registration";
            $base_url = "C:\wamp64\www\HospitalManagementSystem\Admin\verify.php";
            $mail->Body = "
			<p>Hi " . $_POST['firstname'] . ",</p>
            <p>You have been registered as an admin. Your login info: </p> 
            <p>Email Address: " . ($EmailAddress) . "</p>
            <p>Password: " . ($Password) . "</p>
            <p>Best Regards,<br />Hospital Management System</p>
			";
            $mail->AltBody = "Message";

            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Register Done, Please check your mail';
            }
        }
    }
}

?>

<?php
if (isset($_GET['editid'])) {
    $query = "SELECT * FROM pati
    ent_tbl WHERE id='$_GET[editid]' ";
    $Execute = mysqli_query($db_connect, $query);
    $rsedit = mysqli_fetch_array($Execute);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../assets/argon.css">

    <style>
        .card {
            margin-bottom: 30px;
            width: 250px;
            border: 0;
            box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15);
        }

        .card-translucent {
            background-color: rgba(18, 91, 152, .08);
        }

        .card-deck .card {
            margin-bottom: 30px;
        }

        .card.shadow {
            border: 0 !important;
        }

        @media (min-width: 576px) {
            .card-columns {
                column-count: 1;
            }
        }

        @media (min-width: 768px) {
            .card-columns {
                column-count: 2;
            }
        }

        @media (min-width: 1200px) {
            .card-columns {
                column-count: 3;
                column-gap: 1.25rem;
            }
        }

        .card-lift--hover:hover {
            transition: all .15s ease;
            transform: translateY(-20px);
        }

        @media (prefers-reduced-motion: reduce) {
            .card-lift--hover:hover {
                transition: none;
            }
        }

        .card-blockquote {
            position: relative;

            padding: 2rem;
        }

        .card-blockquote .svg-bg {
            position: absolute;
            top: -94px;
            left: 0;

            display: block;

            width: 100%;
            height: 95px;
        }

        .card-profile-image {
            position: relative;
        }

        .card-profile-image img {
            position: absolute;
            left: 50%;

            max-width: 140px;

            transition: all .15s ease;
            transform: translate(-50%, -50%) scale(1);

            border: 3px solid #fff;
            border-radius: .375rem;
        }

        .card-profile-image img:hover {
            transform: translate(-50%, -50%) scale(1.03);
        }

        .card-profile-stats {
            padding: 1rem 0;
        }

        .card-profile-stats>div {
            margin-right: 1rem;
            padding: .875rem;

            text-align: center;
        }

        .card-profile-stats>div:last-child {
            margin-right: 0;
        }

        .card-profile-stats>div .heading {
            font-size: 1.1rem;
            font-weight: bold;

            display: block;
        }

        .card-profile-stats>div .description {
            font-size: .875rem;

            color: #adb5bd;
        }

        .card-profile-actions {
            padding: .875rem;
        }

        .card-stats .card-body {
            padding: 1rem 1.5rem;
        }

        .card-stats .card-status-bullet {
            position: absolute;
            top: 0;
            right: 0;

            transform: translate(50%, -50%);
        }

        .card-img,
        .card-img-top,
        .card-img-bottom {
            width: 100%;

            flex-shrink: 0;
        }

        .card-img,
        .card-img-top {
            border-top-left-radius: calc(.375rem - 1px);
            border-top-right-radius: calc(.375rem - 1px);
        }

        .card-img,
        .card-img-bottom {
            border-bottom-right-radius: calc(.375rem - 1px);
            border-bottom-left-radius: calc(.375rem - 1px);
        }
    </style>


</head>

<script type="text/javascript" src="../assets/scripts/main.js"></script>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <?php include("./layout/header.php"); ?>
        <div class="app-main">
            <?php include("./layout/sidebar.php"); ?>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="tab-content">
                        <div class="row">
                            <?php
                            global $db_connect;
                            $query = "SELECT * FROM patient_tbl ORDER BY id desc";
                            $Execute = mysqli_query($db_connect, $query);
                            while ($rs = mysqli_fetch_array($Execute)) {
                                echo "
                                
                                 <div class='col-xl-3 order-xl-2'>
                                <div class='card card-profile'>
                                    <img src='../assets/images/img1.jpg' alt= 'Image placeholder' class='card-img-top'>
                                    <div class='row justify-content-center card-img-top'>
                                        <div class='col-lg-3 order-lg-2'>
                                            <div class='card-profile-image'>
                                                <a href='#'>
                                                    <img src='../assets/images/user.jpg' class='rounded-circle'>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4'>
                                    </div>
                                    <div class='card-body pt-0'>
                                        <div class='row'>
                                            <div class='col'>
                                                <div class='card-profile-stats d-flex justify-content-center'></div>
                                            </div>
                                        </div>
                                       <div class='text-center'>
                                        <h5 class='h4'>
                                                $rs[firstname]<span class=''> $rs[lastname]</span>
                                            </h5>                                                
                                                <div class='h5 font-weight-300'>
                                                <i class='ni location_pin mr-2'></i>$rs[gender]
                                            </div>
                                       </div>
                                       <a href='addPatient.php?editid=$rs[id]'>
                                                        <button class='btn btn-primary btn-block'>
                                                            View Info
                                                        </button>
                                                    </a>
                                    </div>
                                </div>
                            </div>
                                
                                ";
                            ?>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="app-wrapper-footer">
        <div class="app-footer">
            <div class="app-footer__inner">
                <div class="app-footer-left">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                Footer Link 1
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                Footer Link 2
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="app-footer-right">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                Footer Link 3
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <div class="badge badge-success mr-1 ml-0">
                                    <small>NEW</small>
                                </div>
                                Footer Link 4
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</body>

</html>