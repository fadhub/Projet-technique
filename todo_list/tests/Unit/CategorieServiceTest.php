<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\CategorieService;
use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategorieServiceTest extends TestCase
{
    use DatabaseTransactions;

    protected CategorieService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new CategorieService();
    }

    public function test_it_can_get_all_categories()
    {
        // Act
        $categories = $this->service->getAll();

        // Assert
        $this->assertGreaterThan(0, $categories->count());
    }
}
