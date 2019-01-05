<?php

//ini_set("display_errors", On);
//error_reporting(E_ALL);

// Debugツール
include '../common/ChromePhp.php';
require_once('../common/common.php');


ChromePhp::log('Start!!!');



// Ajax以外からのアクセスを遮断
 $request = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
 if($request !== 'xmlhttprequest') exit;

session_start();



// Debugツール
//include '../common/ChromePhp.php';
//require_once('../common/common.php');


ChromePhp::log('Start!!!');

$post=sanitize($_POST);

date_default_timezone_set('Asia/Tokyo');

// tFPDFをロード
require("../common/tFPDF/tfpdf.php");

class FPDF extends tFPDF {
}
 
// fpdiをロード
require("../common/tFPDF/fpdi.php");

ChromePhp::log('Hello console!');

// PHPMailerをロード
require_once ( '../common/PHPMailer/PHPMailerAutoload.php' );   

//define( 'keri_mail_address', 'keiri@boushiya.co.jp');	// 報告先アドレス
//define( 'todoke', '打刻修正届け');	// 報告先アドレ

// POSTされたデータの受け取り
$date1=$post["date1"];
$date2=$post["date2"];
$date2_1=$post["date2_1"];
$moto=$post["moto"];
$radio0=$post["radio0"];
if(isset($post["shosai1"])){
    $shosai1=$post["shosai1"];
}
else{
    $shosai1='';
}
$shosai2=$post["shosai2"];
$tmp_file=$_FILES["upfile"]["tmp_name"];
$radio1=$post["radio1"];
$timecard1=$post["timecard1"];
$radio2=$post["radio2"];
$timecard2=$post["timecard2"];
$timecard3=$post["timecard3"];
$radio3=$post["radio3"];
$radio4=$post["radio4"];
$radio5=$post["radio5"];
$timecard4=$post["timecard4"];
$timecard5=$post["timecard5"];

$tenpocode=$_SESSION['member_tenpocode'];
$tenpoemail=$_SESSION['member_email'];
$tenponame=$_SESSION['member_name'];

// 確認

//ChromePhp::log('===== TestCodeData ======');
//ChromePhp::log($tenpocode);
//ChromePhp::log($tenpoemail);
//ChromePhp::log($post["upfile"]);
//ChromePhp::log($tenponame);


$errcode1='';
$errcode2='';
$errcode3='';
$errcode4='';

// File Upload

$up_files=sha1(uniqid(rand(), true));

    if (is_uploaded_file($tmp_file)) {
    
        $file_dst="../data/riskdata/".$up_files.".jpg";

        ChromePhp::log($file_dst);
        
        if (move_uploaded_file($tmp_file, $file_dst)) {      
        chmod($file_dst, 0644);
            
        $errcode1='画像ファイルが正常にアップロードされました';
      
    } else {
        $errcode1='画像ファイルが送信できませんでした';  
    }
    
    } else {
        $errcode1='画像ファイルが選択されていません';
    }

// PDF出力    
// Noticeエラー非表示
error_reporting(E_ALL & ~E_NOTICE);

$pdf = new FPDI('P', 'mm', 'A4');

$pdf->AddPage(); //ページを追加

// tPDF
$pdf->AddFont("IPAmjm", "", "ipamjm.ttf", true);

//テンプレートPDF読み込み
$pageno = $pdf->setSourceFile('template/hokoku.pdf');
$tplidx = $pdf->ImportPage(1);
$pdf->useTemplate($tplidx);

// tPDF
$pdf->SetFont("IPAmjm", "", 14);

$pdf->SetTextColor(0,0,0);
$pdf->Text(17, 45,$tenponame);
$str = date('Y年n月j日',strtotime($date1));
$pdf->Text(68, 69, $str);
$str = date('Y年n月j日',strtotime($date2)).'（'.$date2_1.'）'; // UTF8 -> UTF16変換
$pdf->Text(68, 82, $str);
$pdf->Text(68, 94, $moto);

$pdf->SetXY(58, 100);
$pdf->MultiCell(134,6,$shosai1, 0,'L');
$pdf->SetXY(58, 153);
$pdf->MultiCell(134,6,$shosai2, 0,'L');

// PDF出力

// 001+20160921160621
$up_pdf=substr('00'.$tenpocode,-3).date("YmdHis");

$pdf_file_dst='../data/riskdata/'.$up_pdf.'.pdf';

