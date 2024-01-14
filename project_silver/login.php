<?php
session_start(); // 啟動 session
$db = mysqli_connect('127.0.0.1','root','','project_silver');

if(!$db){
    echo "失敗連線資料庫";
}
// else{
//     echo "成功連線資料庫";
// }


$username = $_POST['username'];
$password = $_POST['password'];


$sql = "SELECT * FROM member WHERE username = '".$username."' AND password='".$password."' ";
$result = mysqli_query($db,$sql);
$coumt = mysqli_num_rows($result);

 if($coumt >= 1){
    $row = mysqli_fetch_assoc($result);
    $_SESSION['member_id'] = $row['member_id']; // 假設你的使用者 ID 欄位名稱是 user_id
    echo json_encode("success");
 }
else{
    echo json_encode("error");
}
?>