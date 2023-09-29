<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsImage extends Model
{
    use HasFactory, HasUuids;

    // table name
    protected $table = "news_images";

    //  The attributes that are mass assignable.
    protected $fillable = [
        "url",
        "url_128",
        "url_256",
        "url_512",
        "url_1024",
        "news_id"
    ];

    // returns News model
    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class, "news_id", 'id');
    }
}
