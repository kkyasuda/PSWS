<!----

    Pharmacy Suport Web System  (C)1996 by K.Yasuda
        Last Update 2016/08/25

--->
<?php
// ログインチェック
session_start();

  //強制ブラウズはリダイレクト
  if (!isset($_SESSION['member_login'])){
    header("Location:../index.php");
    exit();
  } 

$_SESSION['pdfdata']='';

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
        <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap datepicker -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap-timepicker.min.css">
    <!--- Font Awesome --->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
      
    <!--- CSS --->    
      <style>
        .navbar-brand {
            background: url("../img/logo.png") no-repeat left center;
            background-size: contain;
            height: 80px;
            width: 250px;
        } 
        header.jumbotron {
            background: url("../img/header.jpg");
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

<div id="wrapper">
    
<!-- ナビゲーションバー　-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            
             <a class="navbar-brand" href="../index.php"></a>
            
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse-id">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
            
        </div><!-- /.navbar-header-->

        <div id="collapse-id" class="collapse navbar-collapse">

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
                
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                各種届け<span class="caret"></span>
                </a>
                    <ul class="dropdown-menu">
                        <li><a href="../todoke/dakoku.php">打刻修正届</a></li>
                        <li><a href="../todoke/kyujitsu.php">休日出勤届</a></li>
                        <li><a href="../todoke/tikoku.php">遅刻早退届</a></li>
                        <li><a href="../todoke/kyuka.php">休暇欠勤届</a></li>
                        <li class="divider"></li>
                        <li><a href="../todoke/tenpo_kyujitu.php">店舗休日届</a></li>
                        <li class="divider"></li>
                        <li><a href="../todoke/benkyoukai.php">研修会出欠届</a></li>
                    </ul>      
                </li>    
                
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                各種発注<span class="caret"></span>
                </a>
                    <ul class="dropdown-menu">
                        <li><a href="../hatyu/fusen.php">付箋</a></li>
                    </ul>      
                </li>   
                
                <li class="active dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                リスク管理報告<span class="caret"></span>
                </a>
                    <ul class="dropdown-menu">
                        <li><a href="risk_houkoku.php">過誤報告</a></li>
                        <li><a href="risk_taisaku.php">過誤対策</a></li>
                    </ul>      
                </li>

                <li><a href="#">月計報告</a></li>
                <li><a href="../dataupload/upload.php">レセデータ送信</a></li> 
                <li><form class="navbar-form navbar-left" action="../member_login/member_logout.php">
                <button type="submit" class="btn btn-default"><i class="fa fa-sign-out " aria-hidden="true"></i></button>
                </form></li>
            </ul>              
<!-- リンクメニュー　ここまで -->                   
                
        </div><!-- /.navbar-collapse-->
    </div><!-- /.container-->
</nav>

    
<!--- パンくず --->

<ol class="breadcrumb">
	<li><a href="../index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>HOME</a></li>
	<li class="active">過誤報告</li>
</ol>
<!--<div id="wrapper">--->
    <div class="container main-content">
      <div class="row">          
          <h2><p class="bg-primary">　　過誤報告書　</p></h2>      
<!---          
          <form method="post" action="" class="form-horizontal" id="form_input">
 --->             
            <form method="post" action="#" class="form-horizontal" id="form_input" enctype="multipart/form-data">  

              
             <div class="form-group">
                <label class="col-sm-2 control-label">発覚日付</label>
             <div class="col-sm-4">       
                <div class="input-group">
                    <input id="datepicker1" type="text" class="form-control datepicker" name="date1">
                        <label class="input-group-addon btn" for="datepicker1">
                            <span class="fa fa-calendar"></span>
                        </label>  
                </div>
              </div>
            </div>              
        
            <div class="form-group">
                <label class="col-sm-2 control-label">発生日付</label>
             <div class="col-sm-4"> 
                <div class="input-group">
                    <input id="datepicker2" type="text" class="form-control datepicker" name="date2">
                        <label class="input-group-addon btn" for="datepicker2">
                            <span class="fa fa-calendar"></span>
                        </label>  
                </div>                
              </div>
                
            <div class="col-sm-3">     
                  <select class="form-control" name="date2_1">
                    <option value="午前">午前</option>
                    <option value="午後">午後</option>
                </select>
              </div>
            </div> 
             
            <div class="form-group">
              <label class="col-sm-2 control-label">発覚元</label>
              <div class="col-sm-3">   
                  <select class="form-control" name="moto">
                    <option value="薬局">薬局</option>
                    <option value="患者">患者</option>
                    <option value="医療機関">医療機関</option>
                    <option value="その他">その他</option>
                </select>
              </div>
            </div>  

            <h4><p class="bg-warning">　　健康被害　</p></h4>  
              
            <div class="form-group">
                <label class="col-sm-2 control-label">健康被害報告</label>
            <div class="radio col-sm-3">
                <label><input type="radio" name="radio0" id="radio0_1" value="なし" checked=true> なし</label>
                <label><input type="radio" name="radio0" id="radio0_2" value="あり"> あり</label>
            </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">詳細</label>
                <div class="col-sm-8">
                    <textarea class="form-control" rows="5"  id="shosai1" name="shosai1" disabled></textarea>
                </div>
            </div>
           
            <h4><p class="bg-warning">　　過誤詳細　</p></h4>  
            
            <div class="form-group">
                <label class="col-sm-2 control-label">詳細</label>
                <div class="col-sm-8">
                    <textarea class="form-control" rows="5" id="shosai2" name="shosai2"></textarea>
                </div>
            </div>
            
            <h4><p class="bg-warning">　　処方箋　</p></h4>   
              
            <div class="form-group">
                 <label for="input-name" class="col-sm-2 control-label">処方箋画像</label>
            <input id="lefile" type="file" name="upfile" style="display:none"> 
                <div class="col-sm-6">
                        <div class="input-group">
                            <input type="text" id="fileup" class="form-control" placeholder="ファイルを選択してください">
                            <span class="input-group-btn"><button type="button" class="btn btn-info" onclick="$('input&#91;id=lefile&#93;').click();"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></button></span>
                        </div>
                        <p class="help-block">ファイルを間違えずに選択してください</p>
                 </div>
             </div>
              
<!--- 調剤状況 --->
    <div class="panel panel-info">
        <div class="panel-heading">　　調剤状況</div>
        <div class="panel-body">
            
            <h5><p class="bg-primary">　　受付</p></h5>
            
            <div class="form-group">
                <label for="input-name" class="col-sm-2 control-label">処方箋分類</label>
                    <div class="col-sm-10">
                        <div class="form-inline">
                            <label class="radio-inline"><input type="radio" name="radio1" id="radio1_1" checked=true value="外来"> 外来</label>
                            <label class="radio-inline"><input type="radio" name="radio1" id="radio1_2" value="在宅(施設)"> 在宅(施設)</label>
                            <label class="radio-inline"><input type="radio" name="radio1" id="radio1_3" value="在宅(居宅)"> 在宅(居宅)</label>
                        </div>
                    </div>
            </div>  
            
<!--- 社員番号呼び出し --->
            <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label">入力者</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="timecard1" placeholder="タイムカード番号" name="timecard1">
                        <label class="input-group-addon btn" for="timecard1">
                        <span class="glyphicon glyphicon-user"></span>
                        </label> 
                    </div>
                    <p class="help-block">入力後に社員名が自動表示されます</p>
                </div>
                
                <div class="col-sm-4">     
                    <input type="text" class="form-control" id="timecard1_1" placeholder="社員名" name="timecard1_1" disabled=true>
                </div> 
            </div>
<!--- ↑　↑　↑　--->
            
            <div class="form-group">
                <label for="input-name" class="col-sm-2 control-label">入力支援利用</label>
                    <div class="col-sm-10">
                        <div class="form-inline">
                            <label class="radio-inline col-sm-2"><input type="radio" name="radio2" id="radio2_2" value="あり"> 二次元(あり)</label>
                            <label class="radio-inline col-sm-2"><input type="radio" name="radio2" id="radio2_1" value="なし" checked=true> 手入力(なし)</label>
                        </div>
                    </div>
            </div>
            
              <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label">処方監査者</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="timecard2" placeholder="タイムカード番号" name="timecard2">
                        <label class="input-group-addon btn" for="timecard2">
                        <span class="glyphicon glyphicon-user"></span>
                        </label> 
                    </div>
                    <p class="help-block">入力後に社員名が自動表示されます</p>
                </div>
                
                <div class="col-sm-4">     
                    <input type="text" class="form-control" id="timecard2_1" placeholder="社員名" name="timecard2_1" disabled=true>
                </div> 
            </div>
            
            <h5><p class="bg-primary">　　調剤</p></h5>
            
            <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label">調剤者</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="timecard3" placeholder="タイムカード番号" name="timecard3">
                        <label class="input-group-addon btn" for="timecard3">
                        <span class="glyphicon glyphicon-user"></span>
                        </label> 
                    </div>
                    <p class="help-block">入力後に社員名が自動表示されます</p>
                </div>
                
                <div class="col-sm-4">     
                    <input type="text" class="form-control" id="timecard3_1" placeholder="社員名" name="timecard3_1" disabled=true>
                </div> 
            </div>
            
            <div class="form-group">
                <label for="input-name" class="col-sm-2 control-label">ピッキング支援利用</label>
                    <div class="col-sm-10">
                        <div class="form-inline">
                            <label class="radio-inline col-sm-2"><input type="radio" name="radio3" id="radio3_1" value="あり"> あり</label>
                            <label class="radio-inline col-sm-2"><input type="radio" name="radio3" id="radio3_2" value="なし" checked=true> なし</label>
                        </div>
                    </div>
            </div>
            
            <div class="form-group">
                <label for="input-name" class="col-sm-2 control-label">水剤調剤支援利用</label>
                    <div class="col-sm-10">
                        <div class="form-inline">
                            <label class="radio-inline col-sm-2"><input type="radio" name="radio4" id="radio4_1" value="あり"> あり</label>
                            <label class="radio-inline col-sm-2"><input type="radio" name="radio4" id="radio4_2" value="なし" checked=true> なし</label>
                        </div>
                    </div>
            </div>
            
            <div class="form-group">
                <label for="input-name" class="col-sm-2 control-label">一包化調剤支援利用</label>
                    <div class="col-sm-10">
                        <div class="form-inline">
                            <label class="radio-inline col-sm-2"><input type="radio" name="radio5" id="radio5_1" value="あり"> あり</label>
                            <label class="radio-inline col-sm-2"><input type="radio" name="radio5" id="radio5_2" value="なし" checked=true> なし</label>
                        </div>
                    </div>
            </div>
            
            <h5><p class="bg-primary">　　鑑査</p></h5>
            
            <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label">鑑査者</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="timecard4" placeholder="タイムカード番号" name="timecard4">
                        <label class="input-group-addon btn" for="timecard4">
                        <span class="glyphicon glyphicon-user"></span>
                        </label> 
                    </div>
                    <p class="help-block">入力後に社員名が自動表示されます</p>
                </div>
                
                <div class="col-sm-4">     
                    <input type="text" class="form-control" id="timecard4_1" placeholder="社員名" name="timecard4_1" disabled=true>
                </div> 
            </div>
            
            <h5><p class="bg-primary">　　服薬指導</p></h5>
            
            <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label">服薬指導者</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="timecard5" placeholder="タイムカード番号" name="timecard5">
                        <label class="input-group-addon btn" for="timecard5">
                        <span class="glyphicon glyphicon-user"></span>
                        </label> 
                    </div>
                    <p class="help-block">入力後に社員名が自動表示されます</p>
                </div>
                
                <div class="col-sm-4">     
                    <input type="text" class="form-control" id="timecard5_1" placeholder="社員名" name="timecard5_1" disabled=true>
                </div> 
            </div>  
        </div>
    </div>　<!--- panel end --->
    
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
<!--- ajax error --->  
                        <div id="XMLHttpRequest"></div><!-- ステータスコード -->
                        <div id="textStatus"></div><!-- エラー情報 -->
                        <div id="errorThrown"></div><!-- 例外情報 -->
<!--- --->
                    <button type="button" class="btn btn-primary btn-lg" id="mcheckButton"><i class="glyphicon glyphicon-ok"> 送信する</i></button>
                    <a>　</a>
                    <button type="button" class="btn btn-success btn-lg" onclick="location.href='../index.php'"><i class="glyphicon glyphicon-home"> 戻る</i></button>
                </div>
            </div>
              
          </form> <!-- form -->
      </div>
    </div><!--/.main-content-->

    
    <!--フッター-->
    <footer class="container-fluid">
      <small><a href="/">Copyright &#169; 2016 K.Yasuda All Rights Reserved.</a></small>
    </footer>
   
</body>
    </div>
<!-- 送信内容確認画面：モーダル１　-->
  <div class="modal" id="mcheck" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-show="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form name="checksend">
<!-- header --->            
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&#215;</span><span class="sr-only">閉じる</span>
          </button>
          <h3 class="modal-title"><p class="bg-primary">　過誤報告書</p></h3>
        </div><!-- /modal-header -->
<!-- body --->        
          <div class="modal-body">
            <div class="form-horizontal">   
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">発覚日時</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="checkdate1" name="checkdate1" disabled>
                </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">発生日時</label>
                    <div class="col-sm-4">
                    <input type="text" class="form-control" id="checkdate2" name="checkdate2" disabled>
                    </div>
                    <div class="col-sm-3">
                    <input type="text" class="form-control" id="checkdate2_1" name="checkdate2_1" disabled>     
                </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">発覚元</label>
                <div class="col-sm-3">
                    <input class="form-control" id="checkmoto" name="checkmoto" disabled>
                </div>
                </div>     
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">健康被害</label>
                        <div class="col-sm-2">
                            <p class="form-control-static">健康被害報告</p>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="checkradio0" name="checkradio0" disabled>
                        </div>
                </div>
                <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5"  id="checkshosai1" name="checkshosai1" disabled></textarea>
                        </div>
                </div>
                <div class="form-group">
                        <label class="col-sm-2 control-label">過誤詳細</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5"  id="checkshosai2" name="checkshosai2" disabled></textarea>
                        </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">画像ファイル名</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="checkfile" name="checkfile" disabled>
                    </div>
                </div>  
                
        <div class="panel panel-info">
            <div class="panel-heading">　　調剤状況</div>
            <div class="panel-body">
                
                <h5><p class="bg-primary">　　受付</p></h5>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label">処方箋分類</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="checkradio1" name="checkradio1" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">入力者</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="checktimecard1" name="checktimecard1" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">入力方法</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="checkradio2" name="checkradio2" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">処方監査者</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="checktimecard2" name="checktimecard2" disabled>
                    </div>
                </div>
                <h5><p class="bg-primary">　　調剤</p></h5>
                <div class="form-group">
                    <label class="col-sm-3 control-label">調剤者</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="checktimecard3" name="checktimecard3" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">入力支援利用</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="checkradio3" name="checkradio3" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">水剤調剤支援利用</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="checkradio4" name="checkradio4" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">一包化調剤支援利用</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="checkradio5" name="checkradio5" disabled>
                    </div>
                </div>
                
                <h5><p class="bg-primary">　　鑑査</p></h5>
                <div class="form-group">
                    <label class="col-sm-3 control-label">鑑査者</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="checktimecard4" name="checktimecard4" disabled>
                    </div>
                </div>
                <h5><p class="bg-primary">　　服薬指導</p></h5>
                <div class="form-group">
                    <label class="col-sm-3 control-label">服薬指導者</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="checktimecard5" name="checktimecard5" disabled>
                    </div>
                </div>
            </div>
        </div>
                
<!---  error message --->
                <div id="DBerror"></div><!-- 例外情報 -->
<!---   --->
                <div class="form-group"> 
                    <div class="col-sm-12">
                    <h3><p class="bg-primary">　
                        この内容で送信しますか？</p></h3>
                    </div>
                </div>
          </div>
        </div>
<!--- footer --->            
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="sendok"><i class="glyphicon glyphicon-ok"></i> は　い</button>
            <button type="button" class="btn btn-default" data-dismiss="modal" id="sendng">いいえ</button>
        </div>
          
          </form>
      </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
  </div> <!-- /.modal -->


<!-- 終了画面：モーダル２ -->
  <div class="modal" id="quitmes" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-show="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&#215;</span><span class="sr-only">閉じる</span>
          </button>
          <h3 class="modal-title">
<!--- 届け種類 --->
              <p class="bg-primary">　過誤報告</p></h3>
        </div><!-- /modal-header -->
          <form name="checksend">

            <div class="modal-body">
                           
                <h5><p class="bg-primary">　　報告書PDF</p></h5>
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-4">
                        
                        <div id="print-pdffile"></div>
                            
                    </div>
                </div>   
       
              <div id="MailMessage"></div><!-- メール内容 -->
              <div id="MailError"></div><!-- エラー内容 -->
                <div class="form-group"> 
                    <div class="col-sm-12">
                    <h3><p class="bg-danger">　
                        上記内容で送信されました</p></h3>
                    </div>
                </div>
          </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="quitok">閉じる</button>
        </div>
          </form>
      </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
  </div> <!-- /.modal -->
      
      
<!--- Script ---->
    <!-- jQuery 1.12.4 読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <!--
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    --->
    <!-- Umi 3.3.7-1 --->
    <script src="../js/bootstrap.min.js"></script>
    <!-- Datepicker Bootstrap -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.ja.min.js">
    </script>
    <!-- Timepicker -->
    <script type="text/javascript" src="../js/bootstrap-timepicker.min.js"></script>

<script>

$(function(){
    
    //確認モーダル表示
    $('#mcheckButton').on('click', function() {
    //  mobile modal scroll
        current_scrollY = $(window).scrollTop();
		$('#wrapper').css({
			top: -1 * current_scrollY,
			position: 'fixed',
		    width: '100%',
		});
        $('#mcheck').modal();  
  });
    
    
    // 確認モーダル表示準備
    $('#mcheck').on('show.bs.modal', function (event) {
       
        var input_timecard1=$('#timecard1_1').val();
        var input_timecard2=$('#timecard2_1').val();
        var input_timecard3=$('#timecard3_1').val();
        var input_timecard4=$('#timecard4_1').val();
        var input_timecard5=$('#timecard5_1').val();
        
        var input_date1=$('input[name="date1"]').val();
        var input_date2=$('input[name="date2"]').val();
        var input_date2_1=$('[name="date2_1"] option:selected').val();
        var input_moto=$('[name="moto"] option:selected').val();
        
        var input_shosai1=$('#shosai1').val();
        var input_shosai2=$('#shosai2').val();
        
        var input_radio0=$('input[name=radio0]:checked').val();
        var input_radio1=$('input[name=radio1]:checked').val();
        var input_radio2=$('input[name=radio2]:checked').val();
        var input_radio3=$('input[name=radio3]:checked').val();
        var input_radio4=$('input[name=radio4]:checked').val();
        var input_radio5=$('input[name=radio5]:checked').val();
        
        var input_file=$('#fileup').val();
       
        $('#checktimecard1').val(input_timecard1);
        $('#checktimecard2').val(input_timecard2);
        $('#checktimecard3').val(input_timecard3);
        $('#checktimecard4').val(input_timecard4);
        $('#checktimecard5').val(input_timecard5);
        $('#checkdate1').val(input_date1);
        $('#checkdate2').val(input_date2);
        $('#checkdate2_1').val(input_date2_1);
        $('#checkmoto').val(input_moto);
        $('#checkshosai1').val(input_shosai1);
        $('#checkshosai2').val(input_shosai2);
        $('#checkradio0').val(input_radio0);
        $('#checkradio1').val(input_radio1);
        $('#checkradio2').val(input_radio2);
        $('#checkradio3').val(input_radio3);
        $('#checkradio4').val(input_radio4);
        $('#checkradio5').val(input_radio5);
        $('#checkfile').val(input_file);
        
        var err_flag=""; 

        if (input_date1==''){
                        $('#checkdate1').val("!　未入力");
                        err_flag=true;    
        }
        if (input_date2==''){
                        $('#checkdate2').val("!　未入力");
                        err_flag=true;    
        }
        if (input_radio0=='あり' && input_shosai1==''){
                        $('#checkshosai1').val("!　未入力");
                        err_flag=true; 
        }
        if (input_shosai2==''){
                        $('#checkshosai2').val("!　未入力");
                        err_flag=true; 
        }
        
        if (input_timecard1==''){
                        $('#checktimecard1').val("!　未入力");
                        err_flag=true;
        }
        else if(input_timecard1=='!　未入力' || input_timecard1=='！　無効なタイムカード番号'){
            err_flag=true; 
        }    
        
        if (input_timecard2==''){
                        $('#checktimecard2').val("!　未入力");
                        err_flag=true;
        }
        else if(input_timecard2=='!　未入力' || input_timecard2=='！　無効なタイムカード番号'){
            err_flag=true; 
        }
        
        if (input_timecard3==''){
                        $('#checktimecard3').val("!　未入力");
                        err_flag=true;
        }
        else if(input_timecard3=='!　未入力' || input_timecard3=='！　無効なタイムカード番号'){
            err_flag=true; 
        }
        
        if (input_timecard4==''){
                        $('#checktimecard4').val("!　未入力");
                        err_flag=true;
        }
        else if(input_timecard4=='!　未入力' || input_timecard4=='！　無効なタイムカード番号'){
            err_flag=true; 
        }
        
        if (input_timecard5==''){
                        $('#checktimecard5').val("!　未入力");
                        err_flag=true;
        }
        else if(input_timecard5=='!　未入力' || input_timecard5=='！　無効なタイムカード番号'){
            err_flag=true; 
        }
        
        if (input_file.substr(-3,3)!='jpg' && input_file.substr(-3,3)!='JPG')
        {
                        $('#checkfile').val("!　ファイル種類が間違っています");
                        err_flag=true; 
        }
        
   document.forms["checksend"].elements["sendok"].disabled=err_flag;    
        
    });
    
  $('#lefile').change(function() {
    $('#fileup').val($(this).val().replace("C:\\fakepath\\", ""));
     
  }); 
    
    
// datepicker    
    $('.datepicker').datepicker({
    format: "yyyy/mm/dd",
    language: "ja",
    autoclose: true,
    orientation: "bottom auto",
    todayHighlight: true
});
    
$('#timecard1').change(function(){
            // 全角→半角変換
    
    var text  = $(this).val();
            var hen = text.replace(/[Ａ-Ｚａ-ｚ０-９]/g,function(s){
            return String.fromCharCode(s.charCodeAt(0)-0xFEE0);
            });
    $(this).val(hen);
    
    var myprint_shain0=new print_shain('#timecard1','#timecard1_1');
 });   
    
$('#timecard2').change(function(){
            // 全角→半角変換
    
    var text  = $(this).val();
            var hen = text.replace(/[Ａ-Ｚａ-ｚ０-９]/g,function(s){
            return String.fromCharCode(s.charCodeAt(0)-0xFEE0);
            });
    $(this).val(hen);
    
    var myprint_shain1=new print_shain('#timecard2','#timecard2_1');
 });      

$('#timecard3').change(function(){
            // 全角→半角変換
    
    var text  = $(this).val();
            var hen = text.replace(/[Ａ-Ｚａ-ｚ０-９]/g,function(s){
            return String.fromCharCode(s.charCodeAt(0)-0xFEE0);
            });
    $(this).val(hen);
    
    var myprint_shain1=new print_shain('#timecard3','#timecard3_1');
 });      
    
$('#timecard4').change(function(){
            // 全角→半角変換
    
    var text  = $(this).val();
            var hen = text.replace(/[Ａ-Ｚａ-ｚ０-９]/g,function(s){
            return String.fromCharCode(s.charCodeAt(0)-0xFEE0);
            });
    $(this).val(hen);
    
    var myprint_shain1=new print_shain('#timecard4','#timecard4_1');
 });
    
$('#timecard5').change(function(){
            // 全角→半角変換
    
    var text  = $(this).val();
            var hen = text.replace(/[Ａ-Ｚａ-ｚ０-９]/g,function(s){
            return String.fromCharCode(s.charCodeAt(0)-0xFEE0);
            });
    $(this).val(hen);
    
    var myprint_shain1=new print_shain('#timecard5','#timecard5_1');
 });
    
$('#radio0_2').click(function(){    
    if($('#radio0_2').val){
        document.getElementById("shosai1").disabled=false;
    }
 });
    
$('#radio0_1').click(function(){   
    if($('#radio0_1').val){
        document.getElementById("shosai1").disabled=true;
        document.getElementById("shosai1").value="";
    }
 });    
    
    
//　---- 社員情報取得 ----
    
var print_shain=function(data_id,data_id2){
    
    var timecode=data_id;
    var printcode=data_id2;
    
    // 社員情報を取り出す
        $.ajax({
            type: "POST",
            url: "../common/shain_check.php",
            data: {timecd : $(timecode).val()
                  },
            dataType: 'text',
            success: function(data){
                var receved_data= JSON.parse(data);
                
                    $(printcode).val(receved_data.name);
          //          error_code=0;
                
                var timecarderr=receved_data.errno;

                    if (timecarderr==2){
                                        $(printcode).val("！　無効なタイムカード番号");
        //                                error_code=1;
                                        }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    $("#XMLHttpRequest").html("XMLHttpRequest : " + XMLHttpRequest.status);
                    $("#textStatus").html("textStatus : " + textStatus);
                    $("#errorThrown").html("errorThrown : " + errorThrown);
      //              error_code=99;
                }
        });
    
    // this.err_f=error_code;
  
}
    // modal mobile Scroll 

	$('#mcheck').on('hidden.bs.modal', function () {
		$('#wrapper').attr( { style: '' } );
		$('html, body').prop({ scrollTop: current_scrollY });
	});

//  データ送信、DB登録処理
    
    $('#mcheck').on('click', '#sendok', function() {
  
//　入力ＯＫの処理
            
        $('#mcheck').modal('hide');
            
//　メール送信、データ登録
    var fd = new FormData($('#form_input').get(0));
       
        $.ajax({
            type: "POST",
            url: "risk_houkoku_done.php",
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json',
        }).done(function(data){
                $('#textStatus').text(data.trans_err);
                $('#quitmes').modal();
                $('#print-pdffile').html(data.pdffile );
            
        }).fail(function(jqXHR, textStatus, errorThrown)
            {
                    $("#XMLHttpRequest").html("jqXHR : " + jqXHR.status);
                    $("#textStatus").html("textStatus : " + textStatus);
                    $("#errorThrown").html("errorThrown : " + errorThrown);
        });
        
           return false;
    });

    // 終了処理
    // $('#quitmes').on('hidden.bs.modal', function (event) {
        // Location.replace("../index.php");
    //    location.reload(true);
    //});

});
    
</script>

</html>