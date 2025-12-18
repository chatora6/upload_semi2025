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
        //$line = explode(",", trim($line));
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

    fclose($csvR);
    return $dataList;
}

