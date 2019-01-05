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

<body onload="firstscript()">

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
	<li class="active">過誤対策報告</li>
</ol>

    <div class="container main-content">
      <div class="row">          
          <h2><p class="bg-primary">　　過誤対策報告　</p></h2>
          
                      <form method="post" action="#" class="form-horizontal" id="form_input" enctype="multipart/form-data">
              
                          <div class="form-group">
                <label class="col-sm-2 control-label">発覚日付</label>
             <div class="col-sm-4">       
                    <input type="text" class="form-control" id="date1" placeholder="発覚日付" name="date1" disabled=true>
              </div>
            </div>              
        
            <div class="form-group">
                <label class="col-sm-2 control-label">発生日付</label>
             <div class="col-sm-4"> 
                    <input type="text" class="form-control" id="date2" placeholder="発生日付" name="date2" disabled=true>
              </div>
                
            <div class="col-sm-3">
                    <input type="text" class="form-control" id="date2_1" placeholder="午前/午後" name="date2_1" disabled=true> 
                </div>
            </div> 
             
            <div class="form-group">
              <label class="col-sm-2 control-label">発覚元</label>
              <div class="col-sm-4">
                    <input type="text" class="form-control" id="moto" placeholder="発覚元" name="moto" disabled=true>   
              </div>
            </div> 

            <h4><p class="bg-warning">　　健康被害　</p></h4>  
              
            <div class="form-group">
                <label class="col-sm-2 control-label">健康被害報告</label>
            
             <div class="col-sm-3">   
                <input type="text" class="form-control" id="moto" placeholder="あり・なし" name="radio0" disabled=true> 
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
                    <textarea class="form-control" rows="5" id="shosai2" name="shosai2" disabled></textarea>
                </div>
            </div>
            
            <h4><p class="bg-warning">　　処方箋　</p></h4>   
              
            <div class="form-group">
                
<!---

    処方箋画像表示のタグを入れる

--->
                
             </div>
              
<!--- 調剤状況 --->
    <div class="panel panel-info">
        <div class="panel-heading">　　調剤状況</div>
        <div class="panel-body">
            
            <h5><p class="bg-primary">　　受付</p></h5>
<!-- 受付 -->
            <div class="form-group">
                <label for="input-name" class="col-sm-2 control-label">処方箋分類</label>
                    <div class="col-sm-4">       
                        <input type="text" class="form-control" id="date1" placeholder="処方箋分類" name="bunrui" disabled=true>
                    </div>
            </div>    
            
<!--- 社員番号呼び出し --->
            <div class="form-group">
                <label for="input-name" class="col-sm-2 control-label">入力者</label>      
                <div class="col-sm-4">     
                    <input type="text" class="form-control" id="timecard1_1" placeholder="社員名" name="timecard1_1" disabled=true>
                </div> 
            </div>
<!--- ↑　↑　↑　--->
            
            <div class="form-group">
                <label for="input-name" class="col-sm-2 control-label">入力支援利用</label>
                        
                <div class="col-sm-4">     
                    <input type="text" class="form-control" id="n_shien" placeholder="入力支援種類" name="n_shien" disabled=true>
                </div>
                    
            </div>
            
              <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label">処方監査者</label>
                <div class="col-sm-4">     
                    <input type="text" class="form-control" id="timecard2_1" placeholder="社員名" name="timecard2_1" disabled=true>
                </div> 
            </div>
