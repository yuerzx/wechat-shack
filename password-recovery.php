<?php
require("functions.php");
global $wpdb;
global $table_school;
global $user_class;
get_header("referral");

$str = $_GET;
$noget = TRUE;
if(isset($str['sEmail']) && !empty($str['sEmail'])){
    $result = $user_class->get_user_info_by_email($str['sEmail']);
}else{
    $noget = TRUE;
}


?>
<div class="row">
    <div class="col-lg-12">

        <div id="content-full">
            <?php if (bi_get_data('enable_disable_breadcrumbs', '1') == '1') { ?>
                <?php echo responsive_breadcrumb_lists(); ?>
            <?php } ?>

            <article>
                <header class="page-header">
                    <h1 class="page-title text-center">文波雅思密码恢复页面</h1>
                </header>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p>Design for Wenbo to recovery password for video page(inside use only!)</p>
                    </div>
                </div>
                <?php
                if(isset($result) && $result != null){
                    $vt         = substr(md5($result['sEmail']."oneuni"),-6);

                    ?>
                <div class="row">
                    <table class="table">
                        <tr>
                            <td>姓名</td>
                            <td><?php if(isset($result['sName']) && !empty($result['sName'])){echo $result['sName'];} ?></td>
                        </tr>
                        <tr>
                            <td>邮箱</td>
                            <td><?= $result['sEmail']; ?></td>
                        </tr>
                        <tr>
                            <td>密码</td>
                            <td><?= $vt; ?></td>
                        </tr>
                        <tr>
                            <td>登陆地址</td>
                            <td>https://www.oneuni.com.au/wenbo-ielts-speaking-video/</td>
                        </tr>
                    </table>

                </div>
                <?php
                }elseif(isset($str['sEmail']) && $result == null){
                    ?>

                    <h4 style="color: red" class="text-center">邮箱尚未登记，请登记后查询！</h4>
                    <?php
                }
                ?>

                <section class="post-entry">
                    <div class="row">
                        <form class="form-horizontal" id="user-form" method="get" novalidate name="regsiter">
                            <fieldset>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="sEmail">邮箱</label>

                                    <div class="col-md-4">
                                        <input id="sEmail" name="sEmail" type="text" placeholder="请填写注册邮箱"
                                               class="form-control input-md" required="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button id="submit" name="submit" class="btn btn-primary btn-lg btn-block">
                                            点击查看
                                        </button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>

                    </div>
                </section>
                <!-- end of .post-entry -->
            </article>
            <!-- end of #post-<?php the_ID(); ?> -->
        </div>
        <!-- end of #content-full -->
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        console.log("*****WANT TO FIND OUT HOW TO DO IT? EMAIL: HANSUN@1230.ME *****");
        console.log("*****技术支持，万友澳洲，联系：HANSUN@1230.me             *****");
    });



</script>
<?php get_footer(); ?>
