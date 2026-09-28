<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;


// php artisan make:seeder CategorySeeder
// php artisan db:seed --class=CategorySeeder

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catagories = ['Sembako', 'Minuman', 'Makanan Ringan', 'Kebutuhan Rumah Tangga'];
        foreach ($catagories as $name) {
            Category::create(['name' => $name]);    
        }
    }
}
