<?php
include("functions.php");
session_start();
check_session_id();
$name = $_SESSION["name"];
// DB接続
$pdo = connect_to_db();


// データ取得SQL作成
$sql = 'SELECT * FROM img_table';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    // fetchAll()関数でSQLで取得したレコードを配列で取得できる
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
    $output = "";
    // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
    // `.=`は後ろに文字列を追加する，の意味
    foreach ($result as $record) {
        // edit deleteリンクを追加

        $output .= "<div class='AutoNewline' id='img_m'>";
        $output .= "<div ><img src='{$record["image"]}'  class='min' id='img'></div>";
        $output .= "<div >{$record["title"]}</div>";
        // $output .= " <form action='comment_act.php' method='POST'>";
        // $output .= "<input type='text' placeholder='コメント'>";
        // $output .= "<input type='submit'>";
        $output .= "</div>";
        // $output .= "</form>";
    }
    // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
    // 今回は以降foreachしないので影響なし
    unset($value);
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .AutoNewline {
            word-break: break-all;
            
        }

        .min {
            word-break: break-all;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-right: 50px;
        }

        .message {
            text-decoration: none;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: center;
            word-break: break-all;
        }

        .select ul li {
            display: inline;
            text-decoration: none;
        }

        header {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        footer {
            right: 40%;
            position: fixed;
            bottom: 10px;
        }

        .modal {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transform: scale(1.1);
            transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 1rem 1.5rem;
            width: 24rem;
            border-radius: 0.5rem;
        }

        .close-button {
            float: right;
            width: 1.5rem;
            line-height: 1.5rem;
            text-align: center;
            cursor: pointer;
            border-radius: 0.25rem;

        }


        .close-button:hover {
            background-color: darkgray;
        }

        .show-modal {
            opacity: 1;
            visibility: visible;
            transform: scale(1.0);
            transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
        }

        .search {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;

        }

        #search {
            margin-top: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .resultarea {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        body {
            background-color: lightgrey;
        }
    </style>
</head>

<body>
    <header>
        <h1>足跡</h1>

    </header>


    <nav class="AutoNewline">

        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->

        <?= $output ?>

    </nav>
    <div class="search">
        <div><input type="text" placeholder="検索" id="search">

        </div>
        <div id="resultarea" class="resultarea"></div>
    </div>
    <footer>
        <div class="select">
            <ul>
                <!-- <li> <a href="message.php">マイページ</a> -->
                <!-- </li> -->
                <li><img class="trigger" src="https://cdn.pixabay.com/photo/2017/03/19/03/51/material-icon-2155448_1280.png" alt="" height="80px" width="160px" alt=""> </a></li>
                <li><a href=" logout.php">ログアウト</a></li>
            </ul>

            <div class="modal">
                <div class="modal-content">
                    <span class="close-button">×</span>
                    <form action="file_create.php" enctype="multipart/form-data" method="POST">


                        <h2>アップロードしましょう。</h2>

                        <div>
                            <label class="btn btn-info">
                                <input id="upload_img" name="upfile" style="display:none;" type="file" accept="image/*" capture="camera">
                                <img src="../10_24_chinminsen/img/photo.png" alt="" height="80px" width="80px">
                            </label>
                        </div>
                        <div>
                            <input type="text" name="title" placeholder="タイトル">
                        </div>
                        <div>
                            <button>submit</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $('#search').on('keyup', function() {
            console.log($(this).val());
            const serchWord = $(this).val();
            const requestUrl = 'get.php';
            axios.get(`${requestUrl}?serchword=${serchWord}`) // ①リクエスト送信
                .then(function(response) {
                    // console.log(response); // ④受け取り→表示
                    // console.log(response.data[0].todo);
                    let result = response.data.map(x =>
                        // console.log(x.deadline)
                        `<img src='${x.image}' class='min' id='img'></div>`
                    );
                    $('#resultarea').html(result);
                })



        });
        var modal = document.querySelector(".modal");
        var trigger = document.querySelector(".trigger");
        var closeButton = document.querySelector(".close-button");

        function toggleModal() {
            modal.classList.toggle("show-modal");
        }

        function windowOnClick(event) {
            if (event.target === modal) {
                toggleModal();
            }
        }

        trigger.addEventListener("click", toggleModal);
        closeButton.addEventListener("click", toggleModal);
        window.addEventListener("click", windowOnClick);
    </script>
</body>

</html>