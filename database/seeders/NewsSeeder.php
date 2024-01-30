<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        News::factory(5)
            ->for(Category::factory())
            ->has(Tag::factory()->count(2))
            ->create();

        News::factory(2)
        ->for(Category::factory())
        ->has(Tag::factory()->count(3))
        ->create();
    }
}
