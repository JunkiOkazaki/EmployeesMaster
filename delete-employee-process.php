<html>
    <head>
        
        <!-- ウェブクローラ拒否 -->
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

        <title>従業員削除完了</title>
    </head>
    <body>

        
        <!--セッション開始-->
        <?php include('session-start.php'); ?>

        <!--ナビゲーションバー-->
        <ul>
            <li><a href="https://dev.jokazaki.net:8443/employees-list.php">従業員一覧</a></li>
            <li><a href="https://dev.jokazaki.net:8443/new-employee.php">従業員登録</a></li>
            <li><a href="https://dev.jokazaki.net:8443/edit-employee.php">従業員編集</a></li>
            <li><a class="active" href="https://dev.jokazaki.net:8443/delete-employee.html">従業員削除</a></li>
            <li><a href="https://dev.jokazaki.net:8443/employees-master-manual.php">マニュアル</a></li>
        </ul>

        <!--メインコンテンツボックス-->
        <div class="mycontents">

            <h1>従業員削除完了</h1>

            <!--DBログイン-->
            <?php include('db-login.php'); ?>
            
            <!--SQL文組み立てと実行-->
            <?php
            try {
                $employee_id = $_SESSION['employee_id'];
                $sql = "UPDATE company.employees SET delete_flag=1 WHERE employee_id=:employee_id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
                $stmt->execute();
            } catch (PDOException $Exception) {
                die('接続エラー：' . $Exception->getMessage());
                echo "データベース処理時にエラーが発生しました。";
            }
            ?>

            <?php
                $pdo = null; //PDOオブジェクト破棄
            ?>

            <!--ボタン-->
            <input type="button" onclick="location.href = 'https://dev.jokazaki.net:8443/delete-employee.html'" value="「従業員削除」に戻る" class="button">

        </div>
    </body>
</html>