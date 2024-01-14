<?php
require 'connect_db.php';

// 初始化錯誤訊息
$error_message = "";

// 接收前端發送的註冊表單數據
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];

    // 在這裡你可以進行進一步的數據驗證和清理，以防止 SQL 注入等攻擊

    // 實行資料庫插入操作
    $sql = "INSERT INTO member (username, password, member_name, member_email, member_address, member_phone)
            VALUES ('$username', '$password', '$name', '$email', '$address', '$phone')";

    if ($conn->query($sql) === TRUE) {
        echo "註冊成功";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// 關閉資料庫連接
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員註冊</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function registerUser() {
            // 獲取表單中的資料
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm-password").value;
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var address = document.getElementById("address").value;
            var phone = document.getElementById("phone").value;

            // 驗證資料
            if (username === "" || password === "" || confirmPassword === "" || name === "" || email === "" || address === "" || phone === "") {
                document.getElementById("error-message").innerHTML = "請填寫所有必填欄位。";
                return;
            }

            // 檢查密碼和確認密碼是否相符
            if (password !== confirmPassword) {
                document.getElementById("error-message").innerHTML = "密碼和確認密碼不相符。";
                return;
            }

            // 使用 XMLHttpRequest 或 Fetch API 將資料發送到伺服器端
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "member_register.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // 將資料格式化為 URL-encoded 字符串
            var data = "username=" + encodeURIComponent(username) +
                    "&password=" + encodeURIComponent(password) +
                    "&name=" + encodeURIComponent(name) +
                    "&email=" + encodeURIComponent(email) +
                    "&address=" + encodeURIComponent(address) +
                    "&phone=" + encodeURIComponent(phone);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // 伺服器回應成功
                    var response = xhr.responseText;
                    if (response === "註冊成功") {
                        // 註冊成功後返回主頁
                        alert("註冊成功");
                    } else {
                        // 顯示伺服器回應的錯誤訊息
                        document.getElementById("error-message").innerHTML = response;
                    }
                }
            };

            // 發送資料
            xhr.send(data);
        }

        function goToHomePage() {
            // 將網頁跳轉到 home.php，使用 window.location.href
            window.location.href = 'home.php';
        }

    </script>
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #333;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        button {
            background-color: #28a745; /* 綠色 */
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        button:last-child {
            background-color: #dc3545; /* 紅色 */
        }

    </style>
</head>
<body>

<div class="container">
    <h1>會員註冊</h1>
    <div id="error-message"></div>

    <form id="registration-form">
        <label for="username">帳號：</label>
        <input type="text" id="username" name="username" required>

        <label for="password">密碼：</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm-password">重複密碼：</label>
        <input type="password" id="confirm-password" name="confirm-password" required>

        <label for="name">姓名：</label>
        <input type="text" id="name" name="name" required>

        <label for="email">信箱：</label>
        <input type="email" id="email" name="email" required>

        <label for="address">地址：</label>
        <input type="text" id="address" name="address" required>

        <label for="phone">手機號碼：</label>
        <input type="tel" id="phone" name="phone" required>
        <button type="button" onclick="registerUser()">註冊</button>
        <button type="button" onclick="goToHomePage()">返回主頁</button>
    </form>
</div>

<script src="script.js"></script>
</body>
</html>
