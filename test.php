<?php
/**
 * Created by PhpStorm.
 * User: Han
 * Date: 2/09/2015
 * Time: 12:07 PM
 */

require("functions.php");

global $user_class;
$name = $user_class->get_user_info_by_email('alicechen0817@gmail.com');
var_dump($name);
//$email = $user_class->send_welcome_email('Chen Xu', 'alicechen0817@gmail.com');
//var_dump($email);
