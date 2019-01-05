<?php

// Debugツール
include '../common/ChromePhp.php';

// Ajax以外からのアクセスを遮断
 $request = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
 if($request !== 'xmlhttprequest') exit;

session_start();

require_once('../common/common.php');

$post=sanitize($_POST);

$hoken=$post["radio1"];
$date1=str_replace("/","",$post["date1"]);
$tmp_file=$_FILES["upfile"]["tmp_name"];
// $up_files=$_FILES["upfile"]["name"];

$tenpocode=$_SESSION['member_tenpocode'];
$tenpoemail=$_SESSION['member_email'];
$tenponame=$_SESSION['member_name'];

$tenpocode1=substr("0".$tenpocode,-2,2);

$up_files=$date1."-".$tenpocode1."-".$hoken."-rece";

$up_hash=hash_file('md5', $tmp_file);

// ChromePhp::log('debug data');
// ChromePhp::log($_SERVER);

ChromePhp::log($hoken);
ChromePhp::log($date1);
ChromePhp::log($up_files);
ChromePhp::log($tenpocode1);
ChromePhp::log($up_hash);

    if (is_uploaded_file($tmp_file)) {
    
        if (move_uploaded_file($tmp_file, "../data/recedata/" . $up_files)) {
      
        chmod("../data/recedata/" . $up_files, 0644);
        $errcode='ファイルが転送完了しました';
      
    } else {
        $errcode='ファイルが送信できません';  
    }
    
    } else {
        $errcode='ファイルが選択されていません';
    }

    
        $data = array( 'trans_err' => $errcode );


    header('Content-type: text/html');
    echo json_encode($data);
  
    
?>