<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_login(); ?>

<?php

//These are inbuilt mail functions used for sending email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; // used to handle errors or exception
use PHPMailer\PHPMailer\SMTP; // smtp is used to transfer email messages and attatchments

if (isset($_POST['submit'])) {

    $Patient = mysqli_real_escape_string($db_connect, $_POST["patient"]);
    $Department = mysqli_real_escape_string($db_connect, $_POST["department"]);
    $DateOfAppointment = mysqli_real_escape_string($db_connect, $_POST["appointmentdate"]);
    $TimeOfAppointment = mysqli_real_escape_string($db_connect, $_POST["appointmenttime"]);
    $Doctor = mysqli_real_escape_string($db_connect, $_POST["doctor"]);
    $ReasonOfAppointment = mysqli_real_escape_string($db_connect, $_POST["reason"]);
    $Room = mysqli_real_escape_string($db_connect, $_POST["room"]);
    $AppointmentType = mysqli_real_escape_string($db_connect, $_POST["apptype"]);
    $ApprovedBy =
        mysqli_real_escape_string($db_connect, $_POST["approvedby"]);
    $EmailAddress = mysqli_real_escape_string($db_connect, $_POST["emailAddress"]);

    if (isset($_GET['editid'])) {
        $query = "UPDATE patient_tbl SET status='Active' WHERE id='$_GET[patientid]'";
        $execute = mysqli_query($db_connect, $query);
        //$roomid = 0;

        $query = "UPDATE doctor_appointment_tbl SET departmentid='$_POST[department]',doctorid='$_POST[doctor]',status='Approved',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[appointmenttime]',roomid='$_POST[room]', appointmenttype='$_POST[apptype]', patientemail='$_POST[emailAddress]' WHERE id='$_GET[editid]';";

        $query .= "UPDATE appointment_tbl SET departmentid='$_POST[department]',doctorid='$_POST[doctor]',status='Approved',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[appointmenttime]',roomid='$_POST[room]', appointmenttype='$_POST[apptype]', patientemail='$_POST[emailAddress]' WHERE patientid=$_GET[patientid] AND appointmentdate='$_POST[appointmentdate]";

        if (mysqli_multi_query($db_connect, $query)) {

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
            $mail->addAddress($_POST['emailAddress']); //the email address is gotten from the form that is filled    // Add a recipient
            $mail->addReplyTo(EMAIL, 'HMS');

            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);  // this is the function that makes it possible to embed html code into the mail function                            
            //<p style='font-size:xx-large'>Dear " . $_POST['patient'] . ",</p>
            $mail->Subject = "Hospital Appointment Approved";
            $mail->Body = "	
            <p>Your hospital appointment has been approved</p>
            <p>This is how you would do it. write whatever 
            you wanna write between this <p></p>tags </p>
            <p>Thank you for choosing HMS
            <p>Best Regards,<br />Hospital Management System</p>
			";
            $mail->AltBody = "Message";

            if (!$mail->send()) {
                // echo 'Message could not be sent.';
                // echo 'Mailer Error: ' . $mail->ErrorInfo;
                $_SESSION["ErrorMessage"] = $mail->ErrorInfo;
                Redirect_to("viewPendingAppointment.php");
            } else {
                //echo 'Register Done, Please check your mail';
                $_SESSION["SuccessMessage"] = "Appointment Approved. Mail has been sent";
                Redirect_to("viewPendingAppointment.php");
            }

            //$roomid = $_POST[select3];
            $billtype = "Room Rent";
            include("insertbillingrecord.php");
            $_SESSION["SuccessMessage"] = "Appointment Approved";
            Redirect_to("viewPendingAppointment.php");
            //echo "<script>alert('appointment record updated successfully...');</script>";
            //echo "<script>window.location='patientreport.php?patientid=$_GET[patientid]&appointmentid=$_GET[editid]';</script>";
        } else {
            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("viewPendingAppointment.php");
        }
    } else {
        $query = "UPDATE patient_tbl SET status='Active' WHERE id='$_POST[id]'";
        $execute = mysqli_query($db_connect, $query);

        $query = "INSERT INTO appointment_tbl(patientid,roomid,appointmenttype,departmentid,appointmentdate,appointmenttime,doctorid,status) values('$_POST[select2]','$_POST[select4]','4','$_POST[apptype]','$_POST[select5]','$_POST[appointmentdate]','$_POST[time]','$_POST[select6]','$_POST[select]')";
        if ($execute = mysqli_query($db_connect, $query)) {
            echo "<script>alert('Appointment record inserted successfully...');</script>";
        } else {
            echo mysqli_error($db_connect);
        }
    }
}

