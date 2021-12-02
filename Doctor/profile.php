<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_doctor_login();
?>

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
        address='$_POST[address]', city='$_POST[city]', phoneNumber='$_POST[phoneNumber]', emailAddress='$_POST[emailAddress]', password='$_POST[password]' WHERE id='$_GET[editid]'";
        if ($Execute = mysqli_query($db_connect, $query)) {

            $_SESSION["SuccessMessage"] = "Record Updated";
            Redirect_to("profile.php");
        } else {

            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("profile.php");
        }
    } else if (
        empty($DoctorFirstname) || empty($DoctorLastname) || empty($Education) || empty($Qualification) || empty($Experience) ||
        empty($ConsultancyFee) || empty($Department) || empty($Gender) || empty($Address) || empty($City) || empty($PhoneNumber) ||
        empty($EmailAddress) || empty($Password)
    ) {

        $_SESSION["ErrorMessage"] = "All Field must be Filled";
        Redirect_to("profile.php");
    } else if (strlen($Password) < 4) {
        $_SESSION["ErrorMessage"] = "Password atleast 6 ";
        Redirect_to("profile.php");
    } else {
        global $db_connect;
        $query = "INSERT INTO doctor_tbl(doctorFirstname,doctorLastname,education,qualification,experience,consultancyFee,departmentid,gender,address,city,phoneNumber,emailAddress,password)
        VALUES('$DoctorFirstname', '$DoctorLastname', '$Education', '$Qualification', '$Experience', '$ConsultancyFee', '$Department',
        '$Gender', '$Address', '$City', '$PhoneNumber', '$EmailAddress', '$Password')";
        $Execute = mysqli_query($db_connect, $query);
        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Doctor added successfully";
            Redirect_to("profile.php");
        } else {
            $_SESSION["ErrorMessage"] = mysqli_error($db_connect);
            Redirect_to("profile.php");
        }
    }
}
?>

