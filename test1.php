<?php
$test_name = filter_input(INPUT_POST,'test_name');
$test_mail = filter_input(INPUT_POST,'test_mail');
$test_title = filter_input(INPUT_POST,'test_title');
$test_toukou = filter_input(INPUT_POST,'test_toukou');

var_dump($test_name,$test_mail,$test_title,$test_toukou);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板テスト</title>
</head>
<body>
    <form action="test1.php" method="post">
        名前:<input type="text" name="test_name"><br>
        メール:<input type="text" name="test_mail"><br>
        タイトル:<input type="text" name="test_title"><br>
        本文:<textarea name="contents" rows="8" cols="40">
        </textarea><br>
        <input type="submit" name="test_toukou" value="投稿">
    </form>
</body>
</html>