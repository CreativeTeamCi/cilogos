<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class routesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        // $response = $this->get('/');

        // $response->assertStatus(200);
        $routeCollection = \Illuminate\Support\Facades\Route::getRoutes();
        foreach ($routeCollection as $value) {
            $response = $this->call($value->getMethods()[0], $value->getPath());
            $this->assertNotEquals(500, $response->status(),"{$value->getMethods()[0]} {$value->getPath()}");
        }
    }
}
