<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_login(); ?>

<?php
if (isset($_POST['submit'])) {
    $TreatmentType = mysqli_real_escape_string($db_connect, $_POST["treatmentType"]);
    $TreatmentCost = mysqli_real_escape_string($db_connect, $_POST["treatmentCost"]);
    $Note = mysqli_real_escape_string($db_connect, $_POST["note"]);
    $Status = mysqli_real_escape_string($db_connect, $_POST["status"]);

    if (isset($_GET['editid'])) {
        $query = "UPDATE treatmenttype_tbl SET treatmentType='$_POST[treatmentType]', treatmentCost='$_POST[treatmentCost]',note='$_POST[note]', status='$_POST[status]' WHERE id='$_GET[editid]'";
        if ($Execute = mysqli_query($db_connect, $query)) {

            $_SESSION["SuccessMessage"] = "Record Updated";
            Redirect_to("addTreatmentType.php");
        } else {

            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("addTreatmentType.php");
        }
    } else if (empty($TreatmentType) || empty($TreatmentCost) || empty($Note) || empty($Status)) {
        $_SESSION["ErrorMessage"] = "All Field must be Filled";
        Redirect_to("addTreatmentType.php");
    } else {
        global $db_connect;
        $query = "INSERT INTO treatmenttype_tbl(treatmentType,treatmentCost,note,status)
        VALUES('$TreatmentType', '$TreatmentCost', '$Note', '$Status')";
        $Execute = mysqli_query($db_connect, $query);
        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Treatment Type saved successfully";
            Redirect_to("addTreatmentType.php");
        } else {
            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("addTreatmentType.php");
        }
    }
}

if (isset($_GET['delid'])) {
    $query = "DELETE FROM treatmenttype_tbl WHERE id='$_GET[delid]'";
    $Execute = mysqli_query($db_connect, $query);
    if (mysqli_affected_rows($db_connect) == 1) {

        $_SESSION["SuccessMessage"] = "Treatment type deleted successfully";
        Redirect_to("addTreatmentType.php");
    }
}

?>

<?php
if (isset($_GET['editid'])) {
    $query = "SELECT * FROM treatmenttype_tbl WHERE id='$_GET[editid]' ";
    $Execute = mysqli_query($db_connect, $query);
    $rsedit = mysqli_fetch_array($Execute);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TreatmentType</title>

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
                                <div>Treatment Type
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
                                        <h5 class="card-title">Treatment Type Setup</h5>
                                        <form action="" method="POST">
                                            <div class="position-relative form-group">
                                                <label>Treatment Type</label>
                                                <input name="treatmentType" id="treatmentType" value="<?php if (isset($_GET['editid'])) echo $rsedit['treatmentType']; ?>" placeholder="Enter Treatment Type" type="text" class="form-control" />

                                                <label>Treatment Cost</label>
                                                <input name="treatmentCost" id="treatmentCost" value="<?php if (isset($_GET['editid'])) echo $rsedit['treatmentCost']; ?>" placeholder="Enter Treatment Cost" type="text" class="form-control" />

                                                <label>Note</label>
                                                <textarea type="text" name="note" id="note" class="form-control" name="note"><?php if (isset($_GET['editid'])) echo $rsedit['note']; ?></textarea>

                                                <label>Status</label>
                                                <select class="mb-2 form-control" name="status" id="status" value="<?php if (isset($_GET['editid'])) echo $rsedit['status']; ?>">
                                                    <option value="">Select</option>
                                                    <?php
                                                    $arr = array("Active", "Inactive");
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
                            <div class="col-md-8">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Edit</th>
                                                    <th>Treatment Type</th>
                                                    <th>Treatment Cost</th>
                                                    <th>Note</th>
                                                    <th>Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                global $db_connect;
                                                $query = "SELECT * FROM treatmenttype_tbl ORDER BY id desc";
                                                $Execute = mysqli_query($db_connect, $query);
                                                while ($rs = mysqli_fetch_array($Execute)) {
                                                    echo "
                                                        <tr>
                                                            <td>
                                                            <a href='addTreatmentType.php?editid=$rs[id]'>
                                                                <button class='btn btn-info btn-sm float-left'>
                                                                    <i class='fa fa-edit'></i>
                                                                </button>
                                                                </a>
                                                            </td>
                                                            <td>&nbsp;$rs[treatmentType]</td>
                                                            <td>&nbsp;$rs[treatmentCost]</td>
                                                            <td>&nbsp;$rs[note]</td>
                                                            <td>&nbsp;$rs[status]</td>
                                                            <td>                         
                                                                 <a href='addTreatmentType.php?delid=$rs[id]'>
                                                                 <button class='btn btn-danger btn-sm float-right'>
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