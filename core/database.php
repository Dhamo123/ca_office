<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "accounting";
$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$sql_details = array(
    'user' => $dbuser,
    'pass' => $dbpass,
    'db'   => $dbname,
    'host' => $dbhost
);

?>