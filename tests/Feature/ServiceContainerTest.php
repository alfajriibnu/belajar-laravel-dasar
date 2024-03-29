<?php

namespace Tests\Feature;
use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
   public function testDependency()
   {
        $foo1 = $this->app->make(Foo::class); // new Foo();
        $foo2 = $this->app->make(Foo::class); // new Foo();

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertNotSame($foo1, $foo2);

   }

   public function testBind()
   {
     $this->app->bind(Person::class, function($app){
        return new Person("Ibnu", "Alfajri");
     });

     $person1 = $this->app->make(Person::class); //closure() // new person ()
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

     $person1 = $this->app->make(Person::class); // tempat penyimpanannya berbeda meski datanya sama.
     $person2 = $this->app->make(Person::class); // tempat penyimpanannya berbeda meski datanya sama.

     self::assertEquals('Ibnu', $person1->firstName);
     self::assertEquals('Ibnu', $person2->firstName);
     self::assertSame($person1, $person2);

   }

   public function testInstance()
   {
      $person = new Person("Ibnu", "Alfajri");
      $this->app->instance(Person::class, $person); //menginstansi semuanya dan dapat digunakan semua pada variable yg dibuat

      $person1 = $this->app->make(Person::class); //$person
      $person2 = $this->app->make(Person::class); //$person

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

      self::assertNotSame($foo, $bar1->foo);

      self::assertNotSame($bar1, $bar2);
   }

   public function testInterfaceToClass()
   {
    // $this->app->singleton(HelloService::class HelloServiceIndonesia::class);

    $this->app->singleton(HelloService::class, function($app){
        return new HelloServiceIndonesia();
    });

    $helloService = $this->app->make(HelloService::class);

    self::assertEquals('Halo Ibnu', $helloService->hello('Ibnu'));
   }

}
