<html>
<head>
    <!-- クローラインデックス拒否 -->
    <meta name="robots" content="noindex">
    
    <!-- 文字コード -->
    <meta charset="utf-8">
    
    <!--スタイルシート-->
    <link rel="stylesheet" href="menu.css">
    
    <!--スマホ画面用設定-->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
    <!-- ファビコン -->
    <link rel="icon" href="favicon.ico">
 
    <!-- スマホ用アイコン -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
 
    <!-- Windows用アイコン -->
    <meta name="application-name" content="従業員マスター"/>
    <meta name="msapplication-square70x70logo" content="small.jpg"/>
    <meta name="msapplication-square150x150logo" content="medium.jpg"/>
    <meta name="msapplication-wide310x150logo" content="wide.jpg"/>
    <meta name="msapplication-square310x310logo" content="large.jpg"/>
    <meta name="msapplication-TileColor" content="#FAA500"/>
 
<title>従業員編集完了</title>
</head>

<body>

<?php include('session-start.php'); ?>
    
<ul>
    <li><a href="https://dev.jokazaki.biz:8443/employees-list.php">従業員一覧</a></li>
    <li><a href="https://dev.jokazaki.biz:8443/new-employee.php">従業員登録</a></li>
    <li><a class="active" href="https://dev.jokazaki.biz:8443/edit-employee.php">従業員編集</a></li>
    <li><a href="https://dev.jokazaki.biz:8443/delete-employee.php">従業員削除</a></li>
    <li><a href="https://dev.jokazaki.biz:8443/employees-master-manual.php">マニュアル</a></li>
</ul>
    
<div class="mycontents">
    
    
<h1>従業員編集完了</h1>

<?php include('db-login.php'); ?>

<?php
try{
    $employee_id = $_SESSION['employee_id'];
    $employee_code = $_SESSION['employee_code'];
    $employee_name = $_SESSION['employee_name'];
    $department_id = $_SESSION['department_id'];
    $updated_at = date("Y-m-d");
    
    $sql = "UPDATE company.employees SET employee_code=:employee_code, employee_name=:employee_name, department_id=:department_id, updated_at=:updated_at WHERE employee_id=:employee_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
    $stmt->bindParam(':employee_code', $employee_code, PDO::PARAM_INT);
    $stmt->bindParam(':employee_name', $employee_name, PDO::PARAM_STR);
    $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
    $stmt->bindParam(':updated_at', $updated_at, PDO::PARAM_INT);
    $stmt->execute();
    
}catch(PDOException $Exception){
    die('接続エラー：' .$Exception->getMessage());
}
?>

<?php            
    $pdo = null; 
?>

<input type="button" onclick="location.href='https://dev.jokazaki.biz:8443/edit-employee.php'" value="「従業員編集」に戻る" class="button">

</div>
</body>
</html>