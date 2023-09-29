<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory, HasUuids;

    // table name
    protected $table = "challenges";

    //  The attributes that are mass assignable.
    protected $fillable = [
        "charity_id"
    ];
}
