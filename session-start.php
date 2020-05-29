<?php
//セッション開始
session_start();
foreach ($_POST as $key => $value) {
    $_SESSION[$key] = $value;
}
?>