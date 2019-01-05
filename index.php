<!----

    Pharmacy Suport Web System  (C)1996 by K.Yasuda
        Last Update 2016/08/21

    Ver Umi

--->

<?php

session_start();
$tmp = $_SESSION;	// 変数値を退避
$_SESSION = array();	// 空にする
session_destroy();	// 破棄
session_id(md5(uniqid(rand(), 1)));	// セッションＩＤ更新
session_start();	// セッション再開
$_SESSION = $tmp;	// セッション変数値を引継ぎ

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- BootstrapのCSS読み込み -->
<!---
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
--->
    <!-- Umi 3.1.7 -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--- Font Awesome --->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<!--- CSS --->
      <style>          
        .navbar-brand {
            background: url("img/logo.png") no-repeat left center;
            background-size: contain;
            height: 80px;
            width: 250px; 
        }
        header.jumbotron {
            background: url("img/header.png");
            background-position: center center;
            background-size: cover;
            color: #4202E8;
        }  
        header .container {
            margin-top: 13%;
        }  
        header .midashi-btn {
            border: 1px solid #fff;
            color: #fff;
            border-radius: 0;
        }
        header .midashi-btn:hover {
            color: #0089ff;
            border-color: #0089ff;
        }
        .navbar-form {
            max-width:1000px;
            padding-right: 30px;
        }
        .sidebar aside {
            background: #f0f0f0;
            padding: 20px;
            margin-bottom: 20px;
        }
          
        @media screen and (max-width: 480px) {
            header.jumbotron .container p {
            font-size: 16px;
            }
        }
        footer {
            text-align: center;
            padding: 10px;
            background: #101010;
        }
        .breadcrumb{
             padding: 60px 10px 10px 90px; 
        }
          
        #login-dp{
            min-width: 250px;
            padding: 14px 14px 0;
            overflow:hidden;
            background-color:rgba(255,255,255,.8);
        }
          
        #login-dp .help-block{
            font-size:12px    
        }
          
        #login-dp .bottom{
            background-color:rgba(255,255,255,.8);
            border-top:1px solid #ddd;
            clear:both;
            padding:14px;
        }
          
        #login-dp .social-buttons{
            margin:12px 0    
        }
          
        #login-dp .social-buttons a{
            width: 49%;
        }
          
        #login-dp .form-group {
            margin-bottom: 10px;
        }
          
        @media(max-width:1130px){
            #login-dp{
                background-color: inherit;
                color: #fff;
            }
            #login-dp .bottom{
                background-color: inherit;
                border-top:0 none;
            }
            .navbar-header {
                float: none;
            }
            .navbar-toggle {
                display: block;
            }
            .navbar-collapse {
                border-top: 1px solid transparent;
                box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
            }
            .navbar-collapse.collapse {
                display: none!important;
            }
            .navbar-nav {
                float: none!important;
                margin: 7.5px -15px;
            }
            .navbar-nav>li {
                float: none;
            }
            .navbar-nav>li>a {
                padding-top: 10px;
                padding-bottom: 10px;
            }
            .navbar-text {
                float: none;
                margin: 15px 0;
            }
            .navbar-collapse.collapse.in {
                display: block!important;
            }
            .collapsing {
                overflow: hidden!important;
            }
        }
    </style>

      <title> ぼうしや支援プログラム Web</title>
      
  </head>

<body>

<!-- ナビゲーションバー　-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            
             <a class="navbar-brand" href="index.php"></a>
            
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse-id">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
            
        </div><!-- /.navbar-header-->

        <div id="collapse-id" class="collapse navbar-collapse">

