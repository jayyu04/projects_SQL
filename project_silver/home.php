<?php
// 啟動 session
session_start();

// 判斷是否已登入
if (isset($_SESSION['member_id'])) {
    // 使用者已登入
    $loggedIn = true;
} else {
    // 使用者未登入
    $loggedIn = false;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>購物主頁</title>
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

<header>
    <h1>歡迎來到我們的購物網站</h1>
    <nav>
        <ul>
        <?php
            // 根據使用者的登入狀態顯示不同的導覽連結
            if (!$loggedIn) {
                echo '<li><a href="member_register.php">會員註冊</a></li>';
                echo '<li><a href="member_login.html">會員登入</a></li>';
                //echo '<li><a href="store.html">商品頁面</a></li>';
                echo '<li><a href="admin_page.php">管理員頁面</a></li>';
            } else {
                //echo '<li><a href="member_edit_profile.php">會員修改資料</a></li>';
                echo '<li><a href="member_logout.php">會員登出</a></li>';
                echo '<li><a href="store.php">商品頁面</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>

<main>
    <!-- 主要內容放在這裡 -->
    <p>這裡放一些主要的購物內容，比如最新商品、促銷活動等。</p>
</main>

<footer>
    <p>&copy; 2024 購物網站. All rights reserved.</p>
</footer>

</body>
</html>