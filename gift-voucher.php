<?php
/**
 * Created by PhpStorm.
 * User: Han
 * Date: 14/10/2015
 * Time: 2:18 PM
 */

include("functions.php");
require('class/jssdk.php');
get_header("yaoyiyao");

//echo $_GET['gift_id'];
//echo 'Ver:'.substr(md5($_GET['from']."oneu"),-6);

//var_dump($_GET);

if (isset($_GET['ver']) && !empty($_GET['ver'])
    && !empty($_GET['t'])   && isset($_GET['gift_id'])) {
    $time = intval($_GET['t']);
    $gift_id = intval($_GET['gift_id']);
    $ver_code = substr(md5($gift_id.$time. "oneu"), -6);
    if ( $ver_code == $_GET['ver']) {
        //sucess
        $tmr_time = $time + 24*60*60;
        $week2_time = $time + 24*60*60*7*2;
        //todo: get done this part to retive information from database and feedback
        //Join two tables for it
        //include the separated parts for inner page
        ?>
        <div style="display: none"><img src="img/share-img.png"></div>
        <header class="page-header" style="margin:0;">
            <div class="col-md-12">
            <h1 class="page-title text-center"><img src="img/header.png" style="max-width: 60%"></h1>
            </div>
        </header>
        <div class="row text-center">
            <div class="col-md-12">
                <h3 style="font-weight: bold;"><?= $_COOKIE['from_user'] ?> 获得</h3>
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
        get_footer();
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