<?php
/**
 * Created by PhpStorm.
 * User: Priyanka
 * Date: 15-12-2015
 * Time: 11:45
 */

namespace backend\models\enums;


class UserTypes {
    const SUPER_ADMIN = 1;
    const ORGANIZATION = 2;
    const COACH = 3;
    const CLIENT = 4;
    const PARTICIPANT = 5;
    const FACULTY = 6;
	
	//status for participant
	const ADD_TO_SYS1 = 10;
    const ADD_TO_BATCH1 = 11;
    const ASN_ADDED = 12;
    const ASN_RESUBSN = 13;
    const ASN_APPR = 14;
    const RES_ADDED = 15;
    const CERT_UPLD1 = 16;
	
	//status for faculty
	const ADD_TO_SYS2 = 20;
    const ADD_TO_PROG = 21;
    const ADD_TO_BATCH2 = 22;
    const DEACT = 23;
    const ASN_UP_ST = 24;
    const ASN_RESUBTD = 25;
    const CERT_UPLD2 = 26;

    public static $constants = [
        'super_admin' => self::SUPER_ADMIN,
        'organization' => self::ORGANIZATION,
        'coach' => self::COACH,
        'client' => self::CLIENT,
        'participant' => self::PARTICIPANT,
        'faculty' => self::FACULTY,
    ];

    public static $titles = [
        self::SUPER_ADMIN => 'super_admin',
        self::ORGANIZATION => 'organization',
        self::COACH => 'coach',
        self::CLIENT => 'client',
        self::PARTICIPANT => 'participant',
        self::FACULTY => 'faculty',
    ];

    public static $headers = [
        self::SUPER_ADMIN => 'Super Admin',
        self::ORGANIZATION => 'Organization',
        self::COACH => 'Coach',
        self::CLIENT => 'Client',
        self::PARTICIPANT => 'Participant',
        self::FACULTY => 'Faculty',
    ];

    public static $users = [
        // self::SUPER_ADMIN => 'Super Admin',
        // self::ORGANIZATION => 'Organization',
        // self::COACH => 'Coach',
        // self::CLIENT => 'Client',
        self::PARTICIPANT => 'Participant',
        self::FACULTY => 'Faculty',
    ];
	
	public static $events1 = [
		self::ADD_TO_SYS1 => 'New Participant added',
		self::ADD_TO_BATCH1 => 'Participant added to batch',
		self::ASN_ADDED => 'New Assignment added',
		self::ASN_RESUBSN => 'Resubmit assignment',
		self::ASN_APPR => 'Assignment approved',
		self::RES_ADDED => 'Resource added',
		self::CERT_UPLD1 => 'Certificate uploaded'
	];
	
	public static $events2 = [
		self::ADD_TO_SYS2 => 'New Faculty added',
		self::ADD_TO_PROG => 'Faculty added to program',
		self::ADD_TO_BATCH2 => 'Faculty added to batch',
		self::DEACT => 'Faculty Deactivated',
		self::ASN_UP_ST => 'Assignment uploaded by Participant',
		self::ASN_RESUBTD => 'Assignment resubmitted by Participant',
		self::CERT_UPLD2 => 'Certificate uploaded',
	];
	
}