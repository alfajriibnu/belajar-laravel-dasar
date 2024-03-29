<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this ->get('/pzn')
              ->assertStatus(200)
              ->assertSeeText("Hallo Programmer Zaman Now");
    }

    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/pzn');
    }

    public function testFallback()
    {
        $this->get('/tidakada')
        ->assertSeeText('404 by Programmer Zaman Now');

        $this->get('/tidakadalagi')
        ->assertSeeText('404 by Programmer Zaman Now');

        $this->get('/ups')
        ->assertSeeText('404 by Programmer Zaman Now');
    }

    public function testRouteParameter()
    {
        $this->get('/products/1')
        ->assertSeeText('Product 1');

        $this->get('/products/2')
        ->assertSeeText('Product 2');

        $this->get('/products/1/items/XXX')
        ->assertSeeText("Product 1, Item XXX");

        $this->get('/products/2/items/YYY')
        ->assertSeeText("Product 2, Item YYY");
    }

    public function testRouteParameterRegex()
    {
        $this->get('/categories/100')
        ->assertSeeText('Category 100');

        $this->get('/categories/Ibnu')
        ->assertSeeText('404 by Programmer Zaman Now');
    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/alfajri')
        ->assertSeeText('User alfajri');

        $this->get('/users/')
        ->assertSeeText('User 404');
    }

    public function testRoutingConflict()
    {

        $this->get('/conflict/ibnu')
        ->assertSeeText('Conflict Ibnu Al Fajri');
    }
}
