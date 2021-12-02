<?php
include("../include/db_connect.php");
?>

<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
		<tbody>
			<tr>
				<th><strong>Doctor</strong></th>
				<th><strong>Patient</strong></th>
				<th><strong>Prescription Date</strong></th>
				<th><strong>View</strong></th>
			</tr>
			<?php
			$query = "SELECT * FROM prescription WHERE patientid='$_GET[patientid]' AND appointmentid='$_GET[appointmentid]'";
			$execute = mysqli_query($db_connect, $query);
			while ($rs = mysqli_fetch_array($execute)) {
				$querypatient = "SELECT * FROM patient_tbl WHERE id='$rs[patientid]'";
				$executepatient = mysqli_query($db_connect, $querypatient);
				$rspatient = mysqli_fetch_array($executepatient);

				$querydoctor = "SELECT * FROM doctor_tbl WHERE id='$rs[doctorid]'";
				$executedoctor = mysqli_query($db_connect, $querydoctor);
				$rsdoctor = mysqli_fetch_array($executedoctor);

				echo "<tr>
              		<td>&nbsp;$rsdoctor[doctorLastname]</td>
              		<td>&nbsp;$rspatient[firstname] $rspatient[lastname]</td>
               		<td>&nbsp;$rs[prescriptiondate]</td>
					<td><a href='prescriptionrecord.php?prescriptionid=$rs[0]&patientid=$rs[patientid]' >View</td>
            </tr>";
			}
			?>
		</tbody>
	</table>
	<?php
	if (isset($_SESSION['id'])) {
	?>
		<hr>
		<table>
			<tr>
				<td>
					<div align="center">
												<strong>
							<a href="prescription.php?patientid=<?php echo $_GET['patientid']; ?>&appid=<?php echo $rsappointment['id']; ?>">
								<button class="btn btn-info">
									Add Prescription records
								</button>
							</a>
						</strong>
					</div>
				</td>
			</tr>
		</table>
	<?php
	}
	?>
</body>

</html>