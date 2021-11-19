<?php

session_start();

define("__ROOT", dirname(__DIR__));

use Korona\Route;

require(__ROOT . "/autoload.php");
require(__ROOT . "/web.php");

$url = isset($_GET['url']) ? "/" . $_GET['url'] : "/";

Route::route($url);

function dateToString($birth) 
{
    $dateExplode = explode("-",$birth);
    $date = $dateExplode[0] . "년 " . $dateExplode[1] . "월 " . $dateExplode[2] ."일";
    return $date;
}

function sextostring($sex)
{
    $who = $sex == 0 ? "여자" : "남자";
    return $who;
}