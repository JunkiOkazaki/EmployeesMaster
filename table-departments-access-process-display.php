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
    
    
     
    
    $sql = "SELECT * FROM company.departments WHERE delete_flag=0";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
        
}catch(PDOException $Exception){
    die('接続エラー：' .$Exception->getMessage());
}
?>


<h3>
<?php
    echo date("Y年m月d日")."時点で登録されている部署"
?>
</h3>
    
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
