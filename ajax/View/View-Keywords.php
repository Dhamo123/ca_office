<?php
include '../../core/int.php';
// DB table to use
$table = 'keywords';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'k.id', 'dt' => 0, 'field' => 'id'),
    array( 'db' => 'k.keywords', 'dt' => 1 ,'field' => 'keywords'),
    array( 'db' => 'k.monthly_search_volume',     'dt' => 2,'field' => 'monthly_search_volume'),
    array( 'db' => 'k.difficulty',     'dt' => 3,'field' => 'difficulty'),
   // array( 'db' => 'k.createDate',     'dt' => 4,'field' => 'createDate'),
    array( 
                     'db' => 'k.createDate',  
                     'dt' => 4,
                     'formatter' => function($d, $row) use ($mysqli){
                       $agent = '<a href="javascript:void(0);" class="keywords_date" keywords="'.$row['keywords'].'" dataid="'.$row['id'].'" date="'.$row['createDate'].'">'.date('d/m/Y',strtotime($row['createDate'])).'</a>';
                        return $agent;
                    }
    ),
    array( 'db' => 'u.Username',     'dt' => 5,'field' => 'Username'),
    array( 'db' => 'k.start_position',     'dt' => 6,'field' => 'start_position'),
    /*array( 'db' => 'cn.name',     'dt' => 3,'field' => 'company_name','as' => 'company_name'),
    array( 'db' => 'b.name',     'dt' => 4,'field' => 'branch','as' => 'branch'),
    array( 'db' => 'c.position', 'dt' => 5, 'field' => 'position'),*/
);


 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.customized.class.php' );
 $joinQuery = "FROM `{$table}` AS `k` LEFT JOIN `customer` AS `u` ON (`k`.`added_by` = `u`.`customer_id`) LEFT JOIN `company` As c ON (`k`.`company_id` = `c`.`company_id`)" ;

$extraCondition = "k.company_id='".$_GET['id']."'";

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraCondition)
);