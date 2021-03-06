<?php

namespace Norival\Spine\tests;

use Norival\Spine\Core\AbstractController;
use Norival\Spine\Core\Route;
use Norival\Spine\Core\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    private \Norival\Spine\Core\Router $router;

    public function setUp(): void
    {
        parent::setUp();

        $this->router = new Router();
    }

    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(Router::class, $this->router);
        /* $this->assertInstanceOf(Router::class, $this->router); */
    }

    public function testCanAddRoute(): void
    {
        $this->router->addRoute('home', '/home/', 'HomeController@index');

        $this->assertIsArray(
            $this->router->getRoutes(),
            'Router::getRoutes() should return an array'
        );
        $this->assertInstanceOf(Route::class, $this->router->getRoutes()[0]);
    }

    public function testResolvePathError(): void
    {
        $this->expectException(\Exception::class);

        $this->router->addRoute('home', '/home/', 'HomeController@index');
        $this->router->resolve('nopath');
    }

    public function testResolvePathWithError(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Class not found");

        $this->router->addRoute('home', '/home/', 'HomeController@index');
        $this->router->resolve('/home');
    }

    public function testResolvePathSlugWithError(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Class not found");

        $this->router->addRoute('home', '/home/{slug}', 'HomeController@index');
        $this->router->resolve('/home/test');
    }

    public function testResolvePathNoSlug(): void
    {
        $this->router->addRoute('test', '/test', '\Norival\Spine\tests\TestController@testNoSlug');
        $this->assertIsInt($this->router->resolve('/test'));
        $this->assertEquals(1, $this->router->resolve('/test'));
    }

    public function testResolvePathSlug(): void
    {
        $this->router->addRoute('test', '/test/{slug}', '\Norival\Spine\tests\TestController@testSlug');
        $this->assertIsInt($this->router->resolve('/test/coucou'));
        $this->assertEquals(1, $this->router->resolve('/test/coucou'));
    }
}
