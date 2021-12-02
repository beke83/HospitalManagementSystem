<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_login(); ?>
<!-- <?php
        if (isset($_SESSION['emailAddress'])) {
            echo "hi" . $_SESSION['emailAddress'];
        }
        ?> -->

<?php
//These are inbuilt mail functions used for sending email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; // used to handle errors or exception
use PHPMailer\PHPMailer\SMTP; // smtp is used to transfer email messages and attatchments


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

$mail->Subject = "Hospital Appointment Approved";
$mail->Body = "
			<p style='font-size:xx-large'>Hi " . $_POST['patient'] . ",</p>
            <p>You didn't check in for your appointment scheduled for today</p>
            <p>Try to book another appointment</p>
            <p>Thank you for choosing HMS
            <p>Best Regards,<br />Hospital Management System</p>
			";
$mail->AltBody = "Message";

if (!$mail->send()) {
    // echo 'Message could not be sent.';
    // echo 'Mailer Error: ' . $mail->ErrorInfo;
    $_SESSION["ErrorMessage"] = $mail->ErrorInfo;
    Redirect_to("viewApprovedAppointment.php");
} else {
    //echo 'Register Done, Please check your mail';
    $_SESSION["SuccessMessage"] = "Mail sent";
    Redirect_to("viewApprovedAppointment.php");
}

?>