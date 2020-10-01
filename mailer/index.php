<?php

if (isset($_POST['sendmail'])) {
    require 'PHPMailerAutoload.php';
    require 'credentials.php';

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
    $mail->addAddress($_POST['email']);     // Add a recipient
    $mail->addReplyTo(EMAIL);

    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $_POST['subject'];
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = $_POST['message'];

    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>NETTUTS > Sign up</title>
    <link href="css/style.css" type="text/css" rel="stylesheet" />
</head>

<body>
    <!-- start header div -->
    <div id="header">
        <h3>NETTUTS > Sign up</h3>

        <div id="wrap">
            <!-- stop php code -->

            <!-- title and description -->
            <h3>Signup Form</h3>
            <p>Please enter your name and email addres to create your account</p>

            <!-- start sign up form -->
            <form action="" method="post" enctype="multipart/form-data">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="" />
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" value="" />
                <label for="email">Subject:</label>
                <input type="text" name="subject" id="subject" value="" />
                <label for="email">Message:</label>
                <textarea name="message" type="text" id="message"></textarea>
                <br />
                <br />
                <button type="submit" name="sendmail" class="btn btn-primary" value="Sign up">Send</button>
            </form>
            <!-- end sign up form -->

        </div>
        <!-- end wrap div -->
</body>

</html>