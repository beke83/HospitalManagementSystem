<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php"); ?>

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

    $dt = date("Y-m-d");
    $tim = date("H:i:s");

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
        || empty($EmailAddress) || empty($Password)
    ) {
        $_SESSION["ErrorMessage"] = "All Field must be Filled";
        Redirect_to("patientRegister.php");
    } else {
        global $db_connect;
        $query = "INSERT INTO patient_tbl(firstname,lastname,gender,dob,bloodGroup,address,city,phoneNumber,emailAddress,password,confirmPassword,status,dateAdmitted,timeAdmitted)
        VALUES('$Firstname','$Lastname', '$Gender', '$DOB', '$BloodGroup', '$Address', '$City', '$PhoneNumber', '$EmailAddress', '$Password', '$Password', 'Active','$dt','$tim')";

        $Execute = mysqli_query($db_connect, $query);

        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Registration Successful";
            Redirect_to("patientLogin.php");
        } else {
            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("patientRegister.php");
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login</title>
    <link rel="stylesheet" href="../assets/main.d810cf0ae7f39f28f336.css">

    <style>
        .custom-ui {
            text-align: center;
            width: 500px;
            padding: 40px;
            background: #1d2787;
            box-shadow: 0 20px 75px rgba(0, 0, 0, 0.23);
            color: #fff;
        }

        .log {
            background-image: url("../assets/images/b2.jpg");
            overflow: hidden;
        }

        .sign {
            background-image: url("assets/images/b5.jpg");
            overflow: hidden;
        }

        .custom-ui>h1 {
            margin-top: 0;
        }

        .custom-ui>button {
            width: 160px;
            padding: 10px;
            border: 1px solid #fff;
            margin: 10px;
            cursor: pointer;
            background: none;
            color: #fff;
            font-size: 14px;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
        }

        .overlay__wrapper {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .overlay__spinner {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .spinner {
            position: absolute;
            left: 50%;
            top: 50%;
            height: 60px;
            width: 60px;
            margin: 0px auto;
            -webkit-animation: rotation 0.6s infinite linear;
            -moz-animation: rotation 0.6s infinite linear;
            -o-animation: rotation 0.6s infinite linear;
            animation: rotation 0.6s infinite linear;
            border-left: 6px solid rgba(0, 174, 239, 0.15);
            border-right: 6px solid rgba(0, 174, 239, 0.15);
            border-bottom: 6px solid rgba(0, 174, 239, 0.15);
            border-top: 6px solid rgba(0, 174, 239, 0.8);
            border-radius: 100%;
        }

        @-webkit-keyframes rotation {
            from {
                -webkit-transform: rotate(0deg);
            }

            to {
                -webkit-transform: rotate(359deg);
            }
        }

        @-moz-keyframes rotation {
            from {
                -moz-transform: rotate(0deg);
            }

            to {
                -moz-transform: rotate(359deg);
            }
        }

        @-o-keyframes rotation {
            from {
                -o-transform: rotate(0deg);
            }

            to {
                -o-transform: rotate(359deg);
            }
        }

        @keyframes rotation {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(359deg);
            }
        }
    </style>

</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="log">
                <div class="d-flex h-100 justify-content-center align-items-center">
                    <div class="mx-auto app-login-box col-md-8">
                        <div class=""></div>
                        <div class="modal-dialog w-100 mx-auto">
                            <div class="modal-content">
                                <?php echo Message();
                                echo SuccessMessage(); ?>
                                <div class="modal-body">
                                    <div class="h5 modal-title text-center">
                                        <h4>
                                            <div>Welcome,</div>
                                            <span>It only takes a <span class="text-success">few seconds</span> to create your account</span>
                                        </h4>
                                    </div>
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


                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label>Email Address</label>
                                                    <input name="emailAddress" id="emailAddress" value="<?php if (isset($_GET['editid'])) echo $rsedit['emailAddress']; ?>" placeholder="Email Address" type="text" class="form-control" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Password</label>
                                                    <input name="password" id="password" value="<?php if (isset($_GET['editid'])) echo $rsedit['password']; ?>" placeholder="Password" type="password" class="form-control" />
                                                </div>

                                            </div>
                                        </div>
                                        <div class="mt-4 d-flex align-items-center">
                                            <h5 class="mb-0">Already have an account? <a href="javascript:void(0);" class="text-primary">Sign in</a></h5>
                                        </div>
                                        <button type="submit" class="mt-1 btn btn-success pull-right" name="submit" id="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                            <div class="text-center text-white opacity-8 mt-3">Copyright © HMS 2020</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="../assets/scripts/main.js"></script>
</body>

</html>