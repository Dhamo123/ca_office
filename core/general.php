<?php  include 'database.php';

function randNum() {
 return abs(rand(100000000000000, 900000000000000)); 
}

function get_app_name() {
  global $con;
  $get = mysqli_query($con, "select App_Name from settings where S_ID = 1");
  $show = mysqli_fetch_array($get);
  return $show['App_Name'];
}

function clean_url_title($string) {
    $string = strtolower(trim($string));
    $string = str_replace("'", '', $string);
    $string = str_replace('"', '', $string);
    $string = str_replace(':', '', $string);
    $string = str_replace(" ", '-', $string);
    return $string;
}

function sanitize($data)
{
   global $con;
   $secureString = mysqli_real_escape_string($con, $data);
   return $secureString;
}

function mysqli_result($result, $row, $field = 0) {
    $result->data_seek($row);
    $data = $result->fetch_array();
    return $data[$field];
}

function output_errors($errors) {
	$output = array();
	return '<ul style="list-style-type:none; font-size:90%; text-align:center; color:red;"><li>' . implode('</li></li>', $errors) . '</li></ul>';
}

function protect_page() {
	if(logged_in() === false) {
		header('Location: index.php');	
		exit();
	}

}

function logged_in_redirect() {
	if(logged_in() === true) {
		header('Location: dashboard');
		exit();	
	}
}


?>