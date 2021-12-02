<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_login(); ?>

<?php
if (isset($_POST['submit'])) {

    $Patient = mysqli_real_escape_string($db_connect, $_POST["patient"]);
    $Department = mysqli_real_escape_string($db_connect, $_POST["department"]);
    $DateOfAppointment = mysqli_real_escape_string($db_connect, $_POST["app_date"]);
    $TimeOfAppointment = mysqli_real_escape_string($db_connect, $_POST["app_time"]);
    $Doctor = mysqli_real_escape_string($db_connect, $_POST["doctor"]);
    $ReasonOfAppointment = mysqli_real_escape_string($db_connect, $_POST["app_reason"]);
    $Status = mysqli_real_escape_string($db_connect, $_POST["status"]);
    $EmailAddress = mysqli_real_escape_string($db_connect, $_POST["emailAddress"]);

    if (isset($_GET['editid'])) {
        $query = "UPDATE appointment_tbl SET patientid='$_POST[select4]',departmentid='$_POST[select5]',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[time]',doctorid='$_POST[select6]',status='$_POST[select]' WHERE appointmentid='$_GET[editid]'";
        if ($execute = mysqli_query($con, $query)) {
            echo "<script>alert('appointment record updated successfully...');</script>";
        } else {
            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("dashboard.php");
        }
    } else if (
        empty($Patient) || empty($Department) || empty($DateOfAppointment) || empty($TimeOfAppointment) || empty($Doctor) ||
        empty($ReasonOfAppointment) || empty($Status)
    ) {

        $_SESSION["ErrorMessage"] = "All Field must be Filled";
        Redirect_to("addNewAppointment.php");
    } else {
        $query = "UPDATE patient_tbl SET status='Active' WHERE id='$_POST[patient]'";
        $execute = mysqli_query($db_connect, $query);

        $query = "INSERT INTO appointment_tbl(patientid, departmentid, appointmentdate, appointmenttime, doctorid, app_reason,status,patientemail) 
        VALUES('$Patient','$Department','$DateOfAppointment','$TimeOfAppointment','$Doctor','$ReasonOfAppointment','$Status','$EmailAddress')";
        if ($execute = mysqli_query($db_connect, $query)) {

            //include("insertbillingrecord.php");
            $_SESSION["SuccessMessage"] = "Appointment record inserted successfullyy";
            Redirect_to("viewPendingAppointment.php");
            //Redirect_to("patientreport.php?patientid=$_POST[patient]");
        } else {
            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("addNewAppointment.php");
        }

        $query = "UPDATE appointment_tbl SET status='InActive'";
        $execute = mysqli_query($db_connect, $query);
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
                    <!-- <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-medal icon-gradient bg-tempting-azure"></i>
                                </div>
                                <div>Appointment
                                    <div class="page-title-subheading">Choose between regular React Bootstrap tables or advanced dynamic ones.</div>
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <div class="d-inline-block dropdown">
                                    <button type="button" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn-shadow btn btn-info">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="fa fa-plus fa-w-20"></i>
                                        </span>
                                        Add new appointment
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo Message();
                                echo SuccessMessage(); ?>
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">New Appointment Form</h5>
                                        <form action="" method="POST">
                                            <div class="position-relative form-group">
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <label>Patient</label>
                                                        <?php
                                                        if (isset($_GET['patid'])) {
                                                            $querypatient = "SELECT * FROM patient_tbl WHERE id='$_GET[patid]'";
                                                            $executepatient = mysqli_query($db_connect, $querypatient);
                                                            $rspatient = mysqli_fetch_array($executepatient);
                                                            echo $rspatient['firstname'] . $rspatient['lastname'] . " (Patient ID - $rspatient[id])";
                                                            echo "<input type='hidden' name='patient' value='$rspatient[id]'>";
                                                        } else {
                                                        ?>
                                                            <select class="mb-2 form-control" name="patient">
                                                                <option value="">Select</option>
                                                                <?php
                                                                $querypatient = "SELECT * FROM patient_tbl WHERE status='Active'";
                                                                $executepatient = mysqli_query($db_connect, $querypatient);
                                                                while ($rspatient = mysqli_fetch_array($executepatient)) {
                                                                    if ($rspatient['id'] == $rsedit['id']) {
                                                                        echo "<option value='$rspatient[id]' selected>$rspatient[id] - $rspatient[patientname]</option>";
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
                                                                if ($rsdepartment['id'] == $rsedit['id']) {
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
                                                        <input name="app_date" id="app_date" type="date" class="form-control" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Time of Appointment</label>
                                                        <input name="app_time" id="app_time" type="time" class="form-control" />
                                                    </div>
                                                </div>
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

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Patient's Email</label>
                                                        <input name="emailAddress" id="emailAddress" value="<?php if (isset($_GET['editid'])) echo $rsedit['emailAddress']; ?>" type="text" class="form-control" />
                                                    </div>
                                                </div>
                                                
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
                                                <button type="submit" name="submit" id="submit" class="mt-1 btn btn-success pull-right">Submit</button>
                                                <button class="mt-1 btn btn-danger">Cancel</button>
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
</body>

</html>