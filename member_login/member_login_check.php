<?php

require_once('../common/common.php');
try
{
	$post=sanitize($_POST);
	$member_email=$post['email'];
	$member_pass=$post['pass'];
	
	$member_pass=md5($member_pass);
    
    include ('../common/conection.php');
    
	$dbh=new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');
	
	$sql='SELECT code,tenpo_code,name,email FROM mst_tenpo WHERE email=? AND password=?';
	$stmt=$dbh->prepare($sql);
	$data[]=$member_email;
	$data[]=$member_pass;
	$stmt->execute($data);

	$dbh=null;
	
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
    
	if(!$rec)
	{
        //ログイン失敗
        header('Location:member_logout.php');
        exit();
    }
	else
	{
        //ログイン成功
        //セッション ID の振り直し
        
/*        session_start();	// 一旦セッションを開始して変数値をロード
        $tmp = $_SESSION;	// 変数値を退避
        $_SESSION = array();	// 空にする
        session_destroy();	// 破棄
        session_id(md5(uniqid(rand(), 1)));	// セッションＩＤ更新
        session_start();	// セッション再開
        $_SESSION = $tmp;	// セッション変数値を引継ぎ
*/
        
        session_start();	// 一旦セッションを開始して変数値をロード
        $_SESSION = array();	// 空にする
        session_destroy();	// 破棄
        session_id(md5(uniqid(rand(), 1)));	// セッションＩＤ更新
        session_start();	// セッション再開
          
		$_SESSION['member_login']=true;
		$_SESSION['member_code']=$rec['code'];
		$_SESSION['member_tenpocode']=$rec['tenpo_code'];
        $_SESSION['member_name']=$rec['name'];
		$_SESSION['member_email']=$rec['email'];
        
	}
	
    //リダイレクト
    header('Location:../index.php');
    
	}
    //DBエラー時は、強制ログアウト
	catch(Exception $e)
	{
		header('Location:member_logout.php');
		exit;
	}

?>