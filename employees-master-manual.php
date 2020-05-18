<html>
<head>
    <!-- クローラインデックス拒否 -->
    <meta name="robots" content="noindex">
    
    <!-- 文字コード -->
    <meta charset="utf-8">
    
    <!--スタイルシート-->
    <link rel="stylesheet" href="menu.css">
    
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
   
<title>マニュアル</title>
</head>
<body>

<ul>
    <li><a href="https://dev.jokazaki.biz:8443/index.php">従業員一覧</a></li>
    <li><a href="https://dev.jokazaki.biz:8443/new-employee.php">従業員登録</a></li>
    <li><a href="https://dev.jokazaki.biz:8443/edit-employee.php">従業員編集</a></li>
    <li><a href="https://dev.jokazaki.biz:8443/delete-employee.php">従業員削除</a></li>
    <li><a class="active" href="https://dev.jokazaki.biz:8443/employees-master-manual.php">マニュアル</a></li>
</ul>

 
<div class="mycontents">   
     

<h1>マニュアル</h1>

<div class="setsumei">
<h2>従業員一覧ページについて</h2>
<p>
<img src="manual1.png" alt="従業員一覧ページの画像">
</p>
</div>

<div class="setsumei">
<h2>従業員登録ページについて</h2>
<p>
従業員新規登録時は、すでに登録されている部署IDしか登録できません。<br/>
下記一覧に表示されているいずれかの部署IDを指定してください。
</p>


<?php include('db-login.php'); ?>

<?php
try{    
    $sql = "SELECT department_id, department_code, department_name, created_at, updated_at FROM company.departments WHERE delete_flag=0";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
        
}catch(PDOException $Exception){
    die('接続エラー：' .$Exception->getMessage());
}
?>

<?php
    echo "<h3>".date("Y年m月d日")."時点で登録されている部署"."</h3>";
?>
    
<table><tbody>
    <tr>
        <th class="midashi">部署ID</th>
        <th class="midashi">部署コード</th>
        <th class="midashi">部署名</th>
        <th class="midashi">データ登録日時</th>
        <th class="midashi">データ更新日時</th>
    </tr>

<?php
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
?>
    
    <tr>
        <th><?=htmlspecialchars($row['department_id'])?></th>
        <th><?=htmlspecialchars($row['department_code'])?></th>
        <th><?=htmlspecialchars($row['department_name'])?></th>
        <th><?=htmlspecialchars($row['created_at'])?></th>
        <th><?=htmlspecialchars($row['updated_at'])?></th>
    </tr>
    
<?php
    }
    $pdo = null;
?>
</tbody></table>
<br/><img src="manual2.png" alt="従業員登録ページの画像">
</div>


<div class="setsumei">
<h2>従業員削除ページについて</h2>
<p>
削除したい従業員の従業員IDを入力し、「確認」を押下してください。
</p>
</div>


<div class="setsumei">
<h2>従業員マスタに関するご連絡</h2>
<p>
<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSc_W3mrjvGmZOuT2_7dw3AnMTBF3cTZCtt1zZ_FURqSBaHBew/viewform?embedded=true" width="640" height="709" frameborder="0" marginheight="0" marginwidth="0">読み込んでいます…</iframe>
</p>


</div>
</body>
</html>