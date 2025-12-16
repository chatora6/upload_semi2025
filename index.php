<?php
header('Location: src/form.html');
exit;
/*
if (isset($_GET['do']) && $_GET['do'] === 'form') {
    //ログイン済みの場合外部ファイルを読み込み
    require 'src/form.php'; 
} else {
    header('Location: ?do=form');
    exit; 
} 
*/
