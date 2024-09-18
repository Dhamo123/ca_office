<?php include '../../core/int.php';
include('../../abeautifulsite/SimpleImage.php');
if($_SESSION['permission_add']!=='Yes'){
	echo 'You don;t have permission';http_response_code(500);exit();
}

$img = new abeautifulsite\SimpleImage();

if(isset($_FILES["image"]["type"])) {

	$Username = $_POST['Username'];
	/*$mobile = $_POST['mobile'];
	$telephone = $_POST['telephone'];*/
	$password = md5($_POST['password']);
	$show_password = $_POST['password'];
	$email = $_POST['email'];
	$code = $_POST['code'];
	
	$telephone = $_POST['telephone'];
	/*$dob = date('Y-m-d', strtotime($_POST['dob']));
	$address = $_POST['address'];
	$image = randNum().$_FILES["image"]["name"];
	$image_tmp = $_FILES["image"]["tmp_name"];
	$path = '../../dist/img/customer/'.$image;
	$img->load($image_tmp);
	$img->save($path);*/
	$permission_add = (array_key_exists("permission_add",$_POST))?$_POST['permission_add']:'No';
	$permission_edit = (array_key_exists("permission_edit",$_POST))?$_POST['permission_edit']:'No';
	$permission_delete = (array_key_exists("permission_delete",$_POST))?$_POST['permission_delete']:'No';

	mysqli_query($con, "insert into customer (Username, email, password, code, telephone, show_password, permission_add, permission_edit, permission_delete) values('$Username', '$email', '$password','$code', '$telephone','$show_password', '$permission_add', '$permission_edit', '$permission_delete')");

} else {

	$Username = $_POST['Username'];
	/*$mobile = $_POST['mobile'];
	$telephone = $_POST['telephone'];*/
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	/*$dob = date('Y-m-d', strtotime($_POST['dob']));
	$address = $_POST['address'];*/
	$code = $_POST['code'];
	$show_password = $_POST['password'];
	$permission_add = (array_key_exists("permission_add",$_POST))?$_POST['permission_add']:'No';
	$permission_edit = (array_key_exists("permission_edit",$_POST))?$_POST['permission_edit']:'No';
	$permission_delete = (array_key_exists("permission_delete",$_POST))?$_POST['permission_delete']:'No';
	
	$telephone = $_POST['telephone'];
	$get = mysqli_query($con, "select * from customer where Username = '$Username' ");
	$show = mysqli_num_rows($get);
	if($show>0){
		 echo 'Username duplicate';http_response_code(500);exit();
	}
	$get = mysqli_query($con, "select * from customer where email = '$email'");
	$show = mysqli_num_rows($get);
	if($show>0){
		 echo 'Email duplicate';http_response_code(500);exit();
	}
	$get = mysqli_query($con, "select * from customer where code = '$code'");
	$show = mysqli_num_rows($get);
	if($show>0){
		 echo 'Code duplicate';http_response_code(500);exit();
	}
	mysqli_query($con, "insert into customer (Username, email, password, code, telephone, show_password, permission_add, permission_edit, permission_delete) values('$Username', '$email', '$password','$code', '$telephone','$show_password', '$permission_add', '$permission_edit', '$permission_delete')");

}
mysqli_close($con);
?>