<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_login(); ?>

<?php
if (isset($_POST['submit'])) {
    $Firstname = mysqli_real_escape_string($db_connect, $_POST["firstname"]);
    $Lastname = mysqli_real_escape_string($db_connect, $_POST["lastname"]);
    $Gender = mysqli_real_escape_string($db_connect, $_POST["gender"]);
    $DOB = mysqli_real_escape_string($db_connect, $_POST["dob"]);
    $BloodGroup = mysqli_real_escape_string($db_connect, $_POST["bloodGroup"]);
    $Address = mysqli_real_escape_string($db_connect, $_POST["address"]);
    $City = mysqli_real_escape_string($db_connect, $_POST["city"]);
    $PhoneNumber = mysqli_real_escape_string($db_connect, $_POST["phoneNumber"]);
    $EmailAddress = mysqli_real_escape_string($db_connect, $_POST["emailAddress"]);
    $Password = mysqli_real_escape_string($db_connect, $_POST["password"]);
    $ConfirmPassword = mysqli_real_escape_string($db_connect, $_POST["confirmPassword"]);
    $Status = mysqli_real_escape_string($db_connect, $_POST["status"]);

    date_default_timezone_set("Africa/Lagos");
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
    $DateTime;
    if (isset($_GET['editid'])) {
        $query = "UPDATE patient_tbl SET firstname='$_POST[firstname]',lastname='$_POST[lastname]',gender='$_POST[gender]', dob='$_POST[dob]',bloodGroup='$_POST[bloodGroup]', address='$_POST[address]', city='$_POST[city]', 
         phoneNumber='$_POST[phoneNumber]',emailAddress='$_POST[emailAddress]', password='$_POST[password]', confirmPassword='$_POST[confirmPassword]', status='$_POST[status]' WHERE id='$_GET[editid]'";
        if ($Execute = mysqli_query($db_connect, $query)) {

            $_SESSION["SuccessMessage"] = "Record Updated";
            Redirect_to("viewPatient.php");
        } else {

            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("viewPatient.php");
        }
    } else if (
        empty($Firstname) || empty($Lastname) || empty($Gender) || empty($DOB) || empty($BloodGroup) || empty($Address) || empty($PhoneNumber)
        || empty($EmailAddress) || empty($Password) || empty($ConfirmPassword) || empty($Status)
    ) {
        $_SESSION["ErrorMessage"] = "All Field must be Filled";
        Redirect_to("addPatient.php");
    } else if ($Password != $ConfirmPassword) {
        $_SESSION["ErrorMessage"] = "Password does'not match";
        Redirect_to("addPatient.php");
    } else {
        global $db_connect;
        $query = "INSERT INTO patient_tbl(firstname,lastname,gender,dob,bloodGroup,address,city,phoneNumber,emailAddress,password,confirmPassword,status,dateTimeAdmitted)
        VALUES('$Firstname','$Lastname', '$Gender', '$DOB', '$BloodGroup', '$Address', '$City', '$PhoneNumber', '$EmailAddress', '$Password', '$ConfirmPassword', '$Status','$DateTime')";

        $Execute = mysqli_query($db_connect, $query);

        /* if ($Execute) {
            $_SESSION["SuccessMessage"] = "Record Saved";
            Redirect_to("addPatient.php");
        } else {
            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("addPatient.php");
        }*/

        if ($Execute) {

            require '../mailer/PHPMailerAutoload.php';
            require '../mailer/credentials.php';

            $mail = new PHPMailer;

            $mail->SMTPDebug = 3;                               // Enable verbose debug output

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

?>

<?php
if (isset($_GET['editid'])) {
    $query = "SELECT * FROM patient_tbl WHERE id='$_GET[editid]' ";
    $Execute = mysqli_query($db_connect, $query);
    $rsedit = mysqli_fetch_array($Execute);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>
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
                                <div>Patient Setup
                                    <div class="page-title-subheading">Choose between regular React Bootstrap tables or advanced dynamic ones.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">Add New Patient Form</h5>
                                        <div class="modal-body">
                                            <form action="" method="POST">
                                                <?php echo Message();
                                                echo SuccessMessage(); ?>
                                                <div class="position-relative form-group">
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <label>Firstname</label>
                                                            <input name="firstname" id="firstname" value="<?php if (isset($_GET['editid'])) echo $rsedit['firstname']; ?>" placeholder="Firstname" type="text" class="form-control" />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Lastname</label>
                                                            <input name="lastname" id="lastname" value="<?php if (isset($_GET['editid'])) echo $rsedit['lastname']; ?>" placeholder="Lastname" type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <label>Gender</label>
                                                            <select class="mb-2 form-control" id="gender" value="<?php if (isset($_GET['editid'])) echo $rsedit['gender']; ?>" name="gender">
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
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Blood Group</label>
                                                            <input type="text" name="bloodGroup" id="bloodGroup" value="<?php if (isset($_GET['editid'])) echo $rsedit['bloodGroup']; ?>" class="form-control" placeholder="Blood Group" />
                                                        </div>
                                                    </div>
                                                    <div class="position-relative form-group">
                                                        <label>Date of Birth</label>
                                                        <input type="date" class="form-control" name="dob" id="dob" value="<?php if (isset($_GET['editid'])) echo $rsedit['dob']; ?>" />
                                                    </div>
                                                    <div class="position-relative form-group">
                                                        <label>Address</label>
                                                        <input name="address" id="address" value="<?php if (isset($_GET['editid'])) echo $rsedit['address']; ?>" placeholder="Address..." type="text" class="form-control" />
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <label>City</label>
                                                            <input name="city" id="city" value="<?php if (isset($_GET['editid'])) echo $rsedit['city']; ?>" placeholder="City..." type="text" class="form-control" />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Phone Number</label>
                                                            <input name="phoneNumber" id="phoneNumber" value="<?php if (isset($_GET['editid'])) echo $rsedit['phoneNumber']; ?>" placeholder="Phone Number" type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <label>Email Address</label>
                                                    <input name="emailAddress" id="emailAddress" value="<?php if (isset($_GET['editid'])) echo $rsedit['emailAddress']; ?>" placeholder="Email Address" type="text" class="form-control" />

                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <label>Password</label>
                                                            <input name="password" id="password" value="<?php if (isset($_GET['editid'])) echo $rsedit['password']; ?>" placeholder="Password" type="password" class="form-control" />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Confirm Password</label>
                                                            <input name="confirmPassword" id="confirmPassword" value="<?php if (isset($_GET['editid'])) echo $rsedit['confirmPassword']; ?>" placeholder="Confirm Password" type="password" class="form-control" />
                                                        </div>
                                                    </div>
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
                                                </div>
                                                <button class="mt-1 btn btn-danger pull-left">Cancel</button>
                                                <button type="submit" class="mt-1 btn btn-success pull-right" name="submit" id="submit">Submit</button>
                                            </form>
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



    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="color: blue;">
                    <h5 class="modal-title" id="exampleModalLongTitle">Register New Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <?php echo Message();
                        echo SuccessMessage(); ?>
                        <div class="position-relative form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label>Firstname</label>
                                    <input name="firstname" id="firstname" placeholder="Firstname" type="text" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label>Lastname</label>
                                    <input name="lastname" id="lastname" placeholder="Lastname" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label>Gender</label>
                                    <select class="mb-2 form-control" id="gender" name="gender">
                                        <option value="">Select gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Blood Group</label>
                                    <select class="mb-2 form-control" id="bloodGroup" name="bloodGroup">
                                        <option value="">Select blood group</option>
                                        <option value="Male">O+</option>
                                        <option value="Female">O-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="position-relative form-group">
                                <label>Date of Birth</label>
                                <input type="text" class="form-control" name="dob" id="dob" />
                            </div>
                            <div class="position-relative form-group">
                                <label>Address</label>
                                <input name="address" id="address" placeholder="Address..." type="text" class="form-control" />
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label>City</label>
                                    <input name="city" id="city" placeholder="City..." type="text" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label>Phone Number</label>
                                    <input name="phoneNumber" id="phoneNumber" placeholder="Phone Number" type="text" class="form-control" />
                                </div>
                            </div>
                            <label>Email Address</label>
                            <input name="emailAddress" id="emailAddress" placeholder="Email Address" type="text" class="form-control" />

                            <div class="form-row">
                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input name="password" id="password" placeholder="Password" type="text" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label>Confirm Password</label>
                                    <input name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" type="text" class="form-control" />
                                </div>
                            </div>
                            <label>Status</label>
                            <select class="mb-2 form-control" name="status" id="status">
                                <option value="">Select Status</option>
                                <option value="Male">Active</option>
                                <option value="Female">InActive</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="mt-1 btn btn-danger pull-left">Cancel</button>
                            <button type="submit" class="mt-1 btn btn-success pull-right" name="submit" id="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>