$pdf->Output($pdf_file_dst, "F");

// PDFクローズ
$pdf->Close();

$errcode2='PDFの作成に成功しました。';

//ChromePhp::log($pdf_file_dst);

//　DB登録

try
{ 
   
//  データベース接続
    include '../common/conection.php';

	$dbh=new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');

    $sql='LOCK TABLES dat_risk_hokoku WRITE';
    $stmt=$dbh->prepare($sql);
    $stmt->execute();
    
	$sql='INSERT INTO dat_risk_hokoku(tenpocode,h_date,h_date1,h_date2,moto,kenko_f,kenko_shosai,kago_shosai,gazo,bunrui,u_shaincode,u_shien,skansa_shaincode,c_shaincode,c_shien1,c_shien2,c_shien3,k_shaincode,f_shaincode,pdf_name,taisaku_no) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
    
	$stmt=$dbh->prepare($sql);

    $dbdata[]=$tenpocode;
    $dbdata[]=$date1;
    $dbdata[]=$date2;
    $dbdata[]=$date2_1;
	$dbdata[]=$moto;     
	$dbdata[]=$radio0;
    $dbdata[]=$shosai1;
    $dbdata[]=$shosai2;
	$dbdata[]=$up_files;
    $dbdata[]=$radio1;
    $dbdata[]=$timecard1;
    $dbdata[]=$radio2;
    $dbdata[]=$timecard2;
    $dbdata[]=$timecard3;
    $dbdata[]=$radio3;
    $dbdata[]=$radio4;
    $dbdata[]=$radio5;
    $dbdata[]=$timecard4;
    $dbdata[]=$timecard5;
    $dbdata[]=$up_pdf;
    $dbdata[]='';
    
	$stmt->execute($dbdata);

    $sql='UNLOCK TABLES';
    $stmt=$dbh->prepare($sql);
    $stmt->execute();

	$dbh=null;
    
    $errcode3="データベースに正常に登録されました。"; 
    
//    メールタイトル、ヘッダー   //

    $mailSubject='重要：調剤過誤報告 ('.$tenponame.')';
    
//  メール 本文  //    

    $mailMessage='過誤が発生しましたので報告します。';

    
 // PHPMailerのインスタンス生成
$mail = new PHPMailer();  
    
// SMTPサーバー設定
// Gmailの場合は「安全性の低いアプリのアクセス」の許可が必要
// https://www.google.com/settings/security/lesssecureapps
$mail->isSMTP(); // SMTP利用宣言
$mail->Host = 'yellow-zebra-afb73f9722df9270.znlc.jp';  // SMTPサーバー
$mail->SMTPAuth = true;  // SMTPユーザー認証の有無
$mail->Username = 'bmaster@yellow-zebra-afb73f9722df9270.znlc.jp'; // SMTPアカウント
$mail->Password = 'quxH2vxw4ssGEtdl';    // SMTPパスワード
$mail->SMTPSecure = 'tls';   // SMTPプロトコル(SSLまたはTLS)
$mail->Port = 587;   // SMTPポート番号(SSL:465, TLS:587)
 
// メール内容設定
$mail->CharSet = "UTF-8";    // 文字セット(デフォルトは'ISO-8859-1')
$mail->Encoding = "base64";  // エンコーディング(デフォルトは'8bit')
$mail->setFrom($tenpoemail, $tenponame);   // 差出元
$mail->addAddress($tenpoemail, $tenponame);  // 宛先
$mail->Subject = $mailSubject; // メール件名
$mail->Body  = $mailMessage; // メール本文
$mail->AddAttachment($pdf_file_dst,'過誤報告書.pdf','base64', 'application/x-compress');   // 添付ファイル
 
// メール送信の実行
if(!$mail->send()) {
    $errcode4='メッセージの送信に失敗しました。(' . $mail->ErrorInfo.')';
} else {
   $errcode4='メッセージが正常に送信されました。';
}
  
}

catch(exception $e)
    
{
	$errcode3="データベースに接続できませんでした。";
}

        $data = array( 'err1' => $errcode1 , 'err2' => $errcode2 ,'err3' => $errcode3 ,'err4' => $errcode4 ,'pdffile' => '<p><a href="'.$pdf_file_dst.'" target="_blank">PDFファイル</a></p>');

    header('Content-type: text/html');
    echo json_encode($data);
    
?>