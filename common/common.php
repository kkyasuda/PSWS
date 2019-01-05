<?php

function gengo($seireki)
{
	if(1868<=$seireki && $seireki<=1911)
	{
		$gengo='明治';
	}
	if(1912<=$seireki && $seireki<=1925)
	{
		$gengo='大正';
	}
	if(1926<=$seireki && $seireki<=1988)
	{
		$gengo='昭和';
	}
	if(1989<=$seireki)
	{
		$gengo='平成';
	}

	return($gengo);
	
}

// array jGetInputData( [ string $type , [ string $str , [ bool $del_null_byte ] ] ] )
//   $type          : 'POST' / 'GET'（デフォルトは POST）
//   $str           : 生データを指定したい場合
//   $del_null_byte : ヌルバイトを削除するか（デフォルトは TRUE）
//   return         : POST / GET データを配列で返します。

function jGetInputData($type = 'post', $str = null, $del_null_byte = true) {
  if ($str === null) {
    switch (strtolower($type)) {
      case 'get': // GET の生データを取得
        $str = $_SERVER["QUERY_STRING"];
        break;
      case 'post': // POST の生データを取得
      default:
        $str = file_get_contents("php://input");
    }
  }

  if (!is_string($str)) return false;
  if (trim($str) === '') return array(); // 何もなし

  // 「&」が含まれていれば分解
  $datas = (strpos($str, '&') === false) ? array($str) : explode('&', $str);
  $rtn = array();

  foreach($datas as $data) {
    $name = null;
    $val = null;

    if (strpos($data, '=') === false) {
      $name = urldecode($data);
    } else {
      $_tmp = explode('=', $data, 2);
      $name = urldecode($_tmp[0]);
      $val = urldecode($_tmp[1]);
    }

    if (!isset($rtn[$name])) {
      // アイテム名が存在しなければそのまま代入
      $rtn[$name] = $val;
    } else {
      if (!is_array($rtn[$name])) {
        // アイテム名の変数が存在し、
        // アイテム名の配列が存在しなければ配列にする
        $rtn[$name] = array($rtn[$name]);
      }
      // 新しい値を配列に追加
      $rtn[$name][] = $val;
    }
  }

  if ($del_null_byte) {
    $rtn = jDelNullbyte($rtn);
  }

  return $rtn;
}

function jDelNullbyte($data) {
    if (is_array($data)) {
        return array_map('jDelNullbyte', $data);
    }

    return str_replace("\0", '', $data);
}


function json_safe_encode($data){
    return json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
}

function sanitize($before)
{
	foreach($before as $key=>$value)
	{
		$after[$key]=htmlspecialchars($value);
	}
	return $after;
}

function pulldown_year()
{
	print'<select name="year">';
	print'<option value="2013">2013</option>';
	print'<option value="2014">2014</option>';
	print'<option value="2015">2015</option>';
	print'<option value="2016">2016</option>';
	print'</select>';
}

function pulldown_month()
{
	print'<select name="month">';
	print'<option value="01">01</option>';
	print'<option value="02">02</option>';
	print'<option value="03">03</option>';
	print'<option value="04">04</option>';
	print'<option value="05">05</option>';
	print'<option value="06">06</option>';
	print'<option value="07">07</option>';
	print'<option value="08">08</option>';
	print'<option value="09">09</option>';
	print'<option value="10">10</option>';
	print'<option value="11">11</option>';
	print'<option value="12">12</option>';
	print'</select>';
}

function pulldown_day()
{
	print'<select name="day">';
	print'<option value="01">01</option>';
	print'<option value="02">02</option>';
	print'<option value="03">03</option>';
	print'<option value="04">04</option>';
	print'<option value="05">05</option>';
	print'<option value="06">06</option>';
	print'<option value="07">07</option>';
	print'<option value="08">08</option>';
	print'<option value="09">09</option>';
	print'<option value="10">10</option>';
	print'<option value="11">11</option>';
	print'<option value="12">12</option>';
	print'<option value="13">13</option>';
	print'<option value="14">14</option>';
	print'<option value="15">15</option>';
	print'<option value="16">16</option>';
	print'<option value="17">17</option>';
	print'<option value="18">18</option>';
	print'<option value="19">19</option>';
	print'<option value="20">20</option>';
	print'<option value="21">21</option>';
	print'<option value="22">22</option>';
	print'<option value="23">23</option>';
	print'<option value="24">24</option>';
	print'<option value="25">25</option>';
	print'<option value="26">26</option>';
	print'<option value="27">27</option>';
	print'<option value="28">28</option>';
	print'<option value="29">29</option>';
	print'<option value="30">30</option>';
	print'<option value="31">31</option>';
	print'</select>';
}

?>