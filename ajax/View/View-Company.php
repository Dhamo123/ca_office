<?php
include '../../core/int.php';
// DB table to use
$table = 'company';
 
// Table's primary key
$primaryKey = 'company_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    //array( 'db' => 'company_id', 'dt' => 0 ,"seo" => '122'),
    array( 
                     'db' => 'company_id',  
                     'dt' => 0,
                     'formatter' => function($d, $row) use ($mysqli){
                       $agent = '<span  seo='.$row['seo'].' class="seo_id" >'.$row['company_id'].'</span>';
                        return $agent;
                    }
    ),
    array( 
                     'db' => 'name',  
                     'dt' => 1,
                     'formatter' => function($d, $row) use ($mysqli){
                       $agent = '<span  seo='.$row['seo'].' class="seo_id" >'.$row['name'].'</span>';
                        return $agent;
                    }
    ),
    array( 
                     'db' => 'email',  
                     'dt' => 2,
                     'formatter' => function($d, $row) use ($mysqli){
                       $agent = '<span seo='.$row['seo'].' class="seo_id" >'.$row['email'].'</span>';
                        return $agent;
                    }
    ),
     array( 'db' => 'seo',     'dt' => 3 ),
  
    
);


 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);