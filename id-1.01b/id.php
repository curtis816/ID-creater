<?php
####################################
#
#	身份証字號產生器
#	by: Curtis Chen
#
####################################
/*
	2007/6/02	修改為 Linux coding style
				刪除不必要的程式碼及註解
	1.01 beta:
	2007/5/14	新增檢查使用者輸入的身分証字號的正確性
	2007/5/12	將函式及 CSS 檔案分開儲存
	2007/5/11	晚上: 驗証輸出數欄位的正確性
				修正輸出的版面配置
	1.0 beta:
	2007/5/11	早上: 開始動工，寫產生部分
				下午: 輸出部分完成
*/

####################################
#	全域變數
####################################
$ver	= '1.01 beta';	//本程式版本
$time1	= microtime();
$do		= $_GET['do'];	//導向頁面
$idnum	= $_POST['idnum'];//身分証字號
$num	= $_GET['num'];

include "id.inc.php";	//須用到的函式
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>身份証字號產生及驗証</title>
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
if ($do == 'create'){
		?>
<div class="title">自動產生身份証字號列表
<span onmouseover="this.style.cursor= 'pointer'" onclick="window.location.reload()" title="如果您希望能得到一份新的列表請點這裡">
　重新整理
</span> 
<a href="id?do=exam">身份証字號驗証</a>
</div>

<div class= "main">
<table>
	<tr><td class="firstline">筆數</td><td class="firstline">身份証字號</td><td class="firstline">性別</td><td class="firstline">戶籍地</td></tr>
		<?php
	
	$num = check_input($num);


for($i=0; $i < $num; $i++){
	?>
	<tr>
	<td>
		<?php
			$id = new_id();
			echo '第'.($i+1).'筆';
		?>
	</td>
	<td>
		<?php
			echo $id;
		?>
	</td>	
	<td>
		<?php
			if($id[1] == '1'){
				echo '<span style="color: blue;">男性</span>';
			}
			else{
				echo '<span style="color: red;">女性</span>';
			}
		?>
	</td>
	<td>
		<?php
		echo place_query($id{0});
}
?>
	</td>
	</tr>
</table>
</div>
<div class="spendtime">
<?php
	$time2 = microtime();
	if($time2>$time1)
		$spendtime = $time2 - $time1;
	else
		$spendtime = $time1 - $time2;
	echo "顯示{$num}筆資料，共耗時{$spendtime}秒";
?>
</div>
<div class="num">
<form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<span>要顯示幾筆資料?(1-1000)</span>
<input name="num" type="text" title="輸入完按ENTER" value="輸入完按ENTER" 
onfocus="num.value=''" onblur="if(!num.value) num.value='輸入完按ENTER'" maxlength = "4" />
</form>
</div>
<?php
	include "footer.inc.php";
}
elseif($do == 'exam') 
{
	?>
	<div class="title">身份証字號正確性驗証
	<a href="id?do=create">自動產生身分証字號
	</a>
	</div>
	<?php
	if(empty($idnum)){
		include "form.exam.php";
		echo $idnum;
	}
	elseif(!empty($idnum)){
		$check_digit = get_check_digit($idnum);
		if ($check_digit == $idnum[9])
			$response = '此為正確的身分証字號。';
		else
			$response = '此為錯誤的身分証字號。';
		?>
		<div class = "exam">
		<span>您所要檢驗的號碼: </span> <span id="idnum"><?php echo $idnum; ?></span>
		</div>
		<div class = "correct">
			<span>其正確性為: </span>
			<?php
			if ($check_digit == $idnum[9]){?>
				<span id="responseright">
			<?php
			}
			else{?>
				<span id="responsewrong">
				<?php
			}
			echo $response; 
			?>
			</span>
		</div>
		<?php
			include "form.exam.php";

	}
	include "footer.inc.php";
}
else{
	?>
	<script language= "JavaScript">
		document.title = "500 Error";
	</script>
	<?php
	echo '<h1>500 Error</h1><br />';
	die("Please contact the Webmaster for support.");
} 

?>