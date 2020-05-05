<html>
<head>
  <meta name="robots" content="noindex">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="このページの説明文">
  <title>新規登録確認画面</title>
</head>
<body>
<h1>新規登録確認画面</h1>
<?php
session_start();
//if (isset($_POST['name'])) {
//    $_SESSION['name'] = $_POST['name'];//入力された値をセッションに代入する
//}

foreach ($_POST as $key => $value){
    $_SESSION[$key] = $value;
}
?>

    
<?php
    $employee_id = $_SESSION['employee_id'];
    $employee_code = $_SESSION['employee_code'];
    $employee_name = $_SESSION['employee_name'];
    $department_id = $_SESSION['department_id'];
    $delete_flag = $_SESSION['delete_flag'];
    $created_at = $_SESSION['created_at'];
    $updated_at = $_SESSION['updated_at'];
 ?>

<form method="post" action="new-employee-process.php">    

<table>
    <tr>
        <th>従業員ID</th>
        <th>従業員コード</th>
        <th>氏名</th>
        <th>部署ID</th>
        <th>削除フラグ</th>
        <th>データ登録日時</th>
        <th>データ更新日時</th>
    </tr>        
    
    <tr>
        <td><?=htmlspecialchars($employee_id)?></td>
        <td><?=htmlspecialchars($employee_code)?></td>
        <td><?=htmlspecialchars($employee_name)?></td>
        <td><?=htmlspecialchars($department_id)?></td>
        <td><?=htmlspecialchars($delete_flag)?></td>
        <td><?=htmlspecialchars($created_at)?></td>
        <td><?=htmlspecialchars($updated_at)?></td>
    </tr>
</table>
 
<input type="hidden" name="postkey" value="<?php echo $post[$key]; ?>">
<div><input type="submit" name="submit" value="登録"></div>
<div><input type="button" value="戻る" onclick="history.back()"></div>    

</body>
</html>