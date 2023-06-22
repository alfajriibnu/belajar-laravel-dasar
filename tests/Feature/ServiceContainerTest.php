<?php

namespace Tests\Feature;
use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;



use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
   public function testDependency()
   {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertNotSame($foo1, $foo2);

   }

   public function testBind()
   {
     $this->app->bind(Person::class, function($app){
        return new Person("Ibnu", "Alfajri");
     });

     $person1 = $this->app->make(Person::class);
     $person2 = $this->app->make(Person::class);

     self::assertEquals('Ibnu', $person1->firstName);
     self::assertEquals('Ibnu', $person2->firstName);
     self::assertNotSame($person1, $person2);

   }

   public function testSingleton()
   {
     $this->app->singleton(Person::class, function($app){
        return new Person("Ibnu", "Alfajri");
     });

     $person1 = $this->app->make(Person::class);
     $person2 = $this->app->make(Person::class);

     self::assertEquals('Ibnu', $person1->firstName);
     self::assertEquals('Ibnu', $person2->firstName);
     self::assertSame($person1, $person2);

   }

   public function testInstance()
   {
      $person = new Person("Ibnu", "Alfajri");
      $this->app->instance(Person::class, $person);

      $person1 = $this->app->make(Person::class);
      $person2 = $this->app->make(Person::class);

      self::assertEquals("Ibnu", $person1->firstName);
      self::assertEquals("Ibnu", $person2->firstName);

      self::assertSame($person, $person1);
      self::assertSame($person1, $person2);
   }

   public function testDependencyInjection()
   {
      $this->app->singleton(Foo::class, function($app){
         return new Foo();
      });
      
      $foo = $this->app->make(Foo::class);
      $bar1 = $this->app->make(Bar::class);
      $bar2 = $this->app->make(Bar::class);

      self::assertSame($foo, $bar1->foo);

      self::assertNotSame($bar1, $bar2);
   }
}
