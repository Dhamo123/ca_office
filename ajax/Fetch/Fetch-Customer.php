<?php include '../../core/int.php';
$data = array();
$id = $_POST['id'];
$get = mysqli_query($con, "select * from customer where customer_id = '$id'");
while ($show = mysqli_fetch_array($get)) {
	$data = array(
			'customer_id' => $show['customer_id'],
			'Username' => $show['Username'],
			'email' => $show['email'],
			'telephone' => $show['telephone'],
			'code' => $show['code'],
			'Password' => $show['Password'],
			'show_password' => $show['show_password'],
			'permission_add' => $show['permission_add'],
			'permission_edit' => $show['permission_edit'],
			'permission_delete' => $show['permission_delete'],
			/*'mobile' => $show['mobile'],
			'address' => $show['address'],
			'email' => $show['email'],
			'telephone' => $show['telephone'],
			'image' => $show['image'],
			'Username' => $show['Username'],
			'dob' => date('d-m-Y', strtotime($show['dob']))*/
			);
}
mysqli_close($con);
echo json_encode($data);
?>