<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyInvites extends Model
{
    use HasFactory, HasUuids;

    protected $table = "company_invites";

    protected $fillable = [
        "hash",
        "company_id"
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class,"company_id", "id");
    }
}
