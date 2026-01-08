<?php

namespace App\Services;

use App\Models\Categorie;
use App\Models\Category;

class CategorieService
{
    public function getAll()
    {
        return Category::all();
    }
}