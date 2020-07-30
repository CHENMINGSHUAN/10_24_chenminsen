<?php
session_start();
include("functions.php");
check_session_id();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <form action="file_create.php" enctype="multipart/form-data" method="POST">


        <a href="read.php">一覧画面</a>
        <a href="logout.php">logout</a>
        <div>
            title: <input type="text" name="title">
        </div>
        <div>
            <label class="btn btn-info">
                <input id="upload_img" name="upfile" style="display:none;" type="file" accept="image/*" capture="camera">
                <img src="https://cdn.pixabay.com/photo/2017/03/19/03/51/material-icon-2155448_1280.png" alt="" height="80px" width="160px">
            </label>
        </div>

        <div>
            <button>submit</button>
        </div>

    </form>

</body>

</html>