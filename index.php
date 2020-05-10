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
    
    <!--スタイルシート-->
    <link rel="stylesheet" href="menu.css">
    
    <!-- jQuery Datepicker -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker({
            dateFormat: 'yymmdd',
            yearSuffix: '年',
            showMonthAfterYear: true,
            monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
            dayNames: ['日', '月', '火', '水', '木', '金', '土'],
            dayNamesMin: ['日', '月', '火', '水', '木', '金', '土']
            
            });
        } );
    </script>
    
<title>従業員検索結果</title>
</head>

<body>

<?php
session_start();
//if (isset($_POST['name'])) {
//    $_SESSION['name'] = $_POST['name'];//入力された値をセッションに代入する
//}

foreach ($_POST as $key => $value){
    $_SESSION[$key] = $value;
}
?>
    
    <ul>
	<li><a class="active" href="http://dev.jokazaki.net:8080/index.php">従業員一覧</a></li>
	<li><a href="http://dev.jokazaki.net:8080/new-employee-entry.php">従業員新規登録</a></li>
	<li><a href="http://dev.jokazaki.net:8080/edit-employee-entry.php">従業員編集</a></li>
	<li><a href="http://dev.jokazaki.net:8080/employees-master-manual.html">マニュアル</a></li>
    </ul>

    
<div class="mycontents">
    
    
<h1>従業員一覧</h1>


<form method="post" action="index.php">
    <div  class="cp_iptxt"><input class="ef" type="text" name="employee_id" size="30" placeholder=""><label>従業員ID</label><span class="focus_line"></span></div>
    <!-- <div>従業員コード <input type="text" name="employee_code" size="50"></div> -->
    <div  class="cp_iptxt"><input class="ef" type="text" name="employee_name" size="30" placeholder=""><label>氏　　名</label><span class="focus_line"></span></div>
    <div  class="cp_iptxt"><input class="ef" type="text" name="department_id" size="30" placeholder=""><label>部　署ID</label><span class="focus_line"></span></div>
    <!-- <div>削除フラグ <input type="text" name="delete_flag" size="50"></div> -->
    <div  class="cp_iptxt"><input class="ef" id="datepicker" type="text" name="created_at" size="30" placeholder="" ><label>登録日時</label><span class="focus_line"></span></div>
    <!-- <div  class="cp_iptxt"><input class="ef" id="datepicker" type="text" name="updated_at" size="30" placeholder="" ><label>更新日時</label><span class="focus_line"></span></div> -->
    <div><input type="submit" name="filter" value="フィルタ" class="button"></div>
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
    //echo $employee_id;
    $employee_code = $_SESSION['employee_code'];
    $employee_name = $_SESSION['employee_name'];
    //echo $employee_name;
    $department_id = $_SESSION['department_id'];
    //echo $department_id;
    //$delete_flag = $_SESSION['delete_flag'];
    //$delete_flag = 1;
    $created_at = $_SESSION['created_at'];
    //echo $created_at;
    //echo "<br />";
    //echo gettype($created_at);
    //$updated_at = $_SESSION['updated_at'];
    //$sql = "SELECT * FROM company.employees WHERE employee_id=? OR employee_code=? OR employee_name LIKE ? OR department_id=? OR delete_flag=? OR created_at=? OR updated_at=?";
    
        
//$sql = "SELECT * FROM company.employees WHERE employee_id=?";
   
    if(is_numeric($employee_id)){
    $sql = "SELECT * FROM company.employees WHERE employee_id=:employee_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
    $stmt->execute();
    }elseif(is_string($employee_name)){
    $sql = "SELECT * FROM company.employees WHERE employee_name LIKE :employee_name";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':employee_name', '%'.$employee_name.'%', PDO::PARAM_STR);
    $stmt->execute();
    }elseif(is_numeric($department_id)){
    $sql = "SELECT * FROM company.employees WHERE department_id=:department_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
    $stmt->execute();
    }elseif(!is_null($created_at)){
    $sql = "SELECT * FROM company.employees WHERE created_at LIKE :created_at";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':created_at', '%'.$created_at.'%', PDO::PARAM_STR);
    $stmt->execute();  
    }else{
    $sql = "SELECT * FROM company.employees";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
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

</div>
</body>
</html>