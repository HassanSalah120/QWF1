<?php

$host="localhost";
$user="root";
$password="";
$dbName="QWF";

$conn = mysqli_connect($host , $user , $password , $dbName);

// check if the connection was successful
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// In configDB.php
// Create a function to retrieve stdID based on stdName


?>