<?php
if(!isset($_SESSION['member_login'])){     
?>
        <ul class="nav navbar-nav navbar-left">            
            <li class="dropdown">
                
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><button class="btn btn-success">ログイン</button></a>
                
                <ul id="login-dp" class="dropdown-menu">
				<li>
					 <div class="row">
							<div class="col-md-12">
								 <form class="form" role="form" method="post" action="member_login/member_login_check.php" accept-charset="UTF-8" id="login-nav">
										<div class="form-group">
											 <label class="sr-only" for="exampleInputEmail2">Email address</label>
											 <input type="email" class="form-control" id="exampleInputEmail2" name="email" placeholder="メールアドレス" required>
										</div>
										<div class="form-group">
											 <label class="sr-only" for="exampleInputPassword2">Password</label>
											 <input type="password" class="form-control" id="exampleInputPassword2" name="pass" placeholder="パスワード" required>
										</div>
										<div class="form-group">
											 <button type="submit" class="btn btn-primary btn-block">ログイン</button>
										</div>
										<div class="checkbox">
											 <label>
											 <input type="checkbox" name="logincheck"> ログインしたままにする
											 </label>
										</div>
								 </form>
							</div>
					 </div>
				</li>
			</ul>
            </li>
        </ul>

<?php    
} else {
?>
<!--- リンクメニュー --->
            <ul class="nav navbar-nav">
                
                <li><form class="navbar-form navbar-left">
                <button class="btn btn-default">
                    <?php 
                            $tenponame=htmlspecialchars($_SESSION['member_name']);
                            $tenponame= str_replace("ぼうしや薬局　", "", $tenponame);
                            $tenponame= str_replace("ぼうしや調剤薬局　", "", $tenponame);
                            echo $tenponame;
                    ?>
                    </button>
                </form></li>
                         
                <li class="active dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                各種届け<span class="caret"></span>
                </a>
                    <ul class="dropdown-menu">
                        <li><a href="todoke/dakoku.php">打刻修正届</a></li>
                        <li><a href="todoke/kyujitsu.php">休日出勤届</a></li>
                        <li><a href="todoke/tikoku.php">遅刻早退届</a></li>
                        <li><a href="todoke/kyuka.php">休暇欠勤届</a></li>
                        <li class="divider"></li>
                        <li><a href="todoke/tenpo_kyujitu.php">店舗休日届</a></li>
                        <li class="divider"></li>
                        <li><a href="todoke/benkyoukai.php">研修会出欠届</a></li>
                    </ul>      
                </li>    
                
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                各種発注<span class="caret"></span>
                </a>
                    <ul class="dropdown-menu">
                        <li><a href="hatyu/fusen.php">付箋</a></li>
                    </ul>      
                </li>   
                
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                リスク管理報告<span class="caret"></span>
                </a>
                    <ul class="dropdown-menu">
                        <li><a href="risk/risk_houkoku.php">過誤報告</a></li>
                        <li><a href="risk/risk_taisaku_select.php">過誤対策</a></li>
                    </ul>      
                </li>

                <li><a href="#">月計報告</a></li>
                <li><a href="dataupload/upload.php">レセデータ送信</a></li> 
                <li><form class="navbar-form navbar-left" action="member_login/member_logout.php">
                <button type="submit" class="btn btn-default"><i class="fa fa-sign-out " aria-hidden="true"></i></button>
                </form></li>
            </ul>
<?php
    }
?>                      
                
        </div><!-- /.navbar-collapse-->
    </div><!-- /.container-->
</nav>

<!-- ヘッダー -->
    <header class="jumbotron">
      <div class="container">
        <h2>ぼうしや薬局　支援ツール</h2>
          <h5>１１月から稼動予定</h5>
        <p>　　Last Update 2016/09/22 </p>
        <p><a class="btn btn-lg midashi-btn" role="button">もっと詳しく &raquo;</a></p>
      </div>
    </header>
    
    <div class="container main-content">
      <div class="row">
        <div class="col-md-9 content-area">
            <h2>アップデート状況</h2>
            
            <p>全体：Web管理OK</p>
            
            <p>届け：経理むけ完了</p>
            <p>届け：研修会出席：DB登録、メール配信OK</p>
            <p>付箋：Web画面OK</p>
            <p>リスク：報告　画面、PDF保存、表示、DB登録OK</p>
            <p>　　　　対策　画面OK</p>
            <p>レセデータ送信：送信OK</p>
            <p>iPad対応 1130px以下バーガーメニュー</p>
            <p>　　　　　modalスクロールOK、写真添付OK</p>
            
            <h2>対応中状況</h2>
            <p>届け：研修会出席：研修会登録DB未作成</p> 
            <p>付箋：DB登録、発注メール送信</p>
            <p>リスク：対策選択画面、DB登録、PDFファイル対応</p>
          
        </div><!--/.content-area-->
          
        <div class="col-md-3 sidebar">
          <aside>
            <h4>ぼうしやリンク</h4>
            <ul class="list-unstyled">
                <li><a href="http://www.boushiya.com/">ぼうしやブログ</a></li>
                <li><a href="http://www.himeyaku.jp/">姫路薬剤師会</a></li>
                <li><a href="http://www.hps.or.jp/">兵庫県薬剤師会</a></li>
            </ul>
          </aside>
<!---
          <aside>
            <h4>新着記事</h4>
            <ul class="list-unstyled">
              <li><a href="">記事のタイトルタイトル</a></li>
              <li><a href="">記事のタイトルタイトル</a></li>
              <li><a href="">記事のタイトルタイトル</a></li>
              <li><a href="">記事のタイトルタイトル</a></li>
              <li><a href="">記事のタイトルタイトル</a></li>
            </ul>
          </aside>
--->
        </div><!--/.sidebar-->
      </div>
    </div><!--/.main-content-->
    
    <!--フッターを追加-->
    <footer class="container-fluid">
      <small><a href="/">Copyright &#169; 2016 K.Yasuda All Rights Reserved.</a></small>
      
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <!-- bootstrap java --->
    <!-- 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    ---->
    <!-- Umi 3.3.7-1 --->
        <script src="js/bootstrap.min.js"></script>
        
</body>
    
</html>