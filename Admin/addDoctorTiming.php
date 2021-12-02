<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_login(); ?>

<?php

if (isset($_POST['submit'])) {
    $Doctor = mysqli_real_escape_string($db_connect, $_POST["doctor"]);
    $StartTime = mysqli_real_escape_string($db_connect, $_POST["start_time"]);
    $EndTime = mysqli_real_escape_string($db_connect, $_POST["end_time"]);
    $Status = mysqli_real_escape_string($db_connect, $_POST["status"]);

    if (isset($_GET['editid'])) {
        $query = "UPDATE doctor_timing_tbl SET doctorid='$_POST[doctor]',start_time='$_POST[start_time]', end_time='$_POST[end_time]', status='$_POST[status]' WHERE id='$_GET[editid]'";
        if ($Execute = mysqli_query($db_connect, $query)) {

            $_SESSION["SuccessMessage"] = "Record Updated";
            Redirect_to("addDoctorTiming.php");
        } else {

            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("addDoctorTiming.php");
        }
    } else if (empty($Doctor) || empty($StartTime) || empty($EndTime) || empty($Status)) {
        $_SESSION["ErrorMessage"] = "All Field must be Filled";
        Redirect_to("addDoctorTimings.php");
    } else {
        global $db_connect;
        $query = "INSERT INTO doctor_timing_tbl(doctorid,start_time,end_time,status)
        VALUES('$Doctor', '$StartTime', '$EndTime', '$Status')";
        $Execute = mysqli_query($db_connect, $query);
        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Doctor Timing added successfully";
            Redirect_to("addDoctorTiming.php");
        } else {
            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("addDoctorTiming.php");
        }
    }
}

if (isset($_GET['delid'])) {
    $query = "DELETE FROM doctor_timing_tbl WHERE id='$_GET[delid]'";
    $execute = mysqli_query($db_connect, $query);
    if (mysqli_affected_rows($db_connect) == 1) {
        echo "<script>alert('doctortimings record deleted successfully..');</script>";
        $_SESSION["SuccessMessage"] = "Doctor timings record deleted successfully";
        Redirect_to("addDoctorTiming.php");
    }
}

?>

<?php
if (isset($_GET['editid'])) {
    $query = "SELECT * FROM doctor_timing_tbl WHERE id='$_GET[editid]' ";
    $execute = mysqli_query($db_connect, $query);
    $rsedit = mysqli_fetch_array($execute);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-medal icon-gradient bg-tempting-azure"></i>
                                </div>
                                <div>Doctor Timings Setup
                                    <!-- <div class="page-title-subheading">Choose between regular React Bootstrap tables or advanced dynamic ones.</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-md-4">
                                <?php echo Message();
                                echo SuccessMessage(); ?>
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">Timing Setup</h5>
                                        <form action="" method="POST">
                                            <div class="position-relative form-group">
                                                <label>Doctor</label>
                                                <select class="mb-2 form-control" name="doctor" id="doctor">
                                                    <option value="">Select</option>
                                                    <?php
                                                    $querydoctor = "SELECT * FROM doctor_tbl WHERE status='Active'";
                                                    $executedoctor = mysqli_query($db_connect, $querydoctor);
                                                    while ($rsdoctor = mysqli_fetch_array($executedoctor)) {
                                                        if ($rsdoctor['id'] == $rsedit['id']) {
                                                            echo "<option value='$rsdoctor[id]' selected>$rsdoctor[doctorFirstname] $rs[doctorLastname]</option>";
                                                        } else {
                                                            echo "<option value='$rsdoctor[id]'>$rsdoctor[doctorFirstName] $rsdoctor[doctorLastname]</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>

                                                <label>From</label>
                                                <input name="start_time" id="start_time" value="<?php if (isset($_GET['editid'])) echo $rsedit['start_time']; ?>" type="time" class="form-control" />

                                                <label>To</label>
                                                <input name="end_time" id="end_time" type="time" value="<?php if (isset($_GET['editid'])) echo $rsedit['end_time']; ?>" class="form-control" />

                                                <label>Status</label>
                                                <select class="mb-2 form-control" name="status" id="status">
                                                    <option value="">Select Status</option>
                                                    <?php
                                                    $arr = array("Active", "InActive");
                                                    foreach ($arr as $val) {
                                                        if ($val == $rsedit['status']) {
                                                            echo "<option value='$val' selected>$val</option>";
                                                        } else {
                                                            echo "<option value='$val'>$val</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <button type="submit" id="submit" name="submit" class="mt-1 btn btn-success pull-right">Submit</button>
                                                <button class="mt-1 btn btn-danger">Cancel</button>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Edit</th>
                                                    <th>Doctor</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM doctor_timing_tbl";
                                                $execute = mysqli_query($db_connect, $query);
                                                while ($rs = mysqli_fetch_array($execute)) {
                                                    $querydoctor = "SELECT * FROM doctor_tbl WHERE id='$rs[id]'";
                                                    $executedoctor = mysqli_query($db_connect, $querydoctor);
                                                    $rsdoctor = mysqli_fetch_array($executedoctor);

                                                    $querydoct = "SELECT * FROM doctor_timing_tbl WHERE id='$rs[id]'";
                                                    $executedoct = mysqli_query($db_connect, $querydoct);
                                                    $rsdoct = mysqli_fetch_array($executedoct);

                                                    echo "<tr>
                                                             <td>
                                                            <a href='addDoctorTiming.php?editid=$rs[id]'>
                                                                <button class='btn btn-info btn-sm float-left'>
                                                                    <i class='fa fa-edit'></i>
                                                                </button>
                                                                </a>
                                                            </td>
                                                            <td>&nbsp;$rsdoctor[doctorLastname]</td>
                                                            <td>&nbsp;$rsdoct[start_time]</td>
                                                            <td>&nbsp;$rsdoct[end_time]</td>
                                                            <td>&nbsp;$rs[status]</td>
                                                           <td>                         
                                                                 <a href='addDoctorTiming.php?delid=$rs[id]'>
                                                                 <button class='btn btn-danger btn-sm float-right'>
                                                                     <i class='fa fa-trash'></i>
                                                                 </button>
                                                                 </a>
                                                            </td>
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