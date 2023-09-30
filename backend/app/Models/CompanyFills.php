<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyFills extends Model
{
    use HasFactory, HasUuids;

    protected $table = "company_fills";

    protected $fillable = [
        "amount",
        "expDate",
        "company_id",
        "user_id",
        "status"
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class,"company_id","id");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,"user_id","id");
    }
}