<?php
if (isset($_GET['editid'])) {
    $query = "SELECT * FROM doctor_tbl WHERE id='$_GET[editid]' ";
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

    <link rel="stylesheet" href="../assets/argon.css">

    <style>
        .card {
            margin-bottom: 30px;

            border: 0;
            box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15);
        }

        .card-translucent {
            background-color: rgba(18, 91, 152, .08);
        }

        .card-deck .card {
            margin-bottom: 30px;
        }

        .card.shadow {
            border: 0 !important;
        }

        @media (min-width: 576px) {
            .card-columns {
                column-count: 1;
            }
        }

        @media (min-width: 768px) {
            .card-columns {
                column-count: 2;
            }
        }

        @media (min-width: 1200px) {
            .card-columns {
                column-count: 3;
                column-gap: 1.25rem;
            }
        }

        .card-lift--hover:hover {
            transition: all .15s ease;
            transform: translateY(-20px);
        }

        @media (prefers-reduced-motion: reduce) {
            .card-lift--hover:hover {
                transition: none;
            }
        }

        .card-blockquote {
            position: relative;

            padding: 2rem;
        }

        .card-blockquote .svg-bg {
            position: absolute;
            top: -94px;
            left: 0;

            display: block;

            width: 100%;
            height: 95px;
        }

        .card-profile-image {
            position: relative;
        }

        .card-profile-image img {
            position: absolute;
            left: 50%;

            max-width: 140px;

            transition: all .15s ease;
            transform: translate(-50%, -50%) scale(1);

            border: 3px solid #fff;
            border-radius: .375rem;
        }

        .card-profile-image img:hover {
            transform: translate(-50%, -50%) scale(1.03);
        }

        .card-profile-stats {
            padding: 1rem 0;
        }

        .card-profile-stats>div {
            margin-right: 1rem;
            padding: .875rem;

            text-align: center;
        }

        .card-profile-stats>div:last-child {
            margin-right: 0;
        }

        .card-profile-stats>div .heading {
            font-size: 1.1rem;
            font-weight: bold;

            display: block;
        }

        .card-profile-stats>div .description {
            font-size: .875rem;

            color: #adb5bd;
        }

        .card-profile-actions {
            padding: .875rem;
        }

        .card-stats .card-body {
            padding: 1rem 1.5rem;
        }

        .card-stats .card-status-bullet {
            position: absolute;
            top: 0;
            right: 0;

            transform: translate(50%, -50%);
        }

        .card-img,
        .card-img-top,
        .card-img-bottom {
            width: 100%;

            flex-shrink: 0;
        }

        .card-img,
        .card-img-top {
            border-top-left-radius: calc(.375rem - 1px);
            border-top-right-radius: calc(.375rem - 1px);
        }

        .card-img,
        .card-img-bottom {
            border-bottom-right-radius: calc(.375rem - 1px);
            border-bottom-left-radius: calc(.375rem - 1px);
        }
    </style>


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
                            <div class="col-xl-4 order-xl-2">
                                <div class="card card-profile">
                                    <img src="../assets/images/img1.jpg" alt="Image placeholder" class="card-img-top">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-3 order-lg-2">
                                            <div class="card-profile-image">
                                                <a href="#">
                                                    <img src="../assets/images/user.jpg" class="rounded-circle">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">

                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col">
                                                <div class="card-profile-stats d-flex justify-content-center">
                                                    <?php
                                                    $sql = "SELECT COUNT(*) FROM appointment_tbl WHERE status= 'Pending' OR 'Approved' AND id='$_SESSION[id]'";
                                                    $qsql = mysqli_query($db_connect, $sql);
                                                    $RowsTotal = mysqli_fetch_array($qsql);

                                                    $Total = array_shift($RowsTotal);
                                                    if ($Total > 0) {
                                                        echo "
                                                                 <div>
                                                            <span class='heading'>$Total</span>
                                                            <span class='description'>Appointment</span>
                                                        </div>
                                                        ";
                                                    ?>

                                                    <?php } ?>
                                                    <div>
                                                        <?php
                                                        $sql = "SELECT COUNT(*) FROM treatment_records WHERE status= 'Active' OR doctorid='$_SESSION[id]'";
                                                        $qsql = mysqli_query($db_connect, $sql);
                                                        $RowsTotal = mysqli_fetch_array($qsql);

                                                        $Total = array_shift($RowsTotal);
                                                        if ($Total > 0) {
                                                            echo "
                                                                 <div>
                                                            <span class='heading'>$Total</span>
                                                            <span class='description'>Treatment</span>
                                                        </div>
                                                        ";
                                                        ?>


                                                        <?php } ?>
                                                    </div>
                                                    <div>
                                                        <?php
                                                        $sql = "SELECT COUNT(*) FROM prescription_records WHERE status= 'Active' OR id='$_SESSION[id]'";
                                                        $qsql = mysqli_query($db_connect, $sql);
                                                        $RowsTotal = mysqli_fetch_array($qsql);

                                                        $Total = array_shift($RowsTotal);
                                                        if ($Total > 0) {
                                                            echo "
                                                                 <div>
                                                            <span class='heading'>$Total</span>
                                                            <span class='description'>Prescription</span>
                                                        </div>
                                                        ";
                                                        ?>


                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <?php
                                            global $db_connect;
                                            $query = "SELECT * FROM doctor_tbl WHERE id='$_SESSION[id]' ";
                                            $Execute = mysqli_query($db_connect, $query);
                                            while ($rs = mysqli_fetch_array($Execute)) {
                                                $querydept = "SELECT * FROM department_tbl WHERE id='$rs[departmentid]'";
                                                $executedept = mysqli_query($db_connect, $querydept);
                                                $rsdept = mysqli_fetch_array($executedept);
                                                echo "
                                                <h5 class='h4'>
                                                $rs[doctorFirstname]<span class=''> $rs[doctorLastname]</span>
                                            </h5>
                                                
                                                <div class='h5 font-weight-300'>
                                                <i class='ni location_pin mr-2'></i>$rsdept[departmentName]
                                            </div>
                                            
                                            ";

                                            ?>
                                            <?php } ?>
                                            <br />
                                            <?php
                                            global $db_connect;
                                            $query = "SELECT * FROM doctor_tbl WHERE id='$_SESSION[id]' ";
                                            $Execute = mysqli_query($db_connect, $query);
                                            while ($rs = mysqli_fetch_array($Execute)) {
                                                echo "
                                                    <a href='profile.php?editid=$rs[id]'>
                                                        <button class='btn btn-primary btn-block'>
                                                            Edit Info
                                                        </button>
                                                    </a>
                                                    ";
                                            ?>

                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 order-xl-1">
                                <div class="card">
                                    <?php echo Message();
                                    echo SuccessMessage(); ?>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <h6 class="heading-small text-muted mb-4">User information</h6>
                                                </div>
                                            </div>
                                            <div class="pl-lg-4">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Firstname</label>
                                                            <input name="doctorFirstname" id="doctorFirstname" value="<?php if (isset($_GET['editid'])) echo $rsedit['doctorFirstname']; ?>" type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Lastname</label>
                                                            <input name="doctorLastname" id="doctorLastname" value="<?php if (isset($_GET['editid'])) echo $rsedit['doctorLastname']; ?>" type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Email Address</label>
                                                            <input name="emailAddress" id="emailAddress" value="<?php if (isset($_GET['editid'])) echo $rsedit['emailAddress']; ?>" type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Password</label>
                                                            <input name="password" id="password" value="<?php if (isset($_GET['editid'])) echo $rsedit['password']; ?>" type="password" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Gender</label>
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
                                                            </select> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="my-4" />
                                            <!-- Address -->
                                            <h6 class="heading-small text-muted mb-4">Work Information</h6>
                                            <div class="pl-lg-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-address">Department</label>
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
                                                            </select> </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-address">Education</label>
                                                            <input name="education" id="education" value="<?php if (isset($_GET['editid'])) echo $rsedit['education']; ?>" type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-city">Qualification</label>
                                                            <input name="qualification" value="<?php if (isset($_GET['editid'])) echo $rsedit['qualification']; ?>" id="qualification" type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-country">Experience</label>
                                                            <input name="experience" id="experience" value="<?php if (isset($_GET['editid'])) echo $rsedit['experience']; ?>" type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-country">Consultancy Fee</label>
                                                            <input name="consultancyFee" id="consiltancyFee" value="<?php if (isset($_GET['editid'])) echo $rsedit['consultancyFee']; ?>" type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="my-4" />
                                            <!-- Address -->
                                            <h6 class="heading-small text-muted mb-4">Contact information</h6>
                                            <div class="pl-lg-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-address">Address</label>
                                                            <input name="address" id="address" value="<?php if (isset($_GET['editid'])) echo $rsedit['address']; ?>" type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-city">City</label>
                                                            <input name="city" id="city" value="<?php if (isset($_GET['editid'])) echo $rsedit['city']; ?>" type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-country">Country</label>
                                                            <input type="text" id="input-country" class="form-control" disabled value="Nigeria">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-country">Phone Number</label>
                                                            <input name="phoneNumber" id="phoneNumber" value="<?php if (isset($_GET['editid'])) echo $rsedit['phoneNumber']; ?>" type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <hr class="my-4" />

                                            <button type="submit" class="mt-1 btn btn-success pull-right" name="submit" id="submit">Submit</button>

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