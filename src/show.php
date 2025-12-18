<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>ファイル一覧</title>
</head>

<body>
<?php
include 'menu.php';
require_once 'get_data.php';

$target_genre = $_GET['genre'] ?? 'すべて';

//$csv_path= '../csv/file.csv';
$csv_data = GetData();

echo '<h2>表示中: ' . htmlspecialchars($target_genre) . '</h2>';
echo '<div class="list" style="margin-top:70px;">';
    echo '<div style="width:40%">ファイル説明</div>';
    echo '<div style="width:20%">ジャンル</div>';
    echo '<div style="20%"></div>';
    echo '<div style="20%"></div>';
echo '</div>';
echo '<hr>';

//fileの中のpdfのみ探す
//$files = glob("../file/*.pdf"); 

//一覧で表示
foreach($csv_data as $i => $file_path){
    //$file_name = basename($file_path);
    // CSVからデータを取得
    //$info = $csv_data[$file_name] ?? ['summary' => '説明なし', 'genre' => '未分類', 'time' => '不明'];
    $info = $csv_data[$i] ?? ['name' => '','summary' => '説明なし', 'genre' => '未分類', 'time' => '不明'];
    $file_name = $info['name'] ?? '';
    $file_summary = $info['summary'] ?? '';
    $file_genre = $info['genre'] ?? '';
    $file_time = $info['time'] ?? '';

    //すべて表示でないときとジャンルが一致しないときはスキップ
    if($target_genre !== 'すべて' && $file_genre !== $target_genre){
        continue;
    }

    echo '<div class="list">';
        echo '<div style="width:40%">' . htmlspecialchars($file_summary) . '</div>'; // 説明
        echo '<div style="width:20%">' . htmlspecialchars($file_genre) . '</div>'; // ジャンル

        echo '<div style="width:20%">';
        echo '<a href="' . $file_name . '" download="' . $file_summary . '">ダウンロード</a>';
        echo '</div>';
        
        echo '<div style="width:20%">';
        echo '<form action="delete.php" method="post" class="delete-form">';
        echo '<input type="hidden" name="delete" value="' . $file_name . '">';
        echo '<button type="submit" onclick="return confirm(\'' . $file_summary . 'を削除しますか？\')">削除</button>';
        echo '</form>';
        echo '</div>';
    echo '</div>';
    echo '<hr>';
}

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(function() {
    $('.delete-form').on('submit', function(e) {
        e.preventDefault(); 

        var formData = new FormData(this); 

        $.ajax({
            url: 'delete.php', 
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