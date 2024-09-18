<?php 

include('../core/int.php');


$phone = $_POST['phone'];
// Check its existence (for example, execute a query from the database) ...

if(mobile_exists($con, $phone) === true ) {
	$isAvailable = false;
} else {
	$isAvailable = true;
}



 // or false

// Finally, return a JSON
echo json_encode(array(
    'valid' => $isAvailable,
));

?>