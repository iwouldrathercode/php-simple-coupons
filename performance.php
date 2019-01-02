<?php 

error_reporting( E_ALL );
ini_set('display_errors', 1);
require('vendor/autoload.php');

use Iwouldrathercode\SimpleCoupons\Coupon;
use JakubOnderka\PhpConsoleColor\ConsoleColor;


function runRound($limit)
{
    $array = [];
    $code = new Coupon();
    $coloredOutput = new ConsoleColor();
    $starttime = microtime(true);
    for($i=1; $i<=$limit; $i++) {
        $coupon = $code->limit(12)->generate();
        // echo $coloredOutput->apply("color_15", $coupon.PHP_EOL);
        array_push($array, $coupon);
        $code->flush();
    }
    $endtime = microtime(true);
    $timeElapsed = $endtime - $starttime;
    if(count(array_unique($array))<count($array)) {
        echo $coloredOutput->apply("color_1", $ilmit.' - '.$timeElapsed.' coupons - Duplicate coupons found!'.PHP_EOL);
        exit(1);
    } else {
        echo $coloredOutput->apply("color_15", '* '.$limit.' - '.$timeElapsed.' seconds'.PHP_EOL);
    }
    $code = $endtime = $timeElapsed = $starttime = $coloredOutput = null;
}

runRound(10);
runRound(100);
runRound(1000);
runRound(10000);
runRound(100000);
runRound(1000000);
// runRound(10000000);




