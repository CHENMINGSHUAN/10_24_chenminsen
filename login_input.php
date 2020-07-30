<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;

        }

        .input {
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .submit {
            margin-top: 10px;
        }

        body {
            background-color: lightgrey;
        }
    </style>
</head>

<body>

    <header>
        <h1> ログイン</h1>
    </header>
    <form action="login_act.php" method="POST">
        <nav>

            <label for="">メールアドレス</label>
            <input type="email" name="email" id="email" class="input">
            <label for="">パスワード</label>
            <input type="password" name="password" id="password" class="input">
            <div> 初めの方は<a href="register_input.php">こちら</a>です。</div>
            <input type="submit" class="submit">
        </nav>
    </form>
</body>

</html>