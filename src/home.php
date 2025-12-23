<?php
session_start();
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>ホーム | カフェ本部連絡システム</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php
include 'menu.php';
require_once 'get_data.php';

$csvData = getData();
//新しい順
$_GET['sort'] = 'new'; 
usort($csvData, 'fileSort');
//最新のファイル5つ
$recentItems = array_slice($csvData, 0, 5);

echo '<main style="max-width: 900px; margin: 80px auto; padding: 0 20px;">';
    echo '<section class="recent-files">';
        echo '<h3>新着の共有文書（最新5件）</h3>';
        echo '<table style="width: 100%; border-collapse: collapse;">';

        foreach($recentItems as $info) {
            $time = htmlspecialchars($info['time']);
            $genre = htmlspecialchars($info['genre']);
            $summary = htmlspecialchars($info['summary']);
            $filePath = '../file/' . $info['name'];

            echo '<tr style="border-bottom: 1px solid #ddd;">';
                echo '<td style="padding: 10px;">' . date('Y/m/d', strtotime($time)) . '</td>';
                echo '<td><span class="badge">' . $genre . '</span></td>';
                echo '<td><strong>' . $summary . '</strong></td>';
                echo '<td style="text-align: right;">';
                    echo '<a href="' . $filePath . '" class="btn">確認</a>';
                echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    echo '</section>';
echo '</main>';
?>
</body>
</html>