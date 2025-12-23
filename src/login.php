<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php
if (isset($_SESSION['user_name'])) {
    header("Location: show.php");
    exit;
}
//echo password_hash("456", PASSWORD_DEFAULT);
?>

    <div class="login-container">
        <h2>ログイン</h2>
        <?php 
        if (isset($_GET['error'])): 
            echo '<p style="color: red;">IDまたはパスワードが違います</p>';
            endif; 
        ?>
        <form action="auth_check.php" method="post">
            <div style="margin-bottom: 10px;">
                <label>ユーザーID</label><br>
                <input type="text" name="user_id" required style="width: 100%;">
            </div>
            <div style="margin-bottom: 10px;">
                <label>パスワード</label><br>
                <input type="password" name="password" required style="width: 100%;">
            </div>
            <button type="submit" style="width: 100%; padding: 10px;">ログイン</button>
        </form>
    </div>
</body>
</html>