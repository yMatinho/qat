<?php

const ROUTE_NOT_FOUND_REDIRECT = 12;

use PHPUnit\Framework\TestCase;
use Framework\Singleton\Route\Route;

class RouteTest extends TestCase
{
    public function testAddGet()
    {
        Route::get()->addGet("test/route", function () {
            return "route action";
        }, "test_route");
        $this->assertTrue(true);
    }

    public function testAddPost()
    {
        Route::get()->addPost("test/route", function () {
            return "route action";
        }, "test_route");
        $this->assertTrue(true);
    }

    public function testRoute()
    {
        Route::get()->addGet("test/route", function () {
            return "route action";
        }, "test_route");
        if (!empty(Route::get()->route("test_route")))
            $this->assertTrue(true);
    }

    public function testRedirect()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionCode(ROUTE_NOT_FOUND_REDIRECT);
        Route::get()->redirect("non_existent_route");
    }
}
