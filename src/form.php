<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/style.css">
  <title>アップロードフォーム</title>
</head>
<body>
<?php
include 'menu.php';
?>
<div class = "form_container">
  
  <form action="upload.php" enctype="multipart/form-data" method="post" class="up_form">
    <table>
    <tr><th>ファイル1</th><td>
    <input name="files[]" type="file">
    <tr><th><a>表示名1</a></th>
    <td><input type="text" name="summary[]" class="form"></td></tr>
    <tr><th><a>ジャンル</a></jth>
    <td><select name="genre[]">
      <option value="">選択してください</option>
      <option value="業務マニュアル・手順書">業務マニュアル・手順書</option>
      <option value="研修・教育資料">研修・教育資料</option>
      <option value="店舗ルール">店舗ルール</option>
      <option value="本部共有資料">本部共有資料</option>
      <option value="レシピ">レシピ</option>
      <option value="その他">その他</option>
    </select></td></tr>

    
    </table>

  <div class="up_btn"><br>
    <input type="submit" value="アップロード" id="up_btn">
  </div>
  </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(function() {
    $('form').on('submit', function(e) {
        e.preventDefault(); 

        var formData = new FormData(this); 

        $.ajax({
            url: 'upload.php', 
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response); 
                if(response.includes("")) {
                    location.reload(); 
                }
            },
            error: function() {
                alert("");
            }
        });
    });
});
</script>
</body>
</html>