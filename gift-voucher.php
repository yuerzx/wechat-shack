<?php
/**
 * Created by PhpStorm.
 * User: Han
 * Date: 14/10/2015
 * Time: 2:18 PM
 */

include("functions.php");
get_header("yaoyiyao");

//echo $_GET['gift_id'];
//echo 'Ver:'.substr(md5($_GET['from']."oneu"),-6);

//var_dump($_GET);

//if(isset($_GET['ver']) && isset($_GET['from']) && !empty($_GET['ver']) &&!empty($_GET['from']) ){
//
//
//
//}else{
//    echo "出错啦~~";
//}

$id = $_GET['gift_id'];

switch($id){
    case 1:
        include "gift-vouncher/page1.php";
        break;
    case 2:
        include "gift-vouncher/page2.php";
        break;
    default:
        include "gift-vouncher/page1.php";
        break;
}