<?php
/**
 * Created by PhpStorm.
 * User: Han
 * Date: 2/09/2015
 * Time: 12:07 PM
 */

require("functions.php");

$current_time = system_time();
echo $current_time."<br>";
$tmr_time = $current_time+24*60*60;
$DateTmr = date("l jS F \@ g:i a",$tmr_time);
$week_time = $current_time+24*60*60*7*2;
$DateNWek = date("l jS F \@ g:i a",$week_time);
echo "Tomorrow ".$DateTmr."<br>";
echo "Next Week".$DateNWek;

