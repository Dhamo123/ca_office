<?php include '../../core/int.php';
$id = $_POST['id'];
if($_SESSION['permission_delete']!=='Yes'){
	echo 'You don;t have permission';http_response_code(500);exit();
}
/*$get = mysqli_query($con, "select image from customer where customer_id = '$id'");
$show  = mysqli_fetch_array($get);
if(!empty($show['image'])) {
	$path = '../../dist/img/customer/'.$show['image'];
	unlink($path);
}*/
mysqli_query($con, "delete from customer where customer_id = '$id'");
mysqli_close($con);
?>