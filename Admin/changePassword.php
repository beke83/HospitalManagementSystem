<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_login(); ?>

<?php
if (isset($_POST['submit'])) {
    $OldPassword = mysqli_real_escape_string($db_connect, $_POST["oldpassword"]);
    $NewPassword = mysqli_real_escape_string($db_connect, $_POST["newpassword"]);
    $ConfirmPassword = mysqli_real_escape_string($db_connect, $_POST["password"]);

    if (empty($OldPassword) || empty($NewPassword) || empty($ConfirmPassword)) {
        $_SESSION["ErrorMessage"] = "All Field must be Filled";
        Redirect_to("changePassword.php");
    } else if ($NewPassword != $ConfirmPassword) {

        $_SESSION["ErrorMessage"] = "Password does'not match";
        Redirect_to("changePassword.php");
    } else {
        $sql = "UPDATE admin_tbl SET password='$_POST[newpassword]' WHERE password='$_POST[oldpassword]'";
        $qsql = mysqli_query($db_connect, $sql);
        if (mysqli_affected_rows($db_connect) == 1) {
            $_SESSION["SuccessMessage"] = "password updated";
            Redirect_to("changePassword.php");
        } else {
            $_SESSION["ErrorMessage"] = "password failed to update";
            Redirect_to("changePasword.php");
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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
                                <div>Change Password
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
                                        <h5 class="card-title">Password Change Form</h5>
                                        <form action="changePassword.php" method="POST">
                                            <div class="position-relative form-group">
                                                <label>Old Password</label>
                                                <input name="oldpassword" id="oldpassword" placeholder="Old password" type="password" class="form-control" />

                                                <label>New Password</label>
                                                <input name="newpassword" id="newpassword" placeholder="New password" type="password" class="form-control" />

                                                <label>Confirm Password</label>
                                                <input name="password" id="password" placeholder="confirm password" type="password" class="form-control" />

                                                <button type="submit" class="mt-1 btn btn-success pull-right" name="submit" id="submit">Update</button>

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