<?php

$db_connect =mysqli_connect("localhost","root","yahoo@");
mysqli_select_db($db_connect,"daiohms") or die(mysqli_error($db_connect));

?>