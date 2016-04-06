<?php 
class WeChar {
    private $_appId;
    private $_appSecret;
    private $_token;
    public function _request($curl, $https = "", $method = 'GET', $data = null) {
        $ch = curl_init();
        //set url 
        curl_setopt($ch, CURLOPT_URL, $curl);
        //return transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //POST
        if ($method == "POST") {
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        }
        //return string 
        $output = curl_exec($ch);
        //close 
        curl_close($ch);
        return $output;
    }
}