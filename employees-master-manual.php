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
   
<title>マニュアル</title>
</head>
<body>

<ul>
    <li><a href="https://dev.jokazaki.biz:8443/employees-list.php">従業員一覧</a></li>
    <li><a href="https://dev.jokazaki.biz:8443/new-employee.html">従業員登録</a></li>
    <li><a href="https://dev.jokazaki.biz:8443/edit-employee.html">従業員編集</a></li>
    <li><a href="https://dev.jokazaki.biz:8443/delete-employee.html">従業員削除</a></li>
    <li><a class="active" href="https://dev.jokazaki.biz:8443/employees-master-manual.php">マニュアル</a></li>
</ul>

 
<div class="mycontents">   
     

<h1>マニュアル</h1>

<div class="setsumei">
<h2>従業員一覧ページについて</h2>
<p>
いずれかのフィールドに入力し、「フィルタ」を押下してください。<br/>
複数フィールドに入力した場合は、上段のフィールドを優先します。<br/>
「従業員名」については、姓名の一部のみでフィルタ可能です。<br/><br/>
<img src="man_img1.jpg" alt="従業員一覧ページの画像">
</p>
</div>

<div class="setsumei">
<h2>従業員登録ページについて</h2>
<p>
「従業員ID」は重複を許可しない設定となっているため、重複する従業員IDを登録しようとするとエラーになります。<br/>
各レコードについては論理削除をしているため、「従業員一覧」に表示されていなくても、過去に使用されていた従業員IDを入力するとエラーとなります。<br/>
エラーとなった場合は、異なる従業員IDを入力してください。<br/>
<br/>
また従業員新規登録時は、すでに登録されている部署IDしか指定できません。<br/>
下記一覧に表示されているいずれかの部署IDを指定してください。<br/>
部署が一覧にない場合は、システム課へ登録を依頼してください。<br/>
</p>


<?php include('db-login.php'); ?>

<?php
try{    
    $sql = "SELECT department_id, department_code, department_name FROM company.departments WHERE delete_flag=0";
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
        <th class="midashi2">部署ID</th>
        <th class="midashi2">部署コード</th>
        <th class="midashi2">部署名</th>
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
<br/>
<img src="man_img2.jpg" alt="従業員登録ページの画像">
</div>


<div class="setsumei">
<h2>従業員編集ページについて</h2>
<p>
すべてのフィールドに入力し、「確認画面へ」を押下してください。<br/>
従業員IDが一致する従業員の「従業員コード」「従業員名」「部署ID」を変更します。<br/>
その他のフィールドは変更できません。<br/>
<br/><img src="man_img3.jpg" alt="従業員編集ページの画像">
</p>
</div>


<div class="setsumei">
<h2>従業員削除ページについて</h2>
<p>
削除したい従業員の従業員IDを入力し、「確認画面へ」を押下してください。<br/>
従業員IDが一致する従業員のレコードを削除します。<br/>
確認画面に表示されるレコードに間違いがないか十分に確認してから、実行してください。<br/><br/>
<img src="man_img4.jpg" alt="従業員削除ページの画像">
</p>
</div>


<div class="setsumei">
<h2>従業員マスタに関するご連絡</h2>
<p>
<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSc_W3mrjvGmZOuT2_7dw3AnMTBF3cTZCtt1zZ_FURqSBaHBew/viewform?embedded=true" height="709" frameborder="0" marginheight="0" marginwidth="0">読み込んでいます…</iframe>
</p>


</div>
</body>
</html>