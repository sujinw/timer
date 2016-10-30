<?php
session_start();
$act = isset($_GET['act']) ? $_GET['act'] : "";

if($act == 'login'){
	$username = isset($_POST['username']) ? $_POST['username'] : "";
	$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : "";

	$dataText = file_get_contents('data/loginuser.md');
	$dataArr = explode('||',$dataText);
	$dataUsername = $dataArr[0];
	$dataPwd = $dataArr[1];
	//print_r($dataArr);
 
	if($username == "" || $pwd == ""){
		$msg = "用户名或者密码不能为空";
		$url = "login.php";
	}elseif($username != $dataUsername || $dataPwd != md5($pwd,false)){
		$msg = "用户名或者密码错误";
		$url = "login.php";
	}else{
		$_SESSION['username'] = $dataUsername;
		$_SESSION['pwd'] = $dataPwd;
		$msg = "登录成功！";
		$url = "index.php";
	}
}elseif($act == 'setDate'){
	$mypwd = isset($_POST['viewpwd']) ? $_POST['viewpwd'] : "";
	$myDate = isset($_POST['mydate']) ? $_POST['mydate'] : "";
	$gdata = isset($_POST['gdata']) ? $_POST['gdata'] : "";
	$dataFile = "data/date.md";
	if( $mypwd == ""){
		$msg = "密码不能为空";
		$url = "index.php";
	}elseif($myDate == ""){
		$msg = "日期不能为空";
		$url = "index.php";
	}elseif($gdata == ""){
		$msg = "间隔时间不能为空";
		$url = "index.php";
	}else{
		$arr = array(
			'pwd'=>$mypwd,
			'date'=>$myDate,
			'gdate'=>$gdata
		);
		$data = serialize($arr);
		if(file_put_contents($dataFile,$data)){
			$msg = "设置成功，返回前台查看效果吧！";
			$url = "index.php";
		}


	}
}elseif($act == "loginout"){
	$_SESSION['username'] = "";
	$_SESSION['pwd'] = "";

	$msg = "退出成功咯";
	$url = "login.php";
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