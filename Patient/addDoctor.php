<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_login(); ?>

<?php
if (isset($_POST['submit'])) {
    $DoctorFirstname = mysqli_real_escape_string($db_connect, $_POST["doctorFirstname"]);
    $DoctorLastname = mysqli_real_escape_string($db_connect, $_POST["doctorLastname"]);
    $Education = mysqli_real_escape_string($db_connect, $_POST["education"]);
    $Qualification = mysqli_real_escape_string($db_connect, $_POST["qualification"]);
    $Experience = mysqli_real_escape_string($db_connect, $_POST["experience"]);
    $ConsultancyFee = mysqli_real_escape_string($db_connect, $_POST["consultancyFee"]);
    $Department = mysqli_real_escape_string($db_connect, $_POST["department"]);
    $Gender = mysqli_real_escape_string($db_connect, $_POST["gender"]);
    $Address = mysqli_real_escape_string($db_connect, $_POST["address"]);
    $City = mysqli_real_escape_string($db_connect, $_POST["city"]);
    $PhoneNumber = mysqli_real_escape_string($db_connect, $_POST["phoneNumber"]);
    $EmailAddress = mysqli_real_escape_string($db_connect, $_POST["emailAddress"]);
    $Password = mysqli_real_escape_string($db_connect, $_POST["password"]);
    $Status = mysqli_real_escape_string($db_connect, $_POST["status"]);

    if (isset($_GET['editid'])) {
        $query = "UPDATE doctor_tbl SET doctorFirstname='$_POST[doctorFirstname]',doctorLastname='$_POST[doctorLastname]', education='$_POST[education]', 
        qualification='$_POST[qualification]', experience='$_POST[experience]', consultancyFee='$_POST[consultancyFee]', departmentid='$_POST[department]', gender='$_POST[gender]', 
        address='$_POST[address]', city='$_POST[city]', phoneNumber='$_POST[phoneNumber]', emailAddress='$_POST[emailAddress]', password='$_POST[password]', status='$_POST[status]' WHERE id='$_GET[editid]'";
        if ($Execute = mysqli_query($db_connect, $query)) {

            $_SESSION["SuccessMessage"] = "Record Updated";
            Redirect_to("viewDoctor.php");
        } else {

            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("viewDoctor.php");
        }
    } else if (
        empty($DoctorFirstname) || empty($DoctorLastname) || empty($Education) || empty($Qualification) || empty($Experience) ||
        empty($ConsultancyFee) || empty($Department) || empty($Gender) || empty($Address) || empty($City) || empty($PhoneNumber) ||
        empty($EmailAddress) || empty($Password) || empty($Status)
    ) {

        $_SESSION["ErrorMessage"] = "All Field must be Filled";
        Redirect_to("addDoctor.php");
    } else if (strlen($Password) < 4) {
        $_SESSION["ErrorMessage"] = "Password atleast 6 ";
        Redirect_to("addDoctor.php");
    } else {
        global $db_connect;
        $query = "INSERT INTO doctor_tbl(doctorFirstname,doctorLastname,education,qualification,experience,consultancyFee,departmentid,gender,address,city,phoneNumber,emailAddress,password,status)
        VALUES('$DoctorFirstname', '$DoctorLastname', '$Education', '$Qualification', '$Experience', '$ConsultancyFee', '$Department',
        '$Gender', '$Address', '$City', '$PhoneNumber', '$EmailAddress', '$Password', '$Status')";
        $Execute = mysqli_query($db_connect, $query);
        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Doctor added successfully";
            Redirect_to("addDoctor.php");
        } else {
            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("addDoctor.php");
        }
    }
}
?>

