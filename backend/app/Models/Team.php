<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use HasFactory, HasUuids;

    // table name
    protected $table = "teams";

    //  The attributes that are mass assignable.
    protected $fillable = [
        "name",
    ];

    // returns User models
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,"team_users");
    }
}
