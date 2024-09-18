<?php

include '../../core/int.php';
$value = $_POST;
if($_SESSION['permission_add']!=='Yes'){
	echo 'You don;t have permission';http_response_code(500);exit();
}
$target_path = $document;  
  	/*$file1 = time().$_FILES['id_card_f']['name'];
  	$file2 = time().$_FILES['id_card_b']['name'];
  	$file3 = time().$_FILES['proof_address']['name'];
  	$file4 = time().$_FILES['proof_bank']['name'];

	$target_path1 = $target_path.basename( $file1);   
	$target_path2 = $target_path.basename( $file2);   
	$target_path3 = $target_path.basename( $file3);   
	$target_path4 = $target_path.basename( $file4);   
	if(basename($_FILES['id_card_f']['name'])==''){
  		$file1 = '';
  	}
  	if(basename($_FILES['id_card_b']['name'])==''){
  		$file2 = '';
  	}
  	if(basename($_FILES['proof_address']['name'])==''){
  		$file3 = '';
  	}
  	if(basename($_FILES['proof_bank']['name'])==''){
  		$file4 = '';
  	}
  	//echo $target_path1; exit();
	if(move_uploaded_file($_FILES['id_card_f']['tmp_name'], $target_path1)) {  
	    echo "File uploaded successfully!";  
	}
	if(move_uploaded_file($_FILES['id_card_b']['tmp_name'], $target_path2)) {  
	    echo "File uploaded successfully!";  
	} 
	if(move_uploaded_file($_FILES['proof_address']['tmp_name'], $target_path3)) {  
	    echo "File uploaded successfully!";  
	} 
	if(move_uploaded_file($_FILES['proof_bank']['tmp_name'], $target_path4)) {  
	    echo "File uploaded successfully!";  
	}*/
	
    $sql_insert ="INSERT INTO inward (pan,adhar,mobile,email,username,address,fileno,return_type) VALUES('".$value['pan']."','".$value['adhar']."','".$value['mobile']."','".$value['email']."','".$value['username']."','".$value['address']."','".$value['fileno']."','".$value['return_type']."')" ;
    	
	if (mysqli_query($con, $sql_insert)) {
		$last_id = mysqli_insert_id($con);
		if($_POST['bankname']){
			for($i=0;$i<count($_POST['bankname']);$i++){
				if(!empty($_POST['bankname'][$i])){
					mysqli_query($con, "insert into bank_detail (inward,bank,ifsc,account_number) values('".$last_id."','".$_POST['bankname'][$i]."', '".$_POST['ifsc'][$i]."','".$_POST['accountno'][$i]."')");
				}
			}
		}
	  echo "New record created successfully";
	} else {
	  echo "Error: " . $sql_insert . "<br>" . mysqli_error($con);
	}

	mysqli_close($con);
	//header('Location: ../../employee');
?>

