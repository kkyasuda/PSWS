<?php

define( 'toppage', '../index.php');	// ログアウト後飛び先

$_SESSION=array();

if(isset($_COOKIE[session_name()])==true)
{
	setcookie(session_name(),'',time()-42000,'/');
}

@session_destroy();

header("Location:".toppage);

exit;

?>