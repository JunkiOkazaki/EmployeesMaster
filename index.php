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
    
    <!-- jQuery Datepicker -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd',
            yearSuffix: '年',
            showMonthAfterYear: true,
            monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
            dayNames: ['日', '月', '火', '水', '木', '金', '土'],
            dayNamesMin: ['日', '月', '火', '水', '木', '金', '土']
            
            });
        } );
    </script>
    
<title>従業員一覧</title>

</head>
<body>
<h1>従業員一覧</h1>

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
    <div>登録日時&nbsp;&thinsp;&thinsp;<input type="text" name="created_at" id="datepicker" size="30"></div>
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
    //$sql = "SELECT * FROM company.employees WHERE employee_id=? OR employee_code=? OR employee_name=? OR department_id=? OR delete_flag=? OR created_at=? OR updated_at=?";
    //$sql = "SELECT * FROM company.employees WHERE employee_id=?";
    $sql = "SELECT * FROM company.employees";
    
    
    //$sql = "SELECT * FROM company.employees WHERE employee_name LIKE ?";
    //$stmt->bindParam(1, $employee_id, PDO::PARAM_INT);
    //$stmt->bindParam(2, $employee_code, PDO::PARAM_INT);
    //$stmt->bindValue(3, $employee_name, PDO::PARAM_STR);
    //$stmt->bindParam(4, $department_id, PDO::PARAM_INT);
    //$stmt->bindParam(5, $delete_flag, PDO::PARAM_INT);
    //$stmt->bindParam(6, $created_at, PDO::PARAM_STR);
    //$stmt->bindParam(7, $updated_at, PDO::PARAM_STR);
    $stmt = $pdo->prepare($sql);
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