<?php

// Debugツール
include '../common/ChromePhp.php';

// Ajax以外からのアクセスを遮断
 $request = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
 if($request !== 'xmlhttprequest') exit;

session_start();

require_once('../common/common.php');

$post=sanitize($_POST);

$tenpocode=$_SESSION['member_tenpocode'];
$tenpoemail=$_SESSION['member_email'];
$tenponame=$_SESSION['member_name'];
$hoken=$post["radio1"];
$date1=str_replace("/","",$post["date1"]);
$tmp_file=$_FILES["upfile"]["tmp_name"];

$tenpocode1=substr("0".$tenpocode,-2,2);

$up_files=$date1."-".$tenpocode1."-".$hoken."-rece";
$up_hash_new=hash_file('md5', $tmp_file);

$up_hash_old='nothing';

if (file_exists("./data/recedata/".$up_files)) {
    $up_hash_old=hash_file('md5', "./data/recedata/".$up_files);
    if($up_hash_new===$up_hash_old)
    {
        $up_status='既にファイルが送信されています。<br >送信できません。';
        $errcode=1;
    }
    else
    {
        $up_status='既にファイルが送信されています。<br >ファイルを上書きする場合は、送信ボタンをおしてください。';
        $errcode=2;
    }
        
} else {
    $up_status='データを送信します。<br >送信ボタンをおしてください。';
    $errcode=3;
}

        $data = array( 'upload_status' => $up_status , 'upload_err' => $errcode );

ChromePhp::log($hoken);
ChromePhp::log($date1);
ChromePhp::log($up_files);
ChromePhp::log($tenpocode1);
ChromePhp::log($up_hash_old);
ChromePhp::log($up_hash_new);

ChromePhp::log($up_status);

    header('Content-type: text/html');
    echo json_encode($data);
  
    
?>