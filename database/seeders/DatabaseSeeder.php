<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Вопрос', 'slug' => 'question'],
            ['name' => 'Ошибка', 'slug' => 'bug'],
            ['name' => 'Предложение', 'slug' => 'feature'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['slug' => $category['slug']], $category);
        }

        foreach (['Ответить позже', 'Нужна проверка', 'Дубль'] as $tagName) {
            Tag::firstOrCreate(['name' => $tagName]);
        }
    }
}