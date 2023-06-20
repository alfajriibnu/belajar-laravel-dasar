<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
   public function testDependencyInjection()
   {
        $foo1 = $this->app->make(Foo::class); //new foo()
        $foo2 = $this->app->make(Foo::class); //new foo()

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertNotSame($foo1, $foo2);
   }


   public function testBind()
   {
        // $person = $this->app->make(Person::class); // new person()
        // self::assertNotNull($person);

        $this->app->bind(Person::class, function ($app)
        {
            return new Person("Eko", "Khannedy");
        });

        $person1 = $this->app->make(Person::class); //closure() // new Person("Eko","Khannedy")
        $person2 = $this->app->make(Person::class); //closure() // new Person("Eko","Khannedy")

        self::assertEquals('Eko', $person1->firstName);
        self::assertEquals('Eko', $person2->firstName);
        self::assertNotSame($person1, $person2);
   }

   public function testSingleton()
   {
        // $person = $this->app->make(Person::class); // new person()
        // self::assertNotNull($person);

        $this->app->singleton(Person::class, function ($app)
        {
            return new Person("Eko", "Khannedy");
        });

        $person1 = $this->app->make(Person::class); //new Person("Eko","Khannedy") if not exists
        $person2 = $this->app->make(Person::class); //return existing

        self::assertEquals('Eko', $person1->firstName);
        self::assertEquals('Eko', $person2->firstName);
        self::assertSame($person1, $person2);
   }


}

