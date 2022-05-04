<?php 

define ("HOST_NAME", "localhost");
define ("HOST_USER", "piotr");
define ("HOST_PASSWORD", "admin@allboards");
define ("DB_NAME", "allboards_products");

// $db = mysqli_connect('localhost', 'piotr', 'admin@allboards', 'allboards_products');
$dbConnection = mysqli_connect(HOST_NAME, HOST_USER, HOST_PASSWORD, DB_NAME);

if(!$dbConnection) {
    echo 'Connection error: ' . mysqli_connect_error();
} 

;?>
