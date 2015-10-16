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

if (isset($_GET['ver']) && isset($_GET['from_user']) && !empty($_GET['ver']) && !empty($_GET['from_user']) &&!empty($_GET['t'])) {
    $time = intval($_GET['t']);
    $ver_code = substr(md5($_GET['gift_id'].$_GET['from_user'] .$time. "oneu"), -7);
    if ( $ver_code == $_GET['ver']) {
        //sucess
        $id = intval($_GET['gift_id']);
        $tmr_time = $time + 24*60*60;
        $week2_time = $time + 24*60*60*7*2;

        //include the separated parts for inner page
        //todo: Add forward message
        ?>
        <header class="page-header" style="margin:0;">
            <h1 class="page-title text-center"><img src="img/header.png" style="max-width: 60%"></h1>
        </header>
        <div class="row text-center">
            <div class="col-md-12">
                <h3 style="font-weight: bold;"><?= $_GET['from_user'] ?> 获得</h3>
            </div>
        </div>
        <?php
        switch ($id) {
            case 1:
                include "gift-vouncher/page1.php";
                break;
            case 2:
                include "gift-vouncher/page2.php";
                break;
            case 3:
                include "gift-vouncher/page3.php";
                break;
            default:
                include "gift-vouncher/page1.php";
                break;
        }
        //end of row sections
        ?>

        <?php

        }else{

        var_dump($ver_code);
        err_report();
        }
    } else {
        //var_dump(substr(md5($_GET['from'] . "oneu"), -6));
        err_report();
    }


function err_report(){
    ?>
    <div class="col-md-12 text-center">
        <h2>出错啦~~</h2><br>
        <h3><a href='wechat-landing.php'>点击返回活动页面</h3>
    </div>

<?php
}