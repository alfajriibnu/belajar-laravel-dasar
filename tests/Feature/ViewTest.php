<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
        ->assertSeeText('Hello Ibnu');

        $this->get('/hello-again')
        ->assertSeeText('Hello Ibnu');
    }

    public function testNested()
    {
        $this->get('/hello-world')
        ->assertSeeText('world Ibnu');
    }

    public function testTemplate()
    {
       $this->view('hello', ['name' => 'Ibnu'])
       ->assertSeeText('Hello Ibnu');

       $this->view('hello.world', ['name' => 'Ibnu'])
       ->assertSeeText('world Ibnu');
    }
}
