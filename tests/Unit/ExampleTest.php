<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ExampleTest extends TestCase
{
      use RefreshDatabase, WithFaker;
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
         $this->assertTrue(true);
    }
}
