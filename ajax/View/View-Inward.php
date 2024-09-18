<?php
include '../../core/int.php';
// DB table to use
$table = 'inward';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'id', 'dt' => 0 ),
    array( 'db' => 'username', 'dt' => 1 ),
    array( 'db' => 'pan', 'dt' => 2 ),
    array( 'db' => 'adhar', 'dt' => 3 ),
    array( 'db' => 'mobile', 'dt' => 4 ),
    array( 'db' => 'email', 'dt' => 5 ),
    array( 'db' => 'fileno', 'dt' => 6 ),
    array( 'db' => 'return_type', 'dt' => 7 ),
);


 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);