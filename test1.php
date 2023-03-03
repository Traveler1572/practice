<?php
// データベースへの接続情報
$host = 'localhost'; // MySQLが稼動しているサーバのアドレス
$dbname = 'testbbs1'; // データベース名
$user = 'root';     // データベースにアクセスするユーザ名
$pass = '';         // データベースにアクセスするユーザのパスワード

// データベースに接続
try {
    $dbh = new PDO("mysql:host={$host};dbname={$dbname}", $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

// POSTされたデータをデータベースに格納する
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 投稿内容を取得
    $test_name = htmlspecialchars(filter_input(INPUT_POST,'test_name'), ENT_QUOTES, 'UTF-8');
    $test_mail = htmlspecialchars(filter_input(INPUT_POST,'test_mail'), ENT_QUOTES, 'UTF-8');
    $test_title = htmlspecialchars(filter_input(INPUT_POST,'test_title'), ENT_QUOTES, 'UTF-8');
    $test_toukou = htmlspecialchars(filter_input(INPUT_POST,'test_toukou'), ENT_QUOTES, 'UTF-8');

    // データベースに格納する
    $stmt = $dbh->prepare('INSERT INTO messages (name, mail, title, comment) VALUES (:name, :mail, :title, :comment)');
    $stmt->bindParam(':name', $test_name, PDO::PARAM_STR);
    $stmt->bindParam(':mail', $test_mail, PDO::PARAM_STR);
    $stmt->bindParam(':title', $test_title, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $test_toukou, PDO::PARAM_STR);
    $stmt->execute();
}

// データベースから投稿内容を取得する
$stmt = $dbh->prepare('SELECT * FROM messages ORDER BY created_at DESC');
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>掲示板テスト</title>
</head>
<body>
    <form action="test1.php" method="post">
        名前:<input type="text" name="test_name"><br>
        メール:<input type="text" name="test_mail"><br>
        タイトル:<input type="text" name="test_title"><br>
        本文:<textarea name="test_toukou" rows="8" cols="40">
        </textarea><br>
        <input type="submit" name="contents" value="投稿">
    </form>
    <hr>
    <!-- 投稿内容一覧 -->
    <?php foreach ($messages as $message) : ?>
        <p><?php echo $message['test_name']; ?> <?php echo $message['created_at']; ?></p>
        <p><?php echo $message['test_mail']; ?>[</p>
        <p><?php echo $message['test_title']; ?>[</p>
        <p><?php echo $message['test_toukou']; ?>[</p>
        <hr>
    <?php endforeach; ?>
</body>
</html>