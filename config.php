<?php
$dsn = "mysql:host=127.0.0.1;port=3306;dbname=ec2_mysql_php;charset=utf8mb4";
$username = "root";
$password = "AvinashJ@ssw0rd!";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
?>
