<?php 

include('../core/int.php');


$username = $_POST['username'];
// Check its existence (for example, execute a query from the database) ...

if(user_exists($con, $username) === true ) {
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