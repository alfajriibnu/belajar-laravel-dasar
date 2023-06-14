<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use illuminate\Support\Facade\App;
use Tests\TestCase;

class AppEnvirontmentTest extends TestCase
{
    public function testAppEnv(){
        var_dump(App::environtment());
        if(App::environtment(["testing", "prod", "dev"])){
            //kode program kita
            self::assertTrue(true);
        }
    }
}
