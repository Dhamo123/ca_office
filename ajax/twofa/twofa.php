<?php
//error_reporting('ALL'); 

include '../../core/int.php';
include '../../vendor/autoload.php';
require_once '../../GoogleAuth/googleLib/GoogleAuthenticator.php';
$data = array();
$id = $_POST['customer_id'];
$get = mysqli_query($con, "select * from customer where customer_id = '$id'");
while ($show = mysqli_fetch_array($get)) {


	/*$data = array(
			'customer_id' => $show['customer_id'],
			'name' => $show['name'],
			'mobile' => $show['mobile'],
			'address' => $show['address'],
			'email' => $show['email'],
			'telephone' => $show['telephone'],
			'image' => $show['image'],
			'Username' => $show['Username'],
			'dob' => date('d-m-Y', strtotime($show['dob']))
			);*/
			if($_POST['two_fa_flag']=='true'){
				$ga = new GoogleAuthenticator();
				$secret = $ga->createSecret();
				$qrCodeUrl = $ga->getQRCodeGoogleUrl('CBM', $secret);
				$sql ="UPDATE customer SET two_fa_flag='1', two_fa_key='".$secret."', two_fa_img='".$qrCodeUrl."' WHERE customer_id='".$show['customer_id']."'";
				mysqli_query($con, $sql);
				$data = array(
					'two_fa_img' => $qrCodeUrl,
				);
				echo json_encode($data);
			}else {
				$sql ="UPDATE customer SET two_fa_flag='0', two_fa_key='', two_fa_img='',two_fa_verify='0' WHERE customer_id='".$show['customer_id']."'";
				mysqli_query($con, $sql);
				$data = array(
					'two_fa_img' => '',
				);
				echo json_encode($data);
			}
}


//$ga = new GoogleAuthenticator();




?>
