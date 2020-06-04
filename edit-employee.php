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

        <title>従業員編集</title>
    </head>
    <body>

        
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


            <h1>従業員編集</h1>

            <!--入力欄-->
            <form method="post" action="edit-employee-check.php">
                <div  class="cp_iptxt"><input class="ef" type="text" name="employee_id" size="30" placeholder=""><label>従業員ID</label><span class="focus_line"></span></div>
                <div  class="cp_iptxt"><input class="ef" type="text" name="employee_code" size="30" placeholder=""><label>従業員コード</label><span class="focus_line"></span></div>
                <div  class="cp_iptxt"><input class="ef" type="text" name="employee_name" size="30" placeholder=""><label>氏　　名</label><span class="focus_line"></span></div>
                <div  class="cp_iptxt"><select class="ef" name="department_name"><option label="部署名" value="">部署名を選択</option><?php foreach($result2 as $rows2){?><option label="部署名" value="<?= htmlspecialchars($rows2['department_name']) ?>"><?= htmlspecialchars($rows2['department_name']) ?></option><?php } $pdo2=null; ?></select><span class="focus_line"></span></div>
                <input type="submit" name="confirm" value="確認画面へ" class="button"><!--ボタン-->
                <br/>

        </div>
    </body>
</html>