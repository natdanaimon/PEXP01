<?php
@session_start();
$s_address = $_SESSION['s_address'];
$s_logo = $_SESSION['s_logo'];
$s_sign = $_SESSION['s_sign'];
$s_name = $_SESSION['s_name'];

function calculator_per($pPos,$pEarned){
$total = ($pPos*$pEarned) / 100;
return $total;
}
$title_name = date('ymdHis').'_'.$_POST[s_name];
ob_start();
?>
<html lang="en" >
    <!-- begin::Head -->
 		<title><?=$title_name;?></title>
    <!-- end::Head -->
    <!-- end::Body -->
    <body  class=""  >     <!-- begin:: Page -->
<?php
if($_POST['s_name']){

$s_product = file_get_contents($_FILES["s_product"]["tmp_name"]); 
$s_slip = file_get_contents($_FILES["s_slip"]["tmp_name"]); 


$typeproduct = explode('.', $_FILES["s_product"]["name"]);
$typeproduct = strtolower($typeproduct[count($typeproduct)-1]);

$typeslip = explode('.', $_FILES["s_slip"]["name"]);
$typeslip = strtolower($typeslip[count($typeslip)-1]);

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
				if($_FILES["s_product"]["name"]){
					echo sprintf('<img src="data:image/'.$typeproduct.';base64,%s" width="230"  />', base64_encode($s_product));
				}else{
					?>
					<img src="../../image/noimage.gif" width="230" />
					<?php
				}
				
				?>
				<br />
				<br />
				<?php
				if($_FILES["s_slip"]["name"]){
				echo sprintf('<img src="data:image/'.$typeslip.';base64,%s" width="230"  />', base64_encode($s_slip));
				}else{
					?>
					<img src="../../image/noimage.gif" width="230" />
					<?php
				}
				?>
				<!-- Slip -->
			</td>
			<td valign="top">
				<!-- Detail -->
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
					<!--<tr>
						<td><strong>ค่าดำเนินการ</strong></td>
						<td align="left"><?=$_POST[i_commission1];?>% : <?=number_format($t_com,2);?>-.</td>
						<td><strong>อัตราดอกเบี้ย</strong></td>
						<td align="left"><?=$_POST[i_vat1];?>% : <?=number_format($t_vat,2);?>-.</td>
					</tr>-->
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
				<div style="border: 1px solid #000; padding: 5px;">
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

 







}else{
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

        <!--begin::Page Vendors -->
        <!--<script src="../../assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>-->
        <!--end::Page Vendors -->  
        <!--begin::Page Snippets -->

        <!--end::Page Snippets -->
    </body>
    <!-- end::Body -->
</html>
<?php
$output = ob_get_contents();
ob_end_clean();
require_once __DIR__ . '/../../vendorPdf/autoload.php';

$mpdf = new \Mpdf\Mpdf([
	'mode' => 'utf-8', 
	'default_font_size' => 15,
	'default_font' => 'thsarabunnew'
]);


$mpdf->SetWatermarkText('       Minnie_Brandname');
$mpdf->showWatermarkText = true;
$mpdf->WriteHTML($output);
$mpdf->Output($title_name.'.pdf','I');
?>
