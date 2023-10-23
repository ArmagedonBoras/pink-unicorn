<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $a = Article::create([
            'title' => 'Välkommen till ny hemsida',
            'body' => 'Ny hemsida!',
        ]);
        //$a->save();

        $a = new Article();
        $a->title = 'Snart dags för BSK';
        $a->body = '3-5 november 2023';
        $a->save();

        Article::factory()->count(12)->create();
    }
}
