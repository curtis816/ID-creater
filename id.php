<?php
####################################
#
#	身份証字號產生器
#	by: Curtis Chen
#
####################################
/*
	1.2.4:
	2010/12/18		將偷懶的部份修改為正規方式，修正輸出樣式
	1.2.3:
	2008/7/05		加入了檢查所產生的每筆號碼正確性標示
	2008/7/04		修正檢查碼可能為10的潛在性問題
	1.2.2:
	2008/7/02		產生頁面部份程式碼最佳化
					A100000001 列為不正確號碼
					與1.02版本程式碼整合
					將錯誤輸出的部分改了css，看起來像是一般的500錯誤頁面
					不合 Linux coding style的部份再作修正
	1.2.1:
	2007/11/18		切割程式碼至不同檔案，以及細部修正作最佳化
	2007/11/18		修正性別與縣市未指定可能會發生的潛在性問題
	1.2.0:
	2007/11/18		加入使用者可自行選擇欲產生的性別及戶籍地
	2007/6/17		將使用者輸入的資料作處理，避兔惡意攻擊
	2007/6/05		開頭小寫會錯誤的狀況修正
					顯示檢驗結果時一律改為顯示大寫
					顯示幾筆資料的送出部份改成用按鈕
	2007/6/02		修改為 Linux coding style
					刪除不必要的程式碼及註解
	1.01 beta:
	2007/5/14		新增檢查使用者輸入的身分証字號的正確性
	2007/5/12		將函式及 CSS 檔案分開儲存
	2007/5/11		晚上: 驗証輸出數欄位的正確性
					修正輸出的版面配置
	1.0 beta:
	2007/5/11		早上: 開始動工，寫產生部分
					下午: 輸出部分完成
*/

####################################
#	常數
####################################

define("PROG_VERSION",	 '1.2.4');	//本程式版本

####################################
#	全域變數
####################################

$time1	= microtime();
$do		= $_GET['do'];	//導向頁面
$debug	= 1;			//0 is debug-mode off,1 is debug-mode on

//----------------------

include "id.inc.php";	//須用到的函式
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>身份證字號產生及驗証</title>
<link rel="stylesheet" href="main.css" type="text/css" />
</head>
<body>

<?php
if(!empty($idnum)){
	$do = 'exam';
}
if (empty($do)){
	$do = 'create';
}
//產生身分証字號頁面
if($do == 'create'){
	$gender	= ($_POST['gender']);
	if(empty($gender)){$gender = "null";}
	$city	= ($_POST['city']);
	if(empty($city)){$city = "null";}
	$amount	= $_POST['amount'];

	include "create.inc.php";
}
//驗証身分証字號頁面
elseif($do == 'exam') {
	$idnum	= htmlspecialchars(strtoupper($_POST['idnum']));//要檢驗的身分證字號
	include "exam.inc.php";
}
//錯誤頁面
else{
	?>
	<script language= "JavaScript">
		document.title = "500 Error";
	</script>
	<style>
	* {
		margin: 2px;
		padding: 2px;
	}
	body
	{
		width: auto;
		height: auto;
		margin: auto;
		border: 0px;	
	}
	</style>	
	<?php
	echo '<h1>500 Error</h1><br />';
	die('Please contact the Webmaster for support.</body></html>');
} 

include "footer.inc.php";

?>
