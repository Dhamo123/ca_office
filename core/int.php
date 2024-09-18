<?php 
session_start();
ob_start();
//error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set("Asia/Kolkata");
require 'database.php';
require 'users.php';
require 'general.php';
//$rootfolder = 'https://corbel-international.com/cbm/';
$rootfolder = 'http://localhost/accounting/';
//$base_url = 'https://corbel-international.com/cbm';
$base_url = 'http://localhost/accounting';
$document = '../../document/';

if(logged_in() === true) {
	$session_user_id = $_SESSION['customer_id'];
	$user_data = user_data($con, $session_user_id,'customer_id', 'Username', 'status',  'First_Name', 'Last_Name', 'telephone', 'role', 'permission_add', 'permission_edit', 'permission_delete');
	$_SESSION['role'] = $user_data['role'];
	$_SESSION['permission_add'] = $user_data['permission_add'];
	$_SESSION['permission_edit'] = $user_data['permission_edit'];
	$_SESSION['permission_delete'] = $user_data['permission_delete'];
	if(user_active($con, $user_data['Username']) === false) {
		session_destroy();
		header('Location: index.php');
		exit();	
	}
}



$errors = array();


?>