<?php

namespace App\Models;

use App\Constants\InvitationConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
}
