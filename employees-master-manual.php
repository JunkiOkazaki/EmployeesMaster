<html>
<head>
    <meta name="robots" content="noindex">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
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
   
<title>マニュアル</title>

</head>
<body>



    <ul>
	<li><a href="https://dev.jokazaki.biz:8443/index.php">従業員一覧</a></li>
	<li><a href="https://dev.jokazaki.biz:8443/new-employee.php">従業員新規登録</a></li>
	<li><a href="https://dev.jokazaki.biz:8443/edit-employee.php">従業員編集</a></li>
        <li><a href="https://dev.jokazaki.biz:8443/delete-employee.php">従業員削除</a></li>
        <li><a class="active" href="https://dev.jokazaki.biz:8443/employees-master-manual.php">マニュアル</a></li>
    </ul>


 
<div class="mycontents">   
     
 
<h1>マニュアル</h1>

<div class="setsumei">
<h2>従業員新規登録時の注意事項</h2>
<p>
従業員新規登録時は、すでに登録されている部署IDしか登録できません。<br/>
下記一覧に表示されているいずれかの部署IDを指定してください。
</p>


<?php include('table-departments-access-display.php'); ?>
</div>

<div class="setsumei">
<h2>従業員マスタに関するご連絡</h2>
<p>
<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSc_W3mrjvGmZOuT2_7dw3AnMTBF3cTZCtt1zZ_FURqSBaHBew/viewform?embedded=true" width="640" height="709" frameborder="0" marginheight="0" marginwidth="0">読み込んでいます…</iframe>
</p>
    
</div>
</body>
</html>