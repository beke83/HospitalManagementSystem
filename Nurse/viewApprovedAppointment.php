<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_login(); ?>


<?php

//These are inbuilt mail functions used for sending email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; // used to handle errors or exception
use PHPMailer\PHPMailer\SMTP; // smtp is used to transfer email messages and attatchments


if (isset($_GET['delid'])) {
    $query = "DELETE FROM appointment_tbl WHERE id='$_GET[delid]'";
    $execute = mysqli_query($db_connect, $query);
    if (mysqli_affected_rows($db_connect) == 1) {
        $_SESSION["SuccessMessage"] = "Appointment Deleted";
        Redirect_to("viewAppointmentApproval.php");;
    }
}
if (isset($_GET['approveid'])) {
    $query = "UPDATE appointment_tbl SET status='Approved' WHERE id='$_GET[approveid]'";
    $execute = mysqli_query($db_connect, $query);
    if (mysqli_affected_rows($db_connect) == 1) {
        $_SESSION["SuccessMessage"] = "Appointment Approved";
        Redirect_to("appointmentApproval.php");;
    }
}

//function for check In button
if (isset($_POST['checkIn'])) {
    $_SESSION["SuccessMessage"] = "Patient Checked In";
    Redirect_to("viewApprovedAppointment.php");
}

