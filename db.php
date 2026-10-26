<?php

$host="localhost";
$userName = "root";
$password = "root";
$database = "HorizoBank";

$connection = new mysqli(
    $host,
    $userName,
    $password,
    $database
);

/*  if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

echo "Database connected successfully!"."\n";
 $connection->close(); */

?>