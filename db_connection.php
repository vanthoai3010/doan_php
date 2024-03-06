<?php
// Thay đổi các thông tin cơ sở dữ liệu cho phù hợp với cấu hình của bạn
$host = "localhost";
$dbname = "karmashop";
$username = "root";
$password = "";

// Kết nối đến cơ sở dữ liệu
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
