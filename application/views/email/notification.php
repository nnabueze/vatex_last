<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>FIRS Admin Remittance Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>

 
<p>Hey,</p> 
<p >FIRS Admin Remittance Report </p>
<?php $i=1; ?>
<table width="500" style=" background-repeat:no-repeat; width:450px;margin:0;" cellpadding="0" cellspacing="0" border="1px solid #c35c4a4a">
	<tr>
		<th width="120" height="65" align="center" style="border: 1px solid #c35c4a4a ;">S/N</th>
		<th width="120" height="65" align="center" style="border: 1px solid #c35c4a4a ;">VENDOR ID</th>
		<th width="120" height="65" align="center" style="border: 1px solid #c35c4a4a ;">TRANSACTION AMOUNT</th>
		<th width="120" height="65" align="center" style="border: 1px solid #c35c4a4a ;">VAT</th>
		<th width="120" height="65" align="center" style="border: 1px solid #c35c4a4a ;">TRANSACTION DATE</th>
	</tr>
<?php foreach($info as $row){?>
	<tr>
		<td width="120" height="65" align="center" style="border: 1px solid #c35c4a4a ;"><?php echo $i; ?></td>
		<td width="120" height="65" align="center" style="border: 1px solid #c35c4a4a ;"><?php echo $row['vendor_name']; ?></td>
		<td width="120" height="65" align="center" style="border: 1px solid #c35c4a4a ;">₦ <?php echo number_format($row['transaction_amount'],0); ?></td>
		<td width="120" height="65" align="center" style="border: 1px solid #c35c4a4a ;">₦ <?php echo number_format($row['output_vat'],0); ?></td>
		<td width="120" height="65" align="center" style="border: 1px solid #c35c4a4a ;"><?php echo $row['transaction_date']; ?></td>
	</tr>
<?php $i++; } ?>
	<tr>
		<td width="120" colspan="3" height="65" align="center" style="border: 1px solid #c35c4a4a ;">Total</td>
		<td width="120" colspan="2" height="65" align="center" style="border: 1px solid #c35c4a4a ;">₦ <?php echo number_format($total,0); ?></td>
	</tr>
</table>

</div>
</body>
</html>