<?php
session_start();
header('Content-type:text/html,charset=utf-8');
if($_SESSION['username'] == ""||$_SESSION['pwd'] == ""){
	header('Location:login.php');
}
$file = "data/date.md";
if(file_exists($file)){
	$data = unserialize(file_get_contents($file));
}else{
	$data = array(
		'pwd' =>
"",
		'date'=>"",
	);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../favicon.ico">

	<title>倒计时设置</title>

	<!-- Bootstrap core CSS -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="../css/signin.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-datetimepicker.min.css">

	<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
	<!--[if lt IE 9]>
	<script src="../../assets/js/ie8-responsive-file-warning.js"></script>
	<![endif]-->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>

	<div class="container">

		<form role="form" action="action.php?act=setDate" method="post">
			<div class="form-group">
				<label for="exampleInputEmail1">前台访问密码</label>
				<input type="text" name="viewpwd" class="form-control" id="exampleInputEmail1" placeholder="<?php 
					if($data['pwd'] == ''){ 
						echo '访问密码';
					}else{
						echo $data['pwd'];
					}
					?>" required=""></div>
			<h2>倒计时设置</h2>
			<div class="form-group">
				<label for="datetimepicker">开始时间</label>
				<input type="text" class="form-control" name="mydate" id="datetimepicker" value="<?php 
					if($data['date'] == ''){
						echo "请选择时间";
					}else{
						echo $data['date'];
					}
				?>" data-date-format="yyyy-mm-dd hh:ii:ss" required=""></div>
			<div class="form-group">
				<label for="datetimepicker">间隔时间设置</label>
				<input type="num" class="form-control" name="gdata" value="" required="" placeholder="单位为分钟"></div>
			<div class="form-group">
				<button type="submit" class="btn btn-default">提  交</button>
			</div>
		</form>

		<div class="content-bottom">
			<ul>
				<li>
					<a href="../index.php">返回首页</a>
					|
				</li>
				<li>
					<a href="action.php?act=loginout">退出登录</a>
				</li>
			</ul>
		</div>
	</div>
		<!-- /container -->
		<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
		<script type="text/javascript">
	$('#datetimepicker').datetimepicker({
		language:"zh-CN"
	});
</script>
</body>
	</html>