<?php
@session_start();
set_time_limit(300000000000);

/*
$s_address = $_SESSION['s_address'];
$s_logo = $_SESSION['s_logo'];
$s_sign = $_SESSION['s_sign'];
$s_name = $_SESSION['s_name'];

if($_SESSION['export_name']){
	$_POST['s_name'] = $_SESSION['export_name'];
	$_POST['s_phone'] = $_SESSION['export_phone'];
	$_POST['s_type'] = $_SESSION['export_type'];
	$_POST[i_price] = $_SESSION['export_price'];
	$_POST[i_commission1] = $_SESSION['export_commission1'];
	$_POST[i_vat1] = $_SESSION['export_vat1'];
	$_POST[d_finish] = $_SESSION['export_finish'];
}
if($_SESSION['export_product']){
	 $s_product =  $_SESSION['export_product'];
}
if($_SESSION['export_slip']){
	$s_slip =  $_SESSION['export_slip'];
}
//*/

$s_address = $_POST['s_address'];
$s_logo = $_POST['s_logo'];
$s_sign = $_POST['s_sign'];
$s_name = $_POST['s_name'];

if($_POST['export_name']){
	$_POST['s_name'] = $_POST['export_name'];
	$_POST['s_phone'] = $_POST['export_phone'];
	$_POST['s_type'] = $_POST['export_type'];
	$_POST[i_price] = $_POST['export_price'];
	$_POST[i_commission1] = $_POST['export_commission1'];
	$_POST[i_vat1] = $_POST['export_vat1'];
	$_POST[d_finish] = $_POST['export_finish'];
	$_POST[title_name] = $_POST['export_title_name'];
}
if($_POST['export_product']){
	 $s_product =  $_POST['export_product'];
}
if($_POST['export_slip']){
	$s_slip =  $_POST['export_slip'];
}


function calculator_per($pPos,$pEarned){
$total = ($pPos*$pEarned) / 100;
return $total;
}
 $title_name = $_POST[title_name];
 //$title_name = date('ymdHis').'_'.$_POST[s_name];
ob_start();
?>
<html lang="en" >
 		<head>
 			<title><?=$title_name;?></title>
 		</head>
    <body> 
