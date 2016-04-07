<?php 
class WeChat {
    private $_appId;
    private $_appSecret;
    private $_token;
    public function _request($curl, $https = true, $method = 'GET', $data = null) {
        $ch = curl_init();
        //set url 
        curl_setopt($ch, CURLOPT_URL, $curl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //return transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($https) {
            curl_setopt($cH, CURLOPT_SSL_VERIFYHOST, TRUE);
            curl_setopt($cH, CURLOPT_SSL_VERIFYPEER, false);
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
}