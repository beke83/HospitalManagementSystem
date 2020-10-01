<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_login(); ?>

<?php
if (isset($_POST['submit'])) {
    $RoomType = mysqli_real_escape_string($db_connect, $_POST["roomtype"]);
    $RoomNo = mysqli_real_escape_string($db_connect, $_POST["roomno"]);
    $NumberOfBeds = mysqli_real_escape_string($db_connect, $_POST["noofbeds"]);
    $RoomTariff = mysqli_real_escape_string($db_connect, $_POST["room_tariff"]);
    $Status = mysqli_real_escape_string($db_connect, $_POST["status"]);

    if (isset($_GET['editid'])) {
        $query = "UPDATE department_tbl SET departmentName='$_POST[departmentName]', description='$_POST[description]', status='$_POST[status]' WHERE id='$_GET[editid]'";
        if ($Execute = mysqli_query($db_connect, $query)) {

            $_SESSION["SuccessMessage"] = "Record Updated";
            Redirect_to("addDepartment.php");
        } else {

            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("addDepartment.php");
        }
    } else if (empty($RoomType) || empty($RoomNo) || empty($NumberOfBeds) || empty($RoomTariff)) {
        $_SESSION["ErrorMessage"] = "All Field must be Filled";
        Redirect_to("addRoom.php");
    } else {
        global $db_connect;
        $query = "INSERT INTO room(roomtype,roomno,noofbeds,room_tariff,status)
        VALUES('$RoomType', '$RoomNo', '$NumberOfBeds', '$RoomTariff', '$Status')";
        $Execute = mysqli_query($db_connect, $query);
        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Room saved successfully";
            Redirect_to("addRoom.php");
        } else {
            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("addRoom.php");
        }
    }
}

if (isset($_GET['delid'])) {
    $query = "DELETE FROM room WHERE id='$_GET[delid]'";
    $Execute = mysqli_query($db_connect, $query);
    if (mysqli_affected_rows($db_connect) == 1) {

        $_SESSION["SuccessMessage"] = "room deleted successfully";
        Redirect_to("addRoom.php");
    }
}

?>

<?php
if (isset($_GET['editid'])) {
    $query = "SELECT * FROM department_tbl WHERE id='$_GET[editid]' ";
    $Execute = mysqli_query($db_connect, $query);
    $rsedit = mysqli_fetch_array($Execute);
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
                                <div>Room Setup
                                    <div class="page-title-subheading">Choose between regular React Bootstrap tables or advanced dynamic ones.</div>
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
                                        <h5 class="card-title">Room Setup Form</h5>
                                        <form action="" method="POST">
                                            <div class="position-relative form-group">
                                                <label>Room Type</label>
                                                <input name="roomtype" id="roomtype" value="<?php if (isset($_GET['editid'])) echo $rsedit['departmentName']; ?>" type="text" class="form-control" />

                                                <label>Number Of Beds</label>
                                                <input name="roomno" id="roomno" value="<?php if (isset($_GET['editid'])) echo $rsedit['departmentName']; ?>" type="text" class="form-control" />

                                                <label>Room Number</label>
                                                <input name="noofbeds" id="noofbeds" value="<?php if (isset($_GET['editid'])) echo $rsedit['departmentName']; ?>" type="text" class="form-control" />

                                                <label>Room Tarriff</label>
                                                <input name="room_tariff" id="room_tariff" value="<?php if (isset($_GET['editid'])) echo $rsedit['departmentName']; ?>" type="text" class="form-control" />

                                                <label>Status</label>
                                                <select class="mb-2 form-control" name="status" id="status" value="<?php if (isset($_GET['editid'])) echo $rsedit['status']; ?>">
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
                                                    <th>Room Type</th>
                                                    <th>Room No</th>
                                                    <th>Number Of beds</th>
                                                    <th>Room Tariff</th>
                                                    <th>Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                global $db_connect;
                                                $query = "SELECT * FROM room ORDER BY id desc";
                                                $Execute = mysqli_query($db_connect, $query);
                                                while ($rs = mysqli_fetch_array($Execute)) {
                                                    echo "
                                                        <tr>
                        
                                                            <td>&nbsp;$rs[roomtype]</td>
                                                            <td>&nbsp;$rs[roomno]</td>
                                                            <td>&nbsp;$rs[noofbeds]</td>
                                                            <td>&nbsp;$rs[room_tariff]</td>
                                                            <td>&nbsp;$rs[status]</td>
                                                            <td>                         
                                                                 <a href='addRoom.php?delid=$rs[id]'>
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