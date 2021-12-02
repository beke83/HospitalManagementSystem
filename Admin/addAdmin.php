<?php include("../include/db_connect.php") ?>
<!-- function to connect to the database -->
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
//function to prevent unauthorized login
confirm_login();
?>

<?php

//These are inbuilt mail functions used for sending email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; // used to handle errors or exception
use PHPMailer\PHPMailer\SMTP; // smtp is used to transfer email messages and attatchments

if (isset($_POST['submit'])) {

    // variable declaration to fill the form

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

    // end of variable declaration

    // code to edit the admin values.
    if (isset($_GET['editid'])) {
        $query = "UPDATE admin_tbl SET firstname='$_POST[firstname]',lastname='$_POST[lastname]',gender='$_POST[gender]', emailAddress='$_POST[emailAddress]',password='$_POST[password]', confirmPassword='$_POST[confirmPassword]', address='$_POST[address]', phoneNumber='$_POST[phoneNumber]',status='$_POST[status]' WHERE id='$_GET[editid]'";

        if ($Execute = mysqli_query($db_connect, $query)) {

            $_SESSION["SuccesMessage"] = "Record Updated";
            Redirect_to("addAdmin.php");
        } else {

            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("addAdmin.php");
        }
    } else if (
        // if field is empty show the error below
        empty($Firstname) || empty($Lastname) || empty($Gender) || empty($EmailAddress) || empty($Password)
        || empty($ConfirmPassword) || empty($PhoneNumber) || empty($Address) || empty($Status)
    ) {
        $_SESSION["ErrorMessage"] = "All Field must be Filled";
        Redirect_to("addAdmin.php");
    } else if ($Password != $ConfirmPassword) {
        // if password != confirmPassword show error.
        $_SESSION["ErrorMessage"] = "Password does'not match";
        Redirect_to("addAdmin.php");
    } else {
        // code to first insert into the database           258

        global $db_connect;
        $query = "INSERT INTO admin_tbl(firstname,lastname,gender,emailAddress,password,confirmPassword,phoneNumber,address,status,addedBy,timeAdded)
        VALUES('$Firstname', '$Lastname', '$Gender', '$EmailAddress', '$Password', '$ConfirmPassword', '$PhoneNumber', '$Address' ,'$Status', '$Admin', '$DateTime')";

        $Execute = mysqli_query($db_connect, $query);

        // if the mysql query is successful then the mail is sent to the registered user.          108

        if ($Execute) {

            // call additional inbuilt functions required to send mail
            require '../PHPMailer-6.5.0/src/PHPMailer.php';
            require '../PHPMailer-6.5.0/src/Exception.php';
            require '../PHPMailer-6.5.0/src/SMTP.php';
            require '../PHPMailer-6.5.0/src/credentials.php';

            $mail = new PHPMailer();

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP(true);
            // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                            // Enable SMTP authentication
            $mail->Username = 'worktestmail9@gmail.com';                 // SMTP username
            $mail->Password = 'yahoo@WorkTest';                     // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;
            // TCP port to connect to

            $mail->setFrom(EMAIL, 'HospitalManagementSystem');
            $mail->addAddress($_POST['emailAddress']); //the email address is gotten from the form that is filled    // Add a recipient
            $mail->addReplyTo(EMAIL, 'HMS');

            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);  // this is the function that makes it possible to embed html code into the mail function                            

            $mail->Subject = "Admin Registration";
            $mail->Body = "
			<p style='font-size:xx-large'>Hi " . $_POST['firstname'] . $_POST['lastname'] . ",</p>
            <p>You have been registered as an admin. Your login info: </p> 
            <p>Email Address: " . ($EmailAddress) . "</p>
            <p>Password: " . ($Password) . "</p>
            <p>Default password is " . ($Password) . " Login and change your password as soon as possible</p>
            <p>Best Regards,<br />Hospital Management System</p>
			";
            $mail->AltBody = "Message";

            if (!$mail->send()) {
                // echo 'Message could not be sent.';
                // echo 'Mailer Error: ' . $mail->ErrorInfo;
                $_SESSION["ErrorMessage"] = $mail->ErrorInfo;
                Redirect_to("addAdmin.php");
            } else {
                //echo 'Register Done, Please check your mail';
                $_SESSION["SuccessMessage"] = "Admin registered, Please check your mail";
                Redirect_to("addAdmin.php");
            }
        }
    }
}

// method to delete from the database
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
//method to edit a value from the database
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
                                                <!-- code to display the values on the table -->
                                                <?php
                                                global $db_connect;
                                                $query = "SELECT * FROM admin_tbl ORDER BY id desc";
                                                $Execute = mysqli_query($db_connect, $query);
                                                // it gets the values in an array format from the database and assigns the value to $rs
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