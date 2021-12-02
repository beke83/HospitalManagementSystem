<?php require_once("../include/db_connect.php"); ?>
<?php require_once("../include/session.php"); ?>
<?php require_once("../include/Functions.php");
?>

<?php
if (isset($_SESSION['emailAddress'])) {
    Redirect_to("nurseLogin.php");
}
?>

<?php
if (isset($_POST["submit"])) {
    $emailAddress = mysqli_real_escape_string($db_connect, $_POST['emailAddress']);
    $password = mysqli_real_escape_string($db_connect, md5($_POST['password']));

    if (empty($emailAddress) || empty($password)) {
        $_SESSION["ErrorMessage"] = "All Field must be Filled";
        Redirect_to("nurseLogin.php");
    } elseif (strlen($password) < 4) {
        $_SESSION["ErrorMessage"] = "Atleast 6 character for password";
        Redirect_to("nurseLogin.php");
    } else {
        $query = "SELECT * FROM nurse_tbl WHERE emailAddress='$_POST[emailAddress]' AND password='$_POST[password]' AND status='Active'";
        $Execute = mysqli_query($db_connect, $query);
        if (mysqli_num_rows($Execute) == 1) {
            $rslogin = mysqli_fetch_array($Execute);
            $_SESSION['id'] = $rslogin['id'];
            Redirect_to("dashboard.php");
        } else {
            $_SESSION["ErrorMessage"] = "Invalid email/password";
            Redirect_to("nurseLogin.php");
        }
    }
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nurse Login</title>
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
            background-image: url("../assets/images/b4.jpg");
            overflow: hidden;
        }

        .sign {
            background-image: url("assets/images/b2.jpg");
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
                                        <h4 class="mt-2">
                                            <span>Please sign in to your account below.</span>
                                        </h4>
                                    </div>
                                    <form action="nurseLogin.php" method="POST">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <input name="emailAddress" id="emailAddress" placeholder="Email here..." type="email" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <input name="password" id="password" placeholder="Password here..." type="password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-relative form-check">
                                            <input name="check" id="exampleCheck" type="checkbox" class="form-check-input">
                                            <label for="exampleCheck" class="form-check-label">Keep me logged in</label>
                                        </div>

                                        <div class="divider"></div>
                                </div>
                                <div class="modal-footer clearfix">
                                    <div class="float-left">
                                        <a href="javascript:void(0);" class="forgotPassword.php">Recover Password</a>
                                    </div>
                                    <div class="float-right">
                                        <button class="btn btn-primary btn-lg" name="submit" type="submit">Login</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="text-center text-white opacity-8 mt-3">Copyright © HMS 2021</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../assets/scripts/main.js"></script>
</body>

</html>