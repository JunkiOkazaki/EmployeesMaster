<html>
    <head>
        
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

        <title>従業員削除確認画面</title>
    </head>
    <body>

        <!--セッション開始-->
        <?php include('session-start.php'); ?>

        <!--トップメニュー-->
        <ul>
            <li><a href="https://dev.jokazaki.biz:8443/employees-list.php">従業員一覧</a></li>
            <li><a href="https://dev.jokazaki.biz:8443/new-employee.php">従業員登録</a></li>
            <li><a href="https://dev.jokazaki.biz:8443/edit-employee.php">従業員編集</a></li>
            <li><a class="active" href="https://dev.jokazaki.biz:8443/delete-employee.html">従業員削除</a></li>
            <li><a href="https://dev.jokazaki.biz:8443/employees-master-manual.php">マニュアル</a></li>
        </ul>

        <!--メインコンテンツボックス-->
        <div class="mycontents">


            <h1>従業員削除確認画面</h1>

            <!--DBログイン-->
            <?php include('db-login.php'); ?>


            <?php
            //SQL文組み立てには、プレースホルダ（バインド機構）を使用する。
            $employee_id = $_SESSION['employee_id'];
            $flag = 0;
            $class = "";
            
            //入力チェックして問題なければ、SQL文組み立てと実行。
            if (!empty($employee_id)) {
                if (preg_match('/^[0-9]{1,4}$/', $employee_id)) {
                    $employee_id = preg_replace('/^[\s　]*(.*?)[\s　]*$/u', '$1', $employee_id);
                } else {
                    $flag = 1;
                    echo "<div class ='error2'>「従業員ID」欄には、1～4桁の半角数字を入力してください。</div>";
                }
            } else {
                $flag = 1;
                echo "<div class ='error2'>「従業員ID」欄が未入力です。</div>";
            }

            if ($flag == 1) {
                $class = "hide";
            } else {
                try {
                    $sql = "SELECT employees.employee_id, employees.employee_code, employees.employee_name, departments.department_name, employees.created_at, employees.updated_at FROM company.employees LEFT JOIN company.departments ON employees.department_id=departments.department_id WHERE employees.delete_flag=0 AND employees.employee_id=:employee_id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $Exception) {
                    die('接続エラー：' . $Exception->getMessage());
                    echo "データベース処理時にエラーが発生しました。";
                }

                if (empty($result[0]['employee_id'])) {
                    $flag = 1;
                    echo "<p class=error2>従業員ID:&nbsp;" . $employee_id . "&nbsp;のレコードが存在しません。</p>";
                } else {
                    echo "<p class='comment'>以下のレコードを削除します。</p>";
                }

                if ($flag == 1) {
                    $class = "hide";
                }
            }
            ?>

            <!--表見出し-->
            <table>
                <tbody>
                    <tr>
                        <th class="midashi">従業員ID</th>
                        <th class="midashi">従業員コード</th>
                        <th class="midashi">氏名</th>
                        <th class="midashi">部署名</th>
                        <th class="midashi">データ登録日時</th>
                        <th class="midashi">データ更新日時</th>
                    </tr>

                    <?php foreach ($result as $rows) { ?>
                    <!--エスケープ処理とSQL文実行結果表示-->
                        <tr>
                            <th><?= htmlspecialchars($rows['employee_id']) ?></th>
                            <th><?= htmlspecialchars($rows['employee_code']) ?></th>
                            <th><?= htmlspecialchars($rows['employee_name']) ?></th>
                            <th><?= htmlspecialchars($rows['department_name']) ?></th>
                            <th><?= htmlspecialchars($rows['created_at']) ?></th>
                            <th><?= htmlspecialchars($rows['updated_at']) ?></th>
                        </tr>

                    <?php
                    }
                    $pdo = null; //PDOオブジェクト破棄
                    ?>
                </tbody>
            </table>
            <br/>

            <!--ボタン-->
            <form method="post" autocomplete="off" action="delete-employee-process.php">
                <input type="submit" name="delete" value="レコード削除" class="button <?php echo $class; ?>"><!--入力チェックで問題がなかった場合のみ表示-->
                <input type="button" onclick="history.back()" value="戻る" class="button">
                <br/>

        </div>
    </body>
</html>