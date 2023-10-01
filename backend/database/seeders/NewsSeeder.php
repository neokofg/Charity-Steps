<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::factory([
            "company_id" => Company::first()->id
        ])
            ->count(40)
            ->create()
            ->each(function ($news) {
                NewsImage::create([
                    "url" => "https://cdn.charity-steps.ru/exampleimage.png",
                    "news_id" => $news->id
                ]);
            });
    }
}
