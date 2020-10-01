
<?php
include("../include/db_connect.php");
$dt = date("Y-m-d");
$tim = date("H:i:s");
//LAST APPOINTMENT ID
$queryappointment1 = "SELECT max(id) FROM appointment_tbl WHERE patientid='$_GET[patientid]' AND (status='Active' OR status='Approved')";
$executeappointment1 = mysqli_query($db_connect, $queryappointment1);
$rsappointment1 = mysqli_fetch_array($executeappointment1);

//SELECTING LAST APPOINTMENT ID RECORD
$query = "SELECT * FROM billing_tbl WHERE appointmentid='$rsappointment1[0]'";
$execute = mysqli_query($db_connect, $query);
$rsbill = mysqli_fetch_array($execute);
if (mysqli_num_rows($execute) == 0) {
	//Create billing invoice for appointment
	$query = "INSERT INTO billing_tbl(patientid, appointmentid, billingdate, billingtime, discount, taxamount, discountreason, discharge_time, discharge_date) VALUES ('$_GET[patientid]','$rsappointment1[0]','$dt','$tim','0','0','','','')";
	$execute = mysqli_query($db_connect, $query);
	$billid = mysqli_insert_id($db_connect);
} else {
	$billid = $rsbill[0];
}

if ($billtype == "Room Rent") {
	if ($roomid != "") {
		$queryroomtariff = "SELECT * FROM room WHERE roomid='$roomid'";
		$executeroomtariff = mysqli_query($db_connect, $queryroomtariff);
		$rsroomtariff = mysqli_fetch_array($executeroomtariff);
		//Room tariff
		$query = "INSERT INTO billing_records( billingid, bill_type_id, bill_type, bill_amount, bill_date, status) VALUES ('$billid','$roomid','Room Rent','$rsroomtariff[room_tariff]','$dt','Active')";
		$execute = mysqli_query($db_connect, $query);
	}
}

if ($billtype == "Doctor Charge" && $billtype1 = "Treatment Cost") {
	//Consultancy Charge
	$querydoctor = "SELECT * FROM doctor_tbl WHERE id='$id'";
	$executedoctor = mysqli_query($db_connect, $querydoctor);
	$rsdoctor = mysqli_fetch_array($executedoctor);

	$queryconsu = "SELECT * FROM billing_records WHERE billingid='$billid' AND bill_type_id='$doctorid' AND bill_type='Consultancy Charge'";
	$executecunsu = mysqli_query($db_connect, $queryconsu);

	if (mysqli_affected_rows($db_connect) == 0) {
		$query = "INSERT INTO billing_records(billingid, bill_type_id, bill_type, bill_amount, bill_date, status) VALUES ('$billid','$doctorid','Consultancy Charge','$rsdoctor[consultancy_charge]','$dt','Active')";
		$execute = mysqli_query($db_connect, $query);
	}

	//Treatment Cost
	$querytreatment = "SELECT * FROM treatment WHERE id='$id'";
	$executetreatment = mysqli_query($db_connect, $querytreatment);
	$rstreatment = mysqli_fetch_array($executetreatment);

	$query = "INSERT INTO billing_records(billingid, bill_type_id, bill_type, bill_amount, bill_date, status) VALUES ('$billid','$treatmentid','Treatment','$rstreatment[treatment_cost]','$dt','Active')";
	$execute = mysqli_query($db_connect, $query);
}

if ($billtype == "Prescription charge") {
	$querytreatment = "SELECT * FROM treatmenttype_tbl WHERE id='$_GET[id]'";
	$executetreatment = mysqli_query($db_connect, $querytreatment);
	$rstreatment = mysqli_fetch_array($executetreatment);
	//Prescription charge
	$query = "INSERT INTO billing_records(billingid, bill_type_id, bill_type, bill_amount, bill_date, status) VALUES ('$billid','$prescriptionid','Prescription Charge','$presamt','$dt','Active')";
	$execute = mysqli_query($db_connect, $query);
}

if ($billtype == "Prescription update") {
	$queryprescription_records = "SELECT sum(cost*unit) FROM prescription_records WHERE prescription_id='$_GET[prescriptionid]'";
	$executeprescription_records = mysqli_query($db_connect, $queryprescription_records);
	$rsprescription_records = mysqli_fetch_array($executeprescription_records);
	//Prescription charge
	$query = "UPDATE billing_records SET bill_amount='$rsprescription_records[0]' WHERE bill_type_id ='$_GET[prescriptionid]'";
	$execute = mysqli_query($db_connect, $query);
}

if ($billtype == "Consultancy Charge") {
	//Consultancy Charge
	$query = "INSERT INTO billing_records( billingid, bill_type_id, bill_type, bill_amount, bill_date, status) VALUES ('$billid','$doctorid','Consultancy Charge','$billamt','$dt','Active')";
	$execute = mysqli_query($db_connect, $query);
}

if ($billtype == "Service Charge") {
	$queryservice_type = "SELECT * FROM service_type WHERE service_type_id='$servicetypeid'";
	$executeservice_type = mysqli_query($db_connect, $queryservice_type);
	$rsservice_type = mysqli_fetch_array($executeservice_type);
	$servicecharge = $rsservice_type['servicecharge'] + $_POST['amount'];
	//Prescription charge
	$query = "INSERT INTO billing_records( billingid, bill_type_id, bill_type, bill_amount, bill_date, status) VALUES ('$billid','$servicetypeid','Service Charge','$servicecharge','$_POST[date]','Active')";
	$execute = mysqli_query($db_connect, $query);
	echo "<script>alert('Service charge added successfully..');</script>";
}
?>