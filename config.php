<?php
$host='localhost'; $db='abshiro_masjid'; $user='root'; $pass='';
date_default_timezone_set('Asia/Kolkata');
try {
 $pdo=new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4",$user,$pass,
 [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);
} catch(PDOException $e){ $pdo=null; }
?>