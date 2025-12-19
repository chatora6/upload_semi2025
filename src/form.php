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
<form action="upload.php" enctype="multipart/form-data" method="post" class="form_container">
  <h2>アップロードフォーム</h2>
  <div class="align_content">
    <a>表示されるファイル名<span style="color: red;">*</span></a>
    <input type="text" name="summary[]" class="item" placeholder="20字以内で入力してください。" maxlength="20" required>
  </div><hr>
  <div class="align_content">
    <a>ファイル<span style="color: red;">*</span></a>
    <input name="files[]" type="file" class="item" required>
  </div><hr>
  <div class="align_content">
    <a>区分<span style="color: red;">*</span></a>
    <div class="radio">
    <div><input type="radio" name="genre[]" value="業務マニュアル・手順書" checked>業務マニュアル・手順書</div>
    <div><input type="radio" name="genre[]" value="研修・教育資料">研修・教育資料</div>
    <div><input type="radio" name="genre[]" value="店舗ルール">店舗ルール</div>
    <div><input type="radio" name="genre[]" value="本部共有資料">本部共有資料</div>
    <div><input type="radio" name="genre[]" value="レシピ">レシピ</div>
    <div><input type="radio" name="genre[]" value="その他">その他</div>
    </div>
  </div>

  <div class=".align_content">
    <input type="submit" value="アップロード" id="up_btn">
  </div>
</form>


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