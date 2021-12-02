<?php
session_start();
include("../include/db_connect.php");
$sql ="select * from doctor_tbl where id='$_GET[deptid]'";
$qsql = mysqli_query($db_connect,$sql);
echo "<select class='form-control' name='doctor' id='doctor'><option value=''>Select doctor</option>";
while($qsql1=mysqli_fetch_array($qsql))
{
	echo"<option value='$qsql1[id]'>$qsql1[doctorLastname]</option>";		
}
?>	          
</select>