<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="このページの説明文">
  <title>新規登録処理ページ</title>
</head>
<body>
<h1>新規登録処理ページ</h1>

<?php
session_start();
?>

<?php

try{
    $pdo = new PDO(
        'mysql:host=dev.jokazaki.net;dbname=company;charset=utf8',
        'devs',
        '9876'
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}catch(PDOException $Exception){
    die('接続エラー：' .$Exception->getMessage());
}

try{
    $sql = "INSERT INTO company.employees (employee_id, employee_code, employee_name, department_id, delete_flag, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $employee_id = $_SESSION['employee_id'];
    $employee_code = $_SESSION['employee_code'];
    $employee_name = $_SESSION['employee_name'];
    $department_id = $_SESSION['department_id'];
    $delete_flag = $_SESSION['delete_flag'];
    $created_at = $_SESSION['created_at'];
    $updated_at = $_SESSION['updated_at'];
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $employee_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $employee_code, PDO::PARAM_INT);
    $stmt->bindParam(3, $employee_name, PDO::PARAM_STR);
    $stmt->bindParam(4, $department_id, PDO::PARAM_INT);
    $stmt->bindParam(5, $delete_flag, PDO::PARAM_INT);
    $stmt->bindParam(6, $created_at, PDO::PARAM_STR);
    $stmt->bindParam(7, $updated_at, PDO::PARAM_STR);
    $stmt->execute();
    
}catch(PDOException $Exception){
    die('接続エラー：' .$Exception->getMessage());
}
?>

登録が完了しました。<br/>
<a href = "http://dev.jokazaki.net:8080/index.php">トップページに戻る</a>
</body>
</html>