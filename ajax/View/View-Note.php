<?php
include '../../core/int.php';
// DB table to use
$table = 'notes';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'n.id', 'dt' => 0, 'field' => 'id'),
    array( 'db' => 'i.fileno', 'dt' => 1 ,'field' => 'fileno'),
    array( 'db' => 'i.return_type', 'dt' => 2 ,'field' => 'return_type'),
    array( 'db' => 'c.Username',     'dt' => 3,'field' => 'Username'),
    array( 'db' => 'n.description', 'dt' => 4 ,'field' => 'description'),
    array( 'db' => 'i.username',     'dt' => 5,'field' => 'username'),
    array( 'db' => 'n.createdDate',     'dt' => 6,'field' => 'createdDate'),
    /*array( 
                     'db' => 'k.createDate',  
                     'dt' => 4,
                     'formatter' => function($d, $row) use ($mysqli){
                       $agent = '<a href="javascript:void(0);" class="keywords_date" keywords="'.$row['keywords'].'" dataid="'.$row['id'].'" date="'.$row['createDate'].'">'.date('d/m/Y',strtotime($row['createDate'])).'</a>';
                        return $agent;
                    }
    ),
    array( 'db' => 'u.Username',     'dt' => 5,'field' => 'Username'),
    array( 'db' => 'k.start_position',     'dt' => 6,'field' => 'start_position'),*/
    
);


 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.customized.class.php' );
 $joinQuery = "FROM `{$table}` AS `n` LEFT JOIN `customer` AS `c` ON (`n`.`user` = `c`.`customer_id`) LEFT JOIN `inward` As i ON (`n`.`inward` = `i`.`id`)" ;

$extraCondition = "";

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraCondition)
);