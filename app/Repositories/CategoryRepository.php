<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends Repository
{

    public function model(): string
    {
       return Category::class;
    }
}
