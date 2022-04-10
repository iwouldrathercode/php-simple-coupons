<?php

namespace Iwouldrathercode\SimpleCoupons;

class Coupon
{
    /**
     * Maximum length of the random string (excluding prefix and suffix).
     *
     * @var Int
     */
    public $randomStringLength = 8;

    /**
     * Random string after generation.
     *
     * @var String
     */
    public $outputString;

    /**
     * Prefix to be used in the coupon code.
     *
     * @var String
     */
    public $prefix;

    /**
     * Suffix to be used in the coupon code.
     *
     * @var String
     */
    public $suffix;

    /**
     * Maximum number of iterations allowed while generating coupon code.
     *
     * @var Int
     */
    public $iterationLimit = 20;

    public function __construct()
    {
        //
    }

    /**
     * Setter for the random string length
     */
    public function limit($length)
    {
        $this->randomStringLength = $length;
        return $this;
    }

    /**
     * Setter for adding prefix string
     *
     * @param Char
     * @return Object
     */
    public function prepend($chars)
    {
        $this->prefix = $chars;
        return $this;
    }

    /**
     * Setter for adding suffix string
     *
     * @param Char
     * @return Object
     */
    public function append($chars)
    {
        $this->suffix = $chars;
        return $this;
    }

    /**
     * Master method to output the generated coupon code with prefixes and suffixes
     *
     * @return String
     */
    public function generate()
    {
        $iterations = 0;
        $length = $this->randomStringLength;

        // Generate a valid coupon until all validation passes
        while ($this->validate() === false) {
            
            // Recovery scenario - break from the loop if exceeded max. iterations
            if ($iterations >= $this->iterationLimit) {
                break;
            }

            // Churn / Generates the random string
            $this->churn($length);

            if($this->validate() === true) {
                break;
            }
            // Incrementing the iteration count
            $iterations++;
        }
        
        $uniqiCode = $this->outputString;
        return $this->prefix.$uniqiCode.$this->suffix;
    }

    /**
     * Generates a string using random_bytes,
     * converts into hex using bin2hex and returns all uppercase string
     *
     * @return String
     */
    public function churn($length)
    {
        // Need to substr as the output hex string of a bin random string
        // http://php.net/manual/en/function.random-bytes.php
        $this->outputString = substr(strtoupper(bin2hex(random_bytes($length))), 0, $length);
    }

    /**
     * Validates if the string contains characters which are
     * only allowed and does not contain characters which are
     * not allowed
     *
     * @return Boolean
     */
    public function validate()
    {
        if (empty($this->outputString)) {
            return false;
        }
        
        if (ctype_alpha($this->outputString)) {
            return true;
        } else {
            if (ctype_digit("".$this->outputString)) {
                return false;
            } else {
                if( strpos($this->outputString, 'I') === false && strpos($this->outputString, 'O') === false && strpos($this->outputString, '0') === false ) {
                    return true;
                }
                return false;
            }
        }

        return false;
    }

    public function __destruct()
    {
        unset($this->outputString);
    }
}
