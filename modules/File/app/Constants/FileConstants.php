<?php

namespace Modules\File\app\Constants;

class FileConstants
{

    const FILE_TYPE_DEFAULT = 'D';
    const FILE_TYPE_NATIONAL_CARD = 'NC';
    const FILE_TYPE_PROFILE = 'P';
    const FILE_TYPE_PRODUCT_IMAGE = 'PI';

    const FILE_TYPES_DETAILS = [
        self::FILE_TYPE_DEFAULT => [
            'directory' => 'Default',
            'is_public' => false,
            'replaceable' => false,
        ],
        self::FILE_TYPE_NATIONAL_CARD => [
            'directory' => 'NationalCard',
            'is_public' => false,
            'replaceable' => true,
        ],
        self::FILE_TYPE_PROFILE => [
            'directory' => 'Profile',
            'is_public' => false,
            'replaceable' => true,
        ],
        self::FILE_TYPE_PRODUCT_IMAGE => [
            'directory' => 'ProductImage',
            'is_public' => true,
            'replaceable' => false,
        ]
    ];

}
