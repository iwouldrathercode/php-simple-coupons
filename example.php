<?php 

error_reporting( E_ALL );
ini_set('display_errors', 1);
require('vendor/autoload.php');

use Iwouldrathercode\SimpleCoupons\Coupon;
use JakubOnderka\PhpConsoleColor\ConsoleColor;

$code = new Coupon();
$coloredOutput = new ConsoleColor();

echo $coloredOutput->apply("color_11", "Plain old simple unique coupon code only".PHP_EOL);
$coupon = $code->generate();
echo $coloredOutput->apply("color_15", $coupon.PHP_EOL);

echo $coloredOutput->apply("color_11", "Simple unique coupon code only with a prefix of ABC".PHP_EOL);
$coupon = $code->prepend('ABC')->generate();
echo $coloredOutput->apply("color_15", $coupon.PHP_EOL);

echo $coloredOutput->apply("color_11", "Simple unique coupon code only with a prefix of ABC and suffix of XYZ".PHP_EOL);
$coupon = $code->prepend('ABC')->append('XYZ')->generate();
echo $coloredOutput->apply("color_15", $coupon.PHP_EOL);

echo $coloredOutput->apply("color_11", "Simple unique coupon code only with a prefix of ABC and suffix of XYZ and max. char. length as - 10".PHP_EOL);
$coupon = $code->limit(10)->generate();
echo $coloredOutput->apply("color_15", $coupon.PHP_EOL);

echo $coloredOutput->apply("color_11", "Simple unique coupon code only with a prefix, suffix, max. char. length as - 10, allow 0 if string contains 0, deny if string contains I".PHP_EOL);
$coupon = $code->allow(['0'])->deny(['I'])->limit(10)->generate();
echo $coloredOutput->apply("color_15", $coupon.PHP_EOL);


