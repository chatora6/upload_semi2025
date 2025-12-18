
<?php
//削除するファイル
$deleteFile =$_POST['delete'];
$DeleteFilePath='../file/'.$deleteFile;

//現在のcsvファイル
$csvfile = '../csv/file.csv';
//一時保存するcsvファイル
$csvfileTmp = '../csv/file_tmp.csv';

//読み込み
$csvR=fopen($csvfile,"r");
//書き込み
$csvTmpW=fopen($csvfileTmp,"w");

$csvData=[];

if(unlink($DeleteFilePath)){
    echo "ファイル削除に成功しました。";
    while(($line = fgetcsv($csvR,1024))!==FALSE){
        $name = $line[0];
        $summary = $line[1];
        $genre = $line[2];
        $time = $line[3];
        if($deleteFile != $name){//削除ファイル以外の時
            fputcsv($csvTmpW, [$name, $summary,$genre,$time]);
        }
    }
    fclose($csvR);//ファイルを閉じる
    fclose($csvTmpW);

    copy($csvfileTmp, $csvfile);
    $csvTmpW=fopen($csvfileTmp,"w");
    fclose($csvTmpW);
    
}else{
    echo "削除に失敗しました。";
}


