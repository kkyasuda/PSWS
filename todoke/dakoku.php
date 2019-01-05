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
                        <span class="sr-only">Toggle navigation</span>
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

                <li class="active dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                各種届け<span class="caret"></span>
                </a>
                    <ul class="dropdown-menu">
                        <li><a href="dakoku.php">打刻修正届</a></li>
                        <li><a href="kyujitsu.php">休日出勤届</a></li>
                        <li><a href="tikoku.php">遅刻早退届</a></li>
                        <li><a href="kyuka.php">休暇欠勤届</a></li>
                        <li class="divider"></li>
                        <li><a href="tenpo_kyujitu.php">店舗休日届</a></li>
                        <li class="divider"></li>
                        <li><a href="benkyoukai.php">研修会出欠届</a></li>
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
                <li><a href="../dataupload/upload.php">レセデータ送信</a></li> 
                <li><form class="navbar-form navbar-left" action="../member_login/member_logout.php">
                <button type="submit" class="btn btn-default"><i class="fa fa-sign-out " aria-hidden="true"></i></button>
                </form></li>
            </ul>                       
        </div><!-- /.navbar-collapse-->
    </div><!-- /.container-->
</nav>

    
<!--- パンくず --->

<ol class="breadcrumb">
	<li><a href="../index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>HOME</a></li>
	<li>各種届け</li>
	<li class="active">打刻修正届</li>
</ol>

<!---- コンテンツ --->

<!-- 打刻修正届
todoke_dakoku_check.php
timecard    :   timecard number
kubun       :   出勤,再入,外出,退勤
date1       :   修正日
time1       :   修正前
time2       :   修正後
jiyu        :   事由
----->

    <div class="container main-content">
      <div class="row">          
          <h2><p class="bg-primary">　　打刻修正届　</p></h2>          
          <form method="post" action="" class="form-horizontal" id="form_input"> 
              
            <div class="form-group">              
              <label class="col-sm-3 control-label">タイムカード番号</label>
                <div class="col-sm-5">
                    <div class="input-group">
                    <input type="text" class="form-control" id="timecard" placeholder="タイムカード番号" name="timecard">
                        <label class="input-group-addon btn" for="timecard">
                            <span class="glyphicon glyphicon-user"></span>
                        </label> 
                    </div>
                    <p class="help-block">入力後に社員名が自動表示されます</p>
                </div>
                <div class="col-sm-4">     
                    <input type="text" class="form-control" id="timecard_p" placeholder="社員名" name="timecard_p" disabled=true>
                </div> 
            </div>
              
            <div class="form-group">
              <label class="col-sm-3 control-label">区分</label>
                <div class="col-sm-2">
                    <p class="form-control-static">打刻修正</p>
                </div>
              <div class="col-sm-3">
                  <select class="form-control" name="kubun" placeholder="選んで下さい">
                    <option value="出勤">出勤</option>
                    <option value="外出">外出</option>
                    <option value="再入">再入</option>
                    <option value="退勤">退勤</option>
                </select>
              </div>
            </div>  
           <div class="form-group">
                <label for="date2" class="col-sm-3 control-label">日付</label>
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
                        <label for="time1" class="col-sm-3 control-label">時間</label>               
                   <div class="form-inline">
                   <div class="col-sm-3">
                        <div class="input-group">
                            <input id="time1_1" type="text" class="form-control timepicker" name="time1">
                            <label class="input-group-addon btn" for="time1_1">
                            <span class="glyphicon glyphicon-time"></span>
                            </label>  
                        </div>
                   </div>
                    <div class="col-sm-1"> 
                        <label for="timepicker2"><i class="fa fa-arrow-right fa-2x" aria-hidden="true"></i></label>
                   </div>
                   
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input id="time2_1" type="text" class="form-control timepicker" name="time2">
                            <label class="input-group-addon btn" for="time2_1">
                            <span class="glyphicon glyphicon-time"></span>
                            </label>  
                        </div>
                   </div>
                </div>
              </div>
              
            <div class="form-group">
              <label class="col-sm-3 control-label">事由</label>
              <div class="col-sm-8">
                <textarea class="form-control" rows="3"  id="jiyu" name="jiyu"></textarea>
              </div>
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

<!-- 送信内容確認画面：モーダル１　-->
  <div class="modal" id="mcheck" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-show="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&#215;</span><span class="sr-only">閉じる</span>
          </button>
