<?php

namespace App\Constants;

class InvitationConstants
{
    // Course Status
    public const STATUS_INACTIVE = 1;
    public const STATUS_OPENED = 2;
    public const STATUS_COMPLETED = 3;

    public static function getStatuses()
    {
        return [
            self::STATUS_INACTIVE => 'inactive',
            self::STATUS_OPENED => 'opened',
            self::STATUS_COMPLETED => 'completed',
        ];
    }

}
