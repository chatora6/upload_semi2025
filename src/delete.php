<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>ファイル一覧</title>
</head>
<body>
<div class="upload_text">
<?php
   
    $delete_file =$_POST['delete'];//削除するファイル
    $filepath='./file/'.$delete_file;

    $csvfile = 'file.csv';//現在のcsvファイル
    $csvfile_tmp = 'file_tmp.csv';//一時保存するcsvファイル

    $file_csv=fopen($csvfile,"r");//読み込み
    $filetmp_csv=fopen($csvfile_tmp,"w");//書き込み

    $csv_data=[];
    
    if(unlink($filepath)){
        echo "ファイル削除に成功しました。";
        while(($line = fgetcsv($file_csv,1024))!==FALSE){
            $name = $line[0];
            $summary = $line[1];
            if($delete_file != $name){//削除ファイル以外の時
                fputcsv($filetmp_csv, [$name, $summary]);
            }
        }
        fclose($file_csv);//ファイルを閉じる
        fclose($filetmp_csv);

        copy($csvfile_tmp, $csvfile);
        $filetmp_csv=fopen($csvfile_tmp,"w");
        fclose($filetmp_csv);
        
    }else{
        echo "削除に失敗しました。";
    }

    echo '<br><a href="./show.php">一覧へ</a> ';
    ?>
</div>
    </body>
</head>
</html>