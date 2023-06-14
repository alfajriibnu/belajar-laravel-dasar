<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    
    public function test_example()
    {
       $firstName = config('contoh.author.first');
       $lastName = config('contoh.author.last');
       $email = config('contoh.email');
       $web = config('contoh.web');

       self::assertEquals('ibnu', $firstName);
       self::assertEquals('alfajri', $lastName);
       self::assertEquals('alfajriibnu1553@gmail.com', $email);
       self::assertEquals('https://www.nuindustries.com', $web);
    }
}
