<?php
session_start();
include("functions.php");
check_session_id();

if (
    !isset($_POST['title']) || $_POST['title'] == '' 
) {
    // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["error_msg" => "no input"]);
    exit();
}

// 受け取ったデータを変数に入れる
$title = $_POST['title'];
$pdo = connect_to_db();

// ここからファイルアップロード&DB登録の処理を追加しよう！！！
if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] == 0) {
} else {
    exit('Error:送信されていないです。');
}

$uploadedFileName = $_FILES['upfile']['name'];
$tempPathName = $_FILES['upfile']['tmp_name'];
$fileDirectoryPath = 'upload/';

$extension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);
$uniqueName = date('YmdHis') . md5(session_id()) . "." . $extension;
$fileNameToSave = $fileDirectoryPath . $uniqueName;

if (is_uploaded_file($tempPathName)) {
    if (move_uploaded_file($tempPathName, $fileNameToSave)) {
        chmod($fileNameToSave, 0644);
    } else {
        exit('failed');
    }
} else {
    exit('Its nothing in here');
};

$sql = 'INSERT INTO img_table(id, title, image, created_at, updated_at) VALUES(NULL, :title, :image,sysdate(), sysdate())';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':image', $fileNameToSave, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    header("Location:read.php");
    exit();
}
