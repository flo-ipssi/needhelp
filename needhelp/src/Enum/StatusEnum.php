<?php

namespace App\Enum;

class StatusEnum {
    const STATUS_PENDING = 'en attente';
    const STATUS_APPROVED = 'en cours';
    const STATUS_ACCEPTED = 'acceptée';
    const STATUS_REFUSED = 'refusée';

    public static $status = [
        self::STATUS_PENDING,
        self::STATUS_APPROVED,
        self::STATUS_ACCEPTED,
        self::STATUS_REFUSED
    ];
}