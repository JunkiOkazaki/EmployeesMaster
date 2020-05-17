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
    
     
    if(!empty($employee_id)){
    $sql = "SELECT * FROM company.employees WHERE employee_id=:employee_id AND delete_flag=0";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
    }elseif(!empty($employee_code)){
    $sql = "SELECT * FROM company.employees WHERE employee_code=:employee_code AND delete_flag=0";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':employee_code', $employee_code, PDO::PARAM_INT);
    }elseif(!empty($employee_name)){
    $sql = "SELECT * FROM company.employees WHERE employee_name LIKE :employee_name AND delete_flag=0";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':employee_name', '%'.$employee_name.'%', PDO::PARAM_STR);
    }elseif(!empty($department_id)){
    $sql = "SELECT * FROM company.employees WHERE department_id=:department_id AND delete_flag=0";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
    }elseif(!empty($created_at)){
    $sql = "SELECT * FROM company.employees WHERE created_at LIKE :created_at AND delete_flag=0";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);
    }elseif(!empty($updated_at)){
    $sql = "SELECT * FROM company.employees WHERE updated_at LIKE :updated_at AND delete_flag=0";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);
    }else{
    $sql = "SELECT * FROM company.employees WHERE delete_flag=0";
    $stmt = $pdo->prepare($sql);
    }
    $stmt->execute();
        
}catch(PDOException $Exception){
    die('接続エラー：' .$Exception->getMessage());
}
?>
    
<table><tbody>
    <tr>
        <th class="midashi">従業員ID</th>
        <th class="midashi">従業員コード</th>
        <th class="midashi">氏名</th>
        <th class="midashi">部署ID</th>
        <th class="midashi">削除フラグ</th>
        <th class="midashi">データ登録日時</th>
        <th class="midashi">データ更新日時</th>
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