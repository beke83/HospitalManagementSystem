<?php
include("../include/db_connect.php");
if (isset($_GET['delid'])) {
	$query = "DELETE FROM billing_records WHERE billingid='$_GET[delid]'";
	$execute = mysqli_query($db_connect, $query);
	if (mysqli_affected_rows($db_connect) == 1) {
		echo "<script>alert('billing record deleted successfully..');</script>";
	}
}
?>
<section class="container">
	<?php
	$querybilling_records = "SELECT * FROM billing_tbl WHERE appointmentid='$_GET[appointmentid]'";
	$executebilling_records = mysqli_query($db_connect, $querybilling_records);
	$rsbilling_records = mysqli_fetch_array($executebilling_records);
	?>
	<table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
		<tbody>
			<tr>
				<th scope="col">
					<div align="right">Bill number &nbsp; </div>
				</th>
				<td> <?php echo $rsbilling_records['id']; ?></td>
			</tr>
			<tr>
				<th width="124" scope="col">
					<div align="right">Appointment Number &nbsp; </div>
				</th>
				<td width="413"> <?php echo $rsbilling_records['appointmentid']; ?>
				</td>
			</tr>

			<tr>
				<th scope="col">
					<div align="right">Billing Date &nbsp; </div>
				</th>
				<td>&nbsp;<?php echo $rsbilling_records['billingdate']; ?></td>
			</tr>

			<tr>
				<th scope="col">
					<div align="right">Billing time&nbsp; </div>
				</th>
				<td>&nbsp;<?php echo $rsbilling_records['billingtime']; ?></td>
			</tr>
		</tbody>
	</table>

	<table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
		<thead>
			<tr>
				<th width="97" scope="col">Date</th>
				<th width="245" scope="col">Description</th>
				<th width="86" scope="col">Bill Amount</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM billing_records where billingid='$rsbilling_records[id]'";
			$execute = mysqli_query($db_connect, $query);
			$billamt = 0;
			while ($rs = mysqli_fetch_array($execute)) {
				echo "<tr>
          	<td>&nbsp;$rs[bill_date]</td>
		 	<td>&nbsp; $rs[bill_type]";

				if ($rs['bill_type'] == "Service Charge") {
					$queryservice_type1 = "SELECT * FROM service_type WHERE id='$rs[bill_type_id]'";
					$executeservice_type1 = mysqli_query($db_connect, $queryservice_type1);
					$rsservice_type1 = mysqli_fetch_array($executeservice_type1);
					echo " - " . $rsservice_type1['service_type'];
				}


				if ($rs['bill_type'] == "Room Rent") {
					$queryroomtariff = "SELECT * FROM room WHERE id='$rs[bill_type_id]'";
					$executeroomtariff = mysqli_query($db_connect, $queryroomtariff);
					$rsroomtariff = mysqli_fetch_array($executeroomtariff);
					echo " : " . $rsroomtariff['roomtype'] .  "- Room No." . $rsroomtariff['roomno'];
				}

				if ($rs['bill_type'] == "Consultancy Fee") {
					//Consultancy Charge
					$querydoctor = "SELECT * FROM doctor_tbl WHERE id='$rs[bill_type_id]'";
					$executedoctor = mysqli_query($db_connect, $querydoctor);
					$rsdoctor = mysqli_fetch_array($executedoctor);
					echo " - Mr." . $rsdoctor['doctorLastname'];
				}

				if ($rs['bill_type'] == "Treatment Cost") {
					//Treatment Cost
					$querytreatment = "SELECT * FROM treatment WHERE id='$rs[bill_type_id]'";
					$executetreatment = mysqli_query($db_connect, $querytreatment);
					$rstreatment = mysqli_fetch_array($executetreatment);
					echo " - " . $rstreatment['treatmenttype'];
				}

				if ($rs['bill_type']  == "Prescription charge") {
					$querytreatment = "SELECT * FROM prescription WHERE treatmentid='$rs[bill_type_id]'";
					$executetreatment = mysqli_query($db_connect, $querytreatment);
					$rstreatment = mysqli_fetch_array($executetreatment);

					$querytreatment1 = "SELECT * FROM treatment_records WHERE treatmentid='$rstreatment[treatmentid]'";
					$executetreatment1 = mysqli_query($db_connect, $querytreatment1);
					$rstreatment1 = mysqli_fetch_array($executetreatment1);

					$querytreatment2 = "SELECT * FROM treatment WHERE id='$rstreatment1[treatmentid]'";
					$executetreatment2 = mysqli_query($db_connect, $querytreatment2);
					$rstreatment2 = mysqli_fetch_array($executetreatment2);
					echo 	" - " . $rstreatment2['treatmenttype'];
				}

				echo " </td><td>&nbsp;#$rs[bill_amount]</td></tr>";
				$billamt = $billamt +  $rs['bill_amount'];
			}
			?>
		</tbody>
	</table>

	<table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
		<tbody>
			<tr>
				<th scope="col">
					<div align="right">Bill Amount &nbsp; </div>
				</th>
				<td>&nbsp;#<?php echo $billamt; ?></td>
			</tr>
			<tr>
				<th width="442" scope="col">
					<div align="right">Tax Amount (5%) &nbsp; </div>
				</th>
				<td width="95">&nbsp;#<?php echo $taxamt = 5 * ($billamt / 100); ?>
				</td>
			</tr>

			<tr>
				<th scope="col">
					<div align="right">Discount &nbsp; </div>
				</th>
				<td>&nbsp;#<?php echo $rsbilling_records['discount']; ?></td>
			</tr>

			<tr>
				<th scope="col">
					<div align="right">Grand Total &nbsp; </div>
				</th>
				<td>&nbsp;#<?php echo ($billamt + $taxamt)  - $rsbilling_records['discount']; ?></td>
			</tr>
		</tbody>
	</table>

</section>