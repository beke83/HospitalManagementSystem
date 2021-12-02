<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_login(); ?>

<?php
if (isset($_GET['delid'])) {
    $query = "DELETE FROM appointment_tbl WHERE id='$_GET[delid]'";
    $execute = mysqli_query($db_connect, $query);
    if (mysqli_affected_rows($db_connect) == 1) {
        $_SESSION["SuccessMessage"] = "Appointment deleted successfully";
        Redirect_to("viewPendingAppointment.php");;
    }
}

if (isset($_GET['approveid'])) {
    $query = "UPDATE patient_tbl SET status='Active' WHERE id='$_GET[patientid]'";
    $execute = mysqli_query($db_connect, $query);

    $query = "UPDATE appointment_tbl SET status='Approved' WHERE id='$_GET[approveid]'";
    $execute = mysqli_query($db_connect, $query);
    if (mysqli_affected_rows($db_connect) == 1) {
        echo "<script>alert('Appointment record Approved successfully..');</script>";
        echo "<script>window.location='viewPendingAppointment.php';</script>";
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
                                <div>Pending Appointment
                                    <div class="page-title-subheading">Choose between regular React Bootstrap tables or advanced dynamic ones.</div>
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
                                        <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Patient detail</th>
                                                    <th>Appointment Date</th>
                                                    <th>Appointment Time</th>
                                                    <th>Department</th>
                                                    <th>Doctor</th>
                                                    <th>Appointment Reason</th>
                                                    <th>Status</th>
                                                    <th style="width: 150px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM appointment_tbl WHERE (status='Pending' OR status='InActive') ORDER BY id desc";
                                                if (isset($_SESSION['patientid'])) {
                                                    $query  = $query . " AND patientid='$_SESSION[patientid]'";
                                                }
                                                $execute = mysqli_query($db_connect, $query);
                                                while ($rs = mysqli_fetch_array($execute)) {
                                                    $querypat = "SELECT * FROM patient_tbl WHERE id='$rs[patientid]'";
                                                    $executepat = mysqli_query($db_connect, $querypat);
                                                    $rspat = mysqli_fetch_array($executepat);


                                                    $querydept = "SELECT * FROM department_tbl WHERE id='$rs[departmentid]'";
                                                    $executedept = mysqli_query($db_connect, $querydept);
                                                    $rsdept = mysqli_fetch_array($executedept);

                                                    $querydoc = "SELECT * FROM doctor_tbl WHERE id='$rs[doctorid]'";
                                                    $executedoc = mysqli_query($db_connect, $querydoc);
                                                    $rsdoc = mysqli_fetch_array($executedoc);
                                                    echo "<tr>
                                            
                                                            
          <td>&nbsp;$rspat[firstname]<br>&nbsp;$rspat[phoneNumber]</td>		 
			 <td>&nbsp;" . date("d-M-Y", strtotime($rs['appointmentdate'])) . " &nbsp; " . date("H:i A", strtotime($rs['appointmenttime'])) . "</td> 
            			 <td>&nbsp;$rs[appointmenttime]</td> 
             <td>&nbsp;$rsdept[departmentName]</td>
			   <td>&nbsp;$rsdoc[doctorLastname]</td>
			    <td>&nbsp;$rs[app_reason]</td>
			    <td>&nbsp;$rs[status]</td>
          <td><div align='center'>";
                                                    if ($rs['status'] != "Approved") {
                                                        if (!(isset($_SESSION['patientid']))) {

                                                            echo "
                                                                <a href= 'appointmentApproval.php?editid=$rs[id]&patientid=$rs[patientid]'>
                                                                <button class='btn btn-info btn-sm float-left'>
                                                                    Approve
                                                                </button>
                                                                </a>
                                                            ";
                                                        }
                                                        echo "
                                                            <a href='viewPendingAppointment.php?delid=$rs[id]'>
                                                                 <button class='btn btn-danger btn-sm float-right'>
                                                                     <i class='fa fa-trash'></i>
                                                                 </button>
                                                                 </a>
                                                        ";
                                                    } else {
                                                        echo "<a href='patientreport.php?patientid=$rs[patientid]&appointmentid=$rs[appointmentid]'>View Report</a>";
                                                    }
                                                    echo "</center></td></tr>";
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

    <script type="text/javascript" src="../assets/scripts/main.js"></script>
</body>

</html>