<?php include '../../core/int.php';
include('../../abeautifulsite/SimpleImage.php');
if($_SESSION['permission_edit']!=='Yes'){
	echo 'You don;t have permission';http_response_code(500);exit();
}
$img = new abeautifulsite\SimpleImage();

if(isset($_FILES["image"]["type"])) {

	

} else {

	

	$fileno = $_POST['fileno'];
	$pan = $_POST['pan'];
	$adhar = $_POST['adhar'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$mobile = $_POST['mobile'];
	$username = $_POST['username'];
	$return_type = $_POST['return_type'];
	
	$id = $_POST['inwardid'];
	
	$get = mysqli_query($con, "select * from inward where fileno = '$fileno' AND id != '$id'");
	$show = mysqli_num_rows($get);
	if($show>0){
		 echo 'fileno duplicate';http_response_code(500);exit();
	}
	
	
	
	mysqli_query($con, "update inward set fileno = '$fileno',  email = '$email',  pan = '$pan',  adhar = '$adhar',  address = '$address',  mobile = '$mobile',  username = '$username', return_type = '$return_type' where id = '$id'");
	
	if($_POST['bankname']){
		for($i=0;$i<count($_POST['bankname']);$i++){
			if(!empty($_POST['bankname'][$i]) && empty($_POST['bankid'][$i])){
				mysqli_query($con, "insert into bank_detail (inward, bank,ifsc,account_number) values('".$_POST['inwardid']."', '".$_POST['bankname'][$i]."','".$_POST['ifsc'][$i]."','".$_POST['accountno'][$i]."')");
			}else if(!empty($_POST['bankname'][$i]) && !empty($_POST['bankid'][$i])){
				mysqli_query($con, "UPDATE bank_detail SET bank='".$_POST['bankname'][$i]."',ifsc='".$_POST['ifsc'][$i]."',account_number='".$_POST['accountno'][$i]."'  WHERE id='".$_POST['bankid'][$i]."'");
			}
		}
	}
}
mysqli_close($con);
?>