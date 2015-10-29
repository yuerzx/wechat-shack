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
            $table_wechat_giftcard.gift_status,
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
        <div class="row">
            <div class="col-md-12 text-center" id="poster-header" style="padding-bottom: 10px;">
                <img src="img/poster.jpg" style="max-width: 95%;">
                <hr>
            </div>
        </div>
        <img src="img/header.png" style="max-width: 99%;">
        <div class="row text-center">
            <div class="col-md-12">
                <h3 style="font-weight: bold;"><?php echo $user_information[0]['nickname']; ?> 获得</h3>
            </div>
        </div>
        <?php
        switch ($user_information[0]['gift_type']) {
            case 1:
                $gift = "5yuan";
                break;
            case 2:
                $gift = "10yuan";
                break;
            case 3:
                $gift = "caomao";
                break;
            case 4:
                $gift = "congyoubing";
                break;
            case 5:
                $gift = "suanmeitang";
                break;
            case 6:
                $gift = "wanzi";
                break;
            default:
                $gift = "5yuan";
                break;
        }
        $gift_img = "gift-".$gift;
        //end of row sections
        ?>
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="img/<?= $gift_img ?>.png">
            </div>
        </div>
        <div class="row">
        <div class="col-md-12">
            <img src="img/use-introduction.png" style="max-width: 25%;padding-top: 20px;">
            <ul style="text-align: left">
                <li>将此页面分享到朋友圈，并且集齐5个赞或者评论，即可以使用</li>
                <li>每桌仅限1张</li>
                <li>有效期: 自 <?= date("D jS M",$tmr_time); ?> 至 <?= date("D jS M",$week2_time); ?></li>
                <li>如果需要保存此代金券，请将代金券分享到朋友圈或者保存链接。</li>
            </ul>
        </div>
    </div>
        <?php
        $current_time = system_time();
        $gift_status = 'new';
        if($user_information[0]['gift_status'] == 1){
            $gift_status = 'used';
        }elseif($current_time < $tmr_time || $current_time > $week2_time){
            $gift_status = 'expired';
        }else{
            $gift_status = 'new';
        }

        if( isset($_COOKIE['user_id']) && $_COOKIE['user_id'] == $user_information[0]['user_id'] ){
            //show claim button
            ?>
            <div class="row">
                <div class="col-md-12">

                    <button type="button"
                            class="btn <?php if($gift_status != 'new'){echo "btn-danger";}else{echo "btn-warning";}?> btn-lg btn-block"
                            data-toggle="modal"
                            data-target=".bs-example-modal-lg"
                            <?php if($gift_status != 'new'){echo "disabled";} ?>
                        id="start-claim">
                        <?php
                            if($gift_status == 'used'){
                                echo "礼券已经被使用";
                            }elseif($gift_status == 'expired'){
                                echo "礼券不在有效期中！";
                            }else{
                                echo "使用折扣券";
                            }
                        ?>

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
                            class="btn btn-danger btn-lg btn-block"
                            id="claim-vouncher">
                            确认使用
                            </button>
                        </div>
                     </div>

                </div>
            </div>
        </div></div>


            <?php
        }else{
            ?>
            <div class="row">
                <div class="col-md-12 text-center" style="display: none;" id="poster" style="padding-bottom: 10px;">
                    <img src="img/poster.jpg" style="max-width: 95%;">
                </div>
                <div class="col-md-12" style="padding-top: 20px;">
                    <button type="button"
                            class="btn btn-warning btn-lg btn-block"
                            id="events-detail">
                        活动详情
                    </button>
                </div>

            </div>
            <?php
        }
        ?>
        <!--        Start Update Info   -->
        <script>
        jQuery(document).ready(function($){
            $('#events-detail').click(function(){
                $('#poster').toggle(3000);
            });
        });

        jQuery(document).ready(function(){
            setTimeout(function(){
                jQuery('#poster-header').fadeOut(1500);
            }, 8000);
        });
        jQuery(document).ready(function($){
            $('#claim-vouncher').click(function(){
                $.ajax({
                    url:"wp-ajax/ajax-update-status.php",
                    data: {
                        "gift_id"   : <?= $gift_id?>,
                        "ver"       :"<?= code_check($gift_id,6);?>"
                    },
                    method: "POST",
                    dataType: 'json'
                }).done(function(data){
                    if(data['status'] == 'ok'){
                        alert("恭喜，使用成功");
                        location.reload();
                    }else{
                        alert("使用失败，请刷新后重试！");
                    }
                    console.log(data);
                    }
                );
            });
        });
        </script>
        <!--        End Update Info     -->
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