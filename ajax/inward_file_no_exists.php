<?php 

include('../core/int.php');


$file = $_POST['fileno'];
$id = $_POST['id'];

if(inward_file_no_exists($con, $file,$id) === true ) {
	$isAvailable = false;
} else {
	$isAvailable = true;
}

// Finally, return a JSON
echo json_encode(array(
    'valid' => $isAvailable,
));

?>