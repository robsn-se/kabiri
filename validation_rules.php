<?php
const VALIDATION_RULES = [
    "authorization" => [
        "login" => [
            "required" => true,
            "pattern" => "/[a-zA-Z\d\-_]{2,50}/",
        ],
        "password" => [
            "required" => true,
            "pattern" => "/[a-zA-Z\d\-_]{2,30}/",
        ]
    ],
    "registration" => [
        "email" => [
            "required" => true,
            "pattern" => "/[a-z\d\-_]{2,100}@[a-z\d\-_]{2,30}\.[a-z]{2,10}/",
        ],
        "login" => [
            "required" => true,
            "pattern" => "/[a-zA-Z\d\-_]{2,50}/",
        ],
        "birthday" => [
            "required" => true,
            "pattern" => "/[0-9]{4}-[0-9]{2}-[0-9]{2}/",
        ],
        "password" => [
            "required" => true,
            "pattern" => "/[a-zA-Z\d\-_]{2,30}/"
        ]
    ],
    "cabinet_exit" => [],
];