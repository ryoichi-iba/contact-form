<?php
//var_dump($_POST);

$page_flag = 0;

if(!empty($_POST['btn_confirm'])) {
    $page_flag = 1;
} elseif(!empty($_POST['btn_submit'])) {
    $page_flag = 2;

    $auto_reply_subject = null;
    $auto_reply_text = null;
    $admin_reply_subject = null;
    $admin_reply_text = null;

    date_default_timezone_set('Asia/Tokyo');

    $auto_reply_subject = 'お問い合わせありがとうございます。';

    $auto_reply_text = "この度はお問い合わせいただき誠にありがとうございます。
    下記の内容でお問い合わせを受け付けました。\n\n";

    $auto_reply_text .= "お問い合わせ日時:" . date("y-m-d H:i") . "\n";
    $auto_reply_text .= "氏名：" . $_POST['your_name'] . "\n";
	$auto_reply_text .= "メールアドレス：" . $_POST['email'] . "\n\n";
	$auto_reply_text .= "GRAYCODE 事務局";

	mb_send_mail($_POST['email'], $auto_reply_subject, $auto_reply_text);

    $admin_reply_subject = "お問い合わせを受け付けました";

    // 本文を設定
    $admin_reply_text = "下記の内容でお問い合わせがありました。\n\n";
    $admin_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
    $admin_reply_text .= "氏名：" . $_POST['your_name'] . "\n";
    $admin_reply_text .= "メールアドレス：" . $_POST['email'] . "\n\n";

    // 運営側へメール送信
    mb_send_mail( 'ryoichiaz18@gmail.com', $admin_reply_subject, $admin_reply_text);
}
?>

<!DOCTYPE>
<html lang="ja">
<head>
    <title>お問い合わせフォーム</title>
    <style rel="stylesheet" type="text/css">
        body {
            padding: 20px;
            text-align: center;
            margin: 0 auto;
            width: 700px;
        }

        h1 {
            margin-bottom: 20px;
            padding: 20px 0;
            color: #209eff;
            font-size: 122%;
            border-top: 1px solid #999;
            border-bottom: 1px solid #999;
        }

        input[type=text] {
            padding: 5px 10px;
            font-size: 86%;
            border: none;
            border-radius: 3px;
            background: #ddf0ff;
        }

        input[name=btn_confirm],
        input[name=btn_submit],
        input[name=btn_back] {
            margin-top: 10px;
            padding: 5px 20px;
            font-size: 100%;
            color: #fff;
            cursor: pointer;
            border: none;
            border-radius: 3px;
            box-shadow: 0 3px 0 #2887d1;
            background: #4eaaf1;
        }

        input[name=btn_back] {
            margin-right: 20px;
            box-shadow: 0 3px 0 #777;
            background: #999;
        }

        .element_wrap {
            margin-bottom: 10px;
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }

        label {
            display: inline-block;
            margin-bottom: 10px;
            font-weight: bold;
            width: 150px;
        }

        .element_wrap p {
            display: inline-block;
            margin:  0;
            text-align: left;
        }
    </style>
</head>
<body>
<h1>お問い合わせフォーム</h1>

<?php if ($page_flag === 1): ?>

    <form method="post" action="">
        <div class="element_wrap">
            <label>氏名</label>
            <p><?php echo $_POST['your_name']; ?></p>
        </div>
        <div class="element_wrap">
            <label>メールアドレス</label>
            <p><?php echo $_POST['email']; ?></p>
        </div>
        <input type="submit" name="btn_back" value="戻る">
        <input type="submit" name="btn_submit" value="送信">
        <input type="hidden" name="your_name" value="<?php echo $_POST['your_name']; ?>">
        <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
    </form>

<?php elseif( $page_flag === 2 ): ?>

    <p>送信が完了しました。</p>

<?php else: ?>
<form method="post" action="">
    <div class="element_wrap">
        <label>氏名</label>
        <input type="text" name="your_name" value="">
    </div>
    <div class="element_wrap">
        <label>メールアドレス</label>
        <input type="text" name="email" value="">
    </div>
    <input type="submit" name="btn_confirm" value="入力内容を確認する">
</form>

<?php endif; ?>
</body>
</html>