<div class="title">產生身分證字號
		<a href="id.php?do=exam">身份證字號驗証</a>
</div>
<br />

<div class= "main">
<table>
	<tr><td class="firstline">筆數</td><td class="firstline">身份證字號</td><td class="firstline">性別</td><td class="firstline">戶籍地</td>
		<?php if($debug==1){echo '<td class="firstline">正確性</td>';}?>
	</tr>
<?php
$num = check_input($amount);


for($i=0; $i < $num; $i++){
	?>
	<tr>
	<td>
		<?php
				$id = new_id($city, $gender);
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
?>
	</td>
	<?php
		if($debug==1){
			$check_digit = get_check_digit($id);
			if (($check_digit <> $id[9])||($id=="A100000001")){
				echo '<td id="responsewrong">錯誤</td>';
			}
			else{
				echo '<td id="responseright">正確</td>';
			}
		}
	?>
	</tr>
<?php
}
?>
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
	<form id="sp" method="post" action="id.php?do=create">
	<select name="gender">
		<option value="null" <?php if($gender == "null") {echo 'selected';}?><?php echo gender_query((string)$i);?>>不指定性別</option>
	<?php
		for($i=1;$i<=2;$i++){?>
			<option value="<?php echo $i; ?>" <?php if($gender == (string)$i) {echo 'selected';}?>><?php echo gender_query((string)$i); ?></option>
	<?php }?>
	</select>
	<select name="city">
		<option value="null" <?php if($city == "null") {echo 'selected';}?>>不指定戶籍</option>
	<?php
		for($i=0;$i<26;$i++){?>
			<option value="<?php echo chr($i+65); ?>" <?php if($city ==(chr($i+65))) {echo 'selected';}?> > <?php echo place_query(chr($i+65)); ?></option>
	<?php }
		?>
	</select>
	<span>顯示幾筆資料?(1-1000)</span>
	<input name="amount" type="text" title="輸入數字" value="<?php if($amount) {echo $amount;} else{echo '1';}?>" 
	onfocus="amount.value=''" maxlength = "4" />
	<input type="submit" />
	</form>
	<br />