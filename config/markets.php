<?php

return [
    'default_locale' => 'eu-en',
    'supported_locales' => [
        'eu-en', 'eu-de', 'eu-fr', 'eu-dk', 'eu-pl', 'eu-nl', 'eu-es',
        'ae-en', 'ae-ar',
        'ng-en',
        'cm-fr', 'cm-en',
        'sa-ar', 'sa-en',
        'in-en',
        'tr-tr',
    ],
    'markets' => [
        'eu' => [
            'default' => 'eu-en',
            'languages' => ['en', 'de', 'fr', 'dk', 'pl', 'nl', 'es'],
        ],
        'ae' => [
            'default' => 'ae-en',
            'languages' => ['en', 'ar'],
        ],
        'ng' => [
            'default' => 'ng-en',
            'languages' => ['en'],
        ],
        'cm' => [
            'default' => 'cm-fr',
            'languages' => ['fr', 'en'],
        ],
        'sa' => [
            'default' => 'sa-ar',
            'languages' => ['ar', 'en'],
        ],
        'in' => [
            'default' => 'in-en',
            'languages' => ['en'],
        ],
        'tr' => [
            'default' => 'tr-tr',
            'languages' => ['tr'],
        ],
    ],
    'country_to_locale' => [
        'DE' => 'eu-de',
        'FR' => 'eu-fr',
        'DK' => 'eu-dk',
        'PL' => 'eu-pl',
        'NL' => 'eu-nl',
        'ES' => 'eu-es',
        'AT' => 'eu-de',
        'BE' => 'eu-fr',
        'IT' => 'eu-en',
        'IE' => 'eu-en',
        'PT' => 'eu-es',
        'SE' => 'eu-en',
        'NO' => 'eu-en',
        'FI' => 'eu-en',
        'CZ' => 'eu-en',
        'AE' => 'ae-ar',
        'NG' => 'ng-en',
        'CM' => 'cm-fr',
        'SA' => 'sa-ar',
        'IN' => 'in-en',
        'TR' => 'tr-tr',
    ],
];
