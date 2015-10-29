<?php
/**
 * Created by PhpStorm.
 * User: Han
 * Date: 23/06/2015
 * Time: 10:38 AM
 */
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){ //windows is \ unix is /
    $adds = explode("\\", __FILE__, -3);
    $adds = implode("\\", $adds).'\\';
    $sessionPath = __DIR__.'\tmp';
}else{
    $adds = explode("/", __FILE__, -3);
    $adds = implode("/", $adds).'/';
    $sessionPath = __DIR__.'/tmp';
}
require ($adds.'wp-config.php');
require "class/user_class.php";
require_once 'class/PHPMailerAutoload.php';
require_once "class/class.CookiesManager.php";
global $cookies;
$cookies = New CookiesManager();

global $wpdb;
$table_wechat_user = $wpdb->prefix.'oneuni_wechat_database';
global $table_wechat_user;
$table_wechat_giftcard = $wpdb->prefix.'oneuni_wechat_giftcard';
global $table_wechat_giftcard;
global $user_class;

$user_class = new Game_Class();

function system_time(){
    list($usec, $sec) = explode(" ", microtime());
    return $sec;
}

function code_check($code, $length){
    return substr(md5($code."oneu"),0,$length);
}
