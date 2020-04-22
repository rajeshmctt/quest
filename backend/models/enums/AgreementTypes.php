<?php
/**
 * Created by PhpStorm.
 * User: Priyanka
 * Date: 15-12-2015
 * Time: 11:45
 */

namespace backend\models\enums;


class AgreementTypes {
    const COACH = 1;
    const CLIENT = 2;
    const PARTICIPANT = 3;

    public static $constants = [
        'coach' => self::COACH,
        'client' => self::CLIENT,
        'participant' => self::PARTICIPANT,
    ];

    public static $titles = [
        self::COACH => 'Coach',
        self::CLIENT => 'Client',
        self::PARTICIPANT => 'Participant'
    ];

    public static $headers = [
        self::COACH => 'Coach Agreement',
        self::CLIENT => 'Client Agreement',
        self::PARTICIPANT => 'Participant Agreement'
    ];
}