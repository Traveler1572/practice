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
        本文:<textarea name="test_toukou" rows="8" cols="40">
        </textarea><br>
        <input type="submit" name="contents" value="投稿">
    </form>
    <hr>
    <?php
    #HTML側からPOST送信された入力データを各変数として受け取る
    $test_name = filter_input(INPUT_POST,'test_name');
    $test_mail = filter_input(INPUT_POST,'test_mail');
    $test_title = filter_input(INPUT_POST,'test_title');
    $test_toukou = filter_input(INPUT_POST,'test_toukou');
    $test_toukou = nl2br($test_toukou);

    #受け取ったデータを段落としてブラウザへ出力する
    print('<p>名前:'.$test_name.'</p>');
    print('<p>メール:'.$test_mail.'</p>');
    print('<p>タイトル:'.$test_title.'</p>');
    print('<p>本文:'.$test_toukou.'</p>');
    print('<hr>');
    ?>
</body>
</html>