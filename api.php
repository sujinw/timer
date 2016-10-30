<?php
error_reporting(E_ALL ^ E_NOTICE); 
date_default_timezone_set('PRC');


//设置缓存文件
$cache_url = "data.txt";

//缓存文件（最后更新时间）
if(file_exists($cache_url)){
    $filemtime = filemtime($cache_url);
}else{
    $filemtime = 0;
}

//缓存文件（更新频率设置）
$second = '10';

if ( time() - $filemtime > $second ) {

    //设置参数
    $data = file_get_contents("http://api.caipiaokong.com/lottery/?name=jlks&format=json&uid=480579&token=655822eeb2ed33db344eac5273f312ce3d3d6e61&num=50");

    //$data缓存
    $array = json_decode($data,true);

    if(is_array($array)) {

        file_put_contents($cache_url,$data,LOCK_EX);
    }

}else{
    //读取缓存
    $data = file_get_contents($cache_url);

    $array = json_decode($data,true);
}
    $d = array();
    foreach ($array as $key => $value) {
        $d[] = array(
            $key => $value
            ); 
    }
  
echo json_encode($d);

?>