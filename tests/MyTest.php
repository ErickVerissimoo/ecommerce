<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class MyTest extends TestCase
{
public function testmethodName()
{
    $uge = 2;
       $this->assertNotEmpty($uge);
}
}