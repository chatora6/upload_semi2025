<?php
function GetData() {
    $csv_path= '../csv/file.csv';
    $data_list = [];
    if (!file_exists($csv_path)) {
        return $data_list; 
    }

    $csv_r = fopen($csv_path, "r");
    //一行ずつ
    while (($line = fgetcsv($csv_r))!== FALSE) {
        // $line[0]:ファイル名, $line[1]:説明, $line[2]:ジャンル
        //$line = explode(",", trim($line));
        /*$data_list[$line[0]] = [
            'summary' => $line[1] ?? '',
            'genre'   => $line[2] ?? '未分類',
            'time'    => $line[3] ?? '不明'
        ];*/
        $data_list[] = [
            'name'  => $line[0] ?? '',
            'summary' => $line[1] ?? '',
            'genre'   => $line[2] ?? '未分類',
            'time'    => $line[3] ?? '不明'
        ];
    }

    fclose($csv_r);
    return $data_list;
}
