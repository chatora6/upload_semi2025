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
    <li><a href="form.php" style="color:white">新規アップロード</a></li>
    <li><a href="show.php?genre=すべて">すべてのファイル</a></li>
    <li><a href="show.php?genre=業務マニュアル・手順書">業務マニュアル・手順書</a></li>
    <li><a href="show.php?genre=研修・教育資料">研修・教育資料</a></li>
    <li><a href="show.php?genre=店舗ルール">店舗ルール</a></li>
    <li><a href="show.php?genre=報告書">報告書</a></li>
    <li><a href="show.php?genre=本部共有資料">本部共有資料</a></li>
    <li><a href="show.php?genre=レシピ">レシピ</a></li>
    <li><a href="show.php?genre=その他">その他</a></li>
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