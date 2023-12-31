<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    // table name
    protected $table = "histories";

    //  The attributes that are mass assignable.
    protected $fillable = [
        "url",
        "url_128",
        "url_256",
        "url_512",
        "url_1024",
        "user_id"
    ];

    // returns user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,"user_id",'id');
    }
}
