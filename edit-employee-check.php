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

        <title>従業員編集確認画面</title>
    </head>
    <body>

        <!--セッション開始-->
        <?php include('session-start.php'); ?>

        <!--ナビゲーションバー-->
        <ul>
            <li><a href="https://dev.jokazaki.biz:8443/employees-list.php">従業員一覧</a></li>
            <li><a href="https://dev.jokazaki.biz:8443/new-employee.php">従業員登録</a></li>
            <li><a class="active" href="https://dev.jokazaki.biz:8443/edit-employee.php">従業員編集</a></li>
            <li><a href="https://dev.jokazaki.biz:8443/delete-employee.html">従業員削除</a></li>
            <li><a href="https://dev.jokazaki.biz:8443/employees-master-manual.php">マニュアル</a></li>
        </ul>


        <!--メインコンテンツボックス-->
        <div class="mycontents">


            <h1>従業員編集確認画面</h1>

            <!--DBログイン-->
            <?php include('db-login.php'); ?>


            <!--部署ID取得-->
            <?php
            try {
                $sql2 = "SELECT department_id from company.departments WHERE department_name LIKE :department_name";
                $stmt2 = $pdo->prepare($sql2);
                $stmt2->bindParam(':department_name', $department_name, PDO::PARAM_STR);
                $stmt2->execute();
                $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $Exception) {
                die('接続エラー：' . $Exception->getMessage());
                echo "データベース処理時にエラーが発生しました。";
            }
            ?>

            <?php
            //SQL文組み立てには、プレースホルダ（バインド機構）を用いる。
            $employee_id = $_SESSION['employee_id'];
            $employee_code = $_SESSION['employee_code'];
            $employee_name = $_SESSION['employee_name'];
            $department_name = $_SESSION['department_name'];
            $updated_at = date("Y-m-d");
            $flag = 0;
            $class = "";


            //入力チェックと条件判定をし、問題なければSQL文組み立てと実行。
            if (!empty($employee_id)) {
                if (preg_match('/^[0-9]{1,4}$/', $employee_id)) {
                    try {
                        $employee_id = preg_replace('/^[\s　]*(.*?)[\s　]*$/u', '$1', $employee_id);
                        $sql = "SELECT employee_id, employee_code, employee_name, department_id, updated_at FROM company.employees WHERE employee_id=:employee_id AND delete_flag=0";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if (empty($result[0][employee_id])) {
                            $flag = 1;
                            echo "<div class=error2>従業員ID:&nbsp;" . $employee_id . "&nbsp;のレコードは存在しません。</div>";
                        }
                    } catch (PDOException $Exception) {
                        die('接続エラー：' . $Exception->getMessage());
                        echo "データベース処理時にエラーが発生しました。";
                        echo '<input type="button" onclick="history.back()" value="戻る" class="button">';
                    }
                } else {
                    $flag = 1;
                    echo "<div class ='error2'>「従業員ID」欄には、1～4桁の半角数字を入力してください。</div>";
                }
            } else {
                $flag = 1;
                echo "<div class ='error2'>「従業員ID」欄が未入力です。</div>";
            }


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


            //入力チェック後にdepartment_nameと一致するdepartment_idを取得
            if (strpos($department_name,'部署名を選択')===false&&!empty($department_name)) {
                if (preg_match('/^[ぁ-んァ-ヶー一-龠]{1,10}+$/u', $department_name)) {
                    $department_id = preg_replace('/^[\s　]*(.*?)[\s　]*$/u', '$1', $department_name);
                    try {
                        $sql2 = "SELECT department_id from company.departments WHERE department_name LIKE :department_name AND delete_flag=0";
                        $stmt2 = $pdo->prepare($sql2);
                        $stmt2->bindParam(':department_name', $department_name, PDO::PARAM_STR);
                        $stmt2->execute();
                        $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                        if (empty($result2[0][department_id])) {
                            $flag = 1;
                            echo "<div class='error2'>部署名:&nbsp;" . $department_name . "&nbspは未登録です。<a href='https://dev.jokazaki.biz:8443/employees-master-manual.php#about2'>マニュアル</a>を参照し、登録済み部署の中から指定してください。</div>";
                        }
                    } catch (PDOException $Exception) {
                        echo "データベース処理時にエラーが発生しました。";
                    }
                } else {
                    $flag = 1;
                    echo "<div class='error2'>「部署名」欄には、1～10文字の全角文字列を入力してください。</div>";
                }
            } else {
                $flag = 1;
                echo "<div class ='error2'>「部署名」欄が未入力です。</div>";
            }
            
            $department_id = $result2[0]['department_id'];


            if ($flag == 1) {
                $class = "hide";
            } else {
                echo "<p class='comment'>従業員ID:&nbsp;" . $employee_id . "&nbsp;のレコードを以下の内容に変更します。</p>";
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
                        <th class="midashi">データ更新日時</th>
                    </tr>
                    <!--エスケープ処理とSQL文実行結果表示-->
                    <tr>
                        <th><?= htmlspecialchars($employee_id) ?></th>
                        <th><?= htmlspecialchars($employee_code) ?></th>
                        <th><?= htmlspecialchars($employee_name) ?></th>
                        <th><?= htmlspecialchars($department_name) ?></th>
                        <th><?= htmlspecialchars($updated_at) ?></th>
                    </tr>
                </tbody>
            </table>

            <!--ボタン-->
            <form method="post" autocomplete="off" action="edit-employee-process.php">
                <input type="submit" name="filter" value="レコード更新" class="button <?PHP echo $class; ?>"><!--入力チェックで問題があった場合は非表示-->
                <input type="button" onclick="history.back()" value="戻る" class="button"><!--「戻る」ボタン-->
                <br/>

        </div>
    </body>
</html>