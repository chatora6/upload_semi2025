<?php 
class FileUploader 
{
  //ファイルの保存先指定
  private $uploadPath = '../file/'; 
  private $csvPath = "../csv/file.csv";
  private $allowedExt = array( 'pdf' );
  //ファイルの上限指定
  private $maxSize = 20 * 1024 * 1024; 

  
  public function upload($file, $summary,$genre,$i = 0){
    //エラーの場合
    if(!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])||$file['error'] !== UPLOAD_ERR_OK){ 
      return "アップロードに失敗しました。"; 
    }

    date_default_timezone_set('Asia/Tokyo');
    $uploadedTime = date('Y/m/d H:i');

    //サーバに一時保存
    $tmpFile=$file['tmp_name'];
    //習得ファイルの名前
    $uploadedName = $file['name'];
    //拡張子を習得
    $ext = pathinfo($uploadedName,PATHINFO_EXTENSION);
    //拡張子の小文字変換 ,拡張子のみを取得
    $ext= strtolower($ext);
    
    //ファイル拡張子の確認
    if(!in_array( $ext, $this->allowedExt )){
        return "PDFファイルのみアップロード可能です。";
      }
    //ファイルサイズの確認
    if(!$file['size'] > $this->maxSize){
      return "ファイルサイズが20MBを超えています。";
    }

    //$summary=$_POST['summary'] ?? '';//ファイル説明の習得

    //$time= date('Y-m-d h-i-s');
    //ハッシュ化し15桁目から8桁取得
    $newNameBase=substr(md5($uploadedTime.$uploadedName.$i),16,8);
    $newName = $newNameBase . '.pdf';
    $mdFile=$this->uploadPath . $newName;

    //$md_=$this->uploadPath . $newName.'.pdf';
    //ファイルの移動
    if(move_uploaded_file($tmpFile, $mdFile)){
      $this->saveCsv($newName, $summary,$genre, $uploadedTime);
      return true;
    }
    return "ファイルの移動に失敗しました。";
  }
  
  function saveCsv($filename, $summary,$genre, $time) {
    //ファイルに追記
    $fp = fopen($this->csvPath, "a");
    if (flock($fp, LOCK_EX)) {
      fputcsv($fp, [$filename, $summary, $genre, $time]);
      flock($fp, LOCK_UN);
    }
    fclose($fp);
  }
}
