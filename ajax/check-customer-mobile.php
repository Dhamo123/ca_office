<?php 

include('../core/int.php');


$mobile = $_POST['mobile'];

if(customer_mobile_exists($con, $mobile) === true ) {
	$isAvailable = false;
} else {
	$isAvailable = true;
}

// Finally, return a JSON
echo json_encode(array(
    'valid' => $isAvailable,
));

?>