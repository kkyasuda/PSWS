<!----

    Pharmacy Suport Web System  (C)1996 by K.Yasuda
        Last Update 2016/08/21

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

<body>

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
                            echo $tenponame
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
                
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                リスク管理報告<span class="caret"></span>
                </a>
                    <ul class="dropdown-menu">
                        <li><a href="../risk/risk_houkoku.php">過誤報告</a></li>
                        <li><a href="../risk/risk_taisaku.php">過誤対策</a></li>
                    </ul>      
                </li>

                <li><a href="#">月計報告</a></li>
                <li class="active"><a href="upload.php">レセデータ送信</a></li> 
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
	<li class="active">レセデータ送信</li>
</ol>

    <div class="container main-content">
      <div class="row">          
          <h2><p class="bg-primary">　　レセプトデータ送信　</p></h2>
          
          <form method="post" action="#" class="form-horizontal" id="form_upload" enctype="multipart/form-data">
              
           <div class="form-group">
                <label for="date2" class="col-sm-3 control-label">年月</label>
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
                <label for="input-name" class="col-sm-3 control-label">レセプト種別</label>
                    <div class="col-sm-9">
                        <div class="form-inline">
                            <label class="radio-inline col-sm-2"><input type="radio" name="radio1" id="radio1_1" checked=true value="kikin"> 基金</label>
                            <label class="radio-inline col-sm-2"><input type="radio" name="radio1" id="radio1_2" value="kokuho"> 国保</label>
                        </div>
                    </div>
            </div>  
          
            <div class="form-group">
                 <label for="input-name" class="col-sm-3 control-label">ファイル</label>
                  <input id="lefile" type="file" name="upfile" style="display:none"> 
                <div class="col-sm-6">
                        <div class="input-group">
                            <input type="text" id="fileup" class="form-control" placeholder="ファイルを選択してください">
                            <span class="input-group-btn"><button type="button" class="btn btn-info" onclick="$('input&#91;id=lefile&#93;').click();"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></button></span>
                        </div>
                        <p class="help-block">ファイルを間違えずに選択してください</p>
                 </div>
             </div>
            
            <div class="form-group">
                <div class="col-sm-3">
                <div class="alert alert-warning">
                <label for="input-name" class="alert-warning">
                <span class="glyphicon glyphicon-exclamation-sign"></span>メッセージ
                </label>
                </div>
                </div>
                                                                                                                 
                <div class="col-sm-4">
                <div id="fileup_Status" class="alert-warning"></div>
                </div>
            </div>  
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
<!--- ajax error --->  
                        <div id="jqXHR"></div><!-- ステータスコード -->
                        <div id="textStatus"></div><!-- エラー情報 -->
                        <div id="errorThrown"></div><!-- 例外情報 -->
<!--- --->
                    <button type="submit" class="btn btn-primary btn-lg" id="mcheckButton"><i class="glyphicon glyphicon-ok"> 送信する</i></button>
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

<!--- Script ---->
    <!-- jQuery 3.1.0 読み込み -->
    <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
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
    format: "yyyy/mm",
    language: "ja",
    autoclose: true,
    orientation: "bottom auto",
    todayHighlight: true,
    minViewMode: 'months'
});
    
$(function(){
    
 $('#lefile').change(function() {
    $('#fileup').val($(this).val().replace("C:\\fakepath\\", ""));
    var check_files=new check_file(); 
     
  });
    
$('#datepicker1').change(function(){
    
    var input_date = $('#datepicker1').val();
    var input_hoken = $('[name="radio1"]:checked').val();
    
    console.log(input_date);
    console.log(input_hoken);
    
    var check_files=new check_file(); 
    
});
    
$('#radio1_1').click(function(){
    
    var input_date = $('#datepicker1').val();
    var input_hoken = $('[name="radio1"]:checked').val();
    
    console.log(input_date);
    console.log(input_hoken);
    var check_files=new check_file(); 
    
});
    
$('#radio1_2').click(function(){
    
        var input_date = $('#datepicker1').val();
    var input_hoken = $('[name="radio1"]:checked').val();
    
    console.log(input_date);
    console.log(input_hoken);
    var check_files=new check_file(); 
    
});    
    
 var check_file=function(){
     
    console.log($('#fileup').val()); 
    console.log($('#fileup').val().substr(-3,3));
     
    if ($('#datepicker1').val()!='' && $('#fileup').val()!='' && $('#fileup').val().substr(-3,3)=='pdf')
     {
         
  /*       
  
  $('#fileup').val(substr(-3,3)!='pdf'))
                 var input_file=$('#fileup').val();
         
         
                 if (input_file.substr(-3,3)!='pdf')
        {
                        $('#checkfile').val("!　ファイル種類が間違っています");
                        err_flag=true; 
        }
    */     
            var fd = new FormData($('#form_upload').get(0));
         
        $.ajax({
            type: "POST",
            url: "upload_check.php",
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json',
        }).done(function(data){
                    $('#fileup_Status').html(data.upload_status); 
                if(data.upload_err=='1')
                    $('#mcheckButton').prop("disabled", true);
                else
                    $('#mcheckButton').prop("disabled", false);
                    
        }).fail(function(jqXHR, textStatus, errorThrown)
                {
                    $("#jqXHR").html("jqXHR : " + jqXHR.status);
                    $("#textStatus").html("textStatus : " + textStatus);
                    $("#errorThrown").html("errorThrown : " + errorThrown);
        });         
         
     return false; 
     }
     
}       
    
 $('#form_upload').submit(function() {

    var fd = new FormData($('#form_upload').get(0));
    /* 
        $.ajax({
            type: "POST",
            url: "upload_done.php",
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data){
                $('#textStatus').text(data.trans_err);     
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    $("#XMLHttpRequest").html("XMLHttpRequest : " + XMLHttpRequest.status);
                    $("#textStatus").html("textStatus : " + textStatus);
                    $("#errorThrown").html("errorThrown : " + errorThrown);
                }
        });
    */
     
        $.ajax({
            type: "POST",
            url: "upload_done.php",
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json',
        }).done(function(data){
                $('#textStatus').text(data.trans_err);     
        }).fail(function(jqXHR, textStatus, errorThrown)
                {
                    $("#jqXHR").html("jqXHR : " + XMLHttpRequest.status);
                    $("#textStatus").html("textStatus : " + textStatus);
                    $("#errorThrown").html("errorThrown : " + errorThrown);
        });
     
     
           return false;
    });
    
 });
    
 </script>   
</html>