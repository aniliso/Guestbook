<?php

return [
    'email' => [
        'description'  => 'guestbook::guestbook.settings.email',
        'view'         => 'text',
        'translatable' => false,
    ],
    'per_page' => [
        'description'  => 'guestbook::guestbook.settings.per_page',
        'view'         => 'text',
        'translatable' => false,
        'default'      => 10
    ]
];
