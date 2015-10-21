<?php
/**
 * Created by PhpStorm.
 * User: Han
 * Date: 2/09/2015
 * Time: 12:07 PM
 */

require("functions.php");
require('class/jssdk.php');

$cookies = new CookiesManager();
//var_dump($_COOKIE);


$string = $_COOKIE['user_id'].$_COOKIE['nickname'];
var_dump($string);
$ver_code = substr(md5($string),-9);
echo "<hr>";
var_dump($ver_code);
echo "<hr>";
var_dump($_COOKIE['ver_code_user_data']);