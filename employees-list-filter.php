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
    
    <!-- jQuery Datepicker -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    <script>
        $( function() {
            $( "#datepicker_ca" ).datepicker({
            dateFormat: 'yy-mm-dd',
            yearSuffix: '年',
            showMonthAfterYear: true,
            monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
            dayNames: ['日', '月', '火', '水', '木', '金', '土'],
            dayNamesMin: ['日', '月', '火', '水', '木', '金', '土']
            
            });
        } );
    </script>
    <script>
        $( function() {
            $( "#datepicker_ua" ).datepicker({
            dateFormat: 'yy-mm-dd',
            yearSuffix: '年',
            showMonthAfterYear: true,
            monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
            dayNames: ['日', '月', '火', '水', '木', '金', '土'],
            dayNamesMin: ['日', '月', '火', '水', '木', '金', '土']
            
            });
        } );
    </script>
    
    <title>フィルタ結果</title>
</head>
<body>

<?php include('session-start.php'); ?>
    
<ul>
    <li><a class="active" href="https://dev.jokazaki.biz:8443/employees-list.php">従業員一覧</a></li>
    <li><a href="https://dev.jokazaki.biz:8443/new-employee.html">従業員登録</a></li>
    <li><a href="https://dev.jokazaki.biz:8443/edit-employee.html">従業員編集</a></li>
    <li><a href="https://dev.jokazaki.biz:8443/delete-employee.html">従業員削除</a></li>
    <li><a href="https://dev.jokazaki.biz:8443/employees-master-manual.php">マニュアル</a></li>
</ul>

    
<div class="mycontents">
    
    
<h1>フィルタ結果</h1>


<form method="post" action="filter-list.php">
    <div  class="cp_iptxt"><input class="ef" type="text" name="employee_id" size="30" placeholder=""><label>従業員ID</label><span class="focus_line"></span></div>
    <div  class="cp_iptxt"><input class="ef" type="text" name="employee_code" size="30" placeholder=""><label>従業員コード</label><span class="focus_line"></span></div>
    <div  class="cp_iptxt"><input class="ef" type="text" name="employee_name" size="30" placeholder=""><label>氏　　名</label><span class="focus_line"></span></div>
    <div  class="cp_iptxt"><input class="ef" type="text" name="department_id" size="30" placeholder=""><label>部　署ID</label><span class="focus_line"></span></div>
    <div  class="cp_iptxt"><input class="ef" id="datepicker_ca" type="text" name="created_at" size="30" placeholder="" ><label>登録日時</label><span class="focus_line"></span></div>
    <div  class="cp_iptxt"><input class="ef" id="datepicker_ua" type="text" name="updated_at" size="30" placeholder="" ><label>更新日時</label><span class="focus_line"></span></div>
    <input type="submit" name="filter" value="フィルタ再適用" class="button">
    <input type="button" onclick="location.href='https://dev.jokazaki.biz:8443/employees-list.php'" value="「従業員一覧」に戻る" class="button">
<br/>

<?php include('db-login.php'); ?>

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
        if(preg_match('/^[0-9]{1,4}$/', $employee_id)){
            $employee_id = preg_replace('/^[\s　]*(.*?)[\s　]*$/u', '$1', $employee_id);
            $sql = "SELECT employee_id, employee_code, employee_name, department_id, created_at, updated_at FROM company.employees WHERE employee_id=:employee_id AND delete_flag=0";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
        }else{
            echo "<div class ='error'>「従業員ID」欄には1～3文字の数字を入力してください</div>";
        }
    }elseif(!empty($employee_code)){
        if(preg_match('/^[0-9]{1,4}$/', $employee_code)){
            $employee_code = preg_replace('/^[\s　]*(.*?)[\s　]*$/u', '$1', $employee_code);
            $sql = "SELECT employee_id, employee_code, employee_name, department_id, created_at, updated_at FROM company.employees WHERE employee_code=:employee_code AND delete_flag=0";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':employee_code', $employee_code, PDO::PARAM_INT);
            {
                echo "<div class='error'>フィルタに該当するレコードがみつかりませんでした</div>";
            }
        }else{
            echo "<div class='error'>「従業員コード」欄には1～3文字の数字を入力してください</div>";
        }
    }elseif(!empty($employee_name)){
        if(preg_match('/^[ぁ-んァ-ヶー一-龠]+$/u', $employee_name)){
            $sql = "SELECT employee_id, employee_code, employee_name, department_id, created_at, updated_at FROM company.employees WHERE employee_name LIKE :employee_name AND delete_flag=0";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':employee_name', '%'.$employee_name.'%', PDO::PARAM_STR);
        }else{
            echo "<div class='error'>「氏名」欄には1～30文字の全角文字列を入力してください</div>";
        }
    }elseif(!empty($department_id)){
        if(preg_match('/^[0-9]{1,4}$/', $department_id)){
            $sql = "SELECT employee_id, employee_code, employee_name, department_id, created_at, updated_at FROM company.employees WHERE department_id=:department_id AND delete_flag=0";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
        }else{
            echo "<div class='error'>「部署ID」欄には1～3文字の数字を入力してください</div>";
        }
    }elseif(!empty($created_at)){
        if(preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $created_at)){
            $sql = "SELECT employee_id, employee_code, employee_name, department_id, created_at, updated_at FROM company.employees WHERE created_at LIKE :created_at AND delete_flag=0";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);
        }else{
            echo "<div class='error'>「登録日時」欄は（例）&quot;2020-05-01&quot;&nbsp;のように入力してください</div>";
        }
    }elseif(!empty($updated_at)){
        if(preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $updated_at)){
            $sql = "SELECT employee_id, employee_code, employee_name, department_id, created_at, updated_at FROM company.employees WHERE updated_at LIKE :updated_at AND delete_flag=0";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);
        }else{
            echo "<div class='error'>「更新日時」欄は（例）&quot;2020-05-01&quot;&nbsp;のように入力してください</div>";
        }
    }else{
        echo "<div class='error'>フィルタ条件が未入力です</div>";
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
        <th><?=htmlspecialchars($row['created_at'])?></th>
        <th><?=htmlspecialchars($row['updated_at'])?></th>
    </tr>
    
<?php            
    }
if($row==0){
    echo "<div class='error'>フィルタに該当するレコードがありません</div>";
}
    $pdo = null; 
?>

</tbody></table>

</div>
</body>
</html>