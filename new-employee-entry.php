<html>
<head>
  <meta name="robots" content="noindex">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>従業員新規登録</title>
 </head>
<body>
<h1>従業員新規登録</h1>
<div id="post_page">
  <form method="post" action="new-employee-check.php">
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