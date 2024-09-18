<?php  include('../core/int.php');  

	
	if(empty($_POST) === false) {
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if(empty($username) === true || empty($password) === true) {
			$errors[] = 'You need to enter a username No. and password';
		} else if(user_exists($con,$username) === false) {
			$errors[] = 'We can\'t find that username No. Have you registered';	
		} else if(user_active($con,$username) === false) {
			$errors[] = 'You haven\'t activated your account';	
		} else {
			
			if(strlen($password) > 32) {
					$errors[] = 'Password too long';	
				}
			$login = login($con, $username, $password);
			if($login === false) {
				$errors[] = 'That username / password combination is incorrect';	
			} else {
				
				$_SESSION['customer_id'] = $login;
				echo $sec = "1";
				exit();
			}
			
		}
		
		echo output_errors($errors);
		
	}
	
	 ?>
      
