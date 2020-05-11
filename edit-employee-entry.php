<html>
<head>
    <meta name="robots" content="noindex">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    
  <title>従業員編集</title>
 </head>
<body>
    
    <ul>
	<li><a class="active" href="https://dev.jokazaki.biz:8443/index.php">従業員一覧</a></li>
	<li><a href="https://dev.jokazaki.biz:8443/new-employee-entry.php">従業員新規登録</a></li>
	<li><a href="https://dev.jokazaki.biz:8443/edit-employee-entry.php">従業員編集</a></li>
        <li><a href="https://dev.jokazaki.biz:8443/employees-master-manual.html">マニュアル</a></li>
    </ul>    

    
<div class="mycontents">
    
    
<h1>従業員編集</h1>
<div id="post_page">
  <form method="post" action="edit-employee-check.php">
    <div  class="cp_iptxt"><input class="ef" type="text" name="employee_id" size="30" placeholder=""><label>従業員ID</label><span class="focus_line"></span></div>
    <!-- <div>従業員コード <input type="text" name="employee_code" size="50"></div> -->
    <div  class="cp_iptxt"><input class="ef" type="text" name="employee_name" size="30" placeholder=""><label>氏　　名</label><span class="focus_line"></span></div>
    <div  class="cp_iptxt"><input class="ef" type="text" name="department_id" size="30" placeholder=""><label>部　署ID</label><span class="focus_line"></span></div>
    <!-- <div>削除フラグ <input type="text" name="delete_flag" size="50"></div> -->
    <div  class="cp_iptxt"><input class="ef" id="datepicker" type="text" name="created_at" size="30" placeholder="" ><label>登録日時</label><span class="focus_line"></span></div>
    <!-- <div>データ更新日時 <input type="text" name="updated_at" size="50"></div> -->
    <div><input type="submit" name="submit" value="確認" class="button"></div>
  </form>
</div>

</div>
</body>
</html>