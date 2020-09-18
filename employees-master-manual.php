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

        <title>マニュアル</title>
    </head>
    <body>

        <!--ナビゲーションバー-->
        <ul>
            <li><a href="https://dev.jokazaki.net:8443/employees-list.php">従業員一覧</a></li>
            <li><a href="https://dev.jokazaki.net:8443/new-employee.php">従業員登録</a></li>
            <li><a href="https://dev.jokazaki.net:8443/edit-employee.php">従業員編集</a></li>
            <li><a href="https://dev.jokazaki.net:8443/delete-employee.html">従業員削除</a></li>
            <li><a class="active" href="https://dev.jokazaki.net:8443/employees-master-manual.php">マニュアル</a></li>
        </ul>


        <!--メインコンテンツボックス-->
        <div class="mycontents">   


            <h1>マニュアル</h1>

            <div class="setsumei">
                <h2><a id ="about1">従業員一覧について</a></h2><!--文書内リンク-->
                <p>
                    いずれかのフィールドに入力し、「フィルタ」を押下してください。<br/>
                    複数フィールドに入力した場合は、上段のフィールドを優先します。<br/>
                    「従業員名」については、姓名の一部のみでフィルタ可能です。<br/><br/>
                    <!--キャプチャ画像-->
                    <img src="man_img1.jpg" alt="従業員一覧ページの画像">
                </p>
            </div>

            <div class="setsumei">
                <h2><a id ="about2">従業員登録について</a></h2><!--文書内リンク-->
                <p>
                    「従業員ID」は自動採番（既存IDの最大値に1を足した値）されるため、新規登録時は入力不要です。<br/>
                    また新規登録時は、すでに登録されている部署名しか指定できません。<br/>
                    下記一覧に表示されているいずれかの部署名を指定してください。<br/>
                    部署が一覧にない場合は、システム課へ登録を依頼してください。<br/>
                </p>

                <!--DBログイン-->
                <?php include('db-login.php'); ?>

                <!--SQL文組み立てと実行-->
                <?php
                try {
                    $sql = "SELECT department_id, department_code, department_name FROM company.departments WHERE delete_flag=0";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                } catch (PDOException $Exception) {
                    die('接続エラー：' . $Exception->getMessage());
                    echo "データベース処理時にエラーが発生しました。";
                    echo '<input type="button" onclick="history.back()" value="戻る" class="button">';
                }
                ?>

                <!--SQL文実行結果表示部-->
                <?php
                echo "<h3>登録済み部署&nbsp;&#040;" . date("Y/m/d") . "現在&#041;</h3>";
                ?>

                <!--表見出し-->
                <table>
                    <tbody>
                        <tr>
                            <th class="midashi2">部署ID</th>
                            <th class="midashi2">部署コード</th>
                            <th class="midashi2">部署名</th>
                        </tr>

                        <!--SQL文実行結果表示部-->
                        <?php
                        while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) { //$rowに実行結果を格納し、順次実行。
                            ?>

                            <!--SQL文実行結果表示部。サニタイズして表示。-->
                            <tr>
                                <th><?= htmlspecialchars($rows['department_id']) ?></th>
                                <th><?= htmlspecialchars($rows['department_code']) ?></th>
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
                <!--キャプチャ画像-->
                <img src="man_img2.jpg" alt="従業員登録ページの画像">
            </div>


            <div class="setsumei">
                <h2><a id ="about3">従業員編集について</a></h2><!--文書内リンク-->
                <p>
                    すべてのフィールドに入力し、「確認画面へ」を押下してください。<br/>
                    従業員IDが一致する従業員の「従業員コード」「従業員名」「部署名」を変更します。<br/>
                    その他のフィールドは、手動では変更できません。<br/>
                    <!--キャプチャ画像-->
                    <br/><img src="man_img3.jpg" alt="従業員編集ページの画像">
                </p>
            </div>


            <div class="setsumei">
                <h2><a id ="about4">従業員削除について</a></h2><!--文書内リンク-->
                <p>
                    削除したい従業員の従業員IDを入力し、「確認画面へ」を押下してください。<br/>
                    従業員IDが一致する従業員のレコードを削除します。<br/>
                    確認画面に表示されるレコードに間違いがないか十分に確認してから、実行してください。<br/><br/>
                    <!--キャプチャ画像-->
                    <img src="man_img4.jpg" alt="従業員削除ページの画像">
                </p>
            </div>


            <div class="setsumei">
                <h2>従業員マスタに関するご連絡</h2>
                <!--Googleフォーム-->
                <p>
                    <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSc_W3mrjvGmZOuT2_7dw3AnMTBF3cTZCtt1zZ_FURqSBaHBew/viewform?embedded=true" height="709" frameborder="0" marginheight="0" marginwidth="0">読み込んでいます…</iframe>
                </p>
            </div>

    </body>
</html>