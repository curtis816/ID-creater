	<div class="title">身份證字號驗証
		<a href="id.php">產生身分證字號</a>
	</div>
	<?php
	if(empty($idnum)){
		include "form.exam.php";
//		echo $idnum;
	}
	elseif(!empty($idnum)){
		$check_digit = get_check_digit($idnum);
		if (($check_digit <> $idnum[9])||($idnum=="A100000001")){
			$response = '此為錯誤的身分証字號。';
			$idtrue = false;
		}
		else{
			$response = '此為正確的身分証字號。';
			$idtrue = true;
		}
		?>
		<div class = "exam">
		<span>您所要檢驗的號碼: </span> <span id="idnum"><?php echo $idnum; ?></span>
		</div>
		<div class = "correct">
			<span>其正確性為: </span>
			<?php
			if ($idtrue == true){?>
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
	?>