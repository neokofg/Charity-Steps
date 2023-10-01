<?php

namespace App\Services;

use App\Models\History;
use Throwable;

class HistoriesService {
    public function __construct()
    {
        $this->relations = [
            "user"
        ];
    }
    public function get_histories()
    {
        try {
            return History::orderBy("created_at", "DESC")->with($this->relations)->get();
        } catch (Throwable $e) {
            return false;
        }
    }
}
