<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\CategorieService;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategorieServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new CategorieService();
    }

    public function test_get_all_categories()
    {
        // Créer des catégories de test
        $category1 = Category::create(['name' => 'Travail']);
        $category2 = Category::create(['name' => 'Personnel']);

        // Appeler la méthode à tester
        $result = $this->service->getAll();

        // Vérifier les résultats
        $this->assertCount(2, $result);
        $this->assertEquals('Travail', $result[0]->name);
        $this->assertEquals('Personnel', $result[1]->name);
    }

    public function test_get_all_categories_empty()
    {
        // Tester le cas où il n'y a pas de catégories
        $result = $this->service->getAll();
        
        $this->assertCount(0, $result);
        $this->assertEmpty($result);
    }
}