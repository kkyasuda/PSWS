<?php
// Ajax以外からのアクセスを遮断
$request = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
if($request !== 'xmlhttprequest') exit;

// Session
session_start();	// 一旦セッションを開始して変数値をロード

if(!isset($_SESSION['member_login']))
{
	header('Location:../index.php');
	exit();
}

require_once('../common/common.php');

//
//  timecd :　タイムカード番号(半角)
//
//  name :　名前
//  code :　社員番号
//  errorno :  0   :   エラーなし
//              1   :   未入力
//              2   :   該当社員なし
//              3   :   例外エラー(DB接続等)


$post=sanitize($_POST);

$dakoku_name='';
$dakoku_scode='';
$err_no=0;

try { 

if (isset($post['timecd']))
{
    $dakoku_id=$post['timecd'];

    if(preg_match("/^[0-9]+$/", $dakoku_id)!=1)
        {
//  タイムカード番号が未入力
            $err_no=1;
        }
    else
        {
        
//  データベース接続
        
            include '../common/conection.php';
        
            $dbh=new PDO($dsn,$user,$password);
            $dbh->query('SET NAMES utf8');
	
            $sql='SELECT name,shain_code FROM mst_shain WHERE time_code=?';
            $stmt=$dbh->prepare($sql);
            $data[]=$dakoku_id;
            $stmt->execute($data);

            $dbh=null;
	
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);

            if($rec==true)
	           {
                    $dakoku_name=$rec['name'];
                    $dakoku_scode=$rec['shain_code'];
                    $err_no=0;
	           }
            else
                {
// 無効なタイムカード番号
                    $err_no=2;
                }
    
        }

}
else
{
// タイムカード番号がnull
    $err_no=1;
}

} catch (Exception $e) { 
//  例外エラー
    $err_no=3;
}

$param = array( "name" => $dakoku_name , "code" => $dakoku_scode , "errno"=> $err_no );

header('Content-type: text/javascript; charset=utf-8');
echo json_encode($param);

?>