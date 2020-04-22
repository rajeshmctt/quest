<?php
/**
 * Created by PhpStorm.
 * User: Priyanka
 * Date: 04-06-2016
 * Time: 17:01
 */

namespace backend\models\enums;


class AssignmentStatusTypes {
    const INACTIVE = 0;
    const END_BY_COACH = 5;
    const AC = 10;

    public static $constants = [
        'inactive' => self::INACTIVE,
        'end_by_coach' => self::END_BY_COACH,
        'active' => self::AC
    ];

    public static $titles = [
        self::INACTIVE => 'Inactive',
        self::END_BY_COACH => 'End by Coach',
        self::AC => 'Active'
    ];

    public static $headers = [
        self::INACTIVE => 'Inactive',
        self::END_BY_COACH => 'End by Coach',
        self::AC => 'Active'
    ];
}