<?php
if (isset($_GET['editid'])) {
    $query = "SELECT * FROM doctor_tbl WHERE id='$_GET[editid]' ";
    $execute = mysqli_query($db_connect, $query);
    $rsedit = mysqli_fetch_array($execute);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>

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
                                <div>Doctor Setup
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
                                        <h5 class="card-title">Doctor Setup Form</h5>
                                        <form action="" method="POST">
                                            <div class="position-relative form-group">
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <label>Doctor's Firstname</label>
                                                        <input name="doctorFirstname" id="doctorFirstname" value="<?php if (isset($_GET['editid'])) echo $rsedit['doctorFirstname']; ?>" placeholder="Firstname" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Doctor's Lastname</label>
                                                        <input name="doctorLastname" id="doctorLastname" value="<?php if (isset($_GET['editid'])) echo $rsedit['doctorLastname']; ?>" placeholder="Lastname" type="text" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="position-relative form-group">
                                                    <label>Education</label>
                                                    <input name="education" id="education" value="<?php if (isset($_GET['editid'])) echo $rsedit['education']; ?>" type="text" class="form-control" />
                                                </div>
                                                <div class="position-relative form-group">
                                                    <label>Qualification</label>
                                                    <input name="qualification" value="<?php if (isset($_GET['editid'])) echo $rsedit['qualification']; ?>" id="qualification" type="text" class="form-control" />
                                                </div>
                                                <div class="position-relative form-group">
                                                    <label>Experience(years)</label>
                                                    <input name="experience" id="experience" value="<?php if (isset($_GET['editid'])) echo $rsedit['experience']; ?>" type="text" class="form-control" />
                                                </div>
                                                <div class="position-relative form-group">
                                                    <label>Consultancy Fee</label>
                                                    <input name="consultancyFee" id="consiltancyFee" value="<?php if (isset($_GET['editid'])) echo $rsedit['consultancyFee']; ?>" type="text" class="form-control" />
                                                </div>

                                                <label>Department</label>
                                                <select class="mb-2 form-control" name="department" id="department">
                                                    <option value="">Select department</option>
                                                    <?php
                                                    $query = "SELECT * FROM department_tbl WHERE status='Active'";
                                                    $execute = mysqli_query($db_connect, $query);
                                                    while ($rsdepartment = mysqli_fetch_array($execute)) {
                                                        if ($rsdepartment['id'] == $rsedit['id']) {
                                                            echo "<option value='$rsdepartment[id]' selected>$rsdepartment[departmentName]</option>";
                                                        } else {
                                                            echo "<option value='$rsdepartment[id]'>$rsdepartment[departmentName]</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>

                                                <label>Gender</label>
                                                <select class="mb-2 form-control" name="gender" id="gender" value="<?php if (isset($_GET['editid'])) echo $rsedit['gender']; ?>">
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
                                                        <input name="phoneNumber" value="<?php if (isset($_GET['editid'])) echo $rsedit['phoneNumber']; ?>" id="phoneNumber" placeholder="Phone Number" type="text" class="form-control" />
                                                    </div>
                                                </div>
                                                <label>Email Address</label>
                                                <input name="emailAddress" value="<?php if (isset($_GET['editid'])) echo $rsedit['address']; ?>" id="emailAddress" placeholder="Email Address" type="text" class="form-control" />

                                                <label>Password</label>
                                                <input name="password" id="password" value="<?php if (isset($_GET['editid'])) echo $rsedit['password']; ?>" placeholder="Password" type="password" class="form-control" />

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

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="color: blue;">
                <h5 class="modal-title" id="exampleModalLongTitle">Register New Doctor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="position-relative form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label>Doctor's Firstname</label>
                            <input name="firstname" placeholder="Firstname" type="text" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label>Doctor's Lastname</label>
                            <input name="lastname" placeholder="Lastname" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="position-relative form-group">
                        <label>Education</label>
                        <input name="address" type="text" class="form-control" />
                    </div>
                    <div class="position-relative form-group">
                        <label>Qualification</label>
                        <input name="address" type="text" class="form-control" />
                    </div>
                    <div class="position-relative form-group">
                        <label>Experience(years)</label>
                        <input name="address" type="text" class="form-control" />
                    </div>
                    <div class="position-relative form-group">
                        <label>Consultancy Fee</label>
                        <input name="address" type="text" class="form-control" />
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label>Gender</label>
                            <select class="mb-2 form-control" name="gender">
                                <option value="">Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Department</label>
                            <select class="mb-2 form-control" name="bloodGroup">
                                <option value="">Select department</option>
                                <option value="Male">O+</option>
                                <option value="Female">O-</option>
                            </select>
                        </div>
                    </div>
                    <div class="position-relative form-group">
                        <label>Address</label>
                        <input name="address" placeholder="Address..." type="text" class="form-control" />
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label>City</label>
                            <input name="city" placeholder="City..." type="text" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label>Phone Number</label>
                            <input name="phoneNumber" placeholder="Phone Number" type="text" class="form-control" />
                        </div>
                    </div>
                    <label>Email Address</label>
                    <input name="emailAddress" placeholder="Email Address" type="text" class="form-control" />

                    <div class="form-row">
                        <div class="col-md-6">
                            <label>Password</label>
                            <input name="password" placeholder="Password" type="text" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label>Confirm Password</label>
                            <input name="confirmPassword" placeholder="Confirm Password" type="text" class="form-control" />
                        </div>
                    </div>
                    <label>Status</label>
                    <select class="mb-2 form-control" name="bloodGroup">
                        <option value="">Select Status</option>
                        <option value="Male">Active</option>
                        <option value="Female">InActive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="mt-1 btn btn-danger pull-left">Cancel</button>
                <button type="button" class="mt-1 btn btn-success pull-right">Submit</button>
            </div>
        </div>
    </div>
</div>