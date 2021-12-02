<!-- This is the code to connect to the database-->
<?php

// localhost- server name
// root - username
// yahoo@ - password
$db_connect = mysqli_connect("localhost", "root", "yahoo@");
mysqli_select_db($db_connect, "daiohms") or die(mysqli_error($db_connect));

?>