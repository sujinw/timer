<?php


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>输入访问密码</title>
	<link rel="stylesheet" type="text/css" href="css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="css/default.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/signin.css">
	<style type="text/css">
		.modal-backdrop.in {
		    filter: alpha(opacity=100);
		    opacity: 1;
		}
		.modal{
			top:20%;
		}
	</style>
</head>
<body>
	<div class="container">

      <form action="action.php?act=toView" class="form-signin" role="form" method="post">
        <h2 class="form-signin-heading">输入密码</h2>
        <input type="password" name="pwd" class="form-control" placeholder="密码" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">确  定</button>
      </form>
    </div>
</body>
</html>