<!-- 調剤 -->
            <h5><p class="bg-primary">　　調剤</p></h5>
            
            <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label">調剤者</label>
                
                <div class="col-sm-4">     
                    <input type="text" class="form-control" id="timecard3_1" placeholder="社員名" name="timecard3_1" disabled=true>
                </div> 
            </div>
            
            <div class="form-group">
                <label for="input-name" class="col-sm-2 control-label">ピッキング支援</label>
                
                    <div class="col-sm-4">       
                        <input type="text" class="form-control" id="p_shien" placeholder="ピッキング支援" name="p_shien" disabled=true>
                    </div>                
            </div>
            
            <div class="form-group">
                <label for="input-name" class="col-sm-2 control-label">水剤調剤支援</label>
                    <div class="col-sm-4">       
                        <input type="text" class="form-control" id="s_shien" placeholder="水剤調剤支援" name="s_shien" disabled=true>
                    </div>  
            </div>
            
            <div class="form-group">
                <label for="input-name" class="col-sm-2 control-label">一包化調剤支援</label>
                    <div class="col-sm-4">       
                        <input type="text" class="form-control" id="i_shien" placeholder="一包化支援" name="i_shien" disabled=true>
                    </div>  
            </div>
            
            <h5><p class="bg-primary">　　鑑査</p></h5>
            
            <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label">鑑査者</label>                
                <div class="col-sm-4">     
                    <input type="text" class="form-control" id="timecard4_1" placeholder="社員名" name="timecard4_1" disabled=true>
                </div> 
            </div>
            
            <h5><p class="bg-primary">　　服薬指導</p></h5>
            
            <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label">服薬指導者</label>
                
                <div class="col-sm-4">     
                    <input type="text" class="form-control" id="timecard5_1" placeholder="社員名" name="timecard5_1" disabled=true>
                </div> 
            </div>  
        </div>
    </div>　<!--- panel end --->
                          
     <!---- 過誤内容 ----->
  <div class="panel panel-info">
        <div class="panel-heading">　　過誤内容</div>
        <div class="panel-body">
            
            <h5><p class="bg-primary">　　受付・入力時</p></h5>
            
            <div class="form-group">
                <label for="input-name" class="col-sm-2 control-label"></label>
                    <div class="col-sm-3">
                        <div class="checkbox">
                        <label><input type="checkbox" value="">薬品名</label>
                        </div>
                        <div class="checkbox">
                        <label><input type="checkbox" value="">用法・用量</label>
                        </div>
                        <div class="checkbox">
                        <label><input type="checkbox" value="">コメント</label>
                        </div>
                    </div>
            </div>  
            
            <h5><p class="bg-primary">　　処方監査</p></h5>
            
            <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label"></label>
                        <div class="col-sm-3">
                        <div class="checkbox">
                        <label><input type="checkbox" value="">用法・用量</label>
                        </div>
                        <div class="checkbox">
                        <label><input type="checkbox" value="">併用薬チェック(相互作用・禁忌)</label>
                        </div>
                        <div class="checkbox">
                        <label><input type="checkbox" value="">患者毎の禁忌薬</label>
                        </div>
                    </div>
            </div>
            
            <h5><p class="bg-primary">　　調剤</p></h5>
            
            <div class="form-group">
                        <label for="input-name" class="col-sm-2 control-label"></label>
                        <div class="col-sm-8">
                        <div class="checkbox">
                        <label><input type="checkbox" value="">調剤もれ・過量調剤</label>
                        </div>
                        <div class="checkbox">
                        <label><input type="checkbox" value="">計数</label>
                        </div>
                        <div class="checkbox">
                        <label><input type="checkbox" value="">計量</label>
                        </div>
                        <div class="checkbox">
                        <label><input type="checkbox" value="">ふせん</label>
                        </div>
                        <div class="checkbox">
                        <label><input type="checkbox" value="">ラベル・めもり</label>
                        </div>
                        <div class="checkbox">
                        <label><input type="checkbox" value="">薬剤取違（先発・後発）</label>
                        </div>
                        <div class="checkbox">
                        <label><input type="checkbox" value="">薬剤取違（剤形）</label>
                        </div>
                        <div class="checkbox">
                        <label><input type="checkbox" value="">薬剤取違（規格）</label>
                        </div>
                        <div class="checkbox">
                        <label><input type="checkbox" value="">薬剤取違（成分違い）</label>
                        <p><br /></p>
                        </div>
                        </div>
            </div>
            
            <h5><p class="bg-primary">　　管理</p></h5>
            
                <div class="form-group">
                    <label for="input-name" class="col-sm-2 control-label"></label>
                        <div class="col-sm-3">
                        <div class="checkbox">
                        <label><input type="checkbox" value="">異物混入</label>
                        </div>
                        <div class="checkbox">
                        <label><input type="checkbox" value="">期限切れ</label>
                        </div>
                        <div class="checkbox">
                        <label><input type="checkbox" value="">充填ミス</label>
                        </div>
                        </div>
                </div>
            
            <h5><p class="bg-primary">　　交付</p></h5>
            
                <div class="form-group">
                    <label for="input-name" class="col-sm-2 control-label"></label>
                        <div class="col-sm-3">
                        <div class="checkbox">
                        <label><input type="checkbox" value="">患者</label>
                        </div>
                        <div class="checkbox">
                        <label><input type="checkbox" value="">説明</label>
                        </div>
                        <div class="checkbox">
                        <label><input type="checkbox" value="">交付もれ</label>
                        </div>
                        </div>
                </div>
        </div>
    </div>　<!--- panel end ---> 
                          
