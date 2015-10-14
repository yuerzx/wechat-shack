<?php
/**
 * Created by PhpStorm.
 * User: Han
 * Date: 23/06/2015
 * Time: 10:38 AM
 */
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){ //windows is \ unix is /
    $adds = explode("\\", __FILE__, -3);
    $adds = implode("\\", $adds).'\\';
}else{
    $adds = explode("/", __FILE__, -3);
    $adds = implode("/", $adds).'/';
}
require ($adds.'wp-config.php');
require "class/user_class.php";
require_once 'class/PHPMailerAutoload.php';

global $wpdb;
$table_game_user_one = $wpdb->prefix.'oneuni_games_user_one';
global $table_game_user_one;
global $user_class;

$user_class = new Game_Class();

