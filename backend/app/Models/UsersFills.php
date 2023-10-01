<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UsersFills extends Model
{
    use HasFactory, HasUuids;

    protected $table = "users_fills";

    protected $fillable = [
        "amount",
        "charity_id",
        "user_id",
        "status"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", 'id');
    }

    public function charity(): BelongsTo
    {
        return $this->belongsTo(Challenge::class, "charity_id", "id");
    }
}
