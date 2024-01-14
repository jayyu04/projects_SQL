<?php
// 假设你已经有数据库连接
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "project_silver";

$conn = new mysqli($host, $username, $password, $database);

// 检查连接是否成功
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 获取从前端传递过来的数据
$member_id = $conn->real_escape_string($_POST['member_id']);
$product_id = $conn->real_escape_string($_POST['product_id']);
$order_date = $conn->real_escape_string($_POST['order_date']);
$product_amount = $conn->real_escape_string($_POST['product_amount']);
$total_price = $conn->real_escape_string($_POST['total_price']);

// 使用 prepared statement 防止 SQL 注入攻击
$insert_query = "INSERT INTO orderlist (member_id, product_id, order_date, product_amount, total_price) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($insert_query);
$stmt->bind_param("iiisd", $member_id, $product_id, $order_date, $product_amount, $total_price);

if ($stmt->execute()) {
    echo "购买成功！";
} else {
    echo "购买失败: " . $conn->error;
}

// 关闭 prepared statement 和 数据库连接
$stmt->close();
$conn->close();
?>
