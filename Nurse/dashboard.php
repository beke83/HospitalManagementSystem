<?php include("../include/db_connect.php") ?>
<?php require_once("../include/session.php"); ?>
<?php require_once("../include/Functions.php");
confirm_login();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nurse Dashboard</title>
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
                                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>Nurse Dashboard

                                </div>
                            </div>
                            <div class="page-title-actions">
                                <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                                    <i class="fa fa-star"></i>
                                </button>
                                <div class="d-inline-block dropdown">
                                    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="fa fa-business-time fa-w-20"></i>
                                        </span>
                                        Buttons
                                    </button>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">
                                                    <i class="nav-link-icon lnr-inbox"></i>
                                                    <span>
                                                        Inbox
                                                    </span>
                                                    <div class="ml-auto badge badge-pill badge-secondary">86</div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">
                                                    <i class="nav-link-icon lnr-book"></i>
                                                    <span>
                                                        Book
                                                    </span>
                                                    <div class="ml-auto badge badge-pill badge-danger">5</div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">
                                                    <i class="nav-link-icon lnr-picture"></i>
                                                    <span>
                                                        Picture
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a disabled href="javascript:void(0);" class="nav-link disabled">
                                                    <i class="nav-link-icon lnr-file-empty"></i>
                                                    <span>
                                                        File Disabled
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-arielle-smile">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Patients</div>
                                        <div class="widget-subheading">Total Number of Patient</div>
                                    </div>
                                    <?php
                                    $sql = "SELECT * FROM patient_tbl WHERE status='Active'";
                                    if (isset($_GET['date'])) {
                                        $sql = $sql . " AND admissiondate ='$_GET[date]'";
                                    }
                                    $qsql = mysqli_query($db_connect, $sql);
                                    $RowsTotal = mysqli_fetch_array($qsql);

                                    $Total = array_shift($RowsTotal);
                                    if ($Total > 0) {
                                    ?>
                                        <div class='widget-content-right'>
                                            <div class='widget-numbers text-white'><span><?php echo $Total ?></span></div>
                                        </div>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-midnight-bloom">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Approved Appointments</div>
                                        <div class="widget-subheading">Total Approved Appointments</div>
                                    </div>
                                    <?php
                                    $sql = "SELECT COUNT(*) FROM appointment_tbl WHERE status='Approved'";
                                    if (isset($_GET['date'])) {
                                        $sql = $sql . " AND appointmentdate ='$_GET[date]'";
                                    }
                                    $qsql = mysqli_query($db_connect, $sql);
                                    $RowsTotal = mysqli_fetch_array($qsql);

                                    $Total = array_shift($RowsTotal);
                                    if ($Total > 0) {
                                    ?>
                                        <div class='widget-content-right'>
                                            <div class='widget-numbers text-white'><span><?php echo $Total; ?></span></div>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-grow-early">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Pending Appointments</div>
                                        <div class="widget-subheading">Total Pending Appointments</div>
                                    </div>
                                    <?php
                                    $sql = "SELECT COUNT(*) FROM appointment_tbl WHERE status='Pending'";
                                    if (isset($_GET['date'])) {
                                        $sql = $sql . " AND appointmentdate ='$_GET[date]'";
                                    }
                                    $qsql = mysqli_query($db_connect, $sql);
                                    $RowsTotal = mysqli_fetch_array($qsql);

                                    $Total = array_shift($RowsTotal);
                                    if ($Total > 0) {
                                    ?>
                                        <div class='widget-content-right'>
                                            <div class='widget-numbers text-white'><span><?php echo $Total; ?></span></div>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <!-- <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-premium-dark">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Products Sold</div>
                                        <div class="widget-subheading">Revenue streams</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-warning"><span>$14M</span></div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header">Active Patient
                                </div>
                                <div class="table-responsive">
                                    <table style="width: 100%;" id="example" class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Patient Name</th>
                                                <th class="text-center">Gender</th>
                                                <th class="text-center">Address</th>
                                                <th class="text-center">Phone Number</th>
                                                <th class="text-center">Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            global $db_connect;
                                            $query = "SELECT * FROM patient_tbl ORDER BY id desc";
                                            $Execute = mysqli_query($db_connect, $query);
                                            while ($rs = mysqli_fetch_array($Execute)) {
                                                echo "
                                                        <tr>
                                                        <td class='text-center'>&nbsp;$rs[id]</td>
                                                        
                                                            <td class='text-center'>&nbsp;$rs[firstname] $rs[lastname]</td>                                  
                                                            <td class='text-center'>&nbsp;$rs[gender]</td>                                                       
                                                            <td class='text-center'>&nbsp;$rs[address]</td>
                                                            <td class='text-center'>&nbsp;$rs[phoneNumber]</td>
                                                            <td class='text-center'>&nbsp;$rs[status]</td>
                                                             <td>
                                                                <a href='addPatient.php?editid=$rs[id]'>
                                                                <button class='btn btn-info btn-sm float-left'>
                                                                    <i class='fa fa-edit'></i>
                                                                </button>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href='viewPatient.php?delid=$rs[id]'>
                                                                 <button class='btn btn-danger btn-sm'>
                                                                     <i class='fa fa-trash'></i>
                                                                 </button>
                                                                 </a>
                                                            </td>
                                                            
                                                        </tr>
                                                    "
                                            ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Billing Reports</div>
                                            <div class="widget-subheading">Total No of Bill Reports</div>
                                        </div>
                                        <?php
                                        $sql = "SELECT COUNT(*) FROM billing_tbl";
                                        if (isset($_GET['date'])) {
                                            $sql = $sql . " AND billingdate ='$_GET[date]'";
                                        }
                                        $qsql = mysqli_query($db_connect, $sql);
                                        $RowsTotal = mysqli_fetch_array($qsql);

                                        $Total = array_shift($RowsTotal);
                                        if ($Total > 0) {
                                        ?>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-success"><?php echo $Total ?></div>
                                            </div>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Treatment</div>
                                            <div class="widget-subheading">Total Treatment Record</div>
                                        </div>
                                        <?php
                                        $sql = "SELECT COUNT(*) FROM treatment_records WHERE status='Active'";
                                        if (isset($_GET['date'])) {
                                            $sql = $sql . " AND billingdate ='$_GET[date]'";
                                        }
                                        $qsql = mysqli_query($db_connect, $sql);
                                        $RowsTotal = mysqli_fetch_array($qsql);

                                        $Total = array_shift($RowsTotal);
                                        if ($Total > 0) {
                                        ?>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-warning"><?php echo $Total; ?></div>
                                            </div>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Appointments</div>
                                            <div class="widget-subheading">Total Appointments Record</div>
                                        </div>
                                        <?php
                                        $sql = "SELECT COUNT(*) FROM appointment_tbl WHERE status='Approved' or 'Pending'";

                                        $qsql = mysqli_query($db_connect, $sql);
                                        $RowsTotal = mysqli_fetch_array($qsql);

                                        $Total = array_shift($RowsTotal);
                                        if ($Total > 0) {
                                        ?>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-danger"><?php echo $Total ?></div>
                                            </div>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                        </div> -->
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header">Active Doctor
                                </div>
                                <div class="table-responsive">
                                    <table style="width: 100%;" id="example" class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Doctor Name</th>
                                                <th class="text-center">Department</th>
                                                <th class="text-center">Email Address</th>
                                                <th class="text-center">Phone Number</th>
                                                <th class="text-center">Gender</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            global $db_connect;
                                            $query = "SELECT * FROM doctor_tbl";
                                            $execute = mysqli_query($db_connect, $query);
                                            while ($rs = mysqli_fetch_array($execute)) {

                                                $querydept = "SELECT * FROM department_tbl WHERE id='$rs[departmentid]'";
                                                $executedept = mysqli_query($db_connect, $querydept);
                                                $rsdept = mysqli_fetch_array($executedept);

                                                echo "
                                                        <tr>
                                                           
                                                            <td class='text-center'>&nbsp;$rs[doctorFirstname] $rs[doctorLastname]</td>
                                                            <td class='text-center'>&nbsp;$rsdept[departmentName]</td>
                                                            <td class='text-center'>&nbsp;$rs[emailAddress]</td>
                                                            <td class='text-center'>&nbsp;$rs[phoneNumber]</td>
                                                            <td class='text-center'>&nbsp;$rs[gender]</td>
                                                            <td class='text-center'>&nbsp;$rs[status]</td>
                                                             <td>
                                                            <a href='addDoctor.php?editid=$rs[id]'>
                                                                <button class='btn btn-info btn-sm float-left'>
                                                                    <i class='fa fa-edit'></i>
                                                                </button>
                                                                </a>
                                                            </td>
                                                            <td>                         
                                                                 <a href='viewDoctor.php?delid=$rs[id]'>
                                                                 <button class='btn btn-danger btn-sm'>
                                                                     <i class='fa fa-trash'></i>
                                                                 </button>
                                                                 </a>
                                                            </td>
                                                            
                                                        </tr>
                                                    ";
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-arielle-smile">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Doctor</div>
                                        <div class="widget-subheading">Total Number of Doctor</div>
                                    </div>
                                    <?php
                                    $sql = "SELECT COUNT(*) FROM doctor_tbl WHERE status='Active'";
                                    $qsql = mysqli_query($db_connect, $sql);
                                    $RowsTotal = mysqli_fetch_array($qsql);

                                    $Total = array_shift($RowsTotal);
                                    if ($Total > 0) {
                                    ?>
                                        <div class='widget-content-right'>
                                            <div class='widget-numbers text-white'><span><?php echo $Total ?></span></div>
                                        </div>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-midnight-bloom">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Department</div>
                                        <div class="widget-subheading">Total Departments</div>
                                    </div>
                                    <?php
                                    $sql = "SELECT COUNT(*) FROM department_tbl";
                                    $qsql = mysqli_query($db_connect, $sql);
                                    $RowsTotal = mysqli_fetch_array($qsql);

                                    $Total = array_shift($RowsTotal);
                                    if ($Total > 0) {
                                    ?>
                                        <div class='widget-content-right'>
                                            <div class='widget-numbers text-white'><span><?php echo $Total; ?></span></div>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-grow-early">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Treatment Records</div>
                                        <div class="widget-subheading">Total Treatment Record</div>
                                    </div>
                                    <?php
                                    $sql = "SELECT COUNT(*) FROM treatment_records";
                                    $qsql = mysqli_query($db_connect, $sql);
                                    $RowsTotal = mysqli_fetch_array($qsql);

                                    $Total = array_shift($RowsTotal);
                                    if ($Total > 0) {
                                    ?>
                                        <div class='widget-content-right'>
                                            <div class='widget-numbers text-white'><span><?php echo $Total; ?></span></div>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <!-- <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-premium-dark">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Products Sold</div>
                                        <div class="widget-subheading">Revenue streams</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-warning"><span>$14M</span></div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
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