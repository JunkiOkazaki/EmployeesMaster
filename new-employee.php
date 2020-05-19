<html>
<head>
    <!-- クローラインデックス拒否 -->
    <meta name="robots" content="noindex">
    
    <!-- 文字コード -->
    <meta charset="utf-8">
    
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
    
    <!--スタイルシート-->
    <link rel="stylesheet" href="menu.css">
    
    <!-- jQuery Datepicker -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
    
<title>従業員登録</title>
</head>

<body>

<?php include('session-start.php'); ?>
    
    <ul>
	<li><a href="https://dev.jokazaki.biz:8443/index.php">従業員一覧</a></li>
	<li><a class="active" href="https://dev.jokazaki.biz:8443/new-employee.php">従業員登録</a></li>
	<li><a href="https://dev.jokazaki.biz:8443/edit-employee.php">従業員編集</a></li>
        <li><a href="https://dev.jokazaki.biz:8443/delete-employee.php">従業員削除</a></li>
        <li><a href="https://dev.jokazaki.biz:8443/employees-master-manual.php">マニュアル</a></li>
    </ul>

    
<div class="mycontents">
    
    
<h1>従業員登録</h1>


<form method="post" action="new-employee-check.php">
    <div class="cp_iptxt"><input class="ef" type="text" name="employee_id" size="30" placeholder=""><label>従業員ID</label><span class="focus_line"></span></div>
    <div class="cp_iptxt"><input class="ef" type="text" name="employee_code" size="30" placeholder=""><label>従業員コード</label><span class="focus_line"></span></div>
    <div class="cp_iptxt"><input class="ef" type="text" name="employee_name" size="30" placeholder=""><label>氏　　名</label><span class="focus_line"></span></div>
    <div class="cp_iptxt"><input class="ef" type="text" name="department_id" size="30" placeholder=""><label>部　署ID</label><span class="focus_line"></span></div>
    <div>
<input type="submit" name="filter" value="確認画面へ" class="button"></div>
<br/>

</div>
</body>
</html>