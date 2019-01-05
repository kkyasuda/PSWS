<?php
// Ajax以外からのアクセスを遮断
$request = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
if($request !== 'xmlhttprequest') exit;

// Session
session_start();

define( 'keri_mail_address', 'keiri@boushiya.co.jp');	// 報告先アドレス
define( 'todoke', '休暇欠勤届');

if(!isset($_SESSION['member_login']))
{
	header('Location:../index.php');
	exit();
}

require_once('../common/common.php');

// PHPMailerをロード
require_once ( '../common/PHPMailer/PHPMailerAutoload.php' ); 

//
//  timecd :　タイムカード番号(半角)
//
//  mes :　メール内容
//  
//  err :   0   ：エラーなし
//          1   ：DB接続エラー
//            
//              

$json = file_get_contents('php://input');
$data=sanitize(json_decode($json, true));

$error_no=0;
$honbun="";

$db_id = isset($data['timecard'])       ? $data['timecard']     : "";
$db_name = isset($data['name'])       ? $data['name']     : "";
$db_scode = isset($data['shaincode'])       ? $data['shaincode']     : "";
$db_kubun = isset($data['kubun'])       ? $data['kubun']     : "";
$db_date1 = isset($data['date1'])       ? $data['date1']     : "";
$db_kikan1 = isset($data['kikan1'])       ? $data['kikan1']     : "";
$db_date2 = isset($data['date2'])       ? $data['date2']     : "";
$db_kikan2 = isset($data['kikan2'])       ? $data['kikan2']     : "";
$db_jiyu = isset($data['jiyu'])       ? $data['jiyu']     : "";
$db_email = $_SESSION['member_email'];

$callback  = isset($_GET['callback'])   ? $_GET["callback"] : "";
$callback  = htmlspecialchars(strip_tags($callback));

try
{ 
    
//  データベース接続
    include '../common/conection.php';

	$dbh=new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');

    $sql='LOCK TABLES dat_todoke WRITE';
    $stmt=$dbh->prepare($sql);
    $stmt->execute();
    
	$sql='INSERT INTO dat_todoke(todokecode,timecard,shaincode,name,kubun,date1,kikan1,date2,kikan2,jiyu) VALUES (?,?,?,?,?,?,?,?,?,?)';
	$stmt=$dbh->prepare($sql);
    $dbdata[]=4;
    $dbdata[]=$db_id;
	$dbdata[]=$db_scode;
	$dbdata[]=$db_name;
	$dbdata[]=$db_kubun;
	$dbdata[]=$db_date1;
    $dbdata[]=$db_kikan1;
    $dbdata[]=$db_date2;
    $dbdata[]=$db_kikan2;
	$dbdata[]=$db_jiyu;
	$stmt->execute($dbdata);

    $sql='UNLOCK TABLES';
    $stmt=$dbh->prepare($sql);
    $stmt->execute();

	$dbh=null;
    
//    メールタイトル、ヘッダー   //

    $title=todoke;
    
    $header = "MIME-Version: 1.0\n";
    $header .='From:'.$db_email."\n";
    $header .= "Reply-To:".$db_email."\n";
    $header .= "Return-Path:".$db_email."\n";
    $header .= "Content-Transfer-Encoding: 7bit\n";
    $header .= "Content-Type: text/plain; charset=ISO-2022-JP\n";
    $header .= "Message-Id: <" . md5(uniqid(microtime())) . "@boushiya.co.jp>\n";
    $header .= "X-Mailer: PHP/". phpversion();
    
//  メール 本文  //    

    $honbun='';
    $honbun.='【 '.$title." 】\n\n";
    $honbun.='タイムカード番号：'.$db_id."\n";
    $honbun.='社員番号：'.$db_scode."\n";
    $honbun.='社員名：'.$db_name."\n\n";
    $honbun.='区分： '.$db_kubun."\n\n";
    $honbun.='期間：'.date('Y年m月d日',strtotime($db_date1)).'('.$db_kikan1.")～".date('Y年m月d日',strtotime($db_date2)).'('.$db_kikan2.")\n\n";
    $honbun.='事由：'.$db_jiyu."\n\n";
    
    $honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
    
    mb_language('Japanese');
    mb_internal_encoding('UTF-8');
    
//  自店宛てメール //
    
    $email=$db_email;
    mb_send_mail($email,$title,$honbun,$header);
   
//  経理宛てメール //
    
    $email=keri_mail_address;
    mb_send_mail($email,$title,$honbun,$header);

// メール内容 //
   
}
catch(exception $e)

{
	$error_no=1;
}

$param = array( "mes" => nl2br($honbun) , "err" => $error_no);

header('Content-Type: text/javascript; charset=utf-8');
echo sprintf("callback(%s)",json_encode($param));

?>
