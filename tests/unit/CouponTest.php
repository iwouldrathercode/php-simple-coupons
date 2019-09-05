<?php

use PHPUnit\Framework\TestCase;
use Iwouldrathercode\SimpleCoupons\Coupon;

class CouponTest extends TestCase
{
    private $code;

    /**
     * Fixture / Initial setup - runs before starting every testcase
     */
    protected function setUp()
    {
        $this->code = new Coupon();
    }

    /**
     * Test if coupon is not null and has value
     */
    public function testCanGenerateSingleCouponCode()
    {
        $coupon = $this->code->generate();
        $this->assertNotEmpty($coupon);
    }

    /**
     * Test if coupon has prepend value in the start
     */
    public function testCanGenerateValuesWithPrependText()
    {
        $coupon = $this->code->prepend('ABC')->generate();
        $this->assertStringStartsWith('ABC', $coupon);
    }

    /**
     * Test if coupon has appended value in the end
     */
    public function testCanGenerateValuesWithAppendedText()
    {
        $coupon = $this->code->append('XYZ')->generate();
        $this->assertStringEndsWith('XYZ', $coupon);
    }

    /**
     * Test if coupon can generate with a character limit of 10
     */
    public function testCanGenerateValueWithCharacterLimit()
    {
        $coupon = $this->code->limit(10)->generate();
        $this->assertTrue(strlen($coupon) === 10);
    }

    /**
     * Test if coupon has both prepend and appended value(s)
     */
    public function testCanGenerateValuesWithPrependAndAppendedText()
    {
        $coupon = $this->code->prepend('ABC')->append('XYZ')->generate();
        $this->assertStringStartsWith('ABC', $coupon);
        $this->assertStringEndsWith('XYZ', $coupon);
    }

    /**
     * Test if coupon can generate a 10 char unique code allowing 0 and denying I
     */
    public function testCanGenerateValueWithCharLimitDenyLCharacter()
    {
        $coupon = $this->code->deny(['L'])->limit(10)->generate();
        $this->assertNotContains('L', $coupon);
        $this->assertTrue(strlen($coupon) === 10);
    }

    /**
     * Fixture / Initial setup - runs after completing every testcase
     */
    protected function tearDown()
    {
        $this->code = null;
    }
}
