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
        
    <title>Laravel_従業員新規登録確認画面</title>

</head>

<body>

<?php include('session-start.php'); ?>
    
<ul>
    <li><a href="https://dev-laravel.jokazaki.biz:8443/employees-list.php">従業員一覧</a></li>
    <li><a class="active" href="https://dev-laravel.jokazaki.biz:8443/new-employee.html">従業員登録</a></li>
    <li><a href="https://dev-laravel.jokazaki.biz:8443/edit-employee.html">従業員編集</a></li>
    <li><a href="https://dev-laravel.jokazaki.biz:8443/delete-employee.html">従業員削除</a></li>
    <li><a href="https://dev-laravel.jokazaki.biz:8443/employees-master-manual.php">マニュアル</a></li>
</ul>

    
<div class="mycontents">
    
    
<h1>従業員新規登録確認画面</h1>

<?php include('db-login-laravel.php'); ?>


<?php

    $employee_id = $_SESSION['employee_id'];
    $employee_code = $_SESSION['employee_code'];
    $employee_name = $_SESSION['employee_name'];
    $department_id = $_SESSION['department_id'];
    $created_at = date("Y-m-d");
    $updated_at = date("Y-m-d");
    
    $flag=0;
    $class="";
     
    if(!empty($employee_id)){
        if(preg_match('/^[0-9]{1,4}$/', $employee_id)){
            try{
                    $employee_id = preg_replace('/^[\s　]*(.*?)[\s　]*$/u', '$1', $employee_id);
                    $sql = "SELECT employee_id FROM l_company.employees WHERE employee_id=:employee_id AND delete_flag=0";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                }catch(PDOException $Exception){
                    die('接続エラー：' .$Exception->getMessage());
                    echo "データベース処理時にエラーが発生しました。<br/>従業員ID:&nbsp;".$employee_id."&nbsp;はすでに使用されています。";
                    echo '<input type="button" onclick="history.back()" value="戻る" class="button">';
            }
        }else{
            $flag=1;
            echo "<div class ='error2'>「従業員ID」欄には1～4文字の数字を入力してください</div>";
        }
    }else{
        $flag=1;
        echo "<div class ='error2'>「従業員ID」欄が未入力です</div>";
    }
    
    
    if(!empty($employee_code)){
        if(preg_match('/^[0-9]{1,4}$/', $employee_code)){
            $employee_code = preg_replace('/^[\s　]*(.*?)[\s　]*$/u', '$1', $employee_code);
        }else{
            $flag=1;
            echo "<div class='error2'>「従業員コード」欄には1～4文字の数字を入力してください</div>";
        }
    }else{
        $flag=1;
        echo "<div class ='error2'>「従業員コード」欄が未入力です</div>";
    }
    
        
    if(!empty($employee_name)){
        if(preg_match('/^[ぁ-んァ-ヶー一-龠]+$/u', $employee_name)){
            $employee_name = preg_replace('/^[\s　]*(.*?)[\s　]*$/u', '$1', $employee_name);
        }else{
            $flag=1;
            echo "<div class='error2'>「氏名」欄には1～30文字の全角文字列を入力してください</div>";
        }
    }else{
        $flag=1;
        echo "<div class ='error2'>「氏名」欄が未入力です</div>";
    }
    
    if(!empty($department_id)){
        if(preg_match('/^[0-9]{1,3}$/', $department_id)){
            $department_id = preg_replace('/^[\s　]*(.*?)[\s　]*$/u', '$1', $department_id);
        }else{
            $flag=1;
            echo "<div class='error2'>「部署ID」欄には1～3文字の数字を入力してください</div>";
        }
    }else{
        $flag=1;
        echo "<div class ='error2'>「部署ID」欄が未入力です</div>";
    }
    
    if ($flag==1){
        $class="hide";
    }else{
        echo "<p class='comment'>以下の内容で登録します</p>";
    }
?>    

<table><tbody>
    <tr>
        <th class="midashi">従業員ID</th>
        <th class="midashi">従業員コード</th>
        <th class="midashi">氏名</th>
        <th class="midashi">部署ID</th>
        <th class="midashi">データ登録日時</th>
        <th class="midashi">データ更新日時</th>
    </tr>

    <tr>
        <th><?=htmlspecialchars($employee_id)?></th>
        <th><?=htmlspecialchars($employee_code)?></th>
        <th><?=htmlspecialchars($employee_name)?></th>
        <th><?=htmlspecialchars($department_id)?></th>
        <th><?=htmlspecialchars($created_at)?></th>
        <th><?=htmlspecialchars($updated_at)?></th>
    </tr>
    
</tbody></table>

<form method="post" action="new-employee-process.php">
<input type="submit" name="filter" value="登録" class="button <?PHP echo $class; ?>">
<input type="button" onclick="history.back()" value="戻る" class="button">
<br/>


</div>
</body>
</html>