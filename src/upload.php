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
    $genre = $_POST['genre'][$i] ?? '未分類';

    // クラスのメソッド呼び出し
    $result = $uploader->upload($fileData, $summary,$genre);
    $fileName = htmlspecialchars($fileData['name']);

    // 結果の判定
    if ($result === true) {
        //echo '<h3>'.$fileName.'アップロード完了しました</h3>';
        $results[] = "アップロード完了しました" . $fileData['name'];
    } else {
        // エラーメッセージを表示
        //echo '<h3 style="color:red;">' .$fileName.$result. '</h3>';
        $results[] = "アップロードに失敗しました" . $fileData['name'] . "：" . $status;
    }
  }

  if (empty($results)) {
    echo "ファイルが選択されていません。";
  } else {
      echo implode("\n", $results); // 改行区切りで結合
  }

} else {
  echo 'ファイルが送信されていません。';
}



