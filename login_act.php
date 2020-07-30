<?php
// var_dump($_POST);
// exit();
session_start();

// 外部ファイル読み込み
include("functions.php");

// DB接続します
$pdo = connect_to_db();

$email = $_POST["email"];
$password = $_POST["password"];

// データ取得SQL作成&実行
$sql = 'SELECT * FROM user_table WHERE email=:email AND password=:password ';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

// SQL実行時にエラーがある場合
if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
}

// うまくいったらデータ（1レコード）を取得
$val = $stmt->fetch(PDO::FETCH_ASSOC);

// ユーザ情報が取得できない場合はメッセージを表示
if (!$val) {
    echo "<p>ログイン情報に誤りがあります．</p>";
    echo '<a href="login_input.php">ログイン</a>';
    exit();
} else {
    $_SESSION = array();
    $_SESSION["session_id"] = session_id();
    $_SESSION["is_admin"] = $val["is_admin"];
    $_SESSION["name"] = $val["name"];
    $_SESSION["email"] = $val["email"];
    $_SESSION["id"] = $val["id"];
    header("Location:read.php");
    exit();
}
