<?php
//產生亂數種子用的，PHP官方網站的範例方式
list($usec, $sec) = explode(' ', microtime());
$value = $sec + ((float) $usec * 100000);
srand($value);
//-------------------------------------------
function get_place_num($first_num)
{
	switch($first_num){
	case 'A':	$first_check = 10;	break;
	case 'B':	$first_check = 11;	break;
	case 'C':	$first_check = 12;	break;
	case 'D':	$first_check = 13;	break;
	case 'E':	$first_check = 14;	break;
	case 'F':	$first_check = 15;	break;
	case 'G':	$first_check = 16;	break;
	case 'H':	$first_check = 17;	break;
	case 'I':	$first_check = 34;	break;
	case 'J':	$first_check = 18;	break;
	case 'K':	$first_check = 19;	break;
	case 'L':	$first_check = 20;	break;
	case 'M':	$first_check = 21;	break;
	case 'N':	$first_check = 22;	break;
	case 'O':	$first_check = 35;	break;
	case 'P':	$first_check = 23;	break;
	case 'Q':	$first_check = 24;	break;
	case 'R':	$first_check = 25;	break;
	case 'S':	$first_check = 26;	break;
	case 'T':	$first_check = 27;	break;
	case 'U':	$first_check = 28;	break;
	case 'V':	$first_check = 29;	break;
	case 'W':$first_check = 32;	break;
	case 'X':	$first_check = 30;	break;
	case 'Y':	$first_check = 31;	break;
	case 'Z':	$first_check = 33;	break;
	}
	return $first_check;
}

//查生檢查碼 (最後一位數字) 函式
function get_check_digit($id)
{
	/*
		A	台北市	10		B	臺中市	11
		C	基隆市	12		D	台南市	13
		E	高雄市	14		F	台北縣	15
		G	宜蘭縣	16		H	桃園縣	17
		I	嘉義市	34		J	新竹縣	18
		K	苗栗縣	19		L	臺中縣	20
		M	南投縣	21		N	彰化縣	22
		O	新竹市	35		P	雲林縣	23
		Q	嘉義縣	24		R	台南縣	25
		S	高雄縣	26		T	屏東縣	27
		U	花蓮縣	28		V	台東縣	29
		W	金門縣	32		X	澎湖縣	30
		Y	陽明山管理局	31
		Z	連江縣	33
		
		公式:
		字母對應左位數 + 字母對應右位數 * 9 + 性別碼 * 8 + 左邊算起（以下皆同）第二位數字 * 7 + 
		第三位數字 * 6 + 第四位數字 * 5 + 第五位數字 * 4 + 第六位數字 * 3 + 第七位數字 * 2 + 第八位數字 * 1
		10減上述公式結果的個位數就是檢查號碼。
	
	*/
	$first_num = $id[0];
	
	$place_num = get_place_num($first_num);
	$sum = (int)($place_num / 10 ) ;
	$sum += ($place_num % 10) * 9;
	for($i = 8,$j = 1;$j< 9;$j++,$i--){
		$sum += (int)($id[$j]) * $i;
	}
	
	$last_digit = (string)((10 - ($sum % 10))%10);
	//$last_digit = (string)(10 - ($sum % 10)); //7/05發現有bug的算式，已更正
	return $last_digit;
}

function place_query($tmp)
{
	if(empty($tmp)){
		return 'empty';
	}
	switch($tmp){
	case 'A':case 'a':	$place='台北市';break;
	case 'B':case 'b':	$place='臺中市';break;
	case 'C':case 'c':	$place='基隆市';break;
	case 'D':case 'd':	$place='台南市';break;
	case 'E':case 'e':	$place='高雄市';break;
	case 'F':case 'f':	$place='台北縣';break;
	case 'G':case 'g':	$place='宜蘭縣';break;
	case 'H':case 'h':	$place='桃園縣';break;
	case 'I':case 'i':	$place='嘉義市';break;
	case 'J':case 'j':	$place='新竹縣';break;
	case 'K':case 'k':	$place='苗栗縣';break;
	case 'L':case 'l':	$place='臺中縣';break;
	case 'M':case 'm':	$place='南投縣';break;
	case 'N':case 'n':	$place='彰化縣';break;
	case 'O':case 'o':	$place='新竹市';break;
	case 'P':case 'p':	$place='雲林縣';break;
	case 'Q':case 'q':	$place='嘉義縣';break;
	case 'R':case 'r':	$place='台南縣';break;
	case 'S':case 's':	$place='高雄縣';break;
	case 'T':case 't':	$place='屏東縣';break;
	case 'U':case 'u':	$place='花蓮縣';break;
	case 'V':case 'v':	$place='台東縣';break;
	case 'W':case 'w':	$place='金門縣';break;
	case 'X':case 'x':	$place='澎湖縣';break;
	case 'Y':case 'y':	$place='陽明山管理局';break;
	case 'Z':case 'z':	$place='連江縣';break;
	default:	return false;
	}

	return $place;
}

function gender_query($gender)
{
	if(empty($gender)){
		return 'empty';
	}
	switch($gender){
	case '1':	$tmp = '男性';break;
	case '2':	$tmp = '女性';break;
	default:	return false;
	}

	return $tmp;
}

function check_input($num)
{
	if(!isset($num)){
		$num = 1;
	}
	if(!is_numeric($num)){
		$num = 1;
		echo '<span style="color: red;">錯誤 : 必須輸入數字，已自動更正為最小顯示數</span>';
		return $num;
	}
	if($num < 1){
		$num = 1;
		echo '<span style="color: red;">錯誤 : 最小顯示為1筆，已自動更正為最小顯示數</span>';
		return $num;
	}
	if($num > 1000){
		$num = 1000;
		echo '<span style="color: red;">錯誤 :　最大顯示為1000筆，已自動更正為最大顯示數</span>';
		return $num;
	}
	return $num;
}

function new_id($city, $gender)
{
	if($city == "null"){
		$id = chr((rand() % 26)+65);
	}
	else{
		$id = $city;
	}
	
	if($gender == "null"){
		$id	.= (string)(rand()%2)+1;
	}
	else{
		$id	.= $gender;
	}
	for($i = 2;$i< 9;$i++){
		$id[$i] = (string)(rand() % 10);
	}

	$id[9]	= get_check_digit($id);
	return $id;
}
?>