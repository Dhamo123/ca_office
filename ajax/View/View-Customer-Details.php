<?php include '../../core/int.php';
$id = $_POST['id'];
$get = mysqli_query($con, "select * from customer where customer_id = '$id'");
$show = mysqli_fetch_array($get); ?>
<table class="table table-bordered">
	<tr>
		<th>Photo:</th>
		<td><img src="dist/img/customer/<?php echo $show['image']; ?>" width="200" class="img-thumbnail"></td>
	</tr>
	<tr>
		<th>Name:</th>
		<td><?php echo $show['name']; ?></td>
	</tr>
	<tr>
		<th>DOB:</th>
		<td><?php echo date('d F Y', strtotime($show['dob'])); ?></td>
	</tr>
	<tr>
		<th>Mobile:</th>
		<td><?php echo $show['mobile']; ?></td>
	</tr>
	<tr>
		<th>Telephone:</th>
		<td><?php echo $show['telephone']; ?></td>
	</tr>
	<tr>
		<th>Address:</th>
		<td><?php echo $show['address']; ?></td>
	</tr>
</table>