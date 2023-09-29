<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class News extends Model
{
    use HasFactory, HasUuids;

    // table name
    protected $table = "news";

    //  The attributes that are mass assignable.
    protected $fillable = [
        "title",
        "content",
        "charity_id",
        "company_id",
    ];

    // returns NewsImage models
    public function images(): HasMany
    {
        return $this->hasMany(NewsImage::class,"news_id",'id');
    }

    // returns Charity model
    public function charity(): BelongsTo
    {
        return $this->belongsTo(Charity::class, "charity_id", 'id');
    }

    // returns Company model
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, "company_id", 'id');
    }
}
