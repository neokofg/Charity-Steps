<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    //  The attributes that are mass assignable.
    protected $fillable = [
        'name',
        'surname',
        'sex',
        'email',
        'password',
        'stepcoins_value',
        'is_email_verified',
        'description'
    ];

    // The attributes that should be hidden for serialization.
    protected $hidden = [
        'password',
    ];

    // The attributes that should be cast.
    protected $casts = [
        'password' => 'hashed',
    ];
    // returns Avatar model, that have url for image
    public function avatar(): HasOne
    {
        return $this->hasOne(Avatar::class,"user_id",'id');
    }

    // returns History model, that have url for image
    public function histories(): HasMany
    {
        return $this->hasMany(History::class,"user_id",'id');
    }

    // return Charity models
    public function charities(): BelongsToMany
    {
        return $this->belongsToMany(Charity::class, "charity_users");
    }

    // return Company models
    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, "company_users");
    }

    // return Admin model
    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class, "user_id",'id');
    }

    // return Team models
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class,'team_users');
    }

    public function isCompanyUser($id): Bool
    {
        if($this->companies->where("id",'=',$id)->count() > 0){
            return true;
        } else {
            return false;
        }
    }

    public function isCharityUser($id): Bool
    {
        if($this->charities->where("id",'=',$id)->count() > 0){
            return true;
        } else {
            return false;
        }
    }

    public function isAdmin(): Bool
    {
        if($this->admin()->exists()){
            return true;
        } else return false;
    }
}
