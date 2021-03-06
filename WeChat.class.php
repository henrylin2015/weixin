<?php 
//define your token 
define('TOKEN','open');
class WeChat {
    private $_appid;
    private $_appsecret;
    private $_token;
    public function __construct($appid,$appsecret){
        $this->_appid = $appid;
        $this->_appsecret = $appsecret;
    }
    public function _request($curl, $https = true, $method = 'GET', $data = null) {
        $ch = curl_init();
        //set url 
        curl_setopt($ch, CURLOPT_URL, $curl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //return transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        //POST
        if ($method == "POST") {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        //return string 
        $output = curl_exec($ch);
        //close 
        curl_close($ch);
        return $output;
    }
    /***
    * @description:获取token
    * @auther:henry
    * @create:2016年04月07日16:49:07
    * @return:token
    */
    public function _getAccessToken(){
        $file = "./AccessToken";
        if(file_exists($file)){
            $content = json_decode(file_get_contents($file));
            if(time()- filemtime($file) < $content->expires_in){
                return $content->access_token;
            }
        }
        $curl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s";
        $curl = sprintf($curl,$this->_appid,$this->_appsecret);
        $content = $this->_request($curl);
        file_put_contents($file,$content);
        $content = json_decode($content);
        return $content->access_token;
    }
    /***
    * @description:创建菜单
    * @auther:henry
    * @create:2016年04月07日16:49:07
    * @return:menu
    */
    public function _createMenu($data){
        $this->_token = $this->_getAccessToken();
        $curl = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=%s";
        $curl = sprintf($curl,$this->_token);
        $content = $this->_request($curl,true,'POST',$data);
        return $content;
    }
    /**
    * @description:用户验证的方法(这个方法在验证token的时候使用)
    * @author:henry
    * @create:2016年04月08日10:55:42
    * @return:false/true
    */
    public function valid(){
        $echoStr = $_GET['echoStr'];
        //valid signature,option 
        if($this->checkSignature()){
            echo $echoStr;
            exit();
        }
    }
    /**
    * @description:用户验证的方法(这个方法在验证token的时候使用)
    * @author:henry
    * @create:2016年04月08日10:55:42
    * @return:false/true
    */
    public function checkSignature(){
        //you must define TOKEN by yourself
        if(!defined("TOKEN")){
            throw new Exception("TOKEN is not defined!");
        }
        $signature = $_GET['signature'];
        $timestamp = $_GET['timestamp'];
        $nonce = $_GET['nonce'];
        $token = TOKEN;
        $tmpArr = array($token,$timestamp,$nonce);
        //use SORT_STRING rule
        sort($tmpArr,SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if($tmpStr == $signature){
            return true;
        }else{
            return false;
        }
    }
}