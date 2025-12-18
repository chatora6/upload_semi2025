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

$targetGenre = $_GET['genre'] ?? 'すべて';

//$csv_path= '../csv/file.csv';
$csvData = getData();

//URLパラメータから受け取る
$sort = $_GET['sort'] ?? 'new';

//並び替え関数
usort($csvData, 'fileSort');

echo '<h2>表示中: ' . htmlspecialchars($targetGenre) . '</h2>';

echo '<select id="sort-select" onchange="changeSort(this.value)">';
    echo '<option value="new" ' . ($sort == 'new' ? 'selected' : '') . '>新しい順</option>';
    echo '<option value="old" ' . ($sort == 'old' ? 'selected' : '') . '>古い順</option>';
    echo '<option value="summary_asc" ' . ($sort == 'summary_asc' ? 'selected' : '') . '>説明(昇順)</option>';
    echo '<option value="summary_desc" ' . ($sort == 'summary_desc' ? 'selected' : '') . '>説明(降順)</option>';
echo '</select>';

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
foreach($csvData as $i => $file_path){
    //$fileName = basename($file_path);
    // CSVからデータを取得
    //$info = $csvData[$fileName] ?? ['summary' => '説明なし', 'genre' => '未分類', 'time' => '不明'];
    $info = $csvData[$i] ?? ['name' => '','summary' => '説明なし', 'genre' => '未分類', 'time' => '不明'];
    $fileName = $info['name'] ?? '';
    $fileSummary = $info['summary'] ?? '';
    $fileGenre = $info['genre'] ?? '';
    $fileTime = $info['time'] ?? '';

    $downloadName = $fileSummary.'.pdf';
    $filePath = "../file/" . $fileName;
    //すべて表示でないときとジャンルが一致しないときはスキップ
    if($targetGenre !== 'すべて' && $fileGenre !== $targetGenre){
        continue;
    }

    echo '<div class="list">';
        echo '<div style="width:40%">' . htmlspecialchars($fileSummary). '</div>'; // 説明
        echo '<div style="width:20%">' . htmlspecialchars($fileGenre) .htmlspecialchars($fileTime). '</div>'; // ジャンル

        echo '<div style="width:20%">';
        echo '<a href="' . $filePath . '" download="' . htmlspecialchars($downloadName). '">ダウンロード</a>';
        echo '</div>';
        
        echo '<div style="width:20%">';
        echo '<form action="delete.php" method="post" class="delete-form">';
        echo '<input type="hidden" name="delete" value="' . $fileName . '">';
        echo '<button type="submit" onclick="return confirm(\'' . $fileSummary . 'を削除しますか？\')">削除</button>';
        echo '</form>';
        echo '</div>';
    echo '</div>';
    echo '<hr>';
}

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function changeSort(sortVal) {
    const genre = "<?php echo htmlspecialchars($targetGenre); ?>";
    window.location.href = "show.php?sort=" + sortVal + "&genre=" + encodeURIComponent(genre);
}


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