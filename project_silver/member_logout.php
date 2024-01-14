<?php
// member_logout.php

// 啟動 session
session_start();

// 清除會員相關的 session 資料
unset($_SESSION['member_id']);

// 清除所有 session 變數
session_unset();

// 銷毀 session
session_destroy();

// 導向回主頁
header("Location: home.php");
exit();
?>