//function for not checked in button
//this function will send a mail to the patient who did not check in for the appointment
if (isset($_GET['patientid'])) {

    $querypatient = "SELECT * FROM patient_tbl WHERE id='$_GET[patientid]'";
    $executepatient = mysqli_query($db_connect, $querypatient);
    $rspatient = mysqli_fetch_array($executepatient);

    // call additional inbuilt functions required to send mail
    require '../PHPMailer-6.5.0/src/PHPMailer.php';
    require '../PHPMailer-6.5.0/src/Exception.php';
    require '../PHPMailer-6.5.0/src/SMTP.php';
    require '../PHPMailer-6.5.0/src/credentials.php';

    $mail = new PHPMailer();

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP(true);
    // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                            // Enable SMTP authentication
    $mail->Username = 'worktestmail9@gmail.com';                 // SMTP username
    $mail->Password = 'yahoo@WorkTest';                     // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;
    // TCP port to connect to

    $mail->setFrom(EMAIL, 'HospitalManagementSystem');
    $mail->addAddress($rspatient['emailAddress']); //the email address is gotten from the form that is filled    // Add a recipient
    $mail->addReplyTo(EMAIL, 'HMS');

    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);  // this is the function that makes it possible to embed html code into the mail function                            

    $mail->Subject = "Hospital Appointment Reminder";
    $mail->Body = "
			<p style='font-size:xx-large'>Hi " . $rspatient['firstname'] . ",</p>
            <p>You didn't check in for your appointment scheduled for today</p>
            <p>Try to book another appointment</p>
            <p>Thank you for choosing HMS
            <p>Best Regards,<br />Hospital Management System</p>
			";
    $mail->AltBody = "Message";

    if (!$mail->send()) {
        // echo 'Message could not be sent.';
        // echo 'Mailer Error: ' . $mail->ErrorInfo;
        $_SESSION["ErrorMessage"] = $mail->ErrorInfo;
        Redirect_to("viewApprovedAppointment.php");
    } else {
        //echo 'Register Done, Please check your mail';
        $_SESSION["SuccessMessage"] = "Mail sent";
        Redirect_to("viewApprovedAppointment.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Appointment</title>

    <link rel="stylesheet" href="../assets/main.d810cf0ae7f39f28f336.css">
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <?php include("./layout/header.php"); ?>
        <div class="app-main">
            <?php include("./layout/sidebar.php"); ?>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-medal icon-gradient bg-tempting-azure"></i>
                                </div>
                                <div>Approved Appointments
                                    <!-- <div class="page-title-subheading">Choose between regular React Bootstrap tables or advanced dynamic ones.</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo Message();
                                echo SuccessMessage(); ?>
                                <div class="main-card mb-3 card">
                                    <div class="card-body table-responsive">
                                        <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Patient detail</th>
                                                    <th>Appointment Date & Time</th>
                                                    <th>Department</th>
                                                    <th>Nurse</th>
                                                    <th>Appointment Reason</th>
                                                    <th>Patient Mail</th>
                                                    <th>Status</th>
                                                    <th>Checked In</th>
                                                    <th></th>
                                                    <th>
                                                        <div align="center">Action</div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM appointment_tbl WHERE status='Approved' OR status='Active'";
                                                if (isset($_SESSION['patientid'])) {
                                                    $query  = $query . " AND patientid='$_SESSION[patientid]'";
                                                }
                                                if (isset($_SESSION['doctorid'])) {
                                                    $query  = $query . " AND doctorid='$_SESSION[doctorid]'";
                                                }
                                                $execute = mysqli_query($db_connect, $query);
                                                while ($rs = mysqli_fetch_array($execute)) {
                                                    $querypat = "SELECT * FROM patient_tbl WHERE id='$rs[patientid]'";
                                                    $executepat = mysqli_query($db_connect, $querypat);
                                                    $rspat = mysqli_fetch_array($executepat);


                                                    $querydept = "SELECT * FROM department_tbl WHERE id='$rs[departmentid]'";
                                                    $executedept = mysqli_query($db_connect, $querydept);
                                                    $rsdept = mysqli_fetch_array($executedept);

                                                    $querynurse = "SELECT * FROM nurse_tbl WHERE id='$rs[approvedby]'";
                                                    $executenurse = mysqli_query($db_connect, $querynurse);
                                                    $rsnurse = mysqli_fetch_array($executenurse);
                                                    echo "<tr>
         
                                                        <td>&nbsp;$rspat[firstname] - $rspat[lastname]<br>&nbsp;$rspat[phoneNumber]</td>		 
                                                        <td>&nbsp;$rs[appointmentdate]&nbsp;$rs[appointmenttime]</td> 
                                                        <td>&nbsp;$rsdept[departmentName]</td>
                                                        <td>&nbsp;$rsnurse[nurseLastname]</td>
                                                        <td>&nbsp;$rs[app_reason]</td>    
                                                        <td>&nbsp;$rs[patientemail]</td>    
                                                        <td>&nbsp;$rs[status]</td>





                                                        <td><a href='viewApprovedAppointment?patientid=$rs[patientid]'>
                                                        <form method='post'>
                                                        <button type='submit' name='checkIn' id='checkIn' class='btn btn-primary btn-sm'>Check In</button>
                                                        </form>
                                                        </a>
                                                        </td>






                                                        <td><a href='viewApprovedAppointment?patientid=$rs[patientid]'>
                                                        <button type='submit' class='btn btn-primary btn-sm'>Not Checked </button>
                                                        </a>
                                                        </td>

                                                        <td><div align='center'>";

                                                    if ($rs['status'] != "Approved") {
                                                        if (!(isset($_SESSION['patientid']))) {
                                                            echo "<a href='appointmentapproval.php?editid=$rs[id]'>Approve</a><hr>";
                                                        }
                                                        echo "  <a href='viewApprovedAppointment.php?delid=$rs[id]'>Delete</a>";
                                                    } else {
                                                        echo "<a href='patientreport.php?patientid=$rs[patientid]&appointmentid=$rs[id]'><button type='submit' class='btn btn-primary btn-sm'>View Report</button></a>";
                                                    }
                                                    echo "</center></td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php
                                if (isset($_GET[''])) {
                                    $querypatient = "SELECT * FROM patient_tbl WHERE id='$_GET[patientid]'";
                                    $executepatient = mysqli_query($db_connect, $querypatient);
                                    $rspatient = mysqli_fetch_array($executepatient);
                                    //echo $rspatient['firstname'] . $rspatient['lastname'] . " (Patient ID - $rspatient[id])";
                                    // echo "<input type='hidden' name='patient' value='$rspatient[id]'>";
                                    echo "
                                    <div class='main-card mb-3 card'>
                                    <div class='card-body'>
                                    <label>Patient Mail</label>
                                                                <select class='mb-2 form-control' name='emailAddress'>
                                                                    <option value='$rspatient[emailAddress]' selected>$rspatient[emailAddress]</option>
                                                                </select>
                                                                </div>
                                                                </div>
                                                            ";
                                }
                                ?>
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

    <script type="text/javascript" src="../assets/scripts/main.js"></script>
</body>

</html>