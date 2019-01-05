<?php

if(!isset($_SESSION['member_login']))
{
	header('Location:../index.php');
	exit();
}

require_once('../common/common.php');

try
{

    include '../common/conection.php';

	$dbh=new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');
	$sql='SELECT fusen_no,youho1,youho2,kosu,gazou,saiyo FROM mst_fusen WHERE 1';
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
    
    $fusen_shurui_kazu=0;
        
	while(true)
	{
		$rec=$stmt->fetch(PDO::FETCH_ASSOC);
        
		if($rec==false)
		{
			break;
		}
                if($rec['saiyo']==0)
                {               $fusen_name[$fusen_shurui_kazu]=$rec['youho1']."　".$rec['youho2']."　".$rec['kosu'];
                $fusen_no[$fusen_shurui_kazu]=$rec['fusen_no'];
                $fusen_last_qu[$fusen_shurui_kazu] ='0';
                $fusen_last2_qu[$fusen_shurui_kazu] ='0'; 
                $fusen_now_qu[$fusen_shurui_kazu]='0';
                $fusen_shurui_kazu++;
                }
	}

    
// 前回発注データ取得     
    
    $sql='
        SELECT
            dat_fusen.order_code,
            dat_fusen.tenpocode,
            dat_fusen.hatyu_date,
            dat_fusen_order.fusen_no,
            dat_fusen_order.quantity
        FROM
            dat_fusen,dat_fusen_order
        WHERE
            dat_fusen_order.fusen_oreder_code=dat_fusen.order_code
            AND dat_fusen.tenpocode=?
            AND substr(dat_fusen.hatyu_date,1,4)=?
            AND substr(dat_fusen.hatyu_date,5,2)=?
        ';

	$stmt=$dbh->prepare($sql);
    $data[]=$_SESSION['member_tenpocode'];
    $data[]='2016';
    $data[]='06';
    
	$stmt->execute($data);
    
    while(true)
	{
		$rec=$stmt->fetch(PDO::FETCH_ASSOC);
		if($rec==false)
		{
			break;
		}
            $last_hatyu_fusen_no=$rec['fusen_no'];
            $last_hatyu_fusen_qu=$rec['quantity'];
      
            for($i=0;$i<$fusen_shurui_kazu;$i++)
            {
                if($fusen_no[$i]==$last_hatyu_fusen_no)
                   {
                       $fusen_last_qu[$i]=$last_hatyu_fusen_qu;
                   }
            }
    }
    
// 前前回発注データ取得     
    
    $sql='
        SELECT
            dat_fusen.order_code,
            dat_fusen.tenpocode,
            dat_fusen.hatyu_date,
            dat_fusen_order.fusen_no,
            dat_fusen_order.quantity
        FROM
            dat_fusen,dat_fusen_order
        WHERE
            dat_fusen_order.fusen_oreder_code=dat_fusen.order_code
            AND dat_fusen.tenpocode=?
            AND substr(dat_fusen.hatyu_date,1,4)=?
            AND substr(dat_fusen.hatyu_date,5,2)=?
        ';

	$stmt=$dbh->prepare($sql);
    $data2[]=$_SESSION['member_tenpocode'];
    $data2[]='2016';
    $data2[]='03';
    
	$stmt->execute($data2);
    
    while(true)
	{
		$rec=$stmt->fetch(PDO::FETCH_ASSOC);
		if($rec==false)
		{
			break;
		}
            $last_hatyu_fusen_no=$rec['fusen_no'];
            $last_hatyu_fusen_qu=$rec['quantity'];
      
            for($i=0;$i<$fusen_shurui_kazu;$i++)
            {
                if($fusen_no[$i]==$last_hatyu_fusen_no)
                   {
                       $fusen_last2_qu[$i]=$last_hatyu_fusen_qu;
                   }
            }
    }	
    
// 今回発注データ取得     
    
    $sql='
        SELECT
            dat_fusen.order_code,
            dat_fusen.tenpocode,
            dat_fusen.hatyu_date,
            dat_fusen_order.fusen_no,
            dat_fusen_order.quantity
        FROM
            dat_fusen,dat_fusen_order
        WHERE
            dat_fusen_order.fusen_oreder_code=dat_fusen.order_code
            AND dat_fusen.tenpocode=?
            AND substr(dat_fusen.hatyu_date,1,4)=?
            AND substr(dat_fusen.hatyu_date,5,2)=?
        ';

	$stmt=$dbh->prepare($sql);
    $data3[]=$_SESSION['member_tenpocode'];
    $data3[]='2016';
    $data3[]='09';
    
	$stmt->execute($data3);
    
    while(true)
	{
		$rec=$stmt->fetch(PDO::FETCH_ASSOC);
		if($rec==false)
		{
			break;
		}
            $now_hatyu_fusen_no=$rec['fusen_no'];
            $now_hatyu_fusen_qu=$rec['quantity'];
      
            for($i=0;$i<$fusen_shurui_kazu;$i++)
            {
                if($fusen_no[$i]==$now_hatyu_fusen_no)
                   {
                       $fusen_now_qu[$i]=$now_hatyu_fusen_qu;
                   }
            }
    }
    
    
    
$dbh=null;    
    
//  テーブル付箋表示
    for($i=0;$i<$fusen_shurui_kazu;$i++)
    {
                    print'<tr><td class="col-md-1">';
                    print'<button type="button" class="btn-sm btn-default"><i class="glyphicon glyphicon-info-sign" id="fusen_info_'.$i.'"></i></button>　　';
                    print'</td>';
                    print'<td class="col-md-1">';
                    print $fusen_no[$i];
                    print'</td>';
                    print'<td class="col-md-2">';
                    print $fusen_name[$i];
                    print'</td>';
                                                                  
                    print'<td class="col-md-2"><input type="number" class="form-control" placeholder="発注数を入力" value="'.$fusen_now_qu[$i].'" id="fusen_order_'.$i.'" name="fusen_order_'.$i.'"></td>';
                    
                    print'<td class="col-md-2">'.$fusen_last_qu[$i].'</td>';
                    print'<td class="col-md-2">'.$fusen_last2_qu[$i].'</td>';
                    print'</tr>';
    }
    
}


catch(exception $e)
{
	// print'サーバー接続に障害が発生しています';
	// exit();
}

?>
