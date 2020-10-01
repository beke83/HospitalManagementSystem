<?php
include("../include/db_connect.php");
if(isset($_GET['delid']))
{
	$query ="DELETE FROM billing_records WHERE billingid='$_GET[delid]'";
	$execute=mysqli_query($db_connect,$query);
	if(mysqli_affected_rows($db_connect) == 1)
	{
		echo "<script>alert('billing record deleted successfully..');</script>";
	}
}

?>
 <section class="container">
<?php
$querybilling_records ="SELECT * FROM billing_tbl WHERE appointmentid='$_GET[id]'";
$executebilling_records = mysqli_query($db_connect,$querybilling_records);
$rsbilling_records = mysqli_fetch_array($executebilling_records);
?>
 	<table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
      <tbody>
        <tr>
          <th scope="col"><div align="right">Bill number &nbsp; </div></th>
          <td><?php echo $rsbilling_records['id']; ?></td>
          <td>Appointment Number &nbsp;</td>
          <td><?php echo $rsbilling_records['appointmentid']; ?></td>
        </tr>
        <tr>
          <th width="442" scope="col"><div align="right">Billing Date &nbsp; </div></th>
          <td width="413"><?php echo $rsbilling_records['billingdate']; ?></td>
          <td width="413">Billing time&nbsp; </td>
          	<td width="413"><?php echo $rsbilling_records['billingtime'] ; ?></td>
        </tr>
         
		<tr>
          <th scope="col"><div align="right"></div></th>
          <td></td>
          <th scope="col"><div align="right">Bill Amount &nbsp; </div></th>
          <td><?php
		$query ="SELECT * FROM billing_records where billingid='$rsbilling_records[id]'";
		$execute = mysqli_query($db_connect,$query);
		$billamt= 0;
		while($rs = mysqli_fetch_array($execute))
		{
			$billamt = $billamt +  $rs['bill_amount'];
		}
?>
  &nbsp;Rs. <?php echo $billamt; ?></td>
        </tr>
        <tr>
          <th width="442" scope="col"><div align="right"></div></th>
          <td width="413">&nbsp;</td>
          <th width="442" scope="col"><div align="right">Tax Amount (5%) &nbsp; </div></th>
          <td width="413">&nbsp;Rs. <?php echo $taxamt = 5 * ($billamt / 100); ?></td>
       	</tr>
         
		<tr>
		  <th scope="col"><div align="right">Disount reason</div></th>
		  <td rowspan="4" valign="top"><?php echo $rsbilling_records['discountreason']; ?></td>
		  <th scope="col"><div align="right">Discount &nbsp; </div></th>
		  <td>&nbsp;Rs. <?php echo $rsbilling_records['discount']; ?></td>
	    </tr>
        
		<tr>
		  <th rowspan="3" scope="col">&nbsp;</th>
		  <th scope="col"><div align="right">Grand Total &nbsp; </div></th>
		  <td>&nbsp;Rs. <?php echo $grandtotal = ($billamt + $taxamt)  - $rsbilling_records['discount'] ; ?></td>
	    </tr>
		<tr>
		  <th scope="col"><div align="right">Paid Amount </div></th>
		  <td>Rs. <?php
		  	$querypayment ="SELECT sum(paidamount) FROM payment where appointmentid='$billappointmentid'";
			$executepayment = mysqli_query($db_connect,$querypayment);
			$rspayment = mysqli_fetch_array($executepayment);
			echo $rspayment[0];		  
		   ?></td>
	    </tr>
		<tr>
		  <th scope="col"><div align="right">Balance Amount</div></th>
		  <td>Rs. <?php echo $balanceamt = $grandtotal - $rspayment[0]  ; ?></td>
	    </tr>
      </tbody>
    </table>
   <p><strong>Payment report:</strong></p>
<?php
$querypayment = "SELECT * FROM payment where appointmentid='$billappointmentid'";
$executepayment = mysqli_query($db_connect,$querypayment);
if(mysqli_num_rows($executepayment) == 0)
{
	echo "<strong>No transaction details found..</strong>";
}
else
{
?>
   <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
     <tbody>
       <tr>
         <th scope="col">Paid Date</th>
         <th scope="col">Paid time</th>
         <th scope="col">Paid amount</th>
       </tr>
<?php       
		while($rspayment = mysqli_fetch_array($executepayment))
		{
		?>
			   <tr>
				 <td>&nbsp;<?php echo $rspayment['paiddate']; ?></td>
				 <td>&nbsp;<?php echo $rspayment['paidtime']; ?></td>
				 <td>&nbsp;Rs. <?php echo $rspayment['paidamount']; ?></td>
			   </tr>
		<?php
		}
?>

     </tbody>
   </table>
<?php
}
?>   
   <p><strong></strong></p>
</section>