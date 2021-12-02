<?php
include("../include/db_connect.php");
?>

<table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
	<tr>
		<td><strong>Treatment type</strong></td>
		<td><strong>Treatment date & time</strong></td>
		<td><strong>Doctor</strong></td>
		<td><strong>Treatment Description</strong></td>
		<td><strong>Treatment cost</strong></td>
	</tr>
	<?php
	$appointmentid = 0;
	//$AppointmentID = mysqli_real_escape_string($db_connect, $_POST['appointmentid']);
	$query = "SELECT * FROM treatment_records LEFT JOIN treatment ON treatment_records.treatmentid=treatment.id WHERE treatment_records.patientid='$_GET[patientid]' AND treatment_records.appointmentid='$_GET[appointmentid]'";
	$execute = mysqli_query($db_connect, $query);
	while ($rs = mysqli_fetch_array($execute)) {
		$querypat = "SELECT * FROM patient_tbl WHERE id='$rs[patientid]'";
		$executepat = mysqli_query($db_connect, $querypat);
		$rspat = mysqli_fetch_array($executepat);

		$querydoc = "SELECT * FROM doctor_tbl WHERE id='$rs[doctorid]'";
		$executedoc = mysqli_query($db_connect, $querydoc);
		$rsdoc = mysqli_fetch_array($executedoc);

		$querytreatment = "SELECT * FROM treatment WHERE id='$rs[treatmentid]'";
		$executetreatment = mysqli_query($db_connect, $querytreatment);
		$rstreatment = mysqli_fetch_array($executetreatment);

		echo "<tr>
					<td>&nbsp;$rstreatment[treatmenttype]</td>
					</td><td>&nbsp;" . date("d-m-Y", strtotime($rs['treatment_date'])) . "  &nbsp;" . date("h:i A", strtotime($rs['treatment_time'])) . "</td>
					<td>&nbsp;$rsdoc[doctorLastname]</td>
					<td>&nbsp;$rs[treatment_description]";
		echo "</td>";
		echo "<td>#$rs[treatment_cost]</td></tr>";
	}
	?>
</table>
<?php
if (isset($_SESSION['id'])) {
?>
	<hr>
	<table>
		<tr>
			<div align="center">
				<a href="treatmentrecord.php?patientid=<?php echo $_GET['patientid']; ?>&appointmentid=<?php echo $rsappointment['id']; ?>">
					<button class="btn btn-primary">
						Add Treatment records
					</button>
				</a>
			</div>
		</tr>
	</table>
<?php
}
?>
<script type="application/javascript">
	function validateform() {
		if (document.frmtreatdetail.select.value == "") {
			alert("Treatment name should not be empty..");
			document.frmtreatdetail.select.focus();
			return false;
		} else if (document.frmtreatdetail.select2.value == "") {
			alert("Doctor name should not be empty..");
			document.frmtreatdetail.select2.focus();
			return false;
		} else if (document.frmtreatdetail.textarea.value == "") {
			alert(" Treatment description should not be empty..");
			document.frmtreatdetail.textarea.focus();
			return false;
		} else if (document.frmtreatdetail.treatmentfile.value == "") {
			alert("Upload file should not be empty..");
			document.frmtreatdetail.treatmentfile.focus();
			return false;
		} else if (document.frmtreatdetail.date.value == "") {
			alert("Treatment date should not be empty..");
			document.frmtreatdetail.date.focus();
			return false;
		} else if (document.frmtreatdetail.time.value == "") {
			alert("Treatment time should not be empty..");
			document.frmtreatdetail.time.focus();
			return false;
		} else {
			return true;
		}
	}
</script>