if (isset($_GET['editid'])) {
    $query = "SELECT * FROM doctor_appointment_tbl WHERE id='$_GET[editid]' ";
    $execute = mysqli_query($db_connect, $query);
    $rsedit = mysqli_fetch_array($execute);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apointment Approval</title>

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
                                <div>Appointment Approval Process
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
                                    <div class="card-body">
                                        <h5 class="card-title">Appointment Approval Form</h5>
                                        <form action="" method="POST">
                                            <div class="position-relative form-group">
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <label>Patient</label>
                                                        <?php
                                                        if (isset($_GET['patientid'])) {
                                                            $querypatient = "SELECT * FROM patient_tbl WHERE id='$_GET[patientid]'";
                                                            $executepatient = mysqli_query($db_connect, $querypatient);
                                                            $rspatient = mysqli_fetch_array($executepatient);
                                                            //echo $rspatient['firstname'] . $rspatient['lastname'] . " (Patient ID - $rspatient[id])";
                                                            // echo "<input type='hidden' name='patient' value='$rspatient[id]'>";
                                                            echo "
                                                                <select class='mb-2 form-control' name='patient' disabled>
                                                                    <option value='$rspatient[id]' selected>$rspatient[firstname] - $rspatient[lastname]</option>
                                                                </select>
                                                            ";
                                                        } else {
                                                        ?>
                                                            <select class="mb-2 form-control" name="patient">
                                                                <option value="">Select</option>
                                                                <?php
                                                                $querypatient = "SELECT * FROM patient_tbl WHERE status='Active'";
                                                                $executepatient = mysqli_query($db_connect, $querypatient);
                                                                while ($rspatient = mysqli_fetch_array($executepatient)) {
                                                                    if ($rspatient['id'] == $rsedit['patientid']) {
                                                                        echo "<option value='$rspatient[id]' selected>$rspatient[firstname] - $rspatient[lastname]</option>";
                                                                    } else {
                                                                        echo "<option value='$rspatient[id]'>$rspatient[firstname] $rspatient[lastname]</option>";
                                                                    }
                                                                }
                                                                ?>
                                                            </select>

                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Department</label>
                                                        <select class="mb-2 form-control" name="department">
                                                            <option value="">Select department</option>
                                                            <?php
                                                            $query = "SELECT * FROM department_tbl WHERE status='Active'";
                                                            $execute = mysqli_query($db_connect, $query);
                                                            while ($rsdepartment = mysqli_fetch_array($execute)) {
                                                                if ($rsdepartment['id'] == $rsedit['departmentid']) {
                                                                    echo "<option value='$rsdepartment[id]' selected>$rsdepartment[departmentName]</option>";
                                                                } else {
                                                                    echo "<option value='$rsdepartment[id]'>$rsdepartment[departmentName]</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <label>Date of Appointment</label>
                                                        <input name="appointmentdate" id="appointmentdate" value="<?php if (isset($_GET['editid'])) echo $rsedit['appointmentdate']; ?>" type="date" class="form-control" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Time of Appointment</label>
                                                        <input name="appointmenttime" id="appointmenttime" value="<?php if (isset($_GET['editid'])) echo $rsedit['appointmenttime']; ?>" type="time" class="form-control" />
                                                    </div>
                                                </div>
                                                <label>Doctor</label>
                                                <select class="mb-2 form-control" name="doctor" id="doctor">

                                                    <?php
                                                    $querydoctor = "SELECT * FROM doctor_tbl INNER JOIN department_tbl ON department_tbl.id=doctor_tbl.departmentid WHERE doctor_tbl.id='$_SESSION[id]'";
                                                    $executedoctor = mysqli_query($db_connect, $querydoctor);
                                                    while ($rsdoctor = mysqli_fetch_array($executedoctor)) {
                                                        if ($rsdoctor['id'] == $rsedit['id']) {
                                                            echo "<option value='$rsdoctor[id]' selected disabled>$rsdoctor[doctorLastname] ( $rsdoctor[departmentName] ) </option>";
                                                        } else {
                                                            echo "<option value='$rsdoctor[id]'>$rsdoctor[doctorLastname] ( $rsdoctor[departmentName] )</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>

                                                <label>Reason</label>
                                                <textarea name="reason" class="form-control"><?php if (isset($_GET['editid'])) echo $rsedit['reason']; ?></textarea>

                                                <label>Room</label>
                                                <select class="mb-2 form-control" name="room" id="room">
                                                    <option value="">Select Room</option>
                                                    <?php
                                                    $query = "SELECT * FROM room WHERE status='Active'";
                                                    $execute = mysqli_query($db_connect, $query);
                                                    while ($rsroom = mysqli_fetch_array($execute)) {
                                                        if ($rsroom['id'] == $rsedit['id']) {
                                                            echo "<option value='$rsroom[id]' selected>$rsroom[roomtype]</option>";
                                                        } else {
                                                            echo "<option value='$rsroom[id]'>$rsroom[roomtype]</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>

                                                <label>Appointment Type</label>
                                                <select class="mb-2 form-control" name="apptype" id="apptype">
                                                    <option value="">Select Appointment Type</option>
                                                    <?php
                                                    $query = "SELECT * FROM appointment_type_tbl WHERE status='Active'";
                                                    $execute = mysqli_query($db_connect, $query);
                                                    while ($rsapptype = mysqli_fetch_array($execute)) {
                                                        if ($rsapptype['id'] == $rsedit['id']) {
                                                            echo "<option value='$rsapptype[appointmentTypeName]' selected>$rsapptype[appointmentTypeName]</option>";
                                                        } else {
                                                            echo "<option value='$rsapptype[appointmentTypeName]'>$rsapptype[appointmentTypeName]</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>

                                                <div class="col-md-12">
                                                    <label>Patient Email</label>
                                                    <?php
                                                    if (isset($_GET['patientid'])) {
                                                        $querypatient = "SELECT * FROM patient_tbl WHERE id='$_GET[patientid]'";
                                                        $executepatient = mysqli_query($db_connect, $querypatient);
                                                        $rspatient = mysqli_fetch_array($executepatient);
                                                        //echo $rspatient['firstname'] . $rspatient['lastname'] . " (Patient ID - $rspatient[id])";
                                                        // echo "<input type='hidden' name='patient' value='$rspatient[id]'>";
                                                        echo "
                                                                <select class='mb-2 form-control' name='emailAddress'>
                                                                    <option value='$rspatient[emailAddress]' selected>$rspatient[emailAddress]</option>
                                                                </select>
                                                            ";
                                                    } else {
                                                    ?>
                                                        <select class="mb-2 form-control" name="emailAddress">
                                                            <option value="">Select</option>
                                                            <?php
                                                            $querypatient = "SELECT * FROM patient_tbl WHERE status='Active'";
                                                            $executepatient = mysqli_query($db_connect, $querypatient);
                                                            while ($rspatient = mysqli_fetch_array($executepatient)) {
                                                                if ($rspatient['id'] == $rsedit['patientid']) {
                                                                    echo "<option value='$rspatient[emailAddress]' selected>$rspatient[emailAddress]</option>";
                                                                } else {
                                                                    echo "<option value='$rspatient[emailAddress]'>$rspatient[emailAddress]</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>

                                                    <?php } ?>
                                                </div>

                                                <br />

                                                <button type="submit" name="submit" id="submit" class="mt-1 btn btn-success pull-right btn-block">Approve</button>

                                            </div>
                                        </form>
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

    <script type="text/javascript" src="../assets/scripts/main.js"></script>
    <script>
        $('.out_patient').hide();
        $('#apptype').change(function() {
            apptype = $('#apptype').val();
            if (apptype == 'InPatient') {
                $('.out_patient').show();
            } else {
                $('.out_patient').hide();
            }
        });
    </script>
</body>

</html>