<?php
if($_POST['s_name']){
$price = $_POST[i_price];
$com = $_POST[i_commission1];
$vat = $_POST[i_vat1];
$t_com = calculator_per($price,$com);
$t_vat = calculator_per($price,$vat);
$t_total = $t_com+$t_vat;
$balance = $price-$t_total;
$_POST[d_finish] = date('d-m-Y',strtotime($_POST[d_finish]));

?>
<div style=" min-height: 1123px;    padding: 10px;"  >
	<div style="border: 1px solid #ccc; padding: 10px;"align="center">
	<table width="100%" align="center" cellpadding="5" >
		<tr>
			<td width="260">
				<img width="250" height="120" src="../../image/logo/<?=$s_logo;?>"/>
			</td>
			<td align="right">
				<h1>ใบรับฝากสินค้า</h1>
			</td>
		</tr>
		<tr><td height="10" colspan="2"></td></tr>
		<tr>
			<td valign="top">
				<?php
				if($s_product){
				?>
				<img src="../../image/pdf/product/<?=$s_product;?>?v=<?=time();?>" width="230" />
				<?php
				}else{
					?>
					<img src="../../image/noimage.gif" width="230" />
					<?php
				}
				?>
				<br />
				<br />
				<?php
				if($s_slip){
				?>
				<img src="../../image/pdf/slip/<?=$s_slip;?>?v=<?=time();?>" width="230" />
				<?php
				}else{
					?>
					<img src="../../image/noimage.gif" width="230" />
					<?php
				}
				?>
			</td>
			<td valign="top">
				<table width="100%">
					<tr>
						<td width="150"><strong>ชื่อผู้ฝากสินค้า</strong></td>
						<td align="left" colspan="3"><?=$_POST[s_name];?></td>
					</tr>
					<tr>
						<td><strong>เบอร์โทรศัพท์</strong></td>
						<td align="left" colspan="3"><?=$_POST[s_phone];?></td>
					</tr>
					<tr>
						<td><strong>ประเภทสินค้า</strong></td>
						<td align="left" colspan="3"><?=$_POST[s_type];?></td>
					</tr>
					<tr>
						<td><strong>ราคาวาง</strong></td>
						<td align="left" colspan="3"><?=number_format($_POST[i_price],2);?>-.</td>
					</tr>
					<tr>
						<td><strong>ค่าดำเนินการ</strong></td>
						<td align="left" colspan="3"><?=$_POST[i_commission1];?>% : <?=number_format($t_com,2);?>-.</td>
					</tr>
					<tr>
						<td><strong>อัตราดอกเบี้ย</strong></td>
						<td align="left" colspan="3"><?=$_POST[i_vat1];?>% : <?=number_format($t_vat,2);?>-.</td>
					</tr>
					<tr>
						<td><strong>ยอดคงเหลือ</strong></td>
						<td align="left" colspan="3"><?=number_format($balance,2);?>-.</td>
					</tr>
					<tr>
						<td><strong>ยอดชำระคืน</strong></td>
						<td align="left" colspan="3"><?=number_format($price,2);?>-.</td>
					</tr>
					<tr>
						<td><strong>วันครบกำหนด</strong></td>
						<td align="left" colspan="3"><?=$_POST[d_finish];?></td>
					</tr>
				</table>
				<div align="center">
					<font style="color: #ff0000;font-style: italic;font-size: 15px;">หมายเหตุ**กรุณาต่อดอกเบี้ย ภายใน 1 เดือน และรับสินค้าออกภายใน 3 เดือน**</font>
				</div>
				<div style="border: 0px solid #000; padding: 5px;">
					<table>
						<tr>
							<td style="border: 1px solid #000; padding: 5px;">
								<table>
									<tr>
										<td valign="top" align="center">
											<!-- QR Code -->
											<img src="../../image/qrcode.jpg"/>
											<br />
											<span class="label-success" style="font-size: 14px;">Scan QR Code</span>
										</td>
										<td valign="top">
											<div>
												<table cellpadding="3">
													<tr>
														<td width="45">
															<img src="../../image/line.png" width="30"/>
														</td>
														<td align="left">
															@minnie.bns
														</td>
													</tr>
													<tr>
														<td>
															<img src="../../image/phone.png" width="30"/>
														</td>
														<td align="left">
															06-4239-8291
														</td>
													</tr>
													<tr>
														<td colspan="2">
															<?=$s_address;?>
														</td>
													</tr>
												</table>
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
					<table>
						<tr>
						<td width="60%"></td>
							<td align="center">
								<img src="../../image/sign/<?=$s_sign;?>" height="33"/>
							</td>
						</tr>
						<tr>
						<td></td>
							<td align="center">
								( <?=$s_name;?> )
							</td>
						</tr>
					</table>
			</td>
		</tr>
	</table>
	</div>
</div>

<?php
}
else{
	?>
	<div align="center">
	<br />
	<br />
	<br />
	<h1>
	กรุณากรอกข้อมูลที่จำเป็นด้วยค่ะ
	<br />
	<a href="../../module/bill/">ออกบิล</a>
	</h1>
	</div>
	<?php
}
?>
    </body>
</html>

<?php
$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
if($Android){
	
}else{
	
if($_GET[cre] == 1){
	

//*
$output = ob_get_contents();
ob_end_clean();
sleep(0);
require_once '../../vendorPdf/autoload.php';

$mpdf = new \Mpdf\Mpdf([
	'mode' => 'utf-8', 
	'default_font_size' => 15,
	'default_font' => 'thsarabunnew'
]);


$mpdf->SetWatermarkText('       Minnie_Brandname');
$mpdf->showWatermarkText = true;
//$mpdf->showImageErrors = true;
$mpdf->WriteHTML($output);
$mpdf->Output('pdf/'.$title_name.'.pdf','F');
//$mpdf->Output($title_name.'.pdf','I');

//*/
}

}

?>
<div align="center"><a href="pdf/<?=$title_name;?>.pdf"><h1>ดูบิลใบรับฝากสินค้า</h1></a></div>