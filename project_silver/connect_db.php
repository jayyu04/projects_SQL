<?php

$host = "127.0.0.1"; // 資料庫主機地址
$username = "root"; // 資料庫使用者名稱
$password = ""; // 資料庫密碼
$database = "project_silver"; // 資料庫名稱

// 建立資料庫連接
$conn = new mysqli($host, $username, $password, $database);

// 檢查連接是否成功
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}else{
    echo "連接成功";
}

// 設定編碼，確保資料庫正確處理中文
$conn->set_charset("utf8");

?>
