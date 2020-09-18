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

        <title>従業員新規登録確認画面</title>

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

            <h1>従業員新規登録確認画面</h1>

            <!--DBログイン-->
            <?php include('db-login.php'); ?>


            <?php
            //SQL文組み立てには、プレースホルダ（バインド機構）を使用。
            $employee_code = $_SESSION['employee_code'];
            $employee_name = $_SESSION['employee_name'];
            $department_name = $_SESSION['department_name'];
            $created_at = date("Y-m-d");
            $updated_at = date("Y-m-d");
            $flag = 0;
            $class = "";


            //入力チェックをして問題なければ、SQL文組み立てと実行
            if (!empty($employee_code)) {
                if (preg_match('/^[0-9]{1,4}$/', $employee_code)) {
                    $employee_code = preg_replace('/^[\s　]*(.*?)[\s　]*$/u', '$1', $employee_code);
                } else {
                    $flag = 1;
                    echo "<div class='error2'>「従業員コード」欄には、1～4桁の半角数字を入力してください。</div>";
                }
            } else {
                $flag = 1;
                echo "<div class ='error2'>「従業員コード」欄が未入力です。</div>";
            }


            if (!empty($employee_name)) {
                if (preg_match('/^[ぁ-んァ-ヶー一-龠]{1,30}+$/u', $employee_name)) {
                    $employee_name = preg_replace('/^[\s　]*(.*?)[\s　]*$/u', '$1', $employee_name);
                } else {
                    $flag = 1;
                    echo "<div class='error2'>「氏名」欄には、1～30文字の全角文字列を入力してください。</div>";
                }
            } else {
                $flag = 1;
                echo "<div class ='error2'>「氏名」欄が未入力です。</div>";
            }

            if (strpos($department_name,'部署名を選択')===false&&!empty($department_name)) {
                if (preg_match('/^[ぁ-んァ-ヶー一-龠]{1,10}+$/u', $department_name)) {
                    try {
                        $department_name = preg_replace('/^[\s　]*(.*?)[\s　]*$/u', '$1', $department_name);
                        $sql2 = "SELECT employees.employee_id, employees.employee_code, employees.employee_name, departments.department_name, employees.created_at, employees.updated_at FROM company.employees LEFT JOIN company.departments ON employees.department_id = departments.department_id WHERE employees.delete_flag=0";
                        $stmt2 = $pdo->prepare($sql2);
                        $stmt2->bindParam(':department_name', $department_name, PDO::PARAM_INT);
                        $stmt2->execute();
                        $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $Exception) {
                        die('接続エラー：' . $Exception->getMessage());
                    }
                    if (empty($result2[0]['department_name'])) {
                        $flag = 1;
                        echo "<div class='error2'>部署名:&nbsp;" . $department_name . "&nbspは未登録です。<a href='https://dev.jokazaki.net:8443/employees-master-manual.php#about2'>マニュアル</a>を参照し、登録済み部署の中から指定してください。</div>";
                    }
                } else {
                    $flag = 1;
                    echo "<div class='error2'>「部署名」欄には、1～10文字の全角文字列を入力してください。</div>";
                }
            } else {
                $flag = 1;
                echo "<div class ='error2'>「部署名」欄が未入力です。</div>";
            }


            if ($flag == 1) {
                $class = "hide";
            } else {
                echo "<p class='comment'>以下の内容で登録します。</p>";
                try {
                    $sql = "SELECT MAX(employee_id) FROM company.employees WHERE employees.delete_flag=0";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $employee_id=$result[0]["MAX(employee_id)"];
                    $employee_id++;
                    $_SESSION['employee_id']=$employee_id;
                } catch (PDOException $Exception) {
                    die('接続エラー：' . $Exception->getMessage());
                }
            }

            
            $pdo = null; //PDOオブジェクト破棄
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


                    <!--サニタイズ処理とSQL実行結果表示-->
                    <tr>
                        <th><?= htmlspecialchars($employee_id) ?></th>
                        <th><?= htmlspecialchars($employee_code) ?></th>
                        <th><?= htmlspecialchars($employee_name) ?></th>
                        <th><?= htmlspecialchars($department_name) ?></th>
                        <th><?= htmlspecialchars($created_at) ?></th>
                        <th><?= htmlspecialchars($updated_at) ?></th>
                    </tr>
                </tbody>
            </table>

            <!--ボタン-->
            <form method="post" autocomplete="off" action="new-employee-process.php">
                <input type="submit" name="filter" value="登録" class="button <?PHP echo $class; ?>"> <!--入力チェックで問題がなかった場合のみ表示-->
                <input type="button" onclick="history.back()" value="戻る" class="button">
                <br/>

        </div>
    </body>
</html>