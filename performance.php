<?php 

error_reporting( E_ALL );
ini_set('display_errors', 1);
require('vendor/autoload.php');

use Iwouldrathercode\SimpleCoupons\Coupon;
use JakubOnderka\PhpConsoleColor\ConsoleColor;
use LucidFrame\Console\ConsoleTable;

$table = new LucidFrame\Console\ConsoleTable();
$table->addHeader('Coupons generated')->addHeader('Time elapsed (microsecs)')->addHeader('Status');

function runRound($limit, $table)
{
    $array = [];
    $code = new Coupon();
    $coloredOutput = new ConsoleColor();
    $starttime = microtime(true);
    for($i=1; $i<=$limit; $i++) {
        gc_enable();
        generate($code, $array);
        gc_disable();
    }
    $endtime = microtime(true);
    $timeElapsed = $endtime - $starttime;
    if(count(array_unique($array))<count($array)) {
        echo $coloredOutput->apply("color_1", $limit.' - '.$timeElapsed.' coupons - Duplicate coupons found!'.PHP_EOL);
        exit(1);
    } else {
        $table->addRow()->addColumn($limit)->addColumn($timeElapsed)->addColumn('No duplicates found!');
    }
    unset($code, $endtime, $timeElapsed, $starttime, $coloredOutput);
}

function generate($code, $array)
{
    $coupon = $code->limit(12)->generate();
    // echo $coloredOutput->apply("color_15", $coupon.PHP_EOL);
    array_push($array, $coupon);
    $code->__destruct();
}

runRound(10, $table);
runRound(100, $table);
runRound(1000, $table);
runRound(10000, $table);
runRound(100000, $table);
runRound(1000000, $table);
runRound(10000000, $table);
$table->display();




