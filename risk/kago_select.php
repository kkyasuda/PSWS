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

    $sql='SELECT h_date,h_date1,h_date2,pdf_name,date FROM dat_risk_hokoku WHERE tenpocode=? AND taisaku_no=0';
    
	$stmt=$dbh->prepare($sql);
    $data[]=$_SESSION['member_tenpocode'];
	$stmt->execute($data);
    
    $data_max=0;
    
	while(true)
	{
		$rec=$stmt->fetch(PDO::FETCH_ASSOC);
        
		if($rec==false)
		{
			break;
		}

        $hakkaku_date[$data_max]=$rec['h_date'];
        $hassei_date[$data_max]=$rec['h_date1'];
        $hassei_time[$data_max]=$rec['h_date2'];
        $pdf_file[$data_max]='../data/riskdata/'.$rec['pdf_name'].'.pdf';
        $houkoku_date[$data_max]=$rec['date'];
        $data_max=$data_max+1;

	}

$dbh=null;

//  テーブル付箋表示

    for($i=0;$i<$data_max;$i++)
    {
                    print'<tr><td class="col-md-1" align = "center" valign ="middle">';
                    print'<input type="radio" name="kago_select" id="taisaku_'.$i.'" value="'.$i.'">';
                    print'</td>';
                    print'<td class="col-md-1" align = "center" valign ="middle">';
                    print $hassei_date[$i].'　('.$hassei_time[$i].')';
                    print'</td>';
                    print'<td class="col-md-1" align = "center" valign ="middle">';
                    print'<p><a href="'.$pdf_file[$i].'" target="_blank">報告書表示</a></p>';
                    print'</td>';
                    print'<td class="col-md-1" align = "center" valign ="middle">';
                    print $hakkaku_date[$i];
                    print'</td>';
                    print'<td class="col-md-1" align = "center" valign ="middle">';
                    print $houkoku_date[$i];
                    print'</td>';
                    print'</tr>';
    }

}


catch(exception $e)
{
	// print'サーバー接続に障害が発生しています';
	// exit();
}

?>
