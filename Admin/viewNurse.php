<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_login(); ?>

<?php
if (isset($_GET['delid'])) {
    $query = "DELETE FROM nurse_tbl WHERE id='$_GET[delid]'";
    $execute = mysqli_query($db_connect, $query);
    if (mysqli_affected_rows($db_connect) == 1) {

        $_SESSION["SuccessMessage"] = "Record deleted successfully";
        Redirect_to("viewDoctor.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Nurses</title>

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
                                <div>Nurse Record
                                    <!-- <div class="page-title-subheading">Choose between regular React Bootstrap tables or advanced dynamic ones.</div> -->
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
                                        <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Edit</th>
                                                    <th>Nurse Name</th>
                                                    <th>Department</th>
                                                    <th>Email Address</th>
                                                    <th>Phone Number</th>
                                                    <th>Gender</th>
                                                    <th>Education</th>
                                                    <th>Experience</th>
                                                    <th>Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                global $db_connect;
                                                $query = "SELECT * FROM nurse_tbl";
                                                $execute = mysqli_query($db_connect, $query);
                                                while ($rs = mysqli_fetch_array($execute)) {

                                                    $querydept = "SELECT * FROM department_tbl WHERE id='$rs[departmentid]'";
                                                    $executedept = mysqli_query($db_connect, $querydept);
                                                    $rsdept = mysqli_fetch_array($executedept);

                                                    echo "
                                                        <tr>
                                                            <td>
                                                            <a href='addNurse.php?editid=$rs[id]'>
                                                                <button class='btn btn-info btn-sm float-left'>
                                                                    <i class='fa fa-edit'></i>
                                                                </button>
                                                                </a>
                                                            </td>
                                                            <td>&nbsp;$rs[nurseFirstname] $rs[nurseLastname]</td>
                                                            <td>&nbsp;$rsdept[departmentName]</td>
                                                            <td>&nbsp;$rs[emailAddress]</td>
                                                            <td>&nbsp;$rs[phoneNumber]</td>
                                                            <td>&nbsp;$rs[gender]</td>
                                                            <td>&nbsp;$rs[education]</td>
                                                            <td>&nbsp;$rs[experience]</td>
                                                            <td>&nbsp;$rs[status]</td>
                                                            <td>                         
                                                                 <a href='viewNurse.php?delid=$rs[id]'>
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