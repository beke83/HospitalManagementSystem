<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_doctor_login(); ?>


<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultancy Charge</title>

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
                                <div>Consultancy Charge
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
                                        <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="97" scope="col">Date</th>
                                                    <th width="245" scope="col">Decription</th>
                                                    <th width="86" scope="col">Bill Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM billing_records where bill_type='Consultancy Charge' AND bill_type_id='$_SESSION[id]'";
                                                $qsql = mysqli_query($db_connect, $sql);
                                                $billamt = 0;
                                                while ($rs = mysqli_fetch_array($qsql)) {
                                                    echo "<tr>
                                                        <td>&nbsp;$rs[bill_date]</td>
                                                        <td>&nbsp; $rs[bill_type]";

                                                    if ($rs['bill_type'] == "Service Charge") {
                                                        $sqlservice_type1 = "SELECT * FROM service_type WHERE id='$rs[bill_type_id]'";
                                                        $qsqlservice_type1 = mysqli_query($db_connect, $sqlservice_type1);
                                                        $rsservice_type1 = mysqli_fetch_array($qsqlservice_type1);
                                                        echo " - " . $rsservice_type1['service_type'];
                                                    }


                                                    if ($rs['bill_type'] == "Room Rent") {
                                                        $sqlroomtariff = "SELECT * FROM room WHERE id='$rs[bill_type_id]'";
                                                        $qsqlroomtariff = mysqli_query($db_connect, $sqlroomtariff);
                                                        $rsroomtariff = mysqli_fetch_array($qsqlroomtariff);
                                                        echo " : " . $rsroomtariff['roomtype'] .  "- Room No." . $rsroomtariff['roomno'];
                                                    }

                                                    if ($rs['bill_type'] == "Consultancy Charge") {
                                                        //Consultancy Charge
                                                        $sqldoctor = "SELECT * FROM doctor_tbl WHERE id='$rs[bill_type_id]'";
                                                        $qsqldoctor = mysqli_query($db_connect, $sqldoctor);
                                                        $rsdoctor = mysqli_fetch_array($qsqldoctor);
                                                        echo " - Mr." . $rsdoctor['doctorLastname'];
                                                    }

                                                    if ($rs['bill_type'] == "Treatment Cost") {
                                                        //Treatment Cost
                                                        $sqltreatment = "SELECT * FROM treatment WHERE id='$rs[bill_type_id]'";
                                                        $qsqltreatment = mysqli_query($db_connect, $sqltreatment);
                                                        $rstreatment = mysqli_fetch_array($qsqltreatment);
                                                        echo " - " . $rstreatment['treatmenttype'];
                                                    }

                                                    if ($rs['bill_type']  == "Prescription charge") {
                                                        $sqltreatment = "SELECT * FROM prescription WHERE treatmentid='$rs[bill_type_id]'";
                                                        $qsqltreatment = mysqli_query($db_connect, $sqltreatment);
                                                        $rstreatment = mysqli_fetch_array($qsqltreatment);

                                                        $sqltreatment1 = "SELECT * FROM treatment_records WHERE treatmentid='$rstreatment[treatment_records_id]'";
                                                        $qsqltreatment1 = mysqli_query($db_connect, $sqltreatment1);
                                                        $rstreatment1 = mysqli_fetch_array($qsqltreatment1);

                                                        $sqltreatment2 = "SELECT * FROM treatment_tbl WHERE id='$rstreatment1[treatmentid]'";
                                                        $qsqltreatment2 = mysqli_query($db_connect, $sqltreatment2);
                                                        $rstreatment2 = mysqli_fetch_array($qsqltreatment2);
                                                        echo     " - " . $rstreatment2['treatmenttype'];
                                                    }

                                                    echo " </td><td>&nbsp;# $rs[bill_amount]</td></tr>";
                                                    $billamt = $billamt +  $rs['bill_amount'];
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <table width="557" border="3" id="example" class="table table-hover table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th scope="col">
                                                        <div align="right">Total Earnings &nbsp; </div>
                                                    </th>
                                                    <td>&nbsp;# <?php echo $billamt; ?></td>
                                                </tr>
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