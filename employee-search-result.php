<html>
<head>
    <meta name="robots" content="noindex">
    <meta charset="utf-8">
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
    <title>従業員検索結果</title>
</head>
<body>
<h1>従業員検索結果</h1>

<?php
session_start();
//if (isset($_POST['name'])) {
//    $_SESSION['name'] = $_POST['name'];//入力された値をセッションに代入する
//}

foreach ($_POST as $key => $value){
    $_SESSION[$key] = $value;
}
?>

<form method="post" action="employee-search-result.php">
    <div>従業員ID&nbsp;&thinsp;<input type="text" name="employee_id" size="30"></div>
    <!-- <div>従業員コード <input type="text" name="employee_code" size="50"></div> -->
    <div>氏　　名&nbsp;&thinsp;&thinsp;<input type="text" name="employee_name" size="30"></div>
    <div>部　署ID&nbsp;&thinsp;<input type="text" name="department_id" size="30"></div>
    <!-- <div>削除フラグ <input type="text" name="delete_flag" size="50"></div> -->
    <!-- <div>データ登録日時 <input type="text" name="created_at" size="50"></div> -->
    <!-- <div>データ更新日時 <input type="text" name="updated_at" size="50"></div> -->
    <div><input type="submit" name="search" value="検索"></div>
<br/>    

<?php

try{
    $pdo = new PDO('mysql:host=dev.jokazaki.net;dbname=company;charset=utf8', 'devs', '9876');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}catch(PDOException $Exception){
    die('接続エラー：' .$Exception->getMessage());
}
?>

<?php
try{
    $employee_id = $_SESSION['employee_id'];
    $employee_code = $_SESSION['employee_code'];
    $employee_name = $_SESSION['employee_name'];
    $department_id = $_SESSION['department_id'];
    $delete_flag = $_SESSION['delete_flag'];
    $created_at = $_SESSION['created_at'];
    $updated_at = $_SESSION['updated_at'];
    //$sql = "SELECT * FROM company.employees WHERE employee_id=? OR employee_code=? OR employee_name LIKE ? OR department_id=? OR delete_flag=? OR created_at=? OR updated_at=?";
    //$sql = "SELECT * FROM company.employees WHERE employee_id=?";
    if(is_numeric($_SESSION['employee_id'])){
    $sql = "SELECT * FROM company.employees WHERE employee_id=:employee_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
    }elseif(is_numeric($_SESSION['department_id'])){
    $sql = "SELECT * FROM company.employees WHERE department_id=:department_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
    }elseif(is_string($_SESSION['employee_name'])) {$sql = "SELECT * FROM company.employees WHERE employee_name LIKE :employee_name";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':employee_name', '%'.$employee_name.'%', PDO::PARAM_STR);
    }else{$sql = "SELECT * FROM company.employees";
    $stmh = $pdo->prepare($sql);
    }
    
    //$sql = "SELECT * FROM company.employees WHERE employee_name LIKE ?";
    //$stmt = $pdo->prepare($sql);
    //$stmt->bindParam(1, $employee_id, PDO::PARAM_INT);
    //$stmt->bindParam(2, $employee_code, PDO::PARAM_INT);
    //$stmt->bindValue(1, '%'.$employee_name.'%', PDO::PARAM_STR);
    //$stmt->bindParam(4, $department_id, PDO::PARAM_INT);
    //$stmt->bindParam(5, $delete_flag, PDO::PARAM_INT);
    //$stmt->bindParam(6, $created_at, PDO::PARAM_STR);
    //$stmt->bindParam(7, $updated_at, PDO::PARAM_STR);
    $stmt->execute();
    
}catch(PDOException $Exception){
    die('接続エラー：' .$Exception->getMessage());
}
?>
    
<table><tbody>
    <tr>
        <th>従業員ID</th>
        <th>従業員コード</th>
        <th>氏名</th>
        <th>部署ID</th>
        <th>削除フラグ</th>
        <th>データ登録日時</th>
        <th>データ更新日時</th>
    </tr>

<?php
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
?>

    <tr>
        <th><?=htmlspecialchars($row['employee_id'])?></th>
        <th><?=htmlspecialchars($row['employee_code'])?></th>
        <th><?=htmlspecialchars($row['employee_name'])?></th>
        <th><?=htmlspecialchars($row['department_id'])?></th>
        <th><?=htmlspecialchars($row['delete_flag'])?></th>
        <th><?=htmlspecialchars($row['created_at'])?></th>
        <th><?=htmlspecialchars($row['updated_at'])?></th>
    </tr>
    
<?php
    }
    $pdo = null;
?>
</tbody></table>

</body>
</html>