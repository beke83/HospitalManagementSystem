<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_login(); ?>

<?php
if (isset($_POST['submit'])) {

    $Patient = mysqli_real_escape_string($db_connect, $_POST["patient"]);
    $Department = mysqli_real_escape_string($db_connect, $_POST["department"]);
    $DateOfAppointment = mysqli_real_escape_string($db_connect, $_POST["appointmentdate"]);
    $TimeOfAppointment = mysqli_real_escape_string($db_connect, $_POST["appointmenttime"]);
    $Doctor = mysqli_real_escape_string($db_connect, $_POST["doctorid"]);
    //$ReasonOfAppointment = mysqli_real_escape_string($db_connect, $_POST["app_reason"]);
    $Room = mysqli_real_escape_string($db_connect, $_POST["room"]);
    $AppointmentType = mysqli_real_escape_string($db_connect, $_POST["apptype"]);
    $Reason = mysqli_real_escape_string($db_connect, $_POST["app_reason"]);
    $ApprovedBy =
        mysqli_real_escape_string($db_connect, $_POST["approvedby"]);
    $Status = mysqli_real_escape_string($db_connect, $_POST["status"]);


    if (isset($_GET['editid'])) {
        $query = "UPDATE patient_tbl SET status='Active' WHERE id='$_GET[patientid]'";
        $execute = mysqli_query($db_connect, $query);
        //$roomid = 0;

        $query = "INSERT INTO doctor_appointment_tbl(patientid,departmentid,appointmentdate,appointmenttime,doctorid,reason,appointmenttype,status) VALUES('$Patient','$Department','$DateOfAppointment','$TimeOfAppointment','$Doctor','$Reason','$AppointmentType','$Status');";
        $query .= "UPDATE appointment_tbl set status='Forwarded to Doctor' WHERE id=$_GET[editid];";
        $Execute = mysqli_multi_query($db_connect, $query);
        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Appointment forwarded to doctor";
            Redirect_to("viewPendingAppointment.php");
        } else {
            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("viewPendingAppointment.php");
        }

        // $query = "UPDATE appointment_tbl SET departmentid='$_POST[department]',doctorid='$_POST[doctor]',status='Approved',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[appointmenttime]',roomid='$_POST[room]', appointmenttype='$_POST[apptype]', approvedby='$_POST[approvedby]' WHERE id='$_GET[editid]'";
        // if ($execute = mysqli_query($db_connect, $query)) {
        //     //$roomid = $_POST[select3];
        //     $billtype = "Room Rent";
        //     include("insertbillingrecord.php");
        //     $_SESSION["SuccessMessage"] = "Appointment Approved";
        //     Redirect_to("viewPendingAppointment.php");
        //     //echo "<script>alert('appointment record updated successfully...');</script>";
        //     //echo "<script>window.location='patientreport.php?patientid=$_GET[patientid]&appointmentid=$_GET[editid]';</script>";
        // } else {
        //     $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
        //     Redirect_to("viewPendingAppointment.php");
        // }
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
    $query = "SELECT * FROM appointment_tbl WHERE id='$_GET[editid]' ";
    $execute = mysqli_query($db_connect, $query);
    $rsedit = mysqli_fetch_array($execute);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forward Apointment</title>

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
                                <div>Forward Appointment Process
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
                                        <h5 class="card-title">Forward Appointment Approval Form</h5>
                                        <form action="" method="POST">
                                            <div class="position-relative form-group">
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <label>Patient</label>
                                                        <?php
                                                        if (isset($_GET['id'])) {
                                                            $querypatient = "SELECT * FROM patient_tbl WHERE id='$_GET[id]'";
                                                            $executepatient = mysqli_query($db_connect, $querypatient);
                                                            $rspatient = mysqli_fetch_array($executepatient);
                                                            //echo $rspatient['firstname'] . $rspatient['lastname'] . " (Patient ID - $rspatient[id])";
                                                            // echo "<input type='hidden' name='patient' value='$rspatient[id]'>";
                                                            echo "
                                                                <select class='mb-2 form-control' name='patient'>
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
                                                <select class="mb-2 form-control" name="doctorid" id="doctor">

                                                    <?php
                                                    $querydoctor = "SELECT * FROM doctor_tbl WHERE status='Active'";
                                                    $executedoctor = mysqli_query($db_connect, $querydoctor);
                                                    while ($rsdoctor = mysqli_fetch_array($executedoctor)) {
                                                        if ($rsdoctor['id'] == $rsedit['doctorid']) {
                                                            echo "<option value='$rsdoctor[id]' selected>$rsdoctor[doctorFirstname] $rsdoctor[doctorLastname]</option>";
                                                        } else {
                                                            echo "<option value='$rsdoctor[id]'>$rsdoctor[doctorFirstname]</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>

                                                <label>Reason</label>
                                                <textarea name="app_reason" class="form-control"><?php if (isset($_GET['editid'])) echo $rsedit['app_reason']; ?></textarea>

                                                <!-- <label>Room</label>
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
                                                </select> -->

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
                                                <!-- <label>Approved by</label>
                                                <select class="mb-2 form-control" name="approvedby" id="approvedby">
                                                    <option value="">Select</option>
                                                    <?php
                                                    $query = "SELECT * FROM nurse_tbl WHERE status='Active' and nurse_tbl.id=$_SESSION[id]";
                                                    $execute = mysqli_query($db_connect, $query);
                                                    while ($rsapprovedby = mysqli_fetch_array($execute)) {
                                                        if ($rsapprovedby['id'] == $rsedit['id']) {
                                                            echo "<option value='$rsapprovedby[id]' selected>$approvedby[nurseLastname]</option>";
                                                        } else {
                                                            echo "<option value='$rsapprovedby[id]'>$rsapprovedby[nurseLastname]</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select> -->

                                                <label>Status</label>
                                                <select class="mb-2 form-control" name="status" id="status">
                                                    <option value="">Select Status</option>
                                                    <?php
                                                    $arr = array("Pending");
                                                    foreach ($arr as $val) {
                                                        if ($val == $rsedit['status']) {
                                                            echo "<option value='$val' selected>$val</option>";
                                                        } else {
                                                            echo "<option value='$val'>$val</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <br />
                                                <button type="submit" name="submit" id="submit" class="mt-1 btn btn-success pull-right btn-block">Forward</button>
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