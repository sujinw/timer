<?php
//缓存数据程序
date_default_timezone_set('PRC');

//接口网址
$apiurl = "http://api.caipiaokong.com/lottery/?name=jlks&format=json&uid=480579&token=655822eeb2ed33db344eac5273f312ce3d3d6e61&num=50";

//缓存文件名
$cachefile = "cache.json";

//缓存文件（最后更新时间）
$filemtime = filemtime($cachefile);

//缓存文件（更新频率设置）
$second = '5';

if ( time() - $filemtime > $second ) {

    //设置参数
    $data = file_get_contents($apiurl);
    file_put_contents("".$cachefile."",$data,LOCK_EX);

}

?>