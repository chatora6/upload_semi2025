<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>ファイル一覧</title>
</head>
<body>
  
<?php 
echo '<div class="upload_text">';
$time= date('y-m-d h-i-s');
$summary=$_POST['summary'] ?? '';//ファイル説明の習得
//foreach ($_FILES['files']['name'] as $key => $upload_file) {

  $upload = '../file/'.$_FILES['files']['name'][$key]; //ファイルの保存先指定
  $upload_file = $_FILES['files']['name'][$key];//習得ファイルの名前
  $ext = pathinfo($upload_file,PATHINFO_EXTENSION);//拡張子を習得
  $tempfile=$_FILES['files']['tmp_name'][$key];//サーバに一時保存
  $md=substr(md5($time.$upload_file),16,8);//ハッシュ関数
  $md_csv=$md.'.pdf';
  $md_='../file/'.$md.'.pdf';
  $file_csv = "../csv/file.csv";
  $file2_csv = fopen($file_csv, "a");//ファイルに追記
  if(is_uploaded_file($tempfile)){ //アップロードが出来たかどうか
    $rest = array( 'pdf' );;
    $ext= strtolower(pathinfo($upload,PATHINFO_EXTENSION));//拡張子の小文字変換 ,拡張子のみを取得
    $maxSize = 20 * 1024 * 1024; //ファイルの上限指定
    if(in_array( $ext, $rest ) && $_FILES['files']['size'] < $maxSize){
      if(move_uploaded_file($tempfile, $md_)){//指定の場所に移動
        fputcsv($file2_csv, [$md_csv, $summary]);
        
        echo '<h3>アップロード完了しました</h3>';
      }
    }else{
      echo '<h3>20MBまでのpdfファイルのみアップロードできます</h3>'; 
    } 

}else{
  echo '<h3>アップロード失敗しました</h3>'; 
}
echo '</div>';

?>


<a href="form.html" style="margin-left: 60%;">戻る</a> 
<a href="show.php" style="margin-left:10px;">一覧へ</a> 


</body>
</html>