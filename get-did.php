<?php
$sql2 = "SELECT department_id from company.departments WHERE department_name LIKE :department_name";
$stmt2 = $pdo->prepare($sql2);
$stmt2->bindParam(':department_name', $department_name, PDO::PARAM_STR);
$stmt2->execute();
$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>