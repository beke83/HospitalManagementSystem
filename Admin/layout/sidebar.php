<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/main.d810cf0ae7f39f28f336.css">
</head>

<body>
    <div class="app-sidebar sidebar-shadow">
        <div class="app-header__logo">
            <div class="logo-src"></div>
            <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="app-header__mobile-menu">
            <div>
                <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
            <span>
                <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                    <span class="btn-icon-wrapper">
                        <i class="fa fa-ellipsis-v fa-w-6"></i>
                    </span>
                </button>
            </span>
        </div>
        <div class="scrollbar-sidebar">
            <div class="app-sidebar__inner">
                <ul class="vertical-nav-menu">
                    <li class="app-sidebar__heading">Dashboards</li>
                    <li>
                        <a href="dashboard.php">
                            <i class="metismenu-icon pe-7s-home"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="app-sidebar__heading">Account</li>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon pe-7s-id"></i>
                            Profile
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="addAdmin.php">
                                    <i class="metismenu-icon"></i>
                                    Add Admin
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="metismenu-icon"></i>
                                    Admin Profile
                                </a>
                            </li>
                            <li>
                                <a href="changePassword.php">
                                    <i class="metismenu-icon"></i>
                                    Change Password
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="app-sidebar__heading">Shared Service</li>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon pe-7s-users"></i>
                            Patient
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="addPatient.php">
                                    <i class="metismenu-icon"></i>
                                    Add Patient
                                </a>
                            </li>
                            <li>
                                <a href="viewPatient.php">
                                    <i class="metismenu-icon"></i>
                                    View Patient Records
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon pe-7s-portfolio"></i>
                            Appointments
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="addNewAppointment.php">
                                    <i class="metismenu-icon"></i>
                                    Add Appointment
                                </a>
                            </li>
                            <li>
                                <a href="viewPendingAppointment.php">
                                    <i class="metismenu-icon"></i>
                                    View Pending Appointments
                                </a>
                            </li>
                            <li>
                                <a href="viewApprovedAppointment.php">
                                    <i class="metismenu-icon"></i>
                                    View Approved Appointments
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon pe-7s-user"></i>
                            Doctor
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="addDoctor.php">
                                    <i class="metismenu-icon"></i>
                                    Add Doctor
                                </a>
                            </li>
                            <li>
                                <a href="viewDoctor.php">
                                    <i class="metismenu-icon"></i>
                                    View Doctor
                                </a>
                            </li>
                            <li>
                                <a href="addDoctorTiming.php">
                                    <i class="metismenu-icon"></i>
                                    Add Doctor Timings
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="viewTreatmentRecord.php">
                            <i class="metismenu-icon pe-7s-display2"></i>
                            Treatment Records
                        </a>
                    </li>
                    <li class="app-sidebar__heading">Settings</li>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon pe-7s-config"></i>
                            Setup
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="addDepartment.php">
                                    <i class="metismenu-icon"></i>
                                    Department
                                </a>
                            </li>
                            <li>
                                <a href="addTreatmentType.php">
                                    <i class="metismenu-icon"></i>
                                    Treatment Type
                                </a>
                            </li>
                            <li>
                                <a href="addMedicine.php">
                                    <i class="metismenu-icon"></i>
                                    Medicine
                                </a>
                            </li>
                            <li>
                                <a href="addRoom.php">
                                    <i class="metismenu-icon"></i>
                                    Room
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../assets/scripts/main.js"></script>
</body>

</html>