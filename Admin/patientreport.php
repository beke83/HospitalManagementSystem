<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_login(); ?>

<?php
if (isset($_POST['submit'])) {
    if (isset($_GET['editid'])) {
        $query = "UPDATE appointment SET patientid='$_POST[select4]',departmentid='$_POST[select5]',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[time]',doctorid='$_POST[select6]',status='$_POST[select]' WHERE appointmentid='$_GET[editid]'";
        if ($execute = mysqli_query($db_connect, $query)) {
            echo "<script>alert('appointment record updated successfully...');</script>";
        } else {
            echo mysqli_error($db_connect);
        }
    } else {
        $query = "INSERT INTO appointment(patientid,departmentid,appointmentdate,appointmenttime,doctorid,status) values('$_POST[select4]','$_POST[select5]','$_POST[appointmentdate]','$_POST[time]','$_POST[select6]','$_POST[select]')";
        if ($execute = mysqli_query($db_connect, $query)) {
            echo "<script>alert('Appointment record inserted successfully...');</script>";
        } else {
            echo mysqli_error($db_connect);
        }
    }
}
if (isset($_GET['editid'])) {
    $query = "SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
    $execute = mysqli_query($db_connect, $query);
    $rsedit = mysqli_fetch_array($execute);
}
?>

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>

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
                                <div id="accordion" class="accordion-wrapper ">
                                    <div class="card">
                                        <div id="headingOne" class="card-header">
                                            <button type="button" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block">
                                                <h5 class="m-0 p-0">Patient Profile</h5>
                                            </button>
                                        </div>
                                        <div data-parent="#accordion" id="collapseOne1" aria-labelledby="headingOne" class="collapse show">
                                            <div class="card-body">
                                                <?php include("patientdetail.php"); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div id="headingTwo" class="b-radius-0 card-header">
                                            <button type="button" data-toggle="collapse" data-target="#collapseOne2" aria-expanded="false" aria-controls="collapseTwo" class="text-left m-0 p-0 btn btn-link btn-block">
                                                <h5 class="m-0 p-0">Appointment Record
                                                </h5>
                                            </button>
                                        </div>
                                        <div data-parent="#accordion" id="collapseOne2" class="collapse">
                                            <div class="card-body"><?php include("appointmentdetail.php"); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div id="headingThree" class="card-header">
                                            <button type="button" data-toggle="collapse" data-target="#collapseOne3" aria-expanded="false" aria-controls="collapseThree" class="text-left m-0 p-0 btn btn-link btn-block">
                                                <h5 class="m-0 p-0">Treatment Record</h5>
                                            </button>
                                        </div>
                                        <div data-parent="#accordion" id="collapseOne3" class="collapse">
                                            <div class="card-body"><?php include("treatmentdetail.php"); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div id="headingFour" class="card-header">
                                            <button type="button" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseFour" class="text-left m-0 p-0 btn btn-link btn-block">
                                                <h5 class="m-0 p-0">Prescription Record</h5>
                                            </button>
                                        </div>
                                        <div data-parent="#accordion" id="collapseOne4" class="collapse">
                                            <div class="card-body">
                                                <?php include("prescriptiondetail.php"); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div id="headingFive" class="card-header">
                                            <button type="button" data-toggle="collapse" data-target="#collapseOne5" aria-expanded="false" aria-controls="collapseFive" class="text-left m-0 p-0 btn btn-link btn-block">
                                                <h5 class="m-0 p-0">Billing Report</h5>
                                            </button>
                                        </div>
                                        <div data-parent="#accordion" id="collapseOne5" class="collapse">
                                            <div class="card-body">
                                                <?php
                                                $billappointmentid = $rsappointment[0];
                                                include("viewbilling.php"); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div id="headingSix" class="card-header">
                                            <button type="button" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseSix" class="text-left m-0 p-0 btn btn-link btn-block">
                                                <h5 class="m-0 p-0">Payment Report</h5>
                                            </button>
                                        </div>
                                        <div data-parent="#accordion" id="collapseOne6" class="collapse">
                                            <div class="card-body">
                                                <?php
                                                $billappointmentid = $rsappointment[0];
                                                include("viewpaymentreport.php");
                                                ?>

                                            </div>
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

    <script type="text/javascript" src="../assets/scripts/main.js"></script>

</body>

</html>