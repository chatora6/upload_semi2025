<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>ファイル一覧</title>
</head>
<body>
  
<?php 
require_once 'process_data.php';

// クラスのインスタンス化
$uploader = new FileUploader();

if (isset($_FILES['files'])) {
  $count = count($_FILES['files']['name']);

  for ($i = 0; $i < $count; $i++) {
    if ($_FILES['files']['error'][$i] === UPLOAD_ERR_NO_FILE) {
      continue;
    }

    $fileData = [
      'name'     => $_FILES['files']['name'][$i],
      'type'     => $_FILES['files']['type'][$i],
      'tmp_name' => $_FILES['files']['tmp_name'][$i],
      'error'    => $_FILES['files']['error'][$i],
      'size'     => $_FILES['files']['size'][$i],
    ];

    $summary = $_POST['summary'][$i] ?? '';
    
    // クラスのメソッド呼び出し
    $result = $uploader->Upload($fileData, $summary);
    $fileName = htmlspecialchars($fileData['name']);

    // 結果の判定
    if ($result === true) {
        echo '<h3>'.$fileName.'アップロード完了しました</h3>';
    } else {
        // エラーメッセージを表示
        echo '<h3 style="color:red;">' .$fileName.$result. '</h3>';
    }
  }

} else {
  echo '<h3>ファイルが送信されていません。</h3>';
}

?>


<a href="form.html" style="margin-left: 60%;">戻る</a> 
<a href="show.php" style="margin-left:10px;">一覧へ</a> 


</body>
</html>