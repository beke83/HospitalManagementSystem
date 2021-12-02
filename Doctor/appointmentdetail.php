<?php
include("../include/db_connect.php");
if (isset($_POST['submitapp'])) {
	$query = "INSERT INTO appointment_tbl(appointmenttype,roomid,departmentid,appointmentdate,appointmenttime,doctorid) values('$_POST[select]','$_POST[select2]','$_POST[select3]','$_POST[date]','$_POST[time]','$_POST[select5]')";
	if ($execute = mysqli_query($db_connect, $query)) {
		echo "<script>alert('appointment record inserted successfully...');</script>";
	} else {
		echo mysqli_error($db_connect);
	}
}

if (isset($_GET['editid'])) {
	$query = "SELECT * FROM appointment_tbl WHERE appointmentid='$_GET[editid]' ";
	$execute = mysqli_query($db_connect, $query);
	$rsedit = mysqli_fetch_array($execute);
}

$queryappointment1 = "SELECT max(id) FROM appointment_tbl where patientid='$_GET[patientid]' AND (status='Active' OR status='Approved')";
$executeappointment1 = mysqli_query($db_connect, $queryappointment1);
$rsappointment1 = mysqli_fetch_array($executeappointment1);

$queryappointment = "SELECT * FROM appointment_tbl where id='$rsappointment1[0]'";
$executeappointment = mysqli_query($db_connect, $queryappointment);
$rsappointment = mysqli_fetch_array($executeappointment);

if (mysqli_num_rows($executeappointment) == 0) {
	echo "<center><h2>No Appointment records found..</h2></center>";
} else {
	$queryappointment = "SELECT * FROM appointment_tbl where id='$rsappointment1[0]'";
	$executeappointment = mysqli_query($db_connect, $queryappointment);
	$rsappointment = mysqli_fetch_array($executeappointment);

	$queryroom = "SELECT * FROM room where id='$rsappointment[id]' ";
	$executeroom = mysqli_query($db_connect, $queryroom);
	$rsroom = mysqli_fetch_array($executeroom);

	$querydepartment = "SELECT * FROM department_tbl where id='$rsappointment[departmentid]'";
	$executedepartment = mysqli_query($db_connect, $querydepartment);
	$rsdepartment = mysqli_fetch_array($executedepartment);

	$querydoctor = "SELECT * FROM doctor_tbl where id='$rsappointment[doctorid]'";
	$executedoctor = mysqli_query($db_connect, $querydoctor);
	$rsdoctor = mysqli_fetch_array($executedoctor);
?>
	<table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">

		<tr>
			<td>Appointment No.</td>
			<td>&nbsp;<?php echo $_GET['appointmentid']; ?></td>
		</tr>
		<tr>
			<td>Department</td>
			<td>&nbsp;<?php echo $rsdepartment['departmentName']; ?></td>
		</tr>
		<tr>
			<td>Doctor</td>
			<td>&nbsp;<?php echo $rsdoctor['doctorLastname']; ?></td>
		</tr>
		<tr>
			<td>Appointment Date</td>
			<td>&nbsp;<?php echo date("d-M-Y", strtotime($rsappointment['appointmentdate'])); ?></td>
		</tr>
		<tr>
			<td>Appointment Time</td>
			<td>&nbsp;<?php echo date("h:i A", strtotime($rsappointment['appointmenttime'])); ?></td>
		</tr>
	</table>
<?php
}
?>
<script type="application/javascript">
	function validateform() {

		if (document.frmappntdetail.select.value == "") {
			alert("Appointment type should not be empty..");
			document.frmappntdetail.select.focus();
			return false;
		} else if (document.frmappntdetail.select2.value == "") {
			alert("Room type should not be empty..");
			document.frmappntdetail.select2.focus();
			return false;
		} else if (document.frmappntdetail.select3.value == "") {
			alert("Department name should not be empty..");
			document.frmappntdetail.select3.focus();
			return false;
		} else if (document.frmappntdetail.date.value == "") {
			alert("Appointment date should not be empty..");
			document.frmappntdetail.date.focus();
			return false;
		} else if (document.frmappntdetail.time.value == "") {
			alert("Appointment time should not be empty..");
			document.frmappntdetail.time.focus();
			return false;
		} else if (document.frmappntdetail.select5.value == "") {
			alert("Doctor name should not be empty..");
			document.frmappntdetail.select5.focus();
			return false;
		} else {
			return true;
		}
	}
</script>