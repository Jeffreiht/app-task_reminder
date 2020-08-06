<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'app';

try {
    $conexion = new PDO("mysql:host=$server; dbname=$database;",$username,$password);
} catch (PDOException $e) {
    die("Conection Failled: " . $e->getMessage());
}
?>