<?php
try {
    $sql2 = "SELECT department_name FROM departments";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute();
    $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $Exception) {
    die('接続エラー：' . $Exception->getMessage());
    echo "データベース処理時にエラーが発生しました。";
}
?>