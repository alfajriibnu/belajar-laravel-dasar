<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvirontmentTest extends TestCase
{
  public function testGetEnv(){
    $youtube = env("YOUTUBE");

        self::assertEquals("ibnu al fajri", $youtube);
  }

  public function testDefaultEnv(){
    $author = env("AUTHOR", "Ibnu");

        self::assertEquals("Ibnu", $author);
  }

  
}
