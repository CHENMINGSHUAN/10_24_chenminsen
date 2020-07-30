<?php
include("functions.php");
$search_word = $_GET["serchword"]; // GETのデータ受け取り
$sql = "SELECT * FROM img_table WHERE title LIKE '%{$search_word}%'";
$pdo = connect_to_db();
$stmt = $pdo->prepare($sql);

$status = $stmt->execute();
if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
    exit();
}
