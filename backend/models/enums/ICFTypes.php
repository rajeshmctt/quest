<?php
/**
 * Created by PhpStorm.
 * User: Priyanka
 * Date: 15-12-2015
 * Time: 11:45
 */

namespace backend\models\enums;


class ICFTypes {
    const ICF_ACC = 1;
    const ICF_PCC = 2;
    const ICF_MCC = 3;
    const NONE_FROM_ICF = 4;

    public static $constants = [
        'icf_acc' => self::ICF_ACC,
        'icf_pcc' => self::ICF_PCC,
        'icf_mcc' => self::ICF_MCC,
        'none_from_icf' => self::NONE_FROM_ICF
    ];

    public static $titles = [
        self::ICF_ACC => 'ICF ACC',
        self::ICF_PCC => 'ICF PCC',
        self::ICF_MCC => 'ICF MCC',
        self::NONE_FROM_ICF => 'None From ICF'
    ];

    public static $headers = [
        self::ICF_ACC => 'ICF ACC',
        self::ICF_PCC => 'ICF PCC',
        self::ICF_MCC => 'ICF MCC',
        self::NONE_FROM_ICF => 'None From ICF'
    ];
}