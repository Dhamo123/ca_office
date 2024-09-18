<?php

include '../../core/int.php';
$value = $_POST;

$target_path = $document;  
  	$file1 = time().$_FILES['id_card_f']['name'];
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
	}
	
    $sql_insert ="INSERT INTO employees (name,surname,national_ID,address,countryId,countryCode,phoneNumber,bank,account_number,account_name,swift,other,salary,deduction,start_date,id_card_f,id_card_b,proof_address,proof_bank,zip,leaveDays,company_id,branch,position) VALUES('".$value['username']."','".$value['surname']."','".$value['nationalid']."','".$value['address']."','".$value['countryId']."','".$value['countryCode']."','".$value['phoneNumber']."','".$value['bank']."','".$value['account_number']."','".$value['account_name']."','".$value['swift']."','".$value['other']."','".$value['salary']."','".$value['deduction']."','".$value['start_date']."','".basename( $file1)."','".basename( $file2)."','".basename( $file3)."','".basename( $file4)."','".$value['zip']."','".$value['leaveDays']."','".$value['company_id']."','".$value['branch']."','".$value['position']."')" ;
    	
	if (mysqli_query($con, $sql_insert)) {
	  echo "New record created successfully";
	} else {
	  echo "Error: " . $sql_insert . "<br>" . mysqli_error($con);
	}

	mysqli_close($con);
	//header('Location: ../../employee');
?>

