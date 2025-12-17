<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="nav-container">
  <button class="menu_icon">
      <span class="line"></span>
      <span class="line"></span>
      <span class="line"></span>
  </button>
  <div class="menu_content">
    <li><a href="form.php">アップロードフォーム</a></li>
    <li><a href="show.php">ファイル一覧</a></li>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>
    $('.menu_icon').on('click', function() {
    $(this).closest('.nav-container').toggleClass('open');
});

// 外側クリックで閉じる
$(document).click(function(e) {
    if (!$(e.target).closest('.nav-container').length) {
        $('.nav-container').removeClass('open');
    }
});

</script>
</body>