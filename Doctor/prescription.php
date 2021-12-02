<?php include("../include/db_connect.php") ?>
<?php include("../include/session.php") ?>
<?php include("../include/Functions.php");
confirm_login(); ?>

<?php
if(isset($_POST['submit']))
{
	//$Treatment = mysqli_real_escape_string($db_connect, $_POST["treatmentid"]);
if(isset($_GET['editid']))
{
$query ="UPDATE prescription SET treatment_records_id='$_POST[treatmentid]',doctorid='$_POST[select2]',patientid='$_POST[patientid]',prescriptiondate='$_POST[date]',status='$_POST[select]' WHERE prescription_id='$_GET[editid]'";
if($execute = mysqli_query($db_connect,$query))
{
echo "<script>
	alert('prescription record updated successfully...');
</script>";
}
else
{
echo mysqli_error($db_connect);
}
}
else
{
$query ="INSERT INTO prescription(treatment_records_id,doctorid,patientid,prescriptiondate,status,appointmentid) values('$_POST[treatmentid]','$_POST[select2]','$_POST[patientid]','$_POST[date]','Active','$_GET[appid]')";
if($execute = mysqli_query($db_connect,$query))
{
$insid= mysqli_insert_id($db_connect);
$prescriptionid= $insid;
$prescriptiondate= $_POST['date'];
$billtype="Prescription charge";
$billamt=0;
include("insertbillingrecord.php");
echo "<script>
	alert('prescription record inserted successfully...');
</script>";
echo "<script>
	window.location = 'prescriptionrecord.php?prescriptionid=" . $insid . "&patientid=$_GET[patientid]&appid=$_GET[appid]';
</script>";
}
else
{
echo mysqli_error($db_connect);
}
}
}
if(isset($_GET['editid']))
{
$query="SELECT * FROM prescription WHERE id='$_GET[editid]' ";
$execute = mysqli_query($db_connect,$query);
$rsedit = mysqli_fetch_array($execute);

}
?>

<div class="wrapper col2">
	<div id="breadcrumb">
		<ul>
			<li class="first">Add New Prescription</li>
		</ul>
	</div>
</div>
<div class="wrapper col4">
	<div id="container">
		<h1>Add new prescription record</h1>
		<form method="post" action="" name="frmpres" onSubmit="return validateform()">
			<input type="hidden" name="patientid" value="<?php echo $_GET['patientid']; ?>" />
			<!-- <input type="hidden" name="treatmentid" value="<?php echo $_GET['']; ?>" /> -->
			<input type="hidden" name="appid" value="<?php echo $_GET['appid']; ?>" />
			<table width="200" border="3">
				<tbody>
					<tr>
						<td>Patient</td>
						<td>
							<?php
							$querypatient = "SELECT * FROM patient_tbl WHERE status='Active' AND id='$_GET[patientid]'";
							$executepatient = mysqli_query($db_connect, $querypatient);
							while ($rspatient = mysqli_fetch_array($executepatient)) {
								echo "$rspatient[id]- $rspatient[lastname]";
							}
							?></td>
					</tr>

					<?php
					if (isset($_SESSION['id'])) {
					?>
						<tr>
							<td>Doctor</td>
							<td>
								<?php
								$querydoctor = "SELECT * FROM doctor_tbl INNER JOIN department_tbl ON department_tbl.id=doctor_tbl.departmentid WHERE doctor_tbl.status='Active' AND doctor_tbl.id='$_SESSION[id]'";
								$executedoctor = mysqli_query($db_connect, $querydoctor);
								while ($rsdoctor = mysqli_fetch_array($executedoctor)) {
									echo "$rsdoctor[doctorLastname] ( $rsdoctor[departmentName] )";
								}
								?>
								<input type="hidden" name="select2" value="<?php echo $_SESSION['id']; ?>" />
							</td>
						<?php
					} else {
						?>
						<tr>
							<td width="34%">Doctor</td>
							<td width="66%"><select name="select2" id="select2">
									<option value="">Select</option>
									<?php
									$querydoctor = "SELECT * FROM doctor_tbl WHERE status='Active'";
									$executedoctor = mysqli_query($db_connect, $querydoctor);
									while ($rsdoctor = mysqli_fetch_array($executedoctor)) {
										if ($rsdoctor['id'] == $rsedit['id']) {
											echo "<option value='$rsdoctor[id]' selected>$rsdoctor[id]-$rsdoctor[doctorLastname]</option>";
										} else {
											echo "<option value='$rsdoctor[id]'>$rsdoctor[id]-$rsdoctor[doctorLastname]</option>";
										}
									}
									?>
								</select></td>
						</tr>
					<?php
					}
					?>
					<tr>
						<td>Prescription Date</td>
						<td><input type="date" name="date" id="date" value="<?php if(isset($_GET['editid'])) echo $rsedit['prescriptiondate']; ?>" /></td>
					</tr>

					<tr>
						<td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Submit" /></td>
					</tr>
				</tbody>
			</table>
			<p>&nbsp;</p>
	</div>
	<div class="clear"></div>
</div>
</div>
<script type="application/javascript">
	function validateform() {
		if (document.frmpres.select2.value == "") {
			alert("Doctor name should not be empty..");
			document.frmpres.select2.focus();
			return false;
		} else if (document.frmpres.select3.value == "") {
			alert("Patient name should not be empty..");
			document.frmpres.select3.focus();
			return false;
		} else if (document.frmpres.date.value == "") {
			alert("Prescription date should not be empty..");
			document.frmpres.date.focus();
			return false;
		} else if (document.frmpres.select.value == "") {
			alert("Kindly select the status..");
			document.frmpres.select.focus();
			return false;
		} else {
			return true;
		}
	}
</script>