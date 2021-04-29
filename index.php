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
    if( $_POST['gender'] === "male" ) {
        $auto_reply_text .= "性別：男性\n";
    } else {
        $auto_reply_text .= "性別：女性\n";
    }

    if( $_POST['age'] === "1" ){
        $auto_reply_text .= "年齢：〜19歳\n";
    } elseif ( $_POST['age'] === "2" ){
        $auto_reply_text .= "年齢：20歳〜29歳\n";
    } elseif ( $_POST['age'] === "3" ){
        $auto_reply_text .= "年齢：30歳〜39歳\n";
    } elseif ( $_POST['age'] === "4" ){
        $auto_reply_text .= "年齢：40歳〜49歳\n";
    } elseif( $_POST['age'] === "5" ){
        $auto_reply_text .= "年齢：50歳〜59歳\n";
    } elseif( $_POST['age'] === "6" ){
        $auto_reply_text .= "年齢：60歳〜\n";
    }

    $auto_reply_text .= "お問い合わせ内容：" . nl2br($_POST['contact']) . "\n\n";
    $auto_reply_text .= "〇〇 事務局";

	mb_send_mail($_POST['email'], $auto_reply_subject, $auto_reply_text);

    $admin_reply_subject = "お問い合わせを受け付けました";

    // 本文を設定
    $admin_reply_text = "下記の内容でお問い合わせがありました。\n\n";
    $admin_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
    $admin_reply_text .= "氏名：" . $_POST['your_name'] . "\n";
    $admin_reply_text .= "メールアドレス：" . $_POST['email'] . "\n\n";

    if( $_POST['gender'] === "male" ) {
        $admin_reply_text .= "性別：男性\n";
    } else {
        $admin_reply_text .= "性別：女性\n";
    }

    if( $_POST['age'] === "1" ){
        $admin_reply_text .= "年齢：〜19歳\n";
    } elseif ( $_POST['age'] === "2" ){
        $admin_reply_text .= "年齢：20歳〜29歳\n";
    } elseif ( $_POST['age'] === "3" ){
        $admin_reply_text .= "年齢：30歳〜39歳\n";
    } elseif ( $_POST['age'] === "4" ){
        $admin_reply_text .= "年齢：40歳〜49歳\n";
    } elseif( $_POST['age'] === "5" ){
        $admin_reply_text.= "年齢：50歳〜59歳\n";
    } elseif( $_POST['age'] === "6" ){
        $admin_reply_text.= "年齢：60歳〜\n";
    }

    $admin_reply_text .= "お問い合わせ内容：" . nl2br($_POST['contact']) . "\n\n";

    // 運営側へメール送信
    mb_send_mail( 'ryoichiaz18@gmail.com', $admin_reply_subject, $admin_reply_text);
}
?>

<!DOCTYPE>
<html lang="ja">
<head>
    <title>お問い合わせフォーム</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>お問い合わせフォーム</h1>

<?php if ($page_flag === 1): ?>

    <form method="post" action="">
        <div class="element_wrap">
            <label>氏名</label>
            <input type="text" name="your_name" value="<?php if( !empty($_POST['your_name']) ){ echo $_POST['your_name']; } ?>">
        </div>
        <div class="element_wrap">
            <label>メールアドレス</label>
            <input type="text" name="email" value="<?php if( !empty($_POST['email']) ){ echo $_POST['email']; } ?>">
        </div>
        <div class="element_wrap">
            <label>性別</label>
            <label for="gender_male"><input id="gender_male" type="radio" name="gender" value="male" <?php if( !empty($_POST['gender']) && $_POST['gender'] === "male" ){ echo 'checked'; } ?>>男性</label>
            <label for="gender_female"><input id="gender_female" type="radio" name="gender" value="female" <?php if( !empty($_POST['gender']) && $_POST['gender'] === "female" ){ echo 'checked'; } ?>>女性</label>
        </div>
        <div class="element_wrap">
            <label>年齢</label>
            <select name="age">
                <option value="">選択してください</option>
                <option value="1" <?php if( !empty($_POST['age']) && $_POST['age'] === "1" ){ echo 'selected'; } ?>>〜19歳</option>
                <option value="2" <?php if( !empty($_POST['age']) && $_POST['age'] === "2" ){ echo 'selected'; } ?>>20歳〜29歳</option>
                <option value="3" <?php if( !empty($_POST['age']) && $_POST['age'] === "3" ){ echo 'selected'; } ?>>30歳〜39歳</option>
                <option value="4" <?php if( !empty($_POST['age']) && $_POST['age'] === "4" ){ echo 'selected'; } ?>>40歳〜49歳</option>
                <option value="5" <?php if( !empty($_POST['age']) && $_POST['age'] === "5" ){ echo 'selected'; } ?>>50歳〜59歳</option>
                <option value="6" <?php if( !empty($_POST['age']) && $_POST['age'] === "6" ){ echo 'selected'; } ?>>60歳〜</option>
            </select>
        </div>
        <div class="element_wrap">
            <label>お問い合わせ内容</label>
            <textarea name="contact"><?php if( !empty($_POST['contact']) ){ echo $_POST['contact']; } ?></textarea>
        </div>
        <div class="element_wrap">
            <label for="agreement"><input id="agreement" type="checkbox" name="agreement" value="1" <?php if( !empty($_POST['agreement']) && $_POST['agreement'] === "1" ){ echo 'checked'; } ?>>プライバシーポリシーに同意する</label>
        </div>
        <input type="submit" name="btn_confirm" value="入力内容を確認する">
    </form>

<?php elseif( $page_flag === 2 ): ?>

    <p>送信が完了しました。</p>

<?php else: ?>
<form method="post" action="">
    <div class="element_wrap">
        <label>氏名</label>
        <input type="text" name="your_name" value="<?php if( !empty($_POST['your_name']) ){ echo $_POST['your_name']; } ?>">
    </div>
    <div class="element_wrap">
        <label>メールアドレス</label>
        <input type="text" name="email" value="<?php if( !empty($_POST['email']) ){ echo $_POST['email']; } ?>">
    </div>
    <div class="element_wrap">
        <label>性別</label>
        <label for="gender_male"><input id="gender_male" type="radio" name="gender" value="male">男性</label>
        <label for="gender_female"><input id="gender_female" type="radio" name="gender" value="female">女性</label>
    </div>
    <div class="element_wrap">
        <label>年齢</label>
        <select name="age">
            <option value="">選択してください</option>
            <option value="1">〜19歳</option>
            <option value="2">20歳〜29歳</option>
            <option value="3">30歳〜39歳</option>
            <option value="4">40歳〜49歳</option>
            <option value="5">50歳〜59歳</option>
            <option value="6">60歳〜</option>
        </select>
    </div>
    <div class="element_wrap">
        <label>お問い合わせ内容</label>
        <textarea name="contact"></textarea>
    </div>
    <div class="element_wrap">
        <label for="agreement"><input id="agreement" type="checkbox" name="agreement" value="1">プライバシーポリシーに同意する</label>
    </div>
    <input type="submit" name="btn_confirm" value="入力内容を確認する">
</form>

<?php endif; ?>
</body>
</html>