<!--- 届け種類 --->
          <h3 class="modal-title"><p class="bg-primary">　打刻修正届</p></h3>
        </div><!-- /modal-header -->
        <form name="checksend">
          <div class="modal-body">
            <div class="form-horizontal">   
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">タイムカード番号</label>
                <div class="col-xs-5">
                    <input type="text" class="form-control" id="checktimecard" name="checktimecard" disabled>
                </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label">社員番号</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" id="checkshain" name="checkshain" disabled>
                </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label">名前</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" id="checkname" name="checkname" disabled>
                </div>
                </div>
                <div class="form-group">
                    <label for="kubun" class="col-xs-4 control-label">区分</label>
                        <div class="col-xs-3">
                            <p class="form-control-static">打刻修正 </p>
                        </div>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" id="checkkubun" name="checkkubun" disabled>
                        </div>
                </div>
                <div class="form-group">
                    <label for="date1" class="col-xs-4 control-label">日付</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" id="checkdate1" name="checkdate1" disabled>
                </div>
                </div>
                <div class="form-group">
                    <label for="time1" class="col-xs-4 control-label">時間</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" id="checktime1" name="checktime1" disabled>
                </div>
                </div>
                <div class="form-group">
                    <label for="time1" class="col-xs-3 control-label"></label>
                    <label for="time1" class="col-xs-1 control-label"> → </label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" id="checktime2" name="checktime2" disabled>
                </div>
                </div>
                <div class="form-group">
                    <label for="date1" class="col-xs-4 control-label">事由</label>
                <div class="col-xs-8">
                    <textarea class="form-control" rows="3"  id="checkjiyu" name="checkjiyu" disabled></textarea>
                </div>
                </div> 
<!---  error message --->
                <div id="DBerror"></div><!-- 例外情報 -->
<!---   --->
                <div class="form-group"> 
                    <div class="col-xs-12">
                    <h3><p class="bg-primary">　
                        この内容で送信しますか？</p></h3>
                    </div>
                </div>
          </div>
        </div>
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
              <p class="bg-primary">　打刻修正届</p></h3>
        </div><!-- /modal-header -->
          <form name="checksend">
          <div class="modal-body">
              <div id="MailMessage"></div><!-- メール内容 -->
              <div id="MailError"></div><!-- エラー内容 -->
                <div class="form-group"> 
                    <div class="col-xs-12">
                    <h3><p class="bg-danger">　
                        上記内容で送信されました</p></h3>
                    </div>
                </div>
          </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="quitok">閉じる</button>
        </div>
      </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
  </div> <!-- /.modal -->


<!---- TEST CODE end ---->

</body>

<!--- Script ---->
    <!-- jQuery 1.12.4 読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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

// timepicker    
    $('.timepicker').timepicker({
    minuteStep: 15,
    showSeconds: false,
    showMeridian: false,
    showInputs: false,
    disableFocus: true
    });

$('#timecard').change(function(){
    
    // 全角→半角変換
    
    var text  = $(this).val();
            var hen = text.replace(/[Ａ-Ｚａ-ｚ０-９]/g,function(s){
            return String.fromCharCode(s.charCodeAt(0)-0xFEE0);
            });
    $(this).val(hen);
    
    var myprint_shain0=new print_shain('#timecard','#timecard_p');
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
                    error_code=0;
                
                var timecarderr=receved_data.errno;

                    if (timecarderr==2){
                                        $(printcode).val("！　無効なタイムカード番号");
                                        error_code=1;
                                        }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    $("#XMLHttpRequest").html("XMLHttpRequest : " + XMLHttpRequest.status);
                    $("#textStatus").html("textStatus : " + textStatus);
                    $("#errorThrown").html("errorThrown : " + errorThrown);
                    error_code=99;
                }
        });
    
    //this.err_f=error_code;
  
}    

