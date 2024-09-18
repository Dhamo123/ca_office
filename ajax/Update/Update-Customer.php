<?php include '../../core/int.php';
include('../../abeautifulsite/SimpleImage.php');
if($_SESSION['permission_edit']!=='Yes'){
	echo 'You don;t have permission';http_response_code(500);exit();
}
$img = new abeautifulsite\SimpleImage();

if(isset($_FILES["image"]["type"])) {

	$Username = $_POST['Username'];
	$email = $_POST['email'];
	$code = $_POST['code'];
	/*$dob = date('Y-m-d', strtotime($_POST['dob']));
	$address = $_POST['address'];*/
	$id = $_POST['id'];
	$telephone = $_POST['telephone'];
	$password = md5($_POST['password']);
	$show_password = $_POST['password'];
	$permission_add = (array_key_exists("permission_add",$_POST))?$_POST['permission_add']:'No';
	$permission_edit = (array_key_exists("permission_edit",$_POST))?$_POST['permission_edit']:'No';
	$permission_delete = (array_key_exists("permission_delete",$_POST))?$_POST['permission_delete']:'No';
	$get = mysqli_query($con, "select * from customer where Username = '$Username' AND customer_id != '$id'");
	$show = mysqli_num_rows($get);
	if($show>0){
		 echo 'Username duplicate';http_response_code(500);exit();
	}
	$get = mysqli_query($con, "select * from customer where email = '$email' AND customer_id != '$id'");
	$show = mysqli_num_rows($get);
	if($show>0){
		 echo 'Email duplicate';http_response_code(500);exit();
	}
	$get = mysqli_query($con, "select * from customer where code = '$code' AND customer_id != '$id'");
	$show = mysqli_num_rows($get);
	if($show>0){
		 echo 'Code duplicate';http_response_code(500);exit();
	}
	mysqli_query($con, "update customer set Username = '$Username',  email = '$email', code='$code', Password='$password' ,telephone = '$telephone', show_password='$show_password', permission_add='$permission_add', permission_edit='$permission_edit', permission_delete='$permission_delete' where customer_id = '$id'");

} else {
	$show_password = $_POST['password'];
	$Username = $_POST['Username'];
	/*$mobile = $_POST['mobile'];
	$umobile = $_POST['umobile'];
	if(empty($mobile)) {
		$mobile = $umobile;
	} else {
		$mobile = $mobile;
	}
	$telephone = $_POST['telephone'];*/
	$email = $_POST['email'];
	$code = $_POST['code'];
	/*$dob = date('Y-m-d', strtotime($_POST['dob']));
	$address = $_POST['address'];*/
	$id = $_POST['id'];
	$telephone = $_POST['telephone'];
	$password = md5($_POST['password']);
	$permission_add = (array_key_exists("permission_add",$_POST))?$_POST['permission_add']:'No';
	$permission_edit = (array_key_exists("permission_edit",$_POST))?$_POST['permission_edit']:'No';
	$permission_delete = (array_key_exists("permission_delete",$_POST))?$_POST['permission_delete']:'No';
	

	$get = mysqli_query($con, "select * from customer where Username = '$Username' AND customer_id != '$id'");
	$show = mysqli_num_rows($get);
	if($show>0){
		 echo 'Username duplicate';http_response_code(500);exit();
	}
	$get = mysqli_query($con, "select * from customer where email = '$email' AND customer_id != '$id'");
	$show = mysqli_num_rows($get);
	if($show>0){
		 echo 'Email duplicate';http_response_code(500);exit();
	}
	$get = mysqli_query($con, "select * from customer where code = '$code' AND customer_id != '$id'");
	$show = mysqli_num_rows($get);
	if($show>0){
		 echo 'Code duplicate';http_response_code(500);exit();
	}
	mysqli_query($con, "update customer set Username = '$Username',  email = '$email', code='$code', Password='$password' ,telephone = '$telephone', show_password='$show_password', permission_add='$permission_add', permission_edit='$permission_edit', permission_delete='$permission_delete' where customer_id = '$id'");

}
mysqli_close($con);
?>