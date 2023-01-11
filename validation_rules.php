<?php
const EMAIL_PATTERN = "/[a-z\d\-_]{2,100}@[a-z\d\-_]{2,30}\.[a-z]{2,10}/";
const LOGIN_PATTERN = "/[a-zA-Z\d\-_]{2,50}/";
const BIRTHDAY_PATTERN = "/[0-9]{4}-[0-9]{2}-[0-9]{2}/";
const PASSWORD_PATTERN = "/[a-zA-Z\d\-_]{2,30}/";

const VALIDATION_RULES = [
    "authorization" => [
        "login" => [
            "required" => true,
            "pattern" => LOGIN_PATTERN,
        ],
        "password" => [
            "required" => true,
            "pattern" => PASSWORD_PATTERN,
        ]
    ],
    "registration" => [
        "email" => [
            "required" => true,
            "pattern" => EMAIL_PATTERN,
        ],
        "login" => [
            "required" => true,
            "pattern" => LOGIN_PATTERN,
        ],
        "birthday" => [
            "required" => true,
            "pattern" => BIRTHDAY_PATTERN,
        ],
        "password" => [
            "required" => true,
            "pattern" => PASSWORD_PATTERN
        ]
    ],
    "cabinet_exit" => [],
    "setting" => [
        "email" => [
            "pattern" => EMAIL_PATTERN,
        ],
        "login" => [
            "pattern" => LOGIN_PATTERN,
        ],
        "birthday" => [
            "pattern" => BIRTHDAY_PATTERN,
        ],
        "password" => [
            "pattern" => PASSWORD_PATTERN
        ]
    ]
];