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
//$cookies->destroy_all();

for ($x = 0; $x <= 30; $x++) {
    echo "The number is: ".substr(md5($x."oneu"),-9)." <br>";
}

