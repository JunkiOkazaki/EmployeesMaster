<html>
<head>
  <meta name="robots" content="noindex">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
<h1>従業員編集</h1>
<div id="post_page">
  <form method="post" action="edit-employee-check.php">
    <div>従業員ID <input type="text" name="employee_id" size="50"></div>
    <div>従業員コード <input type="text" name="employee_code" size="50"></div>
    <div>氏名 <input type="text" name="employee_name" size="50"></div>
    <div>部署ID <input type="text" name="department_id" size="50"></div>
    <div>削除フラグ <input type="text" name="delete_flag" size="50"></div>
    <div>データ登録日時 <input type="text" name="created_at" size="50"></div>
    <div>データ更新日時 <input type="text" name="updated_at" size="50"></div>
    <div><input type="submit" name="submit" value="確認"></div>
  </form>
</div>
</body>
</html>