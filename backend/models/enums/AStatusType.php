<?php
/**
 * Created by PhpStorm.
 * User: Priyanka
 * Date: 04-06-2016
 * Time: 17:01
 */

namespace backend\models\enums;


class AssignmentStatusTypes {
    const PENDING = 0;
    const SUBMIT_NA = 5;
    const RESUBMIT = 10;
    const COMPLETED = 10;

    public static $constants = [
        'pending' => self::PENDING,
        'submit_n_a' => self::SUBMIT_NA,
        'resubmit' => self::RESUBMIT,
        'Completed' => self::COMPLETED
    ];

    public static $titles = [
        self::PENDING => 'Inactive',
        self::SUBMIT_NA => 'Submitted but Not Approved',
        self::RESUBMIT => 'Submitted but Not Approved',
        self::COMPLETED => 'Completed'
    ];

    public static $headers = [
        self::PENDING => 'Inactive',
        self::SUBMIT_NA => 'End by Coach',
        self::RESUBMIT => 'End by Coach',
        self::COMPLETED => 'Active'
    ];
}