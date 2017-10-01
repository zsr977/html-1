<?php
namespace app\yibanmobile\controller;

use think\Exception;

class Api
{
    //个人网站入口
    public function index($APPID,$APPSECRET,$CALLBACK)
    {
        $access_token=$this->getAccessToken($APPID, $APPSECRET, $CALLBACK);
        $user_info=$this->getUserInfo($access_token);
        return $this->getYbId($user_info);
    }
    
    //获取AccessToken
    public function getAccessToken($APPID,$APPSECRET,$CALLBACK)
    {
        if(isset($_GET["code"])){
            $getTokenApiUrl = "https://oauth.yiban.cn/token/info?code=".$_GET['code']."&client_id={$APPID}&client_secret={$APPSECRET}&redirect_uri={$CALLBACK}";
            $res = sendRequest($getTokenApiUrl);
            if(!$res){
                throw new Exception('Get Token Error');
            }
            $userTokenInfo = json_decode($res);
            $access_token = $userTokenInfo["access_token"];
        }else{
            $postStr = pack("H*", $_GET["verify_request"]);
            if(strlen($APPID) == '16') {
                $postInfo = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $APPSECRET, $postStr, MCRYPT_MODE_CBC, $APPID);
            }else {
                $postInfo = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $APPSECRET, $postStr, MCRYPT_MODE_CBC, $APPID);
            }
            $postInfo = rtrim($postInfo);
            $postArr = json_decode($postInfo, true);
            if(!$postArr['visit_oauth']){
                header("Location: https://openapi.yiban.cn/oauth/authorize?client_id={$APPID}&redirect_uri={$CALLBACK}&display=web");
                die;
            }
            $access_token = $postArr['visit_oauth']['access_token'];
        }
        return $access_token;
    }
    
    //获取易班用户信息
    public function getUserInfo($access_token)
    {
        $uri="https://openapi.yiban.cn/user/me?access_token={$access_token}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Yi OAuth2 v0.1');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        $userInfoJsonStr = curl_exec($ch);
        curl_close($ch);
        $arr=json_decode($userInfoJsonStr);
        return $arr;
    }
    
    //获取易班id
    public function getYbId($user_info)
    {
        $yb_id=$user_info->info->yb_userid;
        return $yb_id;
    }
}
