<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__.'/../config.php';
if(!$pdo){http_response_code(500);echo json_encode(['ok'=>false]);exit;}
$m=$_GET['month']??date('Y-m');
$s=$pdo->prepare("SELECT prayer_date,fajr,dhuhr,asr,maghrib,isha FROM prayer_times WHERE DATE_FORMAT(prayer_date,'%Y-%m')=? ORDER BY prayer_date");
$s->execute([$m]);echo json_encode(['ok'=>true,'month'=>$m,'data'=>$s->fetchAll()],JSON_UNESCAPED_UNICODE);
?>