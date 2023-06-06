<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'business', 
            'entertainment', 
            'general', 
            'health', 
            'science', 
            'sports', 
            'technology'
        ];
        
        foreach ($categories as $key => $value) {
            if (Category::where('name', $value)->count() == 0) {
                Category::create([
                    'name' => $value
                ]);
            }
        }
    }
}
