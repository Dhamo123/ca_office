<?php
//error_reporting('ALL'); 

include '../../core/int.php';
include '../../vendor/autoload.php';
require_once '../../GoogleAuth/googleLib/GoogleAuthenticator.php';
$data = array();
$id = $_SESSION['customer_id'];
$get = mysqli_query($con, "select * from customer where customer_id = '$id'");
while ($show = mysqli_fetch_array($get)) {

			
				$ga = new GoogleAuthenticator();
				//$secret = $ga->createSecret();
				//$qrCodeUrl = $ga->getQRCodeGoogleUrl($show['email'], $secret,'CBM');
				$checkResult = $ga->verifyCode(trim($show['two_fa_key']), trim($_POST['two_fa_code']), 5);
				if ($checkResult)
				{
					$sql ="UPDATE customer SET two_fa_verify='1' WHERE customer_id='".$show['customer_id']."'";
					$_SESSION['two_fa_verify_flag']=true;
					mysqli_query($con, $sql);
					echo 'SUCCESS';
				}
				else
				{
					echo 'FAILED';
					$_SESSION['two_fa_verify_flag']=false;
				}
				
				
				//echo json_encode($show);
			
}


//$ga = new GoogleAuthenticator();




?>
