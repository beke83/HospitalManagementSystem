<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_patient_login(); ?>

<?php
if (isset($_POST['submit'])) {

    $Department = mysqli_real_escape_string($db_connect, $_POST["department"]);
    $DateOfAppointment = mysqli_real_escape_string($db_connect, $_POST["app_date"]);
    $TimeOfAppointment = mysqli_real_escape_string($db_connect, $_POST["app_time"]);
    $Doctor = mysqli_real_escape_string($db_connect, $_POST["doctor"]);
    $ReasonOfAppointment = mysqli_real_escape_string($db_connect, $_POST["app_reason"]);

    if (isset($_SESSION['id'])) {
        $lastinsid = $_SESSION['id'];
    } else {
        $dt = date("Y-m-d");
        $tim = date("H:i:s");
        $query = "INSERT INTO patient_tbl(firstname,lastname,gender,dob,bloodGroup,address,city,phoneNumber,emailAddress,password,confirmPassword,status,dateAdmitted,timeAdmitted)
        VALUES('$Firstname','$Lastname', '$Gender', '$DOB', '$BloodGroup', '$Address', '$City', '$PhoneNumber', '$EmailAddress', '$Password', '$db_connectfirmPassword', '$Status','$dt','$tim')";
        if ($execute = mysqli_query($db_connect, $query)) {
            $_SESSION["SuccessMessage"] = "Record Updated";
            Redirect_to("patientAppointment.php");
        } else {
            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("patientAppointment.php");
        }
        $lastinsid = mysqli_insert_id($db_connect);
    }

    $queryappointment = "SELECT * FROM appointment_tbl WHERE appointmentdate='$_POST[app_date]' AND appointmenttime='$_POST[app_time]' AND doctorid='$_POST[doctor]' AND status='Approved'";
    $executeappointment = mysqli_query($db_connect, $queryappointment);
    if (mysqli_num_rows($executeappointment) >= 1) {
        $_SESSION["ErrorMessage"] = "Appointment already scheduled for this time.";
        Redirect_to("patientAppointment.php");
    } else {
        $query = "INSERT INTO appointment_tbl(appointmenttype,patientid,departmentid,appointmentdate,appointmenttime,doctorid,app_reason,status) values('ONLINE','$lastinsid','$Department','$DateOfAppointment','$TimeOfAppointment','$Doctor','$ReasonOfAppointment','Pending')";
        if ($execute = mysqli_query($db_connect, $query)) {
            $_SESSION["SuccessMessage"] = "Appointment Booked Successfully.";
            Redirect_to("patientAppointment.php");
        } else {
            $_SESSION["ErrorMessage"] = "Error booking appointment";
            Redirect_to("patientAppointment.php");
        }
    }
}

