<?php
//DBログイン
try {
    $pdo = new PDO('mysql:host=dev.jokazaki.net;dbname=company;charset=utf8', 'devs', '9876');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $Exception) {
    die('接続エラー：' . $Exception->getMessage());
}
?>