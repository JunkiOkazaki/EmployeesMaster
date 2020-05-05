<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="このページの説明文">
  <title>編集処理ページ</title>
</head>
<body>
<h1>編集処理ページ</h1>
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
    $employee_id = $_SESSION['employee_id'];
    $employee_code = $_SESSION['employee_code'];
    $employee_name = $_SESSION['employee_name'];
    $department_id = $_SESSION['department_id'];
    $delete_flag = $_SESSION['delete_flag'];
    $created_at = $_SESSION['created_at'];
    $updated_at = $_SESSION['updated_at'];
    $sql = "UPDATE company.employees SET employee_code=?, employee_name=?, department_id=?, delete_flag=?, created_at=?, updated_at=? where employee_id =?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $employee_code, PDO::PARAM_INT);
    $stmt->bindParam(2, $employee_name, PDO::PARAM_STR);
    $stmt->bindParam(3, $department_id, PDO::PARAM_INT);
    $stmt->bindParam(4, $delete_flag, PDO::PARAM_INT);
    $stmt->bindParam(5, $created_at, PDO::PARAM_STR);
    $stmt->bindParam(6, $updated_at, PDO::PARAM_STR);
    $stmt->bindParam(7, $employee_id, PDO::PARAM_INT);
    $stmt->execute();
    
}catch(PDOException $Exception){
    die('接続エラー：' .$Exception->getMessage());
}
?>

登録が完了しました。<br/>
<a href = "http://dev.jokazaki.net:8080/index.php">トップページに戻る</a>
</body>
</html>