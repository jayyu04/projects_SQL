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

// 查询订单信息及相关的会员和产品信息
$query = "SELECT
            ol.order_id,
            m.member_name,
            m.member_address,
            m.member_phone,
            p.product_name,
            p.product_price,
            ol.order_date,
            ol.product_amount,
            ol.total_price
          FROM
            orderlist ol
          JOIN
            member m ON ol.member_id = m.member_id
          JOIN
            product p ON ol.product_id = p.product_id";

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
    <title>管理員頁面</title>
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

<header>
<h1>管理員頁面</h1>
    <nav>
        <ul>
            <li><a href="home.php">首頁</a></li>
        </ul>
    </nav>
</header>

<body>
    <h2>訂單訊息</h2>
    <table border="1">
        <tr>
            <th>訂單編號</th>
            <th>會員名稱</th>
            <th>會員地址</th>
            <th>會員電話</th>
            <th>會員名稱</th>
            <th>商品價格</th>
            <th>商品數量</th>
            <th>總價</th>
            <th>訂單日期</th>
        </tr>

        <?php
        // 显示订单信息
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['order_id'] . "</td>";
            echo "<td>" . $row['member_name'] . "</td>";
            echo "<td>" . $row['member_address'] . "</td>";
            echo "<td>" . $row['member_phone'] . "</td>";
            echo "<td>" . $row['product_name'] . "</td>";
            echo "<td>" . $row['product_price'] . "</td>";
            echo "<td>" . $row['product_amount'] . "</td>";
            echo "<td>" . $row['total_price'] . "</td>";
            echo "<td>" . $row['order_date'] . "</td>";
            echo "</tr>";
        }
        ?>

    </table>
</body>
</html>

<?php
// 关闭数据库连接
$conn->close();
?>
