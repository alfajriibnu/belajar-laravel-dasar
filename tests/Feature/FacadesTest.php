<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadesTest extends TestCase
{
    public function testConfig()
    {
        $firstName1 = Config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        self::assertEquals($firstName1, $firstName2);

        var_dump(Config::all());  //Menampilkan semua config
    }

    public function testConfigDependency()
    {
        $config = $this->app->make('config');
        $firstName3 = $config -> get('contoh.author.first');

        $firstName1 = Config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        self::assertEquals($firstName1, $firstName2);
        self::assertEquals($firstName1, $firstName3);

        var_dump($config->all());
    }

    public function testFacadesMock()
    {
        Config::shouldReceive('get')
        ->with('contoh.author.first')
        ->andReturn('Ibnu Keren');

        $firstName = Config::get('contoh.author.first');

        self::assertEquals('Ibnu Keren', $firstName);

    }

}
