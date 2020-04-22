<?php
/**
 * Created by PhpStorm.
 * User: Priyanka
 * Date: 02-06-2016
 * Time: 13:29
 */

namespace backend\models\enums;


class SessionStatusTypes {
    const NO_STATUS = 0;
    const SCHEDULED = 1;
    const COMPLETED = 2;
    const CANCELLED = 3;
    const PAID_CANCELLED = 4;

    public static $constants = [
        'no_status' => self::NO_STATUS,
        'scheduled' => self::SCHEDULED,
        'completed' => self::COMPLETED,
        'cancelled' => self::CANCELLED,
        'paid_cancelled' => self::PAID_CANCELLED
    ];

    public static $titles = [
        self::NO_STATUS => 'No Status',
        self::SCHEDULED => 'Scheduled',
        self::COMPLETED => 'Completed',
        self::CANCELLED => 'Cancelled',
        self::PAID_CANCELLED => 'Paid Cancelled'
    ];

    public static $headers = [
        self::NO_STATUS => 'No Status',
        self::SCHEDULED => 'Scheduled',
        self::COMPLETED => 'Completed',
        self::CANCELLED => 'Cancelled',
        self::PAID_CANCELLED => 'Paid Cancelled'
    ];
}