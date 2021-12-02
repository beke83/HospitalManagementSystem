<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_login(); ?>

<?php
if (isset($_GET['delid'])) {
    $query = "DELETE FROM treatment_records WHERE appointmentid='$_GET[delid]'";
    $execute = mysqli_query($db_connect, $query);
    if (mysqli_affected_rows($db_connect) == 1) {
        $_SESSION["SuccessMessage"] = "Appointment record deleted successfully";
        Redirect_to("viewTreatmentRecord.php");
        // echo "<script>alert('appointment record deleted successfully..');</script>";
    }
}
?>
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Treatment Record</title>

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
                                <div>Treatment Records
                                    <!-- <div class="page-title-subheading">Choose between regular React Bootstrap tables or advanced dynamic ones.</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <td width="71">Treatment type</td>
                                                    <td width="52">Patient</td>
                                                    <td width="78">Doctor</td>
                                                    <td width="82">Treatment Description</td>
                                                    <td width="43">Treatmentdate</td>
                                                    <td width="43">Treatmenttime</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM treatment_records where status='Active'";
                                                if (isset($_SESSION['id'])) {
                                                    $query = $query . " AND patientid='$_SESSION[id]'";
                                                }
                                                if (isset($_SESSION['doctorid'])) {
                                                    $query = $query . " AND doctorid='$_SESSION[doctorid]'";
                                                }
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
                                                        <td>&nbsp;$rspat[lastname]</td>
                                                        <td>&nbsp;$rsdoc[doctorLastname]</td>
                                                        <td>&nbsp;$rs[treatment_description]</td>
                                                        <td>&nbsp;$rs[treatment_date]</td>
                                                        <td>&nbsp;$rs[treatment_time]</td>";

                                                    echo " </tr>";
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