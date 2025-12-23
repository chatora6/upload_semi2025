<?php
function getData() {
$csvPath= '../csv/file.csv';
$dataList = [];
if (!file_exists($csvPath)) {
    return $dataList; 
}

$csvR = fopen($csvPath, "r");
//一行ずつ

while (($line = fgetcsv($csvR))!== FALSE) {
    // $line[0]:ファイル名, $line[1]:説明, $line[2]:ジャンル
    //$part = explode(",", trim($line));
    /*$dataList[$line[0]] = [
        'summary' => $line[1] ?? '',
        'genre'   => $line[2] ?? '未分類',
        'time'    => $line[3] ?? '不明'
    ];*/
    
    if(isset($line[0])){
        $dataList[] = [
            'name'    => $line[0] ?? '',
            'summary' => $line[1] ?? '',
            'genre'   => $line[2] ?? '未分類',
            'time'    => $line[3] ?? '不明'
        ];    
    }
    
}
    /*
while ($line = fgets($csvR)) {
    $parts = explode(",", trim($line));
    $csv_data[$parts[0]] = [
        'summary' => $parts[1] ?? '',
        'genre'   => $parts[2] ?? '未分類',
        'time'    => $parts[3] ?? '不明'
    ];
}*/

fclose($csvR);
return $dataList;
}

function fileSort($a, $b) {
$order = $_GET['sort'] ?? 'new';

$timeAsc = strtotime($a['time']) - strtotime($b['time']);
$timeDesc = strtotime($b['time']) - strtotime($a['time']);
//$summaryAsc =strcmp($a['summary'], $b['summary']);
//$summaryDesc =strcmp($b['summary'], $a['summary']);

switch ($order) {
    case 'old': 
        $diff = $timeAsc;
        //if ($diff === 0) $diff = $summaryAsc;
        return $diff;
    /*
    case 'summary_asc':
        $diff = $summaryAsc;
        //if ($diff === 0) $diff = $timeAsc;
        return $diff;
        

    case 'summary_desc': 
        $diff = $summaryDesc;
        //if ($diff === 0) $diff = $timeAsc;
        return $diff;
    */
    case 'new':
    default:
        
        $diff = $timeDesc;
        //if ($diff === 0) $diff = $summaryAsc;
        return $diff;
}
}
