<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_login(); ?>

<?php
if (isset($_POST['submit'])) {

    $Appointment = mysqli_real_escape_string($db_connect, $_POST["select2"]);
    $Patient = mysqli_real_escape_string($db_connect, $_POST["select3"]);
    $TreatmentType = mysqli_real_escape_string($db_connect, $_POST["select4"]);
    $Doctor = mysqli_real_escape_string($db_connect, $_POST["select5"]);
    $TreatmentDescription = mysqli_real_escape_string($db_connect, $_POST["textarea"]);
    $TreatmentFiles = mysqli_real_escape_string($db_connect, $_POST["uploads"]);
    $TreatmentDate = mysqli_real_escape_string($db_connect, $_POST["treatmentdate"]);
    $TreatmentTime = mysqli_real_escape_string($db_connect, $_POST["treatmenttime"]);

    // $filename = rand() . $_FILES['uploads']['name'];
    // move_uploaded_file($_FILES["uploads"]["tmp_name"], "treatmentfiles/" . $filename);
    if (isset($_GET['editid'])) {
        $query = "UPDATE treatment_records SET appointmentid='$_POST[select2]',treatmentid='$_POST[select4]',patientid='$_POST[patientid]',doctorid='$_POST[select5]',treatment_description='$_POST[textarea]',uploads='$filename',treatment_date='$_POST[treatmentdate]',treatment_time='$_POST[treatmenttime]',status='Active' WHERE appointmentid='$_GET[editid]'";
        if ($execute = mysqli_query($db_connect, $query)) {
            echo "<script>alert('treatment record updated successfully...');</script>";
        } else {
            echo mysqli_error($db_connect);
        }
    } else if (empty($Appointment) || empty($Patient) || empty($TreatmentType) || empty($Doctor) || empty($TreatmentDescription) || empty($TreatmentDate) || empty($TreatmentTime)) {
        $_SESSION["ErrorMessage"] = "All Field must be Filled";
        Redirect_to("treatmentrecord2.php?patientid=1&appointmentid=53");
    } else {
        $query = "INSERT INTO treatment_records(appointmentid,treatmentid,patientid,doctorid,treatment_description,uploads,treatment_date,treatment_time,status) values('$_POST[select2]','$_POST[select4]','$_POST[patientid]','$_POST[select5]','$_POST[textarea]','$filename','$_POST[treatmentdate]','$_POST[treatmenttime]','Active')";
        $execute = mysqli_query($db_connect, $query);
        echo mysqli_error($db_connect);
        if (mysqli_affected_rows($db_connect) >= 1) {
            echo "<script>alert('Treatment record inserted successfully...');</script>";
        }
        $doctorid = $_POST['select5'];
        $billtype = "Doctor Charge";

        $treatmentid = $_POST['select4'];
        $billtype1 = "Treatment Cost";

        include("insertbillingrecord.php");
    }
}
if (isset($_GET['editid'])) {
    $query = "SELECT * FROM treatment_records WHERE appointmentid='$_GET[editid]' ";
    $execute = mysqli_query($db_connect, $query);
    $rsedit = mysqli_fetch_array($execute);
}
if (isset($_GET['delid'])) {
    $query = "DELETE FROM treatment_records WHERE appointmentid='$_GET[delid]'";
    $execute = mysqli_query($db_connect, $query);
    if (mysqli_affected_rows($db_connect) == 1) {
        echo "<script>alert('appointment record deleted successfully..');</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Treatment Record</title>

    <link rel="stylesheet" href="../assets/main.d810cf0ae7f39f28f336.css">

</head>

<script type="text/javascript" src="../assets/scripts/main.js"></script>

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
                                <div>New Treatment Record
                                    <div class="page-title-subheading">Choose between regular React Bootstrap tables or advanced dynamic ones.</div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-md-4">
                                <?php echo Message();
                                echo SuccessMessage(); ?>
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">New Treatment Record Form</h5>
                                        <form action="" method="POST">
                                            <div class="position-relative form-group">
                                                <label>Appointment</label>
                                                <input type="text" readonly name="select2" value="<?php echo $_GET['appointmentid']; ?>" class="form-control" />

                                                <label>Patient</label>
                                                <input type="hidden" class="form-control" name="patientid" value="<?php echo $_GET['patientid']; ?>" />
                                                <?php
                                                $querypatient = "SELECT * FROM patient_tbl WHERE status='Active' AND id='$_GET[patientid]'";
                                                $executepatient = mysqli_query($db_connect, $querypatient);
                                                $rspatient = mysqli_fetch_array($executepatient);
                                                ?>
                                                <input type="text" readonly name="select3" class="form-control" value="<?php echo $rspatient['firstname']; ?>" />

                                                <label>Select Treatment Type</label>
                                                <select name="select4" id="select4" class="mb-2 form-control">
                                                    <option value="">Select</option>
                                                    <?php
                                                    $querytreatment = "SELECT * FROM treatment WHERE status='Active'";
                                                    $executetreatment = mysqli_query($db_connect, $querytreatment);
                                                    while ($rstreatment = mysqli_fetch_array($executetreatment)) {
                                                        if ($rstreatment['id'] == isset($_GET['id'])) {
                                                            echo "<option value='$rstreatment[id]' selected>$rstreatment[treatmenttype]  - (#. $rstreatment[treatment_cost])</option>";
                                                        } else {
                                                            echo "<option value='$rstreatment[id]'>$rstreatment[treatmenttype]  - (#. $rstreatment[treatment_cost])</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>

                                                <?php
                                                if (isset($_SESSION['id'])) {
                                                ?>

                                                    <label>Doctor</label>

                                                    <?php
                                                    $querydoctor = "SELECT * FROM doctor_tbl INNER JOIN department_tbl ON department_tbl.id=doctor_tbl.departmentid WHERE doctor_tbl.id='$_SESSION[id]'";
                                                    $executedoctor = mysqli_query($db_connect, $querydoctor);
                                                    while ($rsdoctor = mysqli_fetch_array($executedoctor)) {
                                                        if ($rsdoctor['id']) {
                                                            echo "<option value='$rsdoctor[id]' selected disabled>$rsdoctor[doctorLastname] ( $rsdoctor[departmentName] ) </option>";
                                                        } else {
                                                            echo "<option value='$rsdoctor[id]'>$rsdoctor[doctorLastname] ( $rsdoctor[departmentName] )</option>";
                                                        }
                                                    }
                                                    ?>
                                                    <input type="hidden" name="select5" class="form-control" value="<?php echo $_SESSION['id']; ?>" />

                                                <?php
                                                } else {
                                                ?>

                                                    <label>Doctor</label>

                                                    <select name="select5" id="select5" class="form-control" <option value="">Select</option>
                                                        <?php
                                                        $sqldoctor = "SELECT * FROM doctor_tbl WHERE doctor.id='Active'";
                                                        $qsqldoctor = mysqli_query($db_connect, $sqldoctor);
                                                        while ($rsdoctor = mysqli_fetch_array($qsqldoctor)) {
                                                            if ($rsdoctor['id'] == $rsedit['id']) {
                                                                echo "<option value='$rsdoctor[id]' selected>$rsdoctor[doctorLastname] ( $rsdoctor[departmentname] ) </option>";
                                                            } else {
                                                                echo "<option value='$rsdoctor[id]'>$rsdoctor[doctorLastname] ( $rsdoctor[departmentname] )</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                <?php
                                                }
                                                ?>

                                                <label>Treatment Description</label>
                                                <textarea name="textarea" id="textarea" class="form-control" cols="45" rows="5"><?php if (isset($_GET['editid'])) echo $rsedit['treatment_description']; ?></textarea>

                                                <label>Treatment Files</label>
                                                <input type="file" name="uploads" id="uploads" value="<?php if (isset($_GET['editid'])) echo $rsedit['uploads']; ?>" class="form-control" />

                                                <label>Treatment Date</label>
                                                <input type="date" class="form-control" max="<?php echo date("Y-m-d"); ?>" name="treatmentdate" id="treatmentdate" value="<?php if (isset($_GET['editid'])) echo $rsedit['treatment_date']; ?>" />

                                                <label>Treatment Time</label>
                                                <input type="time" name="treatmenttime" id="treatmenttime" value="<?php if (isset($_GET['editid'])) echo $rsedit['treatment_time']; ?>" class="form-control" />


                                                <button type="submit" name="submit" id="submit" class="mt-1 btn btn-success pull-right">Submit</button>
                                                | <a href='patientreport.php?patientid=<?php echo $_GET['patientid']; ?>&appointmentid=<?php echo $_GET['appointmentid']; ?>'><strong>View Patient Report>></strong></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="71">Treatment type</th>
                                                    <th width="78">Doctor</th>
                                                    <th width="82">Treatment Description</th>
                                                    <th width="103">Uploads</th>
                                                    <th width="43">Treatment date</th>
                                                    <th width="43">Treatment time</th>
                                                    <th width="54">Status</th>
                                                    <th width="58">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM treatment_records WHERE patientid='$_GET[patientid]' AND appointmentid='$_GET[appointmentid]' ";
                                                $execute = mysqli_query($db_connect, $query);
                                                while ($rs = mysqli_fetch_array($execute)) {
                                                    $querypat = "SELECT * FROM patient_tbl WHERE id='$rs[patientid]'";
                                                    $executepat = mysqli_query($db_connect, $querypat);
                                                    $rspat = mysqli_fetch_array($executepat);

                                                    $querydoc = "SELECT * FROM doctor_tbl WHERE id='$rs[doctorid]'";
                                                    $executedoc = mysqli_query($db_connect, $querydoc);
                                                    $rsdoc = mysqli_fetch_array($executedoc);

                                                    $querytreatment = "SELECT * FROM treatment WHERE id='$rs[treatmentid]'";
                                                    $executetreatment = mysqli_query($db_connect, $querytreatment);
                                                    $rstreatment = mysqli_fetch_array($executetreatment);

                                                    echo "<tr>
          <td>&nbsp;$rstreatment[treatmenttype]</td>
		    <td>&nbsp;$rsdoc[doctorLastname]</td>
			<td>&nbsp;$rs[treatment_description]</td>
			<td>&nbsp;<a href='treatmentfiles/$rs[uploads]'>Download</a></td>
			 <td>&nbsp;$rs[treatment_date]</td>
			  <td>&nbsp;$rs[treatment_time]</td>
			    <td>&nbsp;$rs[status]</td>
          <td>&nbsp;
		  <a href='treatmentrecord.php?editid=$rs[appointmentid]&patientid=$_GET[patientid]&appointmentid=$_GET[appointmentid]'>Edit</a>| <a href='treatmentrecord.php?delid=$rs[appointmentid]&patientid=$_GET[patientid]&appointmentid=$_GET[appointmentid]'>Delete</a> </td>
        </tr>";
                                                }
                                                ?>

                                            </tbody>
                                        </table>
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