if (isset($_GET['editid'])) {
    $query = "SELECT * FROM appointment_tbl WHERE id='$_GET[editid]' ";
    $execute = mysqli_query($db_connect, $query);
    $rsedit = mysqli_fetch_array($execute);
}
if (isset($_SESSION['id'])) {
    $querypatient = "SELECT * FROM patient_tbl WHERE id='$_SESSION[id]' ";
    $executepatient = mysqli_query($db_connect, $querypatient);
    $rspatient = mysqli_fetch_array($executepatient);
    $readonly = " readonly";
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
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo Message();
                                echo SuccessMessage(); ?>
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">New Appointment Form</h5>
                                        <?php

                                        if (isset($_POST['submit'])) {


                                            $Department = mysqli_real_escape_string($db_connect, $_POST["department"]);
                                            $DateOfAppointment = mysqli_real_escape_string($db_connect, $_POST["app_date"]);
                                            $TimeOfAppointment = mysqli_real_escape_string($db_connect, $_POST["app_time"]);
                                            $Doctor = mysqli_real_escape_string($db_connect, $_POST["doctor"]);
                                            $ReasonOfAppointment = mysqli_real_escape_string($db_connect, $_POST["app_reason"]);


                                            if (mysqli_num_rows($qsqlappointment) >= 1) {
                                                echo "<h2>Appointment already scheduled for " . date("d-M-Y", strtotime($_POST['appointmentdate'])) . " " . date("H:i A", strtotime($_POST['appointmenttime'])) . " .. </h2>";
                                            } else {
                                                if (isset($_SESSION['id'])) {
                                                    echo "<h2>Appointment taken successfully.. </h2>";
                                                    echo "<p>Appointment record is in pending process. Kinldy check the appointment status. </p>";
                                                    echo "<p> <a href='viewappointment.php'>View Appointment record</a>. </p>";
                                                } else {
                                                    echo "<h2>Appointment taken successfully.. </h2>";
                                                    echo "<p>Appointment record is in pending process. Please wait for confirmation message.. </p>";
                                                    echo "<p> <a href='patientlogin.php'>Click here to Login</a>. </p>";
                                                }
                                            }
                                        } else {

                                        ?>
                                            <form action="" method="POST">
                                                <div class="position-relative form-group">
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <label>Patient Name</label>
                                                            <input type="text" class="form-control" name="patient" id="patient" value="<?php echo $rspatient['firstname'], $rspatient['lastname'];  ?>" <?php echo $readonly; ?>>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Gender</label>
                                                            <?php
                                                            if (isset($_SESSION['id'])) {
                                                                echo "<input type='text' class='form-control' name='gender' id='gender' value='$rspatient[gender]' disabled>
                                                                ";
                                                            } else {
                                                            ?>
                                                                <select name="gender" id="gender">
                                                                    <option value="">Select</option>
                                                                    <?php
                                                                    $arr = array("Male", "Female");
                                                                    foreach ($arr as $val) {
                                                                        echo "<option value='$val'>$val</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Mobile No</label>
                                                            <input type="text" class="form-control" name=phoneNumber" id="phoneNumber" value="<?php echo $rspatient['phoneNumber'];  ?>" <?php echo $readonly; ?>></td>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Date of Birth</label>
                                                            <input type="text" class="form-control" name="dob" id="dob" value="<?php echo $rspatient['dob'];  ?>" <?php echo $readonly; ?>></td>
                                                        </div>

                                                        <label>City</label>
                                                        <input type="text" class="form-control" name="city" id="city" value="<?php echo $rspatient['city'];  ?>" <?php echo $readonly; ?>></td>

                                                        <label>Address</label>
                                                        <textarea name="textarea" id="textarea" class="form-control" <?php echo $readonly; ?>><?php echo $rspatient['address'];  ?></textarea>
                                                        <?php
                                                        if (!isset($_SESSION['id'])) {
                                                        ?>
                                                            label>Email Address</label>
                                                            <input type="text" class="form-control" name="emailAddress" id="emailAddress" value="<?php echo $rspatient['emailAddress'];  ?>" <?php echo $readonly; ?>></td>

                                                            label>Email Address</label>
                                                            <input type="text" class="form-control" name="password" id="password" value="<?php echo $rspatient['firstname'];  ?>" <?php echo $readonly; ?>></td>

                                                        <?php } ?>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <label>Date of Appointment</label>
                                                            <input name="app_date" min="<?php echo date("Y-m-d"); ?>" id="app_date" type="date" class="form-control" />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Time of Appointment</label>
                                                            <input name="app_time" id="app_time" type="time" class="form-control" />
                                                        </div>
                                                    </div>

                                                    <label>Department</label>
                                                    <select class="mb-2 form-control" name="department" onchange="loaddoctor(this.value)">
                                                        <option value="">Select department</option>
                                                        <?php
                                                        $sqldept = "SELECT * FROM department_tbl WHERE status='Active'";
                                                        $qsqldept = mysqli_query($db_connect, $sqldept);
                                                        while ($rsdept = mysqli_fetch_array($qsqldept)) {
                                                            echo "<option value='$rsdept[id]'>$rsdept[departmentName]</option>";
                                                        }
                                                        ?>
                                                    </select>

                                                    <label>Doctor</label>
                                                    <select class="mb-2 form-control" name="doctor" id="doctor">
                                                        <option value="">Select doctor</option>
                                                        <?php
                                                        $querydoctor = "SELECT * FROM doctor_tbl INNER JOIN department_tbl ON department_tbl.id=doctor_tbl.departmentid WHERE doctor_tbl.status='Active'";
                                                        $executedoctor = mysqli_query($db_connect, $querydoctor);
                                                        while ($rsdoctor = mysqli_fetch_array($executedoctor)) {
                                                            if ($rsdoctor['id'] == $rsedit['id']) {
                                                                echo "<option value='$rsdoctor[id]' selected>$rsdoctor[doctorLastname] ( $rsdoctor[departmentName] ) </option>";
                                                            } else {
                                                                echo "<option value='$rsdoctor[id]'>$rsdoctor[doctorLastname] ( $rsdoctor[departmentName] )</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                    <label>Reason</label>
                                                    <textarea name="app_reason" class="form-control"></textarea>

                                                    <button type="submit" name="submit" id="submit" class="mt-1 btn btn-success pull-right">Submit</button>
                                                    <button class="mt-1 btn btn-danger">Cancel</button>
                                                </div>
                                            </form>
                                        <?php
                                        }
                                        ?>
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
        function loaddoctor(deptid) {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("divdoc").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "departmentDoctor.php?deptid=" + deptid, true);
            xmlhttp.send();
        }
    </script>
</body>

</html>