<?php
/**
 * Created by PhpStorm.
 * User: Han
 * Date: 2/09/2015
 * Time: 12:07 PM
 */

require("functions.php");
require('class/jssdk.php');

$jssdk = new JSSDK("wx2d39a6c422ad663c", "e339b975f47c4a16b2b4b41f10fb5ef1");

$time = system_time();
$test = $jssdk->get_giftcard_by_id(1);
var_dump($test[0]["time_stamp"]);

