<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 5; $i ++) {
            Category::create([
                'name' => 'category'.' '. ($i + 1),
            ]);
        }
    }
}