<!----　過誤対策ほりさげ　---->
              <h4><p class="bg-warning">　　対策ほりさげ　</p></h4>
              
                      <div class="table-responsive">                 
                        <table class="table table-striped" id="ordertable">

                    <tbody>
                    <tr>
                        <th class="col-md-1"><div class="text-center"></div></th>
                        <th class="col-md-1"><div class="text-center">A</div></th>
                        <th class="col-md-1"><div class="text-center">B</div></th>
                        <th class="col-md-1"><div class="text-center">C</div></th>
                    </tr>
                    
                    <tr><th class="col-md-1"><div class="text-center">誰・何</div></th>
                        <td class="col-md-2">
                            <textarea class="form-control" rows="2"  id="jiyu" name="jiyu"></textarea>
                        </td>
                        <td class="col-md-2">
                            <textarea class="form-control" rows="2"  id="jiyu" name="jiyu"></textarea>
                        </td>
                        <td class="col-md-2">
                            <textarea class="form-control" rows="2"  id="jiyu" name="jiyu"></textarea>
                        </td>
                        </tr>
                    
                        <tr><th class="col-md-1"><div class="text-center">ほりさげ　１</div></th>
                        <td class="col-md-2">
                            <textarea class="form-control" rows="3"  id="jiyu" name="jiyu"></textarea>
                        </td>
                        <td class="col-md-2">
                            <textarea class="form-control" rows="3"  id="jiyu" name="jiyu"></textarea>
                        </td>
                        <td class="col-md-2">
                            <textarea class="form-control" rows="3"  id="jiyu" name="jiyu"></textarea>
                        </td>
                        </tr>                    
                        
                        <tr><th class="col-md-1"></th>
                        <td class="col-md-2">
                            <div class="text-center">
                            <i class="fa fa-arrow-down fa-2x" aria-hidden="true"></i>
                            </div>
                        </td>
                        <td class="col-md-2">
                            <div class="text-center">
                            <i class="fa fa-arrow-down fa-2x" aria-hidden="true"></i>
                            </div>
                        </td>
                        <td class="col-md-2">
                            <div class="text-center">
                            <i class="fa fa-arrow-down fa-2x" aria-hidden="true"></i>
                            </div>
                        </td>
                        </tr> 
                        
                    
                    <tr><th class="col-md-1"><div class="text-center">ほりさげ　２</div></th>
                        <td class="col-md-2">
                            <textarea class="form-control" rows="3"  id="jiyu" name="jiyu"></textarea>
                        </td>
                        <td class="col-md-2">
                            <textarea class="form-control" rows="3"  id="jiyu" name="jiyu"></textarea>
                        </td>
                        <td class="col-md-2">
                            <textarea class="form-control" rows="3"  id="jiyu" name="jiyu"></textarea>
                        </td>
                        </tr>
                        
                        <tr><th class="col-md-1"></th>
                        <td class="col-md-2">
                            <div class="text-center">
                            <i class="fa fa-arrow-down fa-2x" aria-hidden="true"></i>
                            </div>
                        </td>
                        <td class="col-md-2">
                            <div class="text-center">
                            <i class="fa fa-arrow-down fa-2x" aria-hidden="true"></i>
                            </div>
                        </td>
                        <td class="col-md-2">
                            <div class="text-center">
                            <i class="fa fa-arrow-down fa-2x" aria-hidden="true"></i>
                            </div>
                        </td>
                        </tr>
                          
                        <tr><th class="col-md-1"><div class="text-center">ほりさげ　３</div></th>
                        <td class="col-md-2">
                            <textarea class="form-control" rows="3"  id="jiyu" name="jiyu"></textarea>
                        </td>
                        <td class="col-md-2">
                            <textarea class="form-control" rows="3"  id="jiyu" name="jiyu"></textarea>
                        </td>
                        <td class="col-md-2">
                            <textarea class="form-control" rows="3"  id="jiyu" name="jiyu"></textarea>
                        </td>
                        </tr>
                        
                        <tr><th class="col-md-1"></th>
                        <td class="col-md-2">
                            <div class="text-center">
                            <i class="fa fa-arrow-down fa-2x" aria-hidden="true"></i>
                            </div>
                        </td>
                        <td class="col-md-2">
                            <div class="text-center">
                            <i class="fa fa-arrow-down fa-2x" aria-hidden="true"></i>
                            </div>
                        </td>
                        <td class="col-md-2">
                            <div class="text-center">
                            <i class="fa fa-arrow-down fa-2x" aria-hidden="true"></i>
                            </div>
                        </td>
                        </tr>  
                        
                    
                          <tr><th class="col-md-1"><div class="text-center">対策</div></th>
                        <td class="col-md-2">
                            <textarea class="form-control" rows="4"  id="jiyu" name="jiyu"></textarea>
                        </td>
                        <td class="col-md-2">
                            <textarea class="form-control" rows="4"  id="jiyu" name="jiyu"></textarea>
                        </td>
                        <td class="col-md-2">
                            <textarea class="form-control" rows="4"  id="jiyu" name="jiyu"></textarea>
                        </td>
                        </tr>    
                    
                                    
                </tbody>
            </table>
        </div>      
        
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
    
