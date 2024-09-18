<?php
include '../../core/int.php';
// DB table to use
$table = 'customer';
 
// Table's primary key
$primaryKey = 'customer_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$columns = array(
    array( 'db' => 'customer_id', 'dt' => 0, 'field' => 'customer_id'),
    array( 'db' => 'Username', 'dt' => 1 ,'field' => 'Username'),
    array( 'db' => 'email',     'dt' => 2,'field' => 'email'),
    array( 'db' => 'code',     'dt' => 3,'field' => 'code'),
    
    /*array( 'db' => 'cn.name',     'dt' => 3,'field' => 'company_name','as' => 'company_name'),
    array( 'db' => 'b.name',     'dt' => 4,'field' => 'branch','as' => 'branch'),
    array( 'db' => 'c.position', 'dt' => 5, 'field' => 'position'),*/
);

 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.customized.class.php' );
 $joinQuery = "FROM `{$table}`  " ;

    $extraCondition = "role='admin'";

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraCondition)
);