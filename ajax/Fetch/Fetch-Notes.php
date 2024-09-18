<?php include '../../core/int.php';
$data = array();
$id = $_POST['id'];
$get = mysqli_query($con, "select * from notes where id = '$id'");
while ($show = mysqli_fetch_assoc($get)) {
	
	
	$data = $show;
}
mysqli_close($con);
echo json_encode($data);
?>