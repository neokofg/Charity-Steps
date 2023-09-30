<?php

namespace App\Services;

use App\Models\News;
use Throwable;

class NewsService {
    public function __construct()
    {
        $this->relations = [
            "images",
            "company"
        ];
    }
    public function get_news(): mixed
    {
        try {
            return News::orderBy("created_at","DESC")
                ->with($this->relations)
                ->paginate(10);
        } catch (Throwable $e) {
            return false;
        }
    }

    public function find_news($r): mixed
    {
        try {
            return News::where("id","=",$r['news_id'])
                ->with($this->relations)
                ->first();
        } catch (Throwable $e) {
            return false;
        }
    }
}
