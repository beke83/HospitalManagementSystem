<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_login();
?>

<?php
if (isset($_POST['submit'])) {
    $Firstname = mysqli_real_escape_string($db_connect, $_POST["firstname"]);
    $Lastname = mysqli_real_escape_string($db_connect, $_POST["lastname"]);
    $Gender = mysqli_real_escape_string($db_connect, $_POST["gender"]);
    $EmailAddress = mysqli_real_escape_string($db_connect, $_POST["emailAddress"]);
    $Password = mysqli_real_escape_string($db_connect, $_POST["password"]);
    $ConfirmPassword = mysqli_real_escape_string($db_connect, $_POST["confirmPassword"]);
    $PhoneNumber = mysqli_real_escape_string($db_connect, $_POST["phoneNumber"]);
    $Address = mysqli_real_escape_string($db_connect, $_POST["address"]);
    $Status = mysqli_real_escape_string($db_connect, $_POST["status"]);
    date_default_timezone_set("Africa/Lagos");
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
    $DateTime;
    $Admin = $_SESSION[$_POST['lastname']];

    if (isset($_GET['editid'])) {
        $query = "UPDATE admin_tbl SET firstname='$_POST[firstname]',lastname='$_POST[lastname]',gender='$_POST[gender]', emailAddress='$_POST[emailAddress]',password='$_POST[password]', confirmPassword='$_POST[confirmPassword]', address='$_POST[address]', phoneNumber='$_POST[phoneNumber]',status='$_POST[status]' WHERE id='$_GET[editid]'";
        if ($Execute = mysqli_query($db_connect, $query)) {

            $_SESSION["SuccesMessage"] = "Record Updated";
            //Redirect_to("addAdmin.php");
        } else {

            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            //Redirect_to("addAdmin.php");
        }
    } else if (
        empty($Firstname) || empty($Lastname) || empty($Gender) || empty($EmailAddress) || empty($Password)
        || empty($ConfirmPassword) || empty($PhoneNumber) || empty($Address) || empty($Status)
    ) {
        $_SESSION["ErrorMessage"] = "All Field must be Filled";
        Redirect_to("addAdmin.php");
    } else if ($Password != $ConfirmPassword) {

        $_SESSION["ErrorMessage"] = "Password does'not match";
        Redirect_to("addAdmin.php");
    } else {
        global $db_connect;
        $query = "INSERT INTO admin_tbl(firstname,lastname,gender,emailAddress,password,confirmPassword,phoneNumber,address,status,addedBy,timeAdded)
        VALUES('$Firstname', '$Lastname', '$Gender', '$EmailAddress', '$Password', '$ConfirmPassword', '$PhoneNumber', '$Address' ,'$Status', '$Admin', '$DateTime')";

        $Execute = mysqli_query($db_connect, $query);

        if ($Execute) {

            require '../mailer/PHPMailerAutoload.php';
            require '../mailer/credentials.php';

            $mail = new PHPMailer;

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = EMAIL;                 // SMTP username
            $mail->Password = PASS;                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom(EMAIL, 'HMS');
            $mail->addAddress($_POST['emailAddress']);     // Add a recipient
            $mail->addReplyTo(EMAIL);

            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = "Admin Registration";
            $base_url = "C:\wamp64\www\HospitalManagementSystem\Admin\verify.php";
            $mail->Body = "
			<p>Hi " . $_POST['firstname'] . ",</p>
            <p>You have been registered as an admin. Your login info: </p> 
            <p>Email Address: " . ($EmailAddress) . "</p>
            <p>Password: " . ($Password) . "</p>
            <p>Best Regards,<br />Hospital Management System</p>
			";
            $mail->AltBody = "Message";

            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Register Done, Please check your mail';
            }
        }
    }
}

if (isset($_GET['delid'])) {
    $query = "DELETE FROM admin_tbl WHERE id='$_GET[delid]'";
    $Execute = mysqli_query($db_connect, $query);
    if (mysqli_affected_rows($db_connect) == 1) {

        $_SESSION["SuccessMessage"] = "Admin record deleted successfully";
        Redirect_to("addAdmin.php");
    }
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
                            <div class="col-md-4">
                                <?php echo Message();
                                echo SuccessMessage(); ?>
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">Admin Setup</h5>
                                        <form action="" method="POST">
                                            <div class="position-relative form-group">
                                                <label>Firstname</label>
                                                <input name="firstname" id="firstname" placeholder="firstname" value="<?php if (isset($_GET['editid'])) echo $rsedit['firstname']; ?>" type="text" class="form-control" />

                                                <label>Lastname</label>
                                                <input name="lastname" id="lastname" placeholder="lastname" value="<?php if (isset($_GET['editid'])) echo $rsedit['lastname']; ?>" type="text" class="form-control" />

                                                <label>Gender</label>
                                                <select class="mb-2 form-control" name="gender" value="<?php if (isset($_GET['editid'])) echo $rsedit['gender']; ?>" id="gender">
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
                                                <input name="emailAddress" id="emailAddress" value="<?php if (isset($_GET['editid'])) echo $rsedit['emailAddress']; ?>" placeholder="Email address" type="text" class="form-control" />

                                                <label>Password</label>
                                                <input name="password" id="password" value="<?php if (isset($_GET['editid'])) echo $rsedit['password']; ?>" placeholder="Password" type="password" class="form-control" />

                                                <label>Confirm Password</label>
                                                <input name="confirmPassword" id="confirmPassword" value="<?php if (isset($_GET['editid'])) echo $rsedit['confirmPassword']; ?>" placeholder="Confirm Password" type="password" class="form-control" />

                                                <label>Phone Number</label>
                                                <input name="phoneNumber" id="phoneNumber" value="<?php if (isset($_GET['editid'])) echo $rsedit['phoneNumber']; ?>" placeholder="Phone Number" type="text" class="form-control" />

                                                <label>Address</label>
                                                <input name="address" id="address" value="<?php if (isset($_GET['editid'])) echo $rsedit['address']; ?>" placeholder="address" type="text" class="form-control" />

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
                                                <button type="submit" class="mt-1 btn btn-success pull-right" name="submit">Submit</button>

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
                                                    <td>Edit</td>
                                                    <th>Firstname</th>
                                                    <th>Lastname</th>
                                                    <th>Email Address</th>
                                                    <th>Address</th>
                                                    <th>Phone Number</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                global $db_connect;
                                                $query = "SELECT * FROM admin_tbl ORDER BY id desc";
                                                $Execute = mysqli_query($db_connect, $query);
                                                while ($rs = mysqli_fetch_array($Execute)) {
                                                    echo "
                                                        <tr>
                                                            <td>
                                                                <a href='addAdmin.php?editid=$rs[id]'>
                                                                <button class='btn btn-info btn-sm float-left'>
                                                                    <i class='fa fa-edit'></i>
                                                                </button>
                                                                </a>
                                                            </td>
                                                            <td>&nbsp;$rs[firstname]</td>
                                                            <td>&nbsp;$rs[lastname]</td>
                                                            <td>&nbsp;$rs[emailAddress]</td>
                                                            <td>&nbsp;$rs[address]</td>
                                                            <td>&nbsp;$rs[phoneNumber]</td>
                                                            <td>
                                                                <a href='addAdmin.php?delid=$rs[id]'>
                                                                 <button class='btn btn-danger btn-sm float-right'>
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