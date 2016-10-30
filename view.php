<?php
	header('Content-type:text/html,charset=utf-8');
	$dataFile = "./admin/data/date.md";
	$data = unserialize(file_get_contents($dataFile));
	$date = $data['date'];
	
	//print_r($data);
	//echo $data['gdate'];
	if($date == ""){
		header('Location:action.php?act=checkNull');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>	
	<title>倒计数器</title>
	<link rel="stylesheet" type="text/css" href="css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="css/default.css">
	<style type="text/css">
	*{
		margin:0;
		padding: 0;
	}
	ul,li{
		list-style:none;
	}
		.kaijiang{
			height:125px;
			width:94%;
			margin:10px auto;
			border:1px solid #ddd;
			border-radius: 8px;
			position: relative;
		}
		#order{
			text-align: center;
			height:24px;
			line-height: 24px;
		}
		#orderNum{
			height:60px;
			line-height: 60px;
			text-align: center;
		}
		#orderNum span{
			display: inline-block;
			margin-left:10px;
			width:40px;
			height:40px;
			line-height: 40px;
			border:1px solid #ddd;
			border-radius: 50%;
		}
		.timer{
			position: absolute;
			right:10px;
			bottom:10px;
		}
		.timer b{
			color:#0f0;
			font-weight: bold;
		}
		.order-list{
			width:100%;
		}
		.order-list .table-header{
			background: #dedede;
			height:40px;
			line-height: 40px;
		}
		.order-list span{
			display: inline-block;
			height:100%;
			text-align: center;
		}
		.order-list li{
			clear: both;
			float:none;
			height:34px;
			line-height: 34px;
			border-bottom:1px dashed #ddd;
			width:100%;
		}
		.s1{
			width:25%;
		}
		.s2{
			width:45%;
		}
		.s3{
			width:25%;
		}
	</style>
</head>
<body>
	<div class="mainPage">
		<div class="kaijiang">
			<div id="order"><span></span>期开奖的号码</div>
			<div id="orderNum">
				<span>3</span>
				<span>5</span>
				<span>6</span>
			</div>
			<div class="timer">
				<div id="toNext">距离下一起开奖<b><?php echo $data['gdate'] ?>:00</b></div>
			</div>
		</div>
		<div class="order-list">
			<div class="table-header">
				<span class="s3">期数</span>
				<span class="s1">开奖号码</span>
				<span class="s2">开奖日期</span>
			</div>
			<ul>
				
			</ul>
		</div>

	</div>
	<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript">
		function getList(){

			$.ajax({
				url:"api.php",
				type:"get",
				dataType:"JSON",
				success:function(data){
					var html = "";

					for(var n in data[0]){
						$("#order > span").text(n);
						var num = data[0][n]['number'].split(',');
						$("#orderNum > span").each(function(index,ele){
							$(ele).text(num[index]);
						});
					}


					for(var i=1;i<data.length;i++){
						for(var k in data[i]){
							html += '<li><span class="s3">'+k+'</span><span class="s1">'+data[i][k]['number']+'</span><span class="s2">'+data[i][k]['dateline']+'</span></li>';
						}
					}
					$(".order-list ul").append(html);
				},
				error:function(){
					alert("获取列表数据失败了");
				}
			});
		}
		var gDate
		var speed;
		var min;
		var second;
		var timer = null;
		function setDownTime(){
			var beginTime = "<?php echo $date?>";
			
			var now = new Date();
			
			console.log(new Date(beginTime).getTime())
			if(new Date(beginTime)*1 <= now*1){
				//小于等于当前开始
				//alert(1)
				gDate = <?php echo $data['gdate'];?>*60;
				speed = 1000;
				min = Math.floor(gDate / 60);
				second = gDate - min*60;
				timer = setInterval(function(){
					countDown()
				},1000);

			}/*else if(new Date(beginTime)*1 < now*1){
				gDate = ((now*1 - new Date(beginTime)*1) % <?php echo $data['gdate']?>)/(1000);
				min = Math.floor(gDate / 60);
				second = gDate - min*60;
				timer = setInterval(function(){
					countDown()
				},1000);
			}*/else{
				//还没到开始时间
			}
		}
		function countDown(){
			
            

            if(second <= 0){
            	min=min-1;
            	second = 60;
            }
            second --;
            console.log(second+"==="+min);

            if(second == 0 && min == 0){
            	min=Math.floor(gDate / 60);
            	second = gDate - min*60;
            }

            var txt = min +":"+((second < 10) ? "0" + second : second);

            $("#toNext > b").text(txt);
            
		}
		$(window).ready(function(){
			getList();
			setDownTime();
		});
	</script>
</body>
</html>