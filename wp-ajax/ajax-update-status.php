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

if(isset($user_data['ver']) && !empty($user_data['ver'])){
    $answer = array("status"=>"ok","_id"=>"test");
    echo json_encode($answer);
}