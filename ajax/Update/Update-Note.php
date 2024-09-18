<?php include '../../core/int.php';
include('../../abeautifulsite/SimpleImage.php');
if($_SESSION['permission_edit']!=='Yes'){
	echo 'You don;t have permission';http_response_code(500);exit();
}
$img = new abeautifulsite\SimpleImage();

if(isset($_FILES["image"]["type"])) {

	

} else {

	$note = $_POST['note'];
	
	$user = $_SESSION['customer_id'];
	
	$id = $_POST['inward_note'];
	
	mysqli_query($con, "update notes set description = '$note', createdDate='".date('Y-m-d H:i:s')."',  user = '$user' where id = '$id'");
	
	
}
mysqli_close($con);
?>