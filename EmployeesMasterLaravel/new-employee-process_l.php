<html>
    <head>
        <!-- クローラインデックス拒否 -->
        <meta name="robots" content="noindex">

        <!-- 文字コード -->
        <meta charset="utf-8">

        <!--スマホ画面用設定-->
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <!--スタイルシート-->
        <link rel="stylesheet" href="menu_l.css">

        <!-- ファビコン -->
        <link rel="icon" href="favicon_l.ico">

        <!-- スマホ用アイコン -->
        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon_l.png">

        <!-- Windows用アイコン -->
        <meta name="application-name" content="従業員マスター"/>
        <meta name="msapplication-square70x70logo" content="small_l.jpg"/>
        <meta name="msapplication-square150x150logo" content="medium_l.jpg"/>
        <meta name="msapplication-wide310x150logo" content="wide_l.jpg"/>
        <meta name="msapplication-square310x310logo" content="large_l.jpg"/>
        <meta name="msapplication-TileColor" content="#FAA500"/>

        <title>Laravel_従業員登録完了</title>
    </head>
    <body>
        
        <!--セッション開始-->
        <?php include('session-start_l.php'); ?>

        <!--ナビゲーションバー-->
        <ul>
            <li><a href="https://dev-laravel.jokazaki.biz:8443/employees-list_l.php">従業員一覧</a></li>
            <li><a class="active" href="https://dev-laravel.jokazaki.biz:8443/new-employee_l.html">従業員登録</a></li>
            <li><a href="https://dev-laravel.jokazaki.biz:8443/edit-employee_l.html">従業員編集</a></li>
            <li><a href="https://dev-laravel.jokazaki.biz:8443/delete-employee_l.html">従業員削除</a></li>
            <li><a href="https://dev-laravel.jokazaki.biz:8443/employees-master-manual_l.php">マニュアル</a></li>
        </ul>


        <!--メインコンテンツボックス-->
        <div class="mycontents">


            <h1>従業員新規登録完了</h1>

            <!--DBログイン-->
            <?php include('db-login_l.php'); ?>

            
            <?php
            try {
                //SQL文組み立てにはプレースホルダ（バインド機構）を使用
                $employee_id = $_SESSION['employee_id'];
                $employee_code = $_SESSION['employee_code'];
                $employee_name = $_SESSION['employee_name'];
                $department_id = $_SESSION['department_id'];
                $delete_flag = 0;
                $created_at = date("Y-m-d");
                $updated_at = date("Y-m-d");

                //SQL文組み立てと実行
                $sql = "INSERT INTO l_company.employees(employee_id, employee_code, employee_name, department_id, delete_flag, created_at, updated_at) VALUES(:employee_id, :employee_code, :employee_name, :department_id, :delete_flag, :created_at, :updated_at)";
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
                //die('接続エラー：' . $Exception->getMessage());
                exit("データベース処理時にエラーが発生しました。<div class ='error2'>従業員ID:&nbsp;$employee_id&nbsp;のレコードがすでに存在します。</div><br/>");
            }
            ?>


            <?php
                $pdo = null; //PDOオブジェクト破棄
            ?>
            
            <!--ボタン-->
            <input type="button" onclick="location.href = 'https://dev-laravel.jokazaki.biz:8443/new-employee_l.html'" value="「従業員登録」に戻る" class="button">

        </div>
    </body>
</html>