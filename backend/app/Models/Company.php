<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory, HasUuids;

    // table name
    protected $table = "companies";

    //  The attributes that are mass assignable.
    protected $fillable = [
        "name",
        "description"
    ];

    // return User models
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "company_users");
    }

    // return Charity models
    public function charities(): BelongsToMany
    {
        return $this->belongsToMany(Charity::class, "company_charities");
    }

    // returns News models
    public function news(): HasMany
    {
        return $this->hasMany(News::class, "company_id", 'id');
    }
}
