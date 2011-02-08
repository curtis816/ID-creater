		<br /><div>
		<form method="post" action="id.php?do=exam" id="examform">
			請輸入要驗証的身分証字號: <input type="text" name="idnum" maxlength="10" value="<?php if (!empty($idnum)) echo $idnum;?>"  onfocus="idnum.value=''" />
			<input type="submit" />
		</form>
		</div>
		<br />