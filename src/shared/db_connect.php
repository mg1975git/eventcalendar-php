<?php
session_start();
require_once('shared/lang.php');
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "eventcalendar";
define('SCHEMA_DB', 'eventcalendar');
try{
    $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
}catch(mysqli_sql_exception $e) {
    $_SESSION["message"] = LOGIN_CONN_ERR[$lang];
    header("Location: ./login.php");
    exit();
}
?>