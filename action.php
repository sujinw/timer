<?php
$act = isset($_GET['act']) ? $_GET['act'] : "";

if($act == "toView"){
	$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : "";

	$dataFile = "./admin/data/date.md";
	$data = unserialize(file_get_contents($dataFile));
	if($pwd == ""){
		$msg = "密码不能为空";
		$url = "index.php";
	}elseif($pwd != $data['pwd']){
		$msg = "密码错误呢";
		$url = "index.php";
	}else{
		$msg = "恭喜你，密码正确，进入倒计时";
		$url = "view.php";
	}
}elseif($act == 'checkNull'){
	$msg = "还没设置倒计时，快去后台设置吧";
	$url = "./admin/login.php";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		
		*{
			margin:0;
			padding: 0;
		}
		.tips{
			width:260px;
			height:45px;
			line-height: 45px;
			text-align: center;
			border:1px solid #ddd;
			border-radius: 5px;
			position: absolute;
			left:50%;
			top:50%;
			margin-left:-130px;
			margin-top:-22px;
		}
	</style>
</head>
<body>
<div class="tips">
	<p>
		<?php echo $msg ?>
	</p>
	<script type="text/javascript">
		setTimeout(function(){window.location.href="<?php echo $url  ?>";},3000)
	</script>
</div>
</body>
</html>