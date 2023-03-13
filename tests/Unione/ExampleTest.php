<?php

namespace Unione;

use PHPUnit\Framework\TestCase;

final class ExampleTest extends TestCase
{
    public function testExample()
    {
        $test = 5;

        $this->assertSame(5, $test);
    }
}