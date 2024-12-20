<?php

use App\Http\Domains\Shared\CalculatorService;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(CalculatorService::class)]
class CalculatorTest extends TestCase
{
    public function test_add(): void
    {
        $calculator = new CalculatorService;
        $result = $calculator->add(1, 2);
        $this->assertEquals(3, $result);
    }

    public function test_subtract(): void
    {
        $calculator = new CalculatorService;
        $result = $calculator->subtract(2, 1);
        $this->assertEquals(1, $result);
    }

    public function test_multiply(): void
    {
        $calculator = new CalculatorService;
        $result = $calculator->multiply(2, 3);
        $this->assertEquals(6, $result);
    }

    public function test_divide(): void
    {
        $calculator = new CalculatorService;
        $result = $calculator->divide(6, 3);
        $this->assertEquals(2, $result);
    }

    public function test_divide_by_zero(): void
    {
        $calculator = new CalculatorService;
        $result = $calculator->divide(6, 0);
        $this->assertEquals('Infinity', $result);
    }

    // public function testAddAndReturnAsString(): void
    // {
    //     $calculator = new CalculatorService();
    //     $result = $calculator->addAndReturnAsString(1, 2);
    //     $this->assertEquals("tiga", $result);
    // }
}
