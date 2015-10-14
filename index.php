<?php
require("functions.php");
global $wpdb;
global $table_school;
get_header("referral");
?>
<div class="row">
    <div class="col-lg-12">

        <div id="content-full">
            <?php if (bi_get_data('enable_disable_breadcrumbs', '1') == '1') { ?>
                <?php echo responsive_breadcrumb_lists(); ?>
            <?php } ?>

            <article>
                <header class="page-header">
                    <h1 class="page-title text-center">文波雅思领取页面</h1>
                </header>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul style="list-style-type:none">
                            <li>语法提升班-- 20小时 -- 短期提升写复合句的能力</li>
                            <li>词汇速记班-- 22小时 -- 快速掌握3000学术词汇</li>
                            <li>雅思写作保过班-- 27小时 -- 包含无限次作文批改</li>
                            <li>雅思口语保过班-- 20小时 -- 课下口语练习平台免费使用</li>
                            <li>PTE全科提高班-- 35小时 -- 听说读写全面提升</li>
                            <li>雅思基础五分班-- 120小时-- 零基础到五分全面包含</li>
                            <li>VIP一对一课程--个性化一对一服务</li>
                        </ul>
                    </div>
                </div>

                <section class="post-entry">
                    <div class="row">
                        <form class="form-horizontal" id="user-form" method="post" novalidate name="regsiter">
                            <fieldset>
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="sName">姓名</label>

                                    <div class="col-md-4">
                                        <input id="sName" name="sName" type="text" placeholder=""
                                               class="form-control input-md" required="">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="sPhone">手机</label>

                                    <div class="col-md-4">
                                        <input id="sPhone" name="sPhone" type="text" placeholder=""
                                               class="form-control input-md" required="">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="sEmail">邮箱</label>

                                    <div class="col-md-4">
                                        <input id="sEmail" name="sEmail" type="text" placeholder="请正确填写密码会发送到邮箱中"
                                               class="form-control input-md" required="">
                                    </div>
                                </div>

                                <!-- Select Basic -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="sSchool">在读学校</label>

                                    <div class="col-md-4">
                                        <select id="sSchool" name="sSchool" class="form-control">
                                            <?php
                                            $uni_list = $wpdb->get_results("
                                                    SELECT school_id, school_name
                                                    FROM $table_school
                                                    WHERE school_type = 'u'
                                                ", ARRAY_A);
                                            foreach ($uni_list as $key => $value) {
                                                echo '<option value="' . $value["school_id"] . '">' . $value['school_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="sSubject">专业</label>

                                    <div class="col-md-4">
                                        <input id="sSubject" name="sSubject" type="text" placeholder=""
                                               class="form-control input-md" required="">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label"
                                           for="sGraduateYear">毕业时间</label>

                                    <div class="col-md-2">
                                        <select id="sGraduateM" name="sGraduateM" class="form-control">
                                            <option value="1">Jan</option>
                                            <option value="2">Feb</option>
                                            <option value="3">Mar</option>
                                            <option value="4">Apr</option>
                                            <option value="5">May</option>
                                            <option value="6">Jun</option>
                                            <option value="7">Jul</option>
                                            <option value="8">Aug</option>
                                            <option value="9">Sep</option>
                                            <option value="10">Oct</option>
                                            <option value="11">Nov</option>
                                            <option value="12">Dec</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <select id="sGraduateY" name="sGraduateY" class="form-control">

                                            <?php
                                            for ($i = 2000; $i <= 2023; $i++) {
                                                echo "<option value='$i'>$i</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label"
                                           for="sGraduateYear">生日<i class="fa fa-birthday-cake"></i></label>

                                    <div class="col-md-2">
                                        <select id="sBirthD" name="sBirthD"
                                                class="form-control" required="">
                                            <?php
                                            for ($i = 1; $i <= 31; $i++) {
                                                echo "<option value='$i'>$i</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <select id="sBirthM" name="sBirthM" class="form-control">
                                            <option value="1">Jan</option>
                                            <option value="2">Feb</option>
                                            <option value="3">Mar</option>
                                            <option value="4">Apr</option>
                                            <option value="5">May</option>
                                            <option value="6">Jun</option>
                                            <option value="7">Jul</option>
                                            <option value="8">Aug</option>
                                            <option value="9">Sep</option>
                                            <option value="10">Oct</option>
                                            <option value="11">Nov</option>
                                            <option value="12">Dec</option>
                                        </select>
                                    </div>


                                </div>
                                <?php wp_nonce_field('game_submit', 'game_name_ver'); ?>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button id="submit" name="submit" class="btn btn-primary btn-lg btn-block">
                                            点击生成
                                        </button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <div class="row" id="Call-Back-Frame">
                            <div class="col-md-12" id="result">
                            </div>
                            <div class="col-md-12 text-center" id="success" style="display: none">
                                <h2 id="Call-Back-Title"></h2>

                                <p id="Call-Back-Contain"></p>

                                <div class="col-md-12">
                                    <button id="new-entry" name="submit" class="btn btn-primary btn-lg btn-block"
                                            onclick="returnForm()">录入新的
                                    </button>
                                </div>
                            </div>
                        </div>
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

    var warning1 = '<div class="alert alert-warning alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    var warning2 = '</div>';
    function returnForm() {
        jQuery('#success').hide();
        jQuery('#user-form').show(1000);
        jQuery('#user-form')[0].reset();
        jQuery('#submit').prop('disabled', false).text("点击生成");
    }
    ;
    function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    }
    ;
    jQuery(document).ready(function ($) {
            $("#user-form").submit(function (event) {
                    event.preventDefault();
                    var phone = $('#sPhone').val();
                    var result = $('#result');
                    var name = $('#sName').val();
                    var email = $('#sEmail').val();
                    if (phone && phone.length == 10 && isValidEmailAddress(email)) {
                        $('#submit').prop('disabled', true).text("载入中.....请稍等");
                        $.ajax({
                            type: "POST",
                            url: "wp-ajax/ajax-register-user.php",
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function (data) {
                                console.log(data);
                                if (data['status'] == 'ok') {
                                    $('#user-form').hide(1000);
                                    result.hide();
                                    var s_title = "恭喜<b>" + name + "</b>登记成功";
                                    var s_pass = "您的用户名是：" + "</b><br> 视频地址是: <a href='http://www.oneuni.com.au/wenbo-ielts-speaking-video/'>http://www.oneuni.com.au/wenbo-ielts-speaking-video/</a>" + "<br>您可以直接用您的邮箱登陆视频页面了！ 如果没收到邮件，请直接尝试登陆页面，谢谢。 在60秒后页面自动返回";
                                    $('#Call-Back-Title').html(s_title);
                                    $('#Call-Back-Contain').html(s_pass);
                                    $('#success').show(700);

                                    setTimeout(returnForm, 60000);
                                } else if (data['status'] == 'fail') {
                                    $(warning1 + '手机号已经存在，请更改后注册' + warning2).hide().prependTo(result).show("slow");
                                    $('#submit').prop('disabled', false).text("点击生成");
                                }
                            },
                            error: function (xhr, status, error) {
                                $('#result').html("系统连接错误，请刷新后重试");
                                console.log(error);
                                console.log(status);
                                console.log(xhr);
                                $('#submit').prop('disabled', false).text("点击生成");
                            }
                        });
                    } else {
                        $(warning1 + '<b>手机</b>或者<b>邮箱</b>为空或格式不对，请更改后重试' + warning2).hide().prependTo(result).show("slow");
                    }
                }
            );
        }
    );


</script>
<?php get_footer(); ?>
