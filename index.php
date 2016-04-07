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
$weChat = new  WeChat();
echo $weChat->_request("https://www.baidu.com/");