<!-- 過誤対策選択画面：モーダル１　-->
  <div class="modal" id="mcheck" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-show="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form name="checksend">
<!-- header --->            
        <div class="modal-header">
        <!---
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&#215;</span><span class="sr-only">閉じる</span>
          </button>
        --->
          <h3 class="modal-title"><p class="bg-primary">　   過誤対策作成選択</p></h3>
        </div><!-- /modal-header -->
<!-- body --->        
          <div class="modal-body">
            <div class="form-horizontal">   
                
                
                
            <div class="table-responsive">                 
                <table class="table table-striped" id="ordertable">
                <thread>
                    <tr>
                        <th><div class="text-center">選択</div></th>
                        <th><div class="text-center">過誤発生日</div></th>
                        <th><div class="text-center">過誤報告書</div></th>
                        <th><div class="text-center">過誤発覚日</div></th>
                        <th><div class="text-center">過誤報告日</div></th>
                    </tr>
                </thread>
                <tbody>
                    
                    <?php include "kago_select.php"; ?>
                    
                </tbody>
                </table>
        </div> 
                
                
                
                
<!---  error message --->
                <div id="DBerror"></div><!-- 例外情報 -->
<!---   --->
                <div class="form-group"> 
                    <div class="col-sm-12">
                    <h3><p class="bg-primary">　
                        未提出の過誤報告を選択してください</p></h3>
                    </div>
                </div>
          </div>
        </div>
<!--- footer --->            
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="sendok"><i class="glyphicon glyphicon-ok"></i> 作　成</button>
            <button type="button" class="btn btn-default" data-dismiss="modal" id="gohome">戻　る</button>
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

// datepicker    
    $('.datepicker').datepicker({
    format: "yyyy/mm/dd",
    language: "ja",
    autoclose: true,
    orientation: "bottom auto",
    todayHighlight: true
});
    
//  過誤報告選択画面
$(function firstscript(){
    
    //  mobile modal scroll
        current_scrollY = $(window).scrollTop();
		$('#wrapper').css({
			top: -1 * current_scrollY,
			position: 'fixed',
		    width: '100%',
		});
    
    $('#mcheck').modal();
     
});

$('#mcheck').on('click', '#sendok', function() {
    
    i=$("input:radio[name='kago_select']:checked").val();

            if (!i) {
                alert("ラジオボタンが未選択");
            } else {
                alert("選択しているのは、" + i);
            }
    
});
 $('#mcheck').on('click', '#gohome', function() {
    location.href="../index.php";
});   
    // modal mobile Scroll 

$('#mcheck').on('hidden.bs.modal', function () {
		$('#wrapper').attr( { style: '' } );
		$('html, body').prop({ scrollTop: current_scrollY });
});    
    
</script>

</html>