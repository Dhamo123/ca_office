<?php 
include ('core/int.php');

/*$sql ="UPDATE customer SET two_fa_verify='0' WHERE customer_id='".$_SESSION['customer_id']."'";
mysqli_query($con, $sql);*/
@session_start();
@session_destroy();

header('Location: index.php');
?>
