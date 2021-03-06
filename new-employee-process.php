<html>
    <head>
        
        <!-- ウェブクローラ拒否 -->
        <meta name="robots" content="noindex">
        
        <!-- 文字コード -->
        <meta charset="utf-8">

        <!--スマホ画面用設定-->
        <meta name="viewport" content="width=device-width,initial-scale=1">

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

        <title>従業員登録完了</title>
    </head>
    <body>
        
        <!--セッション開始-->
        <?php include('session-start.php'); ?>

        <!--ナビゲーションバー-->
        <ul>
            <li><a href="https://dev.jokazaki.net:8443/employees-list.php">従業員一覧</a></li>
            <li><a class="active" href="https://dev.jokazaki.net:8443/new-employee.php">従業員登録</a></li>
            <li><a href="https://dev.jokazaki.net:8443/edit-employee.php">従業員編集</a></li>
            <li><a href="https://dev.jokazaki.net:8443/delete-employee.html">従業員削除</a></li>
            <li><a href="https://dev.jokazaki.net:8443/employees-master-manual.php">マニュアル</a></li>
        </ul>


        <!--メインコンテンツボックス-->
        <div class="mycontents">


            <h1>従業員新規登録完了</h1>

            <!--DBログイン-->
            <?php include('db-login.php'); ?>

            
            <?php
            try {
                //SQL文組み立てにはプレースホルダ（バインド機構）を使用。
                $employee_id = $_SESSION['employee_id'];
                $employee_code = $_SESSION['employee_code'];
                $employee_name = $_SESSION['employee_name'];
                $delete_flag = 0;
                $created_at = date("Y-m-d");
                $updated_at = date("Y-m-d");
                
                //$department_nameと一致するdepartment_idを取得
                $department_name = $_SESSION['department_name'];
                $sql2 = "SELECT department_id from company.departments WHERE department_name LIKE :department_name";
                $stmt2 = $pdo->prepare($sql2);
                $stmt2->bindParam(':department_name', $department_name, PDO::PARAM_STR);
                $stmt2->execute();
                $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                $department_id=$result2[0]['department_id'];                    

                //SQL文組み立てと実行
                $sql = "INSERT INTO company.employees (employee_id, employee_code, employee_name, department_id, delete_flag, created_at, updated_at) VALUES (:employee_id, :employee_code, :employee_name, :department_id, :delete_flag, :created_at, :updated_at)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
                $stmt->bindParam(':employee_code', $employee_code, PDO::PARAM_INT);
                $stmt->bindParam(':employee_name', $employee_name, PDO::PARAM_STR);
                $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
                $stmt->bindParam(':delete_flag', $delete_flag, PDO::PARAM_INT);
                $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);
                $stmt->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);
                $stmt->execute();            
            } catch (PDOException $Exception) {
                die('接続エラー：' .$Exception->getMessage());
                exit("データベース処理時にエラーが発生しました。<div class ='error2'>従業員ID:&nbsp;$employee_id&nbsp;のレコードがすでに存在します。</div><br/>");
            }
            ?>


            <?php
                $pdo = null; //PDOオブジェクト破棄
            ?>

            <!--ボタン-->
            <input type="button" onclick="location.href = 'https://dev.jokazaki.net:8443/new-employee.php'" value="「従業員登録」に戻る" class="button">

        </div>
    </body>
</html>