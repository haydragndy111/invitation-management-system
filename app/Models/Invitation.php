<?php

namespace App\Models;

use App\Constants\InvitationConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'survey_id',
        'group_id',
        'email',
        'status',
        'num_of_sends',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', InvitationConstants::STATUS_COMPLETED);
    }

    public function scopeOpened($query)
    {
        return $query->where('status', InvitationConstants::STATUS_OPENED);
    }

    public function scopeActive($query)
    {
        return $query->where('status', InvitationConstants::STATUS_INACTIVE);
    }

}
