<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_login(); ?>

<?php
if (isset($_POST['submit'])) {
}
?>

<?php
if (isset($_GET['editid'])) {
    $query = "SELECT * FROM admin_tbl WHERE id='$_GET[editid]' ";
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
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo Message();
                                echo SuccessMessage(); ?>
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">Admin Setup</h5>
                                        <form action="addAdmin.php" method="POST">
                                            <div class="position-relative form-group">
                                                <label>Firstname</label>
                                                <input name="firstname" id="firstname" value="<?php echo $rsedit['firstname']; ?>" placeholder="firstname" type="text" class="form-control" />

                                                <label>Lastname</label>
                                                <input name="lastname" id="lastname" value="<?php echo $rsedit['lastname']; ?>" placeholder="lastname" type="text" class="form-control" />

                                                <label>Gender</label>
                                                <select class="mb-2 form-control" name="gender" id="gender">
                                                    <option value="">Select gender</option>
                                                    <?php
                                                    $arr = array("Male", "Female");
                                                    foreach ($arr as $val) {
                                                        if ($val == $rsedit['gender']) {
                                                            echo "<option value='$val' selected>$val</option>";
                                                        } else {
                                                            echo "<option value='$val'>$val</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>

                                                <label>Email address</label>
                                                <input name="emailAddress" id="emailAddress" value="<?php echo $rsedit['emailAddress']; ?>" placeholder="Email address" type="text" class="form-control" />

                                                <label>Password</label>
                                                <input name="password" id="password" value="<?php echo $rsedit['password']; ?>" placeholder="Password" type="password" class="form-control" />

                                                <label>Confirm Password</label>
                                                <input name="confirmPassword" id="confirmPassword" value="<?php echo $rsedit['confirmPassword']; ?>" placeholder="Confirm Password" type="password" class="form-control" />

                                                <label>Phone Number</label>
                                                <input name="phoneNumber" id="phoneNumber" value="<?php echo $rsedit['phoneNumber']; ?>" placeholder="Phone Number" type="text" class="form-control" />

                                                <label>Address</label>
                                                <input name="address" id="address" value="<?php echo $rsedit['address']; ?>" placeholder="address" type="text" class="form-control" />

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
                                                <button type="submit" class="mt-1 btn btn-success pull-right" name="submit">Submit</button>

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
</body>

</html>