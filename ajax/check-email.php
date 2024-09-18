<?php 

include('../core/int.php');


$email = $_POST['email'];
// Check its existence (for example, execute a query from the database) ...

if(user_exists($con, $email) === true ) {
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