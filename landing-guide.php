<?php
/**
 * Created by PhpStorm.
 * User: Han
 * Date: 14/10/2015
 * Time: 1:59 PM
 */

include("functions.php");
require('class/jssdk.php');
global $cookies;

$opp = array(1, 1, 1, 1, 1, 2, 2, 3, 3, 3, 3, 1, 1);
$rand = rand(0, 12);
//get the random page id
$land_page_id = $opp[$rand];
$get = FALSE;

$req_uri = explode('/',$_SERVER["REQUEST_URI"], -1);
$req_uri = implode('/', $req_uri);


if(isset($_GET['code']) && isset($_GET['state']) && strlen($_GET['code']) == 32){
    $get = TRUE;
    $code = sanitize_text_field($_GET['code']);
    $state = sanitize_text_field($_GET['state']);
}

if(!empty($_COOKIE['openid'])){
    //if we are already get all the information, then time to retrive from database
    $user_info = new stdClass();
    $user_info-> nickname   = $_COOKIE['nickname'];
    $user_info-> user_id    = $_COOKIE['user_id'];
    $user_info-> openid     = $_COOKIE['openid'];
    $user_info-> country    = $_COOKIE['country'];
    $user_info-> city       = $_COOKIE['city'];
    $user_info-> headimgurl = $_COOKIE['headimgurl'];
    $string = $user_info->nickname.$user_info->nickname.$user_info->openid.$user_info->city.$user_info->country.$user_info->headimgurl;
    $ver_code = substr(md5($string),0,-9);
    if($ver_code != $_COOKIE['ver_code_user_data']){
        //if the cookies has been modified by user
        //we use blank information instead
        $user_info-> nickname   = "万友澳洲 测试账号";
        $user_info-> user_id    = 1;
        $user_info-> openid     = "00";
        $user_info-> country    = "澳大利亚";
        $user_info-> city       = "墨尔本";
        $user_info-> headimgurl = "https://oneu.me/wp-content/themes/OneUni/images/common/logo-withwords.png";
    }
}elseif($get && empty($_COOKIE['openid'])){
    //if customers are new, then we are ready for next step.
    $jssdk = new JSSDK("wx2d39a6c422ad663c", "e339b975f47c4a16b2b4b41f10fb5ef1");
    $user_info = $jssdk->getPageUserInfo($code);
    if(!empty($user_info->openid)){
        // if successfully get the user information, then we are able to process.
        $cookies->set("nickname",   $user_info->nickname,15,"days");
        $cookies->set('user_id',    $user_info->nickname,15,"days" );
        $cookies->set('openid',     $user_info->openid,15,"days" );
        $cookies->set('city',       $user_info->city,15,"days" );
        $cookies->set('country',    $user_info->country,15,"days" );
        $cookies->set('headimgurl', $user_info->headimgurl,15,"days" );
        $string = $user_info->nickname.$user_info->nickname.$user_info->openid.$user_info->city.$user_info->country.$user_info->headimgurl;
        $ver_code = substr(md5($string),0,-9);
        $cookies->set('ver_code_user_data', $ver_code, 15, "days");
    }else{
        //relocated to the login page, to get code again.
    }
}else{
    //without get and without the session, logout
    $user_info = new stdClass();
    $user_info-> nickname   = "万友澳洲 测试账号";
    $user_info-> user_id    = 1;
    $user_info-> openid     = "00";
    $user_info-> country    = "澳大利亚";
    $user_info-> city       = "墨尔本";
    $user_info-> headimgurl = "https://oneu.me/wp-content/themes/OneUni/images/common/logo-withwords.png";
}


$from_user = $user_info->nickname;
$time = system_time();
$ver_code = substr(md5($land_page_id.$user_info->nickname.$time."oneu"),-7);
$url = "http://".$_SERVER["HTTP_HOST"] . $req_uri."/gift-voucher.php?gift_id=".$land_page_id."&ver=".$ver_code."&from_user=".$from_user."&t=".$time;
wp_redirect( $url);
exit;


