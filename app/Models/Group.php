<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    protected $appends = [
        'name_by_locale',
    ];

    public function getNameByLocaleAttribute()
    {
        if (app()->getLocale() == 'en') {
            return $this->name_en;
        } elseif (app()->getLocale() == 'ar') {
            return $this->name_ar;
        }
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, GroupUser::class);
    }

}
