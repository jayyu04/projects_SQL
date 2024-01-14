<?php

// 假设你已经有数据库连接
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "project_silver";

// 启动 Session
session_start();

if(isset($_SESSION['member_id'])) {
    echo "Session member_id is set. Current member_id is: " . $_SESSION['member_id'];
} else {
    echo "Session member_id is not set";
}

$conn = new mysqli($host, $username, $password, $database);

// 检查连接是否成功
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 查询产品信息
$query = "SELECT product_id, product_name, product_price FROM product";
$result = $conn->query($query);

// 检查查询是否成功
if (!$result) {
    die("查询失败: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品頁面</title>
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        header {
            padding: 20px;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        nav li {
            display: inline-block;
            margin-right: 20px;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: 16px;
        }

        main {
            padding: 20px;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>商品列表</h1>
    <nav>
        <ul>
            <li><a href="home.php">首頁</a></li>
        </ul>
    </nav>
    <table border="1">
        <tr>
            <th>商品名稱</th>
            <th>商品價格</th>
            <th>商品數量</th>
            <th>操作</th>
        </tr>

        <?php
        // 显示产品信息
        while ($row = $result->fetch_assoc()) {
            $productId = $row['product_id'];
            $productName = $row['product_name'];
            $productPrice = $row['product_price'];

            echo "<tr>";
            echo "<td>$productName</td>";
            echo "<td>$productPrice</td>";
            echo "<td><input type='number' name='quantity' id='quantity_$productId' value='1'></td>";
            echo "<td><button onclick='checkout(parseInt($productId), parseFloat($productPrice))'>購買</button></td>";
            echo "</tr>";
        }
        ?>

    </table>


    <script>
        function checkout(productId, productPrice) {
            // 获取购买数量
            var quantity = document.getElementById('quantity_' + productId).value;

            // 获取会员ID
            var member_id = <?php echo isset($_SESSION['member_id']) ? $_SESSION['member_id'] : 'null'; ?>;

            // 获取当前日期
            var orderDate = new Date().toISOString().slice(0, 10);

            // 计算总价
            var totalPrice = quantity * productPrice;

            // 发送 AJAX 请求将数据写入数据库
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // 处理响应
                    console.log(this.responseText);
                }
            };

            // 修改為POST請求
            xhttp.open("POST", "checkout.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var params = "member_id=" + member_id + "&product_id=" + productId + "&order_date=" + orderDate + "&product_amount=" + quantity + "&total_price=" + totalPrice;
            xhttp.send(params);
        }

    </script>
</body>
</html>

<?php
// 关闭数据库连接
$conn->close();
?>