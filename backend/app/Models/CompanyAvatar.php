<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyAvatar extends Model
{
    use HasFactory, HasUuids;

    protected $table = "company_avatars";

    protected $fillable = [
        "url",
        "url_128",
        "url_256",
        "url_512",
        "url_1024",
        "company_id"
    ];

    protected $hidden = [
        'company_id',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, "user_id", "id");
    }
}
