<?php
/**
 * Created by PhpStorm.
 * User: Han
 * Date: 14/10/2015
 * Time: 1:59 PM
 */

include("functions.php");
require('class/jssdk.php');

$opp = array(1, 2, 5, 1, 2, 2, 3, 3, 3, 3, 4, 5, 6);
$rand = rand(0, 12);
//get the random page id
$land_page_id = $opp[$rand];

$req_uri = explode('/',$_SERVER["REQUEST_URI"], -1);
$req_uri = implode('/', $req_uri);


if(isset($_GET['code']) && isset($_GET['state']) && strlen($_GET['code']) == 32){
    $get = TRUE;
    $code = sanitize_text_field($_GET['code']);
    $state = sanitize_text_field($_GET['state']);
    $jssdk = new JSSDK("wx2d39a6c422ad663c", "e339b975f47c4a16b2b4b41f10fb5ef1");
    $user_info = $jssdk->getPageUserInfo($code);
    $ver_code = substr(md5($user_info->nickname."oneu"),-6);
    $from_user = $user_info->nickname;
    $url = "http://".$_SERVER["HTTP_HOST"] . $req_uri."/gift-voucher.php?gift_id=".$land_page_id."&ver=".$ver_code."&from=".$from_user;
    wp_redirect( $url);
    exit;
}else{

}





var_dump($user_info);

//for testing purpose
var_dump($url);

//wp_redirect( $url);
//exit;

