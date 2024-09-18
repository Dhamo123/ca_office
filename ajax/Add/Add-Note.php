<?php

include '../../core/int.php';
$value = $_POST;
if($_SESSION['permission_add']!=='Yes'){
	echo 'You don;t have permission';http_response_code(500);exit();
}

  mysqli_query($con, "INSERT INTO notes (description,inward,user) VALUES('".$value['note']."','".$value['inward_note']."','".$_SESSION['customer_id']."')");	
	
	mysqli_close($con);
	//header('Location: ../../employee');
?>

