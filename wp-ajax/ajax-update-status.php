<?php
/**
 * Created by PhpStorm.
 * User: Han
 * Date: 29/10/2015
 * Time: 6:13 PM
 */

require('../functions.php');
$user_data = $_POST;
global $user_class;

if(isset($user_data['ver']) && !empty($user_data['ver'])
    && isset($user_data['gift_id'])
    && !empty($user_data['gift_id'])
    ){
    $gift_id = intval($user_data['gift_id']);
    if(code_check($gift_id,6) == $user_data['ver']){
        global $table_wechat_giftcard;
        global $wpdb;
        $result = $wpdb->update(
            $table_wechat_giftcard,
            array(
                'gift_status' => 1
            ),
            array(
                'gift_id' => $gift_id
            ),
            array(
                '%d'
            ),
            array(
                '%d'
            )
        );
        if($result === false){
            $answer = array("status"=>"error", "id" => $wpdb->insert_id);
        }else{
            $answer = array("status"=>"ok", "id" => $wpdb->insert_id);
        }
        echo json_encode($answer);
    }
}else{
    $answer = array("status"=>"error","id"=>"test");
    echo json_encode($answer);
}