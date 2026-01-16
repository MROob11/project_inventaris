<?php
$host = 'localhost';
$dbname = 'db_inventaris';
$username = 'root';
$password = '';

try {
    $pdo_temp = new PDO("mysql:host=$host", $username, $password);
    $pdo_temp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo_temp->exec("CREATE DATABASE IF NOT EXISTS `$dbname`");
    $pdo_temp = null;

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>