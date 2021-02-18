<?php
session_start();

$servername = "localhost";
$dbname='visitaberdeen';
$username = "root";
$password = "";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
 die("Connection failed: " . $db->connect_error);
}

?>