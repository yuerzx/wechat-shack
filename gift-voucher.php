<?php
/**
 * Created by PhpStorm.
 * User: Han
 * Date: 14/10/2015
 * Time: 2:18 PM
 */

include("functions.php");
get_header("yaoyiyao");
global $wpdb;
global $table_wechat_giftcard;
global $table_wechat_user;
$user_information = [];

//echo $_GET['gift_id'];
//echo 'Ver:'.substr(md5($_GET['from']."oneu"),-6);

//var_dump($_GET);

if (isset($_GET['ver']) && !empty($_GET['ver'])
    && !empty($_GET['t'])   && isset($_GET['gift_id'])) {
    $time = intval($_GET['t']);
    $gift_id = intval($_GET['gift_id']);
    $ver_code = substr(md5($gift_id.$time. "oneu"),-6);
    if ( $ver_code == $_GET['ver']) {
        //sucess
        $id = intval($_GET['gift_id']);
        $tmr_time = $time + 24*60*60;
        $week2_time = $time + 24*60*60*7*2;

        $mysql = $wpdb->prepare( "
            SELECT
            $table_wechat_user.openid,
            $table_wechat_user.user_id,
            $table_wechat_giftcard.gift_type,
            $table_wechat_giftcard.time_stamp,
            $table_wechat_user.nickname
            FROM $table_wechat_giftcard
            JOIN $table_wechat_user ON $table_wechat_giftcard.wechat_user_id = $table_wechat_user.user_id
            WHERE $table_wechat_giftcard.gift_id = %d
            LIMIT 1
        ", $id );

        $user_information = $wpdb->get_results(
            $mysql, ARRAY_A
        );

        if(empty($user_information)){
            $user_information[0]['nickname'] = "万友澳洲";
            $user_information[0]['user_id']  = 1;
        }
        if(!isset($user_information[0]['nickname']) || empty($user_information[0]['nickname'])){
            $user_information[0]['nickname'] = "无名大侠";
        }

        //include the separated parts for inner page
        ?>
        <script src="js/jquery.countdown.min.js"></script>
        <div style="display: none"><img src="img/share-img.png"></div>
        <header class="page-header" style="margin:0;">
            <div class="col-md-12">
            <h1 class="page-title text-center"><img src="img/header.png" style="max-width: 60%;margin-top: -40px;"></h1>
            </div>
        </header>
        <div class="row text-center">
            <div class="col-md-12">
                <h3 style="font-weight: bold;"><?php echo $user_information[0]['nickname']; ?> 获得</h3>
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

        if( isset($_COOKIE['user_id']) && $_COOKIE['user_id'] == $user_information[0]['user_id'] ){
            //show claim button
            ?>
            <div class="row">
                <div class="col-md-12">
                    <button type="button"
                            class="btn btn-warning btn-lg btn-block"
                            data-toggle="modal"
                            data-target=".bs-example-modal-lg">
                        使用折扣券
                    </button>
                </div>
            </div>
            <div class="row">
            <div class="col-md-12">
                     <div class="alert alert-info text-center" role="alert"><h5>距离下一次摇一摇还有:</h5><div id="getting-started"></div></div>
            </div>
            </div>
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myLargeModalLabel">确认信息</h4>
                    </div>
                    <div class="modal-body">
                    <div class="row text-center">
                     一但点击使用，您的优惠券将会失效。只有No.1餐厅成员确认才有效。
                        <div class="col-md-12">
                            <button type="button"
                            class="btn btn-danger btn-lg btn-block">
                        确认使用
                            </button>
                        </div>
                     </div>

                </div>
            </div>
        </div>
            <?php
        }
        ?>
        <!--        Start countdown code -->
        <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery("#getting-started")
               .countdown(<?= ($time+60*60*8)*1000; ?>, function(event) {
                 jQuery(this).text(
                   event.strftime('%H:%M:%S')
                 );
               });
        }
        );

         </script>


        <?php
        get_footer();
        ?>

        <?php

        }else{

        var_dump("Ver: ".$ver_code);
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