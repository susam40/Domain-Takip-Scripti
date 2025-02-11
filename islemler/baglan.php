<?php
session_start();
$host = "localhost";
$veritabani_ismi = "domaintakip";
$kullanici_adi = "root";
$sifre = "";

try {
    $db = new PDO("mysql:host=$host; dbname=$veritabani_ismi;charset=utf8", $kullanici_adi, $sifre);
} catch (Exception $e) {
    echo $e->getMessage();
}
$sorgu = $db->prepare("SELECT * FROM ayarlar");
// ayarlar tablosundan bütün verileri çeker
$sorgu->execute();
$ayarcek = $sorgu->fetch(PDO::FETCH_ASSOC);

?>