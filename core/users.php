 <?php include 'database.php';

 function get_customer_mobile($con, $id) {
 	$get = mysqli_query($con, "select mobile from customer where customer_id = '$id'");
 	$show = mysqli_fetch_array($get);
 	return $show['mobile'];
 }

 function get_customer_name($con, $id) {
 	$get = mysqli_query($con, "select name from customer where customer_id = '$id'");
 	$show = mysqli_fetch_array($get);
 	return $show['name'];
 }


 function get_count_by_ref($con, $table, $column, $id) {
 	$query = "select ".$column." from ".$table." where ".$column." = ".$id;
 	$get = mysqli_query($con, $query);
 	$show = mysqli_num_rows($get);
 	return $show;
 }

function customer_mobile_exists($con, $mobile) {
	$mobile = sanitize($mobile);
    $query = "SELECT COUNT(customer_id) FROM `customer` WHERE `mobile` = '$mobile'";
    $result = mysqli_query($con,$query);
    list($count) = mysqli_fetch_row($result);
    return ($count) ? true : false;
}
function inward_file_no_exists($con, $file, $id) {
	$mobile = sanitize($file);
	$id = sanitize($id);
	if(isset($id) && !empty($id)){
		$query = "SELECT COUNT(id) FROM `inward` WHERE `fileno` = '$file' AND `id`!='$id'";
	}else{
		$query = "SELECT COUNT(id) FROM `inward` WHERE `fileno` = '$file'";
	}
    
    $result = mysqli_query($con,$query);
    list($count) = mysqli_fetch_row($result);
    return ($count) ? true : false;
}

function Get_User_Name($con, $id) {
	$id = $id;
	$get = mysqli_query($con, "select * from users where user_id = '$id'");
	$show = mysqli_fetch_array($get);
	return $show['First_Name'].' '.$show['Last_Name'];
}	

function Get_User_First_Name($con, $id) {
	$id = $id;
	$get = mysqli_query($con, "select * from users where user_id = '$id'");
	$show = mysqli_fetch_array($get);
	return $show['First_Name'];
}

function is_admin($con, $user_id) {
	$user_id = (int)$user_id;
    $query = "select COUNT(user_id) from users where user_id = '$user_id' AND Type = 1";
    $result = mysqli_query($con,$query);
    list($count) = mysqli_fetch_row($result);
    return ($count) ? true : false;
}


function user_data($con, $user_id) {
	$data = array();
	$user_id = (int)$user_id;
	
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	
	if($func_num_args > 1) {
		unset($func_get_args[0]);
		unset($func_get_args[1]);
		
		$fields = '`' .  implode('`, `', $func_get_args) . '`';
		$query = "SELECT $fields FROM `customer` WHERE `customer_id` = $user_id";
		$result = mysqli_query($con,$query);
		$data = mysqli_fetch_assoc($result);
				
		return $data;
		
	}
	
}

function logged_in() {
	return (isset($_SESSION['customer_id']) ? true : false);	
}

function user_exists($con, $username) {
	$username = sanitize($username);
    $query = "SELECT COUNT(`customer_id`) FROM `customer` WHERE `Username` = '$username'";
    $result = mysqli_query($con,$query);
    list($count) = mysqli_fetch_row($result);
    return ($count) ? true : false;
}

function user_active($con, $username) {
	$username = sanitize($username);
    $query = "SELECT COUNT(`customer_id`) FROM `customer` WHERE `Username` = '$username' AND `status` = 'Active'";
    $result = mysqli_query($con,$query);
    list($count) = mysqli_fetch_row($result);
    return ($count) ? true : false;
}

function user_id_from_username($con, $username) {
	$username = sanitize($username);
    $query = "select customer_id FROM customer WHERE Username = '$username'";
    $result = mysqli_query($con,$query);
    list($count) = mysqli_fetch_row($result);
    return ($count);
}

function login($con, $username, $password) {
	$user_id = user_id_from_username($con, $username);
	
	$username = sanitize($username);
	$password = md5($password); 
	
    $query = "SELECT COUNT(`customer_id`) FROM `customer` WHERE `Username` = '$username' AND `Password` = '$password'";
    $result = mysqli_query($con,$query);
    list($count) = mysqli_fetch_row($result);
    return ($count) ? $user_id : false;
}

function mobile_exists($con, $mobile) {
	$mobile = sanitize($mobile);
    $query = "SELECT COUNT(user_id) FROM `users` WHERE `Mobile` = '$mobile'";
    $result = mysqli_query($con,$query);
    list($count) = mysqli_fetch_row($result);
    return ($count) ? true : false;
}

function mobile_active($con, $mobile) {
	$username = sanitize($username);
    $query = "SELECT COUNT(`user_id`) FROM `users` WHERE `Mobile` = '$mobile' AND `Active` = 1";
    $result = mysqli_query($con,$query);
    list($count) = mysqli_fetch_row($result);
    return ($count) ? true : false;
}

function user_id_from_mobile($con, $mobile) {
	$mobile = sanitize($mobile);
    $query = "select user_id FROM users WHERE Mobile = '$mobile'";
    $result = mysqli_query($con,$query);
    list($count) = mysqli_fetch_row($result);
    return ($count);
}


function login_mobile($con, $mobile, $password) {
	$user_id = user_id_from_mobile($con, $mobile);
	
	$mobile = sanitize($mobile);
	$password = md5($password); 
	
    $query = "SELECT COUNT(`user_id`) FROM `users` WHERE `Mobile` = '$mobile' AND `Password` = '$password'";
    $result = mysqli_query($con,$query);
    list($count) = mysqli_fetch_row($result);
    return ($count) ? $user_id : false;
}


 ?>