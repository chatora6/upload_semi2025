<?php 
class FileUploader {
  //ファイルの保存先指定
  private $upload_path = '../file/'; 
  private $csv_path = "../csv/file.csv";
  private $allowed_ext = array( 'pdf' );
  //ファイルの上限指定
  private $max_size = 20 * 1024 * 1024; 

  
  public function Upload($file, $summary,$genre){
    //エラーの場合
    if(!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])||$file['error'] !== UPLOAD_ERR_OK){ 
      return "アップロードに失敗しました。"; 
    }

    //サーバに一時保存
    $tmp_file=$file['tmp_name'];
    //習得ファイルの名前
    $uploaded_name = $file['name'];
    //拡張子を習得
    $ext = pathinfo($uploaded_name,PATHINFO_EXTENSION);
    //拡張子の小文字変換 ,拡張子のみを取得
    $ext= strtolower($ext);
    
    //ファイル拡張子の確認
    if(!in_array( $ext, $this->allowed_ext )){
        return "PDFファイルのみアップロード可能です。";
      }
    //ファイルサイズの確認
    if(!$file['size'] > $this->max_size){
      return "ファイルサイズが20MBを超えています。";
    }

    //$summary=$_POST['summary'] ?? '';//ファイル説明の習得

    $time= date('Y-m-d h-i-s');
    //ハッシュ化し15桁目から8桁取得
    $new_name_base=substr(md5($time.$uploaded_name),16,8);
    $new_name = $new_name_base . '.pdf';
    $md_file=$this->upload_path . $new_name;

    //$md_=$this->upload_path . $new_name.'.pdf';
    //ファイルの移動
    if(move_uploaded_file($tmp_file, $md_file)){
      $this->SaveCsv($new_name, $summary,$genre);
      return true;
    }
    return "ファイルの移動に失敗しました。";
  }
  
  function SaveCsv($filename, $summary,$genre) {
    //ファイルに追記
    $fp = fopen($this->csv_path, "a");
    if (flock($fp, LOCK_EX)) {
      fputcsv($fp, [$filename, $summary, $genre]);
      flock($fp, LOCK_UN);
    }
    fclose($fp);
  }
}
?>