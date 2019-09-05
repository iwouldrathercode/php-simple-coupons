<h1 align="center">
  PHP SIMPLE COUPONS
  <br>
</h1>
<h4 align="center">
    PHP package to help generates simple and unique coupon codes
</h4>

[![Total Downloads](https://img.shields.io/packagist/dt/iwouldrathercode/php-simple-coupons.svg?style=flat-square)](https://packagist.org/packages/iwouldrathercode/php-simple-coupons)

## Installation
```bash
composer require iwouldrathercode/php-simple-coupons
```

## Usage

> Generating single coupon codes
```php
use Iwouldrathercode\SimpleCoupons\Coupon;

.
.
.
// Somewhere in your code...

$code = new Coupon();

// Coupon code only
$coupon = $code->generate();

// Coupon code with a prefix of `ABC`
$coupon = $code->prepend('ABC')->generate();

// Coupon code with a prefix of `ABC` and suffix of `XYZ`
$coupon = $code->prepend('ABC')->append('XYZ')->generate();

// Coupon code with a prefix of `ABC` and suffix of `XYZ` and max. char. length as - 10
$coupon = $code->limit(10)->generate();

// Coupon code with a prefix, suffix, max. char. length as - 10, allow 0 if string contains 0, deny if string contains `I`
$coupon = $code->allow(['0'])->deny(['I'])->limit(10)->generate();

.
.
```

> Generating multiple coupon codes
```php
use Iwouldrathercode\SimpleCoupons\Coupon;

.
.
.

// Somewhere in your code...

function generateMultipleCodes($limit, $table)
{
    $couponsArray = [];
    $code = new Coupon();

    // Looping through unti limit is reached
    for($i=1; $i<=$limit; $i++) {

        // VERY VERY IMPORTANT - TO AVOID MEMORY_LIMIT ISSUES
        gc_enable(); 
        
        // Call to function to generate one coupon code
        generate($code, $couponsArray);

        // VERY VERY IMPORTANT - TO AVOID MEMORY_LIMIT ISSUES
        gc_disable();
    }

    // VERY VERY IMPORTANT - TO AVOID MEMORY_LIMIT ISSUES
    unset($code);

    return $array;
}

function generate($code, $couponsArray)
{
    $coupon = $code->limit(12)->generate();
    // echo $coloredOutput->apply("color_15", $coupon.PHP_EOL);
    array_push($couponsArray, $coupon);
    $code->__destruct();
}

// Generate 10 coupon codes
$multipleCoupons = generateMultipleCodes(10, $table);

```
> For more examples do refer example.php and performance.php

## Credits

- [Shankar](https://github.com/psgganesh)

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.