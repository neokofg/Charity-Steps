<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Charity extends Model
{
    use HasFactory, HasUuids;

    // table name
    protected $table = "charities";

    //  The attributes that are mass assignable.
    protected $fillable = [
        "name"
    ];


    // return User models
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "charity_users");
    }

    // return Company models
    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, "company_charities");
    }

    // returns News models
    public function news(): HasMany
    {
        return $this->hasMany(News::class, "charity_id", 'id');
    }
}
