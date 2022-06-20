<?php
session_start();

//エラー条件
$error = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    // フォーム送信時にエラーチェックをする。
    if ($post['name'] === '') {
        $error['name'] = 'blank';
    }
    if($post['email'] === '') {
        $error['email'] = 'blank';
    } else if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'email';
    }

    if($post['contact'] === '') {
        $error['contact'] = 'blank';
    }

    if(count($error) === 0) {
        //エラーがない時に確認画面へ遷移
        $_SESSION['form'] = $post;
        header('Location: confirm.php');
        exit();
    }
} else {
    if (isset($_SESSION['form'])) {
        $post = $_SESSION['form'];
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問合せフォーム</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="contact.css">
    <script type="text/javascript" src="index.js"></script>
    <script type="text/javascript" src="jquery-3.4.1.min.js" ></script>
</head>
<body>
    <!-- お問合せフォーム画面 -->
    <div class="container">
        <form action="" method="POST" novalidate>
            <p>お問い合わせ</p>
            <div class="form-group">
                <div class="row">
                    <div class="col-2">
                        <label for="inputName">お名前</label>
                    </div>
                    <div class="col-2">
                        <p class="require_item">必須</p>
                    </div>
                    <div class="col-8">
                        <input type="text" name="name" id="inputName" oninput="nameCheck(this)" class="form-control" value="<?php echo htmlspecialchars($post['name']); ?>"  required autofocus>
                        <?php if($error['name'] === 'blank')://名前が空欄だった時にエラーを返す。 ?>
                            <p class="error_msg">※お名前をご記入下さい</p>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-2">
                        <label for="inputEmail">メールアドレス</label>
                    </div>
                    <div class="col-2">
                        <p class="require_item">必須</p>
                    </div>
                    <div class="col-8">
                        <input type="email" name="email" id="inputEmail" class="form-control" oninput="emailCheck(this)" value="<?php echo htmlspecialchars($post['email']) ?>" required>
                        <?php if($error['email'] === 'blank'): //emailが空欄だったらエラーを返す。 ?>
                        <p class="error_msg">メールアドレスを入力してください。</p>
                        <?php endif; ?>
                        <?php if($error['email'] === 'email'): //emailが空欄だったらエラーを返す。 ?>
                        <p class="error_msg">メールアドレスを正しくご記入ください。</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-2">
                        <label for="inputContent">お問い合わせ内容</label>
                    </div>
                    <div class="col-2">
                        <p class="require_item">必須</p>
                    </div>
                    <div class="col-8">
                        <textarea name="contact" id="inputContent" rows="10" class="form-control" oninput="nameCheck(this)" required><?php echo htmlspecialchars($post['contact']) ?></textarea>
                        <?php if($error['contact'] === 'blank'): //お問い合わせ内容が空欄だったら ?>
                        <p class="error_msg">必ず1つは入力してください。</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8 offset-4">
                    <button type="submit">確認画面へ</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
