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
        <link rel="stylesheet" type="text/css" href="../css/bootstrap-datepicker.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap-timepicker.min.css">
    <!-- Umi 3.1.7 -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
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
                
                <li class="active dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                各種発注<span class="caret"></span>
                </a>
                    <ul class="dropdown-menu">
                        <li><a href="fusen.php">付箋</a></li>
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
                <li><a href="../upload.php">レセデータ送信</a></li> 
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
	<li>各種発注</li>
	<li class="active">付箋</li>
</ol>

<!--- Main --->
    <div class="container main-content">
      <div class="row">          
          <h2><p class="bg-primary">　　付箋発注　</p></h2>          
          <form method="post" action="" class="form-horizontal" id="form_input"> 
              
              
        <div class="table-responsive">                 
            <table class="table table-striped" id="ordertable">
                <thread>
                    <tr><th></th><th>付箋番号</th><th>付箋名</th><th>今回</th><th>前回</th><th>前々回</th></tr>
                </thread>
                <tbody>    
                    <?php include "fusen_indicate.php"; ?>                
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
                    <button type="button" class="btn btn-primary btn-lg" id="mcheckButton"><i class="glyphicon glyphicon-ok"> 発注する</i></button>
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
                    <label for="name" class="col-xs-4 control-label">タイムカード番号</label>
                <div class="col-xs-8">
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
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <!---
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    --->
<!-- Umi 3.3.7-1 --->
    <script src="../js/bootstrap.min.js"></script>
<script>
    
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
    
    this.err_f=error_code;
  
}    

// --------------------------    
    
$('#mcheckButton').on('click', function() {
    
//        $('#mcheck').modal(); 

var data = [];
var tr = $("#ordertable tr");//テーブルの全行を取得
for( var i=1,l=tr.length;i<l;i++ ){
    var cells = tr.eq(i).children();//1行目から順番に列を取得(th、td)
    if( typeof data[i] == "undefined" )
        data[i-1] = [];
    data[i-1][0] = cells.eq(1).text();//i行目j列の文字列を取得
}    
    
$('input[name^="fusen_order_"]').each(function(index,elm){  
    data[index][1]=$(elm).val();
});        

// data[1][1] : 付箋no
// data[1][2] : 発注数
    
    
     var ary_data = new Array(100); //[1,2,3,4,5,6];
    for (var i = 0; i < ary_data.length; i++) {
        ary_data[i]=i;
    }
    send_data= JSON.stringify(ary_data);
        
// Ajax処理
         $.ajax({
            type: "POST",
            url: "fusen_done.php",
            data: send_data,
 //           dataType: 'json',
            success: function(data2){
                var receved_data= JSON.parse(data2);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    $("#XMLHttpRequest").html("XMLHttpRequest : " + XMLHttpRequest.status);
                    $("#textStatus").html("textStatus : " + textStatus);
                    $("#errorThrown").html("errorThrown : " + errorThrown);
                }
        });
    
//
    
}); 



$(function() {

//確認モーダル表示
/* $('#mcheckButton').on('click', function() {
        $('#mcheck').modal();  
        fusen_count = $("tr").length;
        
        
  }); 
*/
    
// 確認モーダル表示準備
    $('#mcheck').on('show.bs.modal', function (event) {
       
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