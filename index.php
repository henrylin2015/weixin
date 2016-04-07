<?php 
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);
include "./WeChat.class.php";
/**
//判断某个php函数是否支持
$f = trim($_GET['f']);
if (function_exists($f)) {
    echo "<b>支持<b>".$f."函数<br>";
} else {
    echo "<b>不支持<b>".$f."函数"."<br>";
}
echo "time".mt_rand(1, time())."<br>";
*/
$weChat = new  WeChat("wx5da47318d62796fa","81b21cf819fe6d0fd3491ae020ac3a34","");
//echo $weChat->_request("https://www.baidu.com/");
//echo $weChat->_getAccessToken();
$data = '{
     "button":[
     {	
          "type":"click",
          "name":"今日歌曲",
          "key":"V1001_TODAY_MUSIC"
      },
      {
           "name":"菜单",
           "sub_button":[
           {	
               "type":"view",
               "name":"搜索",
               "url":"http://www.soso.com/"
            },
            {
               "type":"view",
               "name":"视频",
               "url":"http://v.qq.com/"
            },
            {
               "type":"click",
               "name":"赞一下我们",
               "key":"V1001_GOOD"
            }]
       }]
 }';
 echo $weChat->_createMenu($data);