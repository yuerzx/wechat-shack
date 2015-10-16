<?php
/**
 * Created by PhpStorm.
 * User: Han
 * Date: 14/10/2015
 * Time: 1:59 PM
 */

include("functions.php");
require('class/jssdk.php');

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

if(!empty($_SESSION['openid'])){
    //if we are already get all the information, then time to retrive from database
    $user_info = new stdClass();
    $user_info-> nickname   = $_SESSION['nickname'];
    $user_info-> user_id    = $_SESSION['user_id'];
    $user_info-> openid     = $_SESSION['openid'];
    $user_info-> country    = $_SESSION['country'];
    $user_info-> city       = $_SESSION['city'];
    $user_info-> headimgurl = $_SESSION['headimgurl'];
}elseif($get && empty($_SESSION['openid'])){
    //if customers are new, then we are ready for next step.
    $jssdk = new JSSDK("wx2d39a6c422ad663c", "e339b975f47c4a16b2b4b41f10fb5ef1");
    $user_info = $jssdk->getPageUserInfo($code);
    if(!empty($user_info->openid)){
        // if successfully get the user information, then we are able to process.
        $_SESSION['nickname']   = $user_info->nickname;
        $_SESSION['user_id']    = $user_info->user_id;
        $_SESSION['openid']     = $user_info->openid;
        $_SESSION['city']       = $user_info->city;
        $_SESSION['country']    = $user_info->country;
        $_SESSION['headimgurl'] = $user_info-> headimgurl;
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


