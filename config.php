<?php
// config.php

$host = 'localhost';
$db   = 'ziyaretci_defteri';
$user = 'root'; // XAMPP varsayılan kullanıcı adı
$pass = '';     // XAMPP varsayılan şifresi (genellikle boş)
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Hata modunu ayarla
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Varsayılan fetch modunu ayarla
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Gerçek prepared statements kullan
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Hata durumunda mesaj göster
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
