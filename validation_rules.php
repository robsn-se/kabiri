<?php
const EMAIL_PATTERN = "/[a-z\d\-_]{2,100}@[a-z\d\-_]{2,30}\.[a-z]{2,10}/";
const LOGIN_PATTERN = "/[a-zA-Z\d\-_]{2,50}/";
const BIRTHDAY_PATTERN = "/[0-9]{4}-[0-9]{2}-[0-9]{2}/";
const PASSWORD_PATTERN = "/[a-zA-Z\d\-_]{2,30}/";
const SHORT_STRING = "/[a-zа-я0-9\d\-\s]{5,200}/iu";


const VALIDATION_RULES = [
    "authorization" => [
        VALIDATION_REQUEST_METHOD => "POST",
        VALIDATION_FIELDS_COUNT_CHECK => true,
        VALIDATION_FORM_FIELDS => [
            "login" => [
                VALIDATION_FIELD_REQUIRED => true,
                VALIDATION_FIELD_PATTERN => LOGIN_PATTERN,
            ],
            "password" => [
                VALIDATION_FIELD_REQUIRED => true,
                VALIDATION_FIELD_PATTERN => PASSWORD_PATTERN,
            ]
        ],
    ],
    "registration" => [
        VALIDATION_REQUEST_METHOD => "POST",
        VALIDATION_FIELDS_COUNT_CHECK => true,
        VALIDATION_FORM_FIELDS => [
            "email" => [
                VALIDATION_FIELD_REQUIRED => true,
                VALIDATION_FIELD_PATTERN => EMAIL_PATTERN,
            ],
            "login" => [
                VALIDATION_FIELD_REQUIRED => true,
                VALIDATION_FIELD_PATTERN => LOGIN_PATTERN,
            ],
            "birthday" => [
                VALIDATION_FIELD_REQUIRED => true,
                VALIDATION_FIELD_PATTERN => BIRTHDAY_PATTERN,
            ],
            "password" => [
                VALIDATION_FIELD_REQUIRED => true,
                VALIDATION_FIELD_PATTERN => PASSWORD_PATTERN
            ]
        ],
    ],
    "cabinet_exit" => [
        VALIDATION_REQUEST_METHOD => "POST",
    ],
    "setting" => [
        VALIDATION_REQUEST_METHOD => "POST",
        VALIDATION_FIELDS_COUNT_CHECK => true,
        VALIDATION_FORM_FIELDS => [
            "email" => [
                VALIDATION_FIELD_PATTERN => EMAIL_PATTERN,
            ],
            "login" => [
                VALIDATION_FIELD_PATTERN => LOGIN_PATTERN,
            ],
            "birthday" => [
                VALIDATION_FIELD_PATTERN => BIRTHDAY_PATTERN,
            ],
            "password" => [
                VALIDATION_FIELD_PATTERN => PASSWORD_PATTERN
            ]
        ],
    ],
    "add_action" => [
        VALIDATION_REQUEST_METHOD => "POST",
        VALIDATION_FIELDS_COUNT_CHECK => true,
        VALIDATION_FORM_FIELDS => [
            "title" => [
                VALIDATION_FIELD_REQUIRED => true,
                VALIDATION_FIELD_PATTERN => SHORT_STRING,
            ],
            "description" => [],
            "location" => [
                VALIDATION_FIELD_REQUIRED => true,
            ],
            "type" => [
                VALIDATION_FIELD_REQUIRED => true,
                VALIDATION_FIELD_PATTERN => SHORT_STRING,
            ],
        ],
    ],
    "get_action_by_id" => [
        VALIDATION_REQUEST_METHOD => "GET",
        VALIDATION_FIELDS_COUNT_CHECK => true,
        VALIDATION_FORM_FIELDS => [
            "action_id" => [
                VALIDATION_FIELD_EXISTENCE => true,
                VALIDATION_FIELD_REQUIRED => true,
            ]
        ]
    ]
];