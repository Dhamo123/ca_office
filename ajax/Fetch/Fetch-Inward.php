<?php include '../../core/int.php';
$data = array();
$id = $_POST['id'];
$get = mysqli_query($con, "select * from inward where id = '$id'");
while ($show = mysqli_fetch_assoc($get)) {
	
	$get_branch = mysqli_query($con, "select * from bank_detail where inward = '$id'");
	while ($show_branch = mysqli_fetch_assoc($get_branch)) {
		$show['bank'][] = $show_branch;
	}
	$data = $show;
}
mysqli_close($con);
echo json_encode($data);
?>