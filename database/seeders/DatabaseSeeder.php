<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $tags = Tag::factory(2)->create();

        Category::factory(5)->create()
            ->each(function ($category) use ($tags) {
                News::create([
                    'title' => fake()->text(20),
                    'content' => fake()->paragraph(),
                    'banner_image' => fake()->text(10),
                    'slug' => fake()->slug(),
                    'category_id' => $category->id
                ])->each(function ($news) use ($tags) {
                    $news->tags()->attach($tags->random(1));
                });
            });

        $this->call([
            // CategorySeeder::class,
            // TagsSeeder::class,
            // NewsSeeder::class,
            // TagsSeeder::class,
        ]);
    }
}
