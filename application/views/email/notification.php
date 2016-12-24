<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>FIRS Admin Remittance Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div>
   <div style="font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: center" align="center" id="emb-email-header"><img style="border: 0;-ms-interpolation-mode: bicubic;display: block;Margin-left: auto;Margin-right: auto;max-width: 152px" src="http://www.anil2u.info/wp-content/uploads/2013/09/anil-kumar-panigrahi-blog.png" alt="" width="152" height="108"></div>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Hey,</p> 
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">FIRS Admin Remittance Report </p>
<table>
	<tr>
		<th>VENDOR ID</th>
		<th>PERIOD</th>
		<th>TRANSACTION AMOUNT</th>
		<th>OUTPUT VAT</th>
		<th>INPUT VAT</th>
		<th>NET VAT</th>
	</tr>
<?php foreach($total_result as $result){?>
	<tr>
		<td><?php echo $result['Vendor_Id']; ?></td>
		<td><?php echo $result['period']; ?></td>
		<td><?php echo $result['transaction_amount']; ?></td>
		<td><?php echo $result['output_vat']; ?></td>
		<td><?php echo $result['input_vat']; ?></td>
		<td><?php echo $result['net_vat']; ?></td>
	</tr>
<?php } ?>
</table>

</div>
</body>
</html>