<?php
include("../include/db_connect.php");
if (isset($_POST['submitpat'])) {

	$Firstname = mysqli_real_escape_string($db_connect, $_POST["firstname"]);
	$Lastname = mysqli_real_escape_string($db_connect, $_POST["lastname"]);
	$Gender = mysqli_real_escape_string($db_connect, $_POST["gender"]);
	$DOB = mysqli_real_escape_string($db_connect, $_POST["dob"]);
	$BloodGroup = mysqli_real_escape_string($db_connect, $_POST["bloodGroup"]);
	$Address = mysqli_real_escape_string($db_connect, $_POST["address"]);
	$City = mysqli_real_escape_string($db_connect, $_POST["city"]);
	$PhoneNumber = mysqli_real_escape_string($db_connect, $_POST["phoneNumber"]);
	$EmailAddress = mysqli_real_escape_string($db_connect, $_POST["emailAddress"]);
	$Password = mysqli_real_escape_string($db_connect, $_POST["password"]);
	$ConfirmPassword = mysqli_real_escape_string($db_connect, $_POST["confirmPassword"]);
	$Status = mysqli_real_escape_string($db_connect, $_POST["status"]);

	$query = "INSERT INTO patient_tbl(firstname,lastname,gender,dob,bloodGroup,address,city,phoneNumber,emailAddress,password,confirmPassword,status,dateTimeAdmitted)
        VALUES('$Firstname','$Lastname', '$Gender', '$DOB', '$BloodGroup', '$Address', '$City', '$PhoneNumber', '$EmailAddress', '$Password', '$ConfirmPassword', '$Status','$DateTime')";
	if ($execute = mysqli_query($db_connect, $query)) {
		echo "<script>alert('patients record inserted successfully...');</script>";
	} else {
		echo mysqli_error($db_connect);
	}
}

if (isset($_GET['editid'])) {
	$query = "SELECT * FROM patient_tbl WHERE id='$_GET[editid]' ";
	$execute = mysqli_query($db_connect, $query);
	$rsedit = mysqli_fetch_array($execute);
}
?>
<?php
if (!isset($_GET['patientid'])) {
?>
	<form method="post" action="" name="frmpatdet" onSubmit="return validateform()">
		<table width="808" border="1">
			<tbody>
				<tr>
					<td width="17%"><strong>Patient Name </strong></td>
					<td width="41%"><input type="text" name="patientname" id="patientname" /></td>
					<td width="16%"><strong>Patient ID</strong></td>
					<td width="26%"><input type="text" name="patientid" id="patientid" /></td>
				</tr>
				<tr>
					<td><strong>Address</strong></td>
					<td align="right"><textarea name="address" id="address" cols="45" rows="5"> </textarea></td>
					<td><strong>Gender</strong></td>
					<td><label for="select"></label>
						<select name="select" id="select">
							<option value="">Select</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select></td>
				</tr>
				<tr>
					<td><strong>Contact Number</strong></td>
					<td><input type="text" name="mobilenumber" id="mobilenumber" /></td>
					<td><strong>Date Of Birth </strong></td>
					<td><input type="date" name="dateofbirth" id="dateofbirth" /></td>
				</tr>
				<tr>
					<td colspan="4" align="center"><input type="submit" name="submitpat" id="submitpat" value="Submit" /></td>
				</tr>
			</tbody>
		</table>
	</form>
<?php
} else {
	$querypatient = "SELECT * FROM patient_tbl where id='$_GET[patientid]'";
	$executepatient = mysqli_query($db_connect, $querypatient);
	$rspatient = mysqli_fetch_array($executepatient);
?>

	<table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
		<tbody>
			<tr>
				<td width="16%"><strong>Patient Name </strong></td>
				<td width="34%">&nbsp;<?php echo $rspatient['firstname'] . " " . $rspatient['lastname']; ?></td>
				<td width="16%"><strong>Patient Email</strong></td>
				<td width="34%">&nbsp;<?php echo $rspatient['emailAddress']; ?></td>
			</tr>
			<tr>
				<td><strong>Address</strong></td>
				<td>&nbsp;<?php echo $rspatient['address']; ?></td>
				<td><strong>Gender</strong></td>
				<td> <?php echo $rspatient['gender']; ?></td>
			</tr>
			<tr>
				<td><strong>Contact Number</strong></td>
				<td>&nbsp;<?php echo $rspatient['phoneNumber']; ?></td>
				<td><strong>Date Of Birth </strong></td>
				<td>&nbsp;<?php echo $rspatient['dob']; ?></td>
			</tr>
		</tbody>
	</table>
<?php
}
?>
<script type="application/javascript">
	function validateform() {
		if (document.frmpatdet.patientname.value == "") {
			alert("Patient name should not be empty..");
			document.frmpatdet.patientname.focus();
			return false;
		} else if (document.frmpatdet.patientid.value == "") {
			alert("Patient ID should not be empty..");
			document.frmpatdet.patientid.focus();
			return false;
		} else if (document.frmpatdet.admissiondate.value == "") {
			alert("Admission date should not be empty..");
			document.frmpatdet.admissiondate.focus();
			return false;
		} else if (document.frmpatdet.admissiontime.value == "") {
			alert("Admission time should not be empty..");
			document.frmpatdet.admissiontime.focus();
			return false;
		} else if (document.frmpatdet.address.value == "") {
			alert("Address should not be empty..");
			document.frmpatdet.address.focus();
			return false;
		} else if (document.frmpatdet.select.value == "") {
			alert("Gender should not be empty..");
			document.frmpatdet.select.focus();
			return false;
		} else if (document.frmpatdet.mobilenumber.value == "") {
			alert("Contact number should not be empty..");
			document.frmpatdet.mobilenumber.focus();
			return false;
		} else if (document.frmpatdet.dateofbirth.value == "") {
			alert("Date Of Birth should not be empty..");
			document.frmpatdet.dateofbirth.focus();
			return false;
		} else {
			return true;
		}
	}
</script>