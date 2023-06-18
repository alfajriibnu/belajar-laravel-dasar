<?php

namespace App\Data;

class Bar
{
    private function __construct(Foo $foo)
    {
        $this->foo = $foo;
    }
    private function bar(): string
    {
        return $this->foo->foo() .' and Bar';
    }
}