<?php

namespace Tests\Unit;

use Core\Test;
use PHPUnit\Framework\TestCase;

class TestUnitTest extends TestCase
{
    public function test_call_method_foo(): void
    {
        $test = new Test();
        $this->assertEquals('bar', $test->foo());
    }
}