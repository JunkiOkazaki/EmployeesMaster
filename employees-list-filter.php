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
        <link rel="stylesheet" href="./jquery-ui-1.12.1/jquery-ui.css">
        <script src="jquery-1.12.4.js"></script>
        <script src="jquery-ui.js"></script>

        <script>
            $(function () {
                $("#datepicker_ca").datepicker({
                    dateFormat: 'yy-mm-dd',
                    yearSuffix: '年',
                    showMonthAfterYear: true,
                    monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                    dayNames: ['日', '月', '火', '水', '木', '金', '土'],
                    dayNamesMin: ['日', '月', '火', '水', '木', '金', '土']
                });
            });
        </script>
        <script>
            $(function () {
                $("#datepicker_ua").datepicker({
                    dateFormat: 'yy-mm-dd',
                    yearSuffix: '年',
                    showMonthAfterYear: true,
                    monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                    dayNames: ['日', '月', '火', '水', '木', '金', '土'],
                    dayNamesMin: ['日', '月', '火', '水', '木', '金', '土']
                });
            });
        </script>

        <title>フィルタ結果</title>
    </head>
    <body>

        <!--セッション開始-->
        <?php include('session-start.php'); ?>


        <!--ナビゲーションバー-->    
        <ul>
            <li><a class="active" href="https://dev.jokazaki.biz:8443/employees-list.php">従業員一覧</a></li>
            <li><a href="https://dev.jokazaki.biz:8443/new-employee.html">従業員登録</a></li>
            <li><a href="https://dev.jokazaki.biz:8443/edit-employee.html">従業員編集</a></li>
            <li><a href="https://dev.jokazaki.biz:8443/delete-employee.html">従業員削除</a></li>
            <li><a href="https://dev.jokazaki.biz:8443/employees-master-manual.php">マニュアル</a></li>
        </ul>


        <!--メインコンテンツボックス-->
        <div class="mycontents">


            <h1>フィルタ結果</h1>
           

                <!--DBログイン-->
                <?php include('db-login.php'); ?>


                <!--入力チェック-->
                <?php
                //SQL文組み立てには、プレースホルダ（バインド機構）を用いる。
                $employee_id = $_SESSION['employee_id'];
                $employee_code = $_SESSION['employee_code'];
                $employee_name = $_SESSION['employee_name'];
                $department_name = $_SESSION['department_name'];
                $delete_flag = $_SESSION['delete_flag'];
                $created_at = $_SESSION['created_at'];
                $updated_at = $_SESSION['updated_at'];
                
                $input_flag=0;
                
                $sql2 = "SELECT department_name FROM departments";
                $stmt2 = $pdo->prepare($sql2);
                $stmt2->execute();
                $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                
                //入力チェックで問題なければ、SQL文組み立てと実行。
                if (!empty($employee_id)) {
                    if (preg_match('/^[0-9]{1,4}$/', $employee_id)) {
                        $employee_id = preg_replace('/^[\s　]*(.*?)[\s　]*$/u', '$1', $employee_id);
                        try {
                            $sql = "SELECT employees.employee_id, employees.employee_code, employees.employee_name, departments.department_name, employees.created_at, employees.updated_at FROM company.employees LEFT JOIN company.departments ON employees.department_id=departments.department_id WHERE employees.employee_id=:employee_id AND employees.delete_flag=0";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            if (empty($result[0]['employee_id'])) {
                                echo "<p class=error2>従業員ID:&nbsp;" . $employee_id . "&nbsp;のレコードは存在しません。</p>";
                            }
                        } catch (PDOException $Exception) {
                            die('接続エラー：' . $Exception->getMessage());
                            echo "データベース処理時にエラーが発生しました。";
                            echo '<input type="button" onclick="history.back()" value="戻る" class="button">';
                        }
                    } else {
                        echo "<div class ='error'>「従業員ID」欄には、1～3桁の半角数字を入力してください。</div>";
                    }
                } elseif (!empty($employee_code)) {
                    if (preg_match('/^[0-9]{1,4}$/', $employee_code)) {
                        $employee_code = preg_replace('/^[\s　]*(.*?)[\s　]*$/u', '$1', $employee_code);
                        try {
                            $sql = "SELECT employees.employee_id, employees.employee_code, employees.employee_name, departments.department_name, employees.created_at, employees.updated_at FROM company.employees LEFT JOIN company.departments ON employees.department_id=departments.department_id WHERE employees.employee_code=:employee_code AND employees.delete_flag=0";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':employee_code', $employee_code, PDO::PARAM_INT);
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            if (empty($result[0]['employee_code'])) {
                                echo "<p class=error2>従業員コード:&nbsp;" . $employee_code . "&nbsp;のレコードは存在しません。</p>";
                            }
                        } catch (PDOException $Exception) {
                            die('接続エラー：' . $Exception->getMessage());
                            echo "データベース処理時にエラーが発生しました。";
                            echo '<input type="button" onclick="history.back()" value="戻る" class="button">';
                        }
                    } else {
                        echo "<div class='error'>「従業員コード」欄には、1～3桁の半角数字を入力してください。</div>";
                    }
                } elseif (!empty($employee_name)) {
                    if (preg_match('/^[ぁ-んァ-ヶー一-龠]+$/u', $employee_name)) {
                        $employee_name = preg_replace('/^[\s　]*(.*?)[\s　]*$/u', '$1', $employee_name);
                        try {
                            $sql = "SELECT employees.employee_id, employees.employee_code, employees.employee_name, departments.department_name, employees.created_at, employees.updated_at FROM company.employees LEFT JOIN company.departments ON employees.department_id=departments.department_id WHERE employees.employee_name LIKE :employee_name AND employees.delete_flag=0";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindValue(':employee_name', '%' . $employee_name . '%', PDO::PARAM_STR);
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            if (empty($result[0]['employee_name'])) {
                                echo "<p class=error2>従業員名:&nbsp;" . $employee_name . "&nbsp;のレコードは存在しません。</p>";
                            }
                        } catch (PDOException $Exception) {
                            die('接続エラー：' . $Exception->getMessage());
                            echo "データベース処理時にエラーが発生しました。";
                            echo '<input type="button" onclick="history.back()" value="戻る" class="button">';
                        }
                    } else {
                        echo "<div class='error'>「氏名」欄には、1～30文字の全角文字列を入力してください。</div>";
                    }
                } elseif (!empty($department_name) && empty($created_at) && empty($updated_at)) {
                    if (preg_match('/^[ぁ-んァ-ヶー一-龠]+$/u', $department_name)) {
                        try {
                            $department_name = preg_replace('/^[\s　]*(.*?)[\s　]*$/u', '$1', $department_name);
                            $sql = "SELECT employees.employee_id, employees.employee_code, employees.employee_name, departments.department_name, employees.created_at, employees.updated_at FROM company.employees LEFT JOIN company.departments ON employees.department_id=departments.department_id WHERE departments.department_name LIKE :department_name AND employees.delete_flag=0";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':department_name', $department_name, PDO::PARAM_INT);
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            if (empty($result[0]['department_name'])) {
                                echo "<div class='error2'>部署名:&nbsp;" . $department_name . "&nbspは未登録です。<a href='https://dev.jokazaki.biz:8443/employees-master-manual.php#about2'>マニュアル</a>を参照し、登録済み部署の中から指定してください。</div>";
                            }
                        } catch (PDOException $Exception) {
                            die('接続エラー：' . $Exception->getMessage());
                            echo "データベース処理時にエラーが発生しました。";
                            echo '<input type="button" onclick="history.back()" value="戻る" class="button">';
                        }
                    } else {
                        echo "<div class='error'>「部署名」欄には、1～10文字の全角文字列を入力してください。</div>";
                    }                    
                } elseif (!empty($created_at)) {
                    if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $created_at)) {
                        try {
                            $created_at = preg_replace('/^[\s　]*(.*?)[\s　]*$/u', '$1', $created_at);
                            $sql = "SELECT employee_id, employee_code, employee_name, department_name, created_at, updated_at FROM company.employees WHERE created_at LIKE :created_at AND delete_flag=0";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            if (empty($result[0]['created_at'])) {
                                echo "<p class=error2>登録日時:&nbsp;" . $created_at . "&nbsp;のレコードは存在しません。</p>";
                            }
                        } catch (PDOException $Exception) {
                            die('接続エラー：' . $Exception->getMessage());
                            echo "データベース処理時にエラーが発生しました。";
                            echo '<input type="button" onclick="history.back()" value="戻る" class="button">';
                        }
                    } else {
                        echo "<div class='error'>「登録日時」欄は（例）&quot;2020-05-01&quot;&nbsp;のように半角で入力してください。</div>";
                    }
                } elseif (!empty($updated_at)) {
                    if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $updated_at)) {
                        try {
                            $updated_at = preg_replace('/^[\s　]*(.*?)[\s　]*$/u', '$1', $updated_at);
                            $sql = "SELECT employee_id, employee_code, employee_name, department_name, created_at, updated_at FROM company.employees WHERE updated_at LIKE :updated_at AND delete_flag=0";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            if (empty($result[0]['updated_at'])) {
                                echo "<p class=error2>更新日時:&nbsp;" . $updated_at . "&nbsp;のレコードは存在しません。</p>";
                            }
                        } catch (PDOException $Exception) {
                            die('接続エラー：' . $Exception->getMessage());
                            echo "データベース処理時にエラーが発生しました。";
                            echo '<input type="button" onclick="history.back()" value="戻る" class="button">';
                        }
                    } else {
                        echo "<div class='error'>「更新日時」欄は（例）&quot;2020-05-01&quot;&nbsp;のように半角で入力してください。</div>";
                    }                    
                } else {
                    echo "<div class='error'>フィルタ条件が未入力です。</div>";
                }
                ?>
                
                
                
                <!--入力欄-->
                <form method="post" action="employees-list-filter.php">
                <div  class="cp_iptxt"><input class="ef" type="text" name="employee_id" size="30" placeholder=""><label>従業員ID</label><span class="focus_line"></span></div>
                <div  class="cp_iptxt"><input class="ef" type="text" name="employee_code" size="30" placeholder=""><label>従業員コード</label><span class="focus_line"></span></div>
                <div  class="cp_iptxt"><input class="ef" type="text" name="employee_name" size="30" placeholder=""><label>氏　　名</label><span class="focus_line"></span></div>
                <div  class="cp_iptxt"><select class="ef" name="department_name"><option label="部署名" value=""></option><?php foreach($result2 as $rows2){?><option label="部署名" value="<?= htmlspecialchars($rows2['department_name']) ?>"><?= htmlspecialchars($rows2['department_name']) ?></option><?php } $pdo2=null; ?></select><span class="focus_line"></span></div>
                <div  class="cp_iptxt"><input class="ef" id="datepicker_ca" type="text" name="created_at" size="30" placeholder="" ><label>登録日時</label><span class="focus_line"></span></div>
                <div  class="cp_iptxt"><input class="ef" id="datepicker_ua" type="text" name="updated_at" size="30" placeholder="" ><label>更新日時</label><span class="focus_line"></span></div>
                <input type="submit" name="filter" value="フィルタ再適用" class="button">
                <input type="button" onclick="location.href = 'https://dev.jokazaki.biz:8443/employees-list.php'" value="「従業員一覧」に戻る" class="button">
                <br/>
                

                <!--表見出し-->
                <table>
                    <tbody>
                        <tr>
                            <th class = "midashi">従業員ID</th>
                            <th class = "midashi">従業員コード</th>
                            <th class = "midashi">氏名</th>
                            <th class = "midashi">部署名</th>
                            <th class = "midashi">データ登録日時</th>
                            <th class = "midashi">データ更新日時</th>
                        </tr>


                    <?php foreach ($result as $rows) { ?> <!--$resultの配列各要素を$rowsとして取り出し、順次実行。-->

                        <!--エスケープ処理とSQL実行結果表示-->
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
        </div>
    </body>
</html>