// --------------------------    
    
    
$(function() {

//確認モーダル表示
    $('#mcheckButton').on('click', function() {
        $('#mcheck').modal();  
  }); 
    
// 確認モーダル表示準備
    $('#mcheck').on('show.bs.modal', function (event) {
       
    // var input_timecard=document.forms["form_input"].elements["timecard_p"].value;
        var input_timecard=document.forms["form_input"].elements["timecard"].value;
        var input_kubun=document.forms["form_input"].elements["kubun"].value;
        var input_date1=document.forms["form_input"].elements["date1"].value;
        var input_time1=document.forms["form_input"].elements["time1"].value;
        var input_time2=document.forms["form_input"].elements["time2"].value;
        var input_jiyu=document.forms["form_input"].elements["jiyu"].value;

        $('#checktimecard').val(input_timecard);
        $('#checkkubun').val(input_kubun);  
        $('#checkdate1').val(input_date1);   
        $('#checktime1').val(input_time1);
        $('#checktime2').val(input_time2);
        $('#checkjiyu').val(input_jiyu); 
        
// 社員情報を取り出す

        $.ajax({
            type: "POST",
            url: "../common/shain_check.php",
            data: {timecd : $('#timecard').val()
                  },
            dataType: 'text',
            success: function(data){
                var receved_data= JSON.parse(data);
                    $('#checkname').val(receved_data.name);
                    $('#checkshain').val(receved_data.code);
                var timecarderr=receved_data.errno;
           
                        var err_flag="";     
    
                    if (timecarderr==1){
                                        $('#checktimecard').val("!　未入力");
                                        err_flag=true;
                                        }
                    if (timecarderr==2){
                                        $('#checktimecard').val("！　無効なタイムカード番号");
                                        err_flag=true;
                                        }
                    if (timecarderr==3){
                                        $("#DBerror").html('<h2><p class="bg-danger">　サーバー障害が発生しています</p></h2>');
                                        err_flag=true;
                                        }
   
    /*    
                    if (input_timecard==''){
                                        $('#checktimecard').val("!　未入力");
                                        err_flag=true;
                                        }
                    else if(input_timecard=='!　未入力' || input_timecard=='！　無効なタイムカード番号'){
                                        err_flag=true; 
                                        }         
    */
        
                    if (input_kubun==''){
                                        $('#checkkubun').val("!　未入力");
                                        err_flag=true;
                                        }
                    if (input_date1==''){
                                        $('#checkdate1').val("!　未入力");
                                        err_flag=true;
                                        }
                    if (input_time1==''){
                                        $('#checktime1').val("!　未入力");
                                        err_flag=true;
                                        }   
                    if (input_time2==''){
                                        $('#checktime2').val("!　未入力");
                                        err_flag=true;
                                        }

                document.forms["checksend"].elements["sendok"].disabled=err_flag;
             
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    $("#XMLHttpRequest").html("XMLHttpRequest : " + XMLHttpRequest.status);
                    $("#textStatus").html("textStatus : " + textStatus);
                    $("#errorThrown").html("errorThrown : " + errorThrown);
                }
        });
        
    });
    
//  データ送信、DB登録処理
    
    $('#mcheck').on('click', '#sendok', function() {
  
//　入力ＯＫの処理
            
            var param2={ timecard: $('#checktimecard').val(),
                        name: $('#checkname').val(),
                        shaincode: $('#checkshain').val(),
                        kubun: $('#checkkubun').val(),
                        date1: $('#checkdate1').val(),
                        time1: $('#checktime1').val(),
                        time2: $('#checktime2').val(),
                        jiyu: $('#jiyu').val(),          
                      };
            
            $('#mcheck').modal('hide');
            
//　メール送信、データ登録
            $.ajax({
            type: "POST",
            url: "todoke_dakoku_done.php",
            data: JSON.stringify(param2),
            dataType: 'jsonp',
            contentType: 'application/json',
            scriptCharset: 'utf-8',
            jsonpCallback: 'callback',
            success: function(data2){
                
// 終了確認モーダル表示
                if(data2.err==0){
                                    $('#quitmes').modal();
                                    $("#MailMessage").html(data2.mes);
                                }
                else
// DB接続エラー
                    {
                        alert("\n\nデータを登録できませんでした。\n\nサーバー障害が発生しています。");   
                    }                
            },
            
            error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    $("#XMLHttpRequest").text("XMLHttpRequest : " + XMLHttpRequest.status);
                    $("#textStatus").text("textStatus : " + textStatus);
                    $("#errorThrown").text("errorThrown : " + errorThrown);
                }
        });
        
    });
    
// 終了処理
    $('#quitmes').on('hidden.bs.modal', function (event) {
        // Location.replace("../index.php");
        location.reload(true);
    });
});

</script>

</html>