<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Define which assets will be available through the asset manager
    |--------------------------------------------------------------------------
    | These assets are registered on the asset manager
    */
    'media-partial-assets'          => [
        'vue.min.js'                     => ['module' => 'guestbook:js/vue/vue.min.js'],
        'vue-resource.min.js'            => ['module' => 'guestbook:js/vue/vue-resource.min.js'],
        'jasny-bootstrap.min.css'        => ['module' => 'guestbook:css/jasny-bootstrap.min.css'],
        'jasny-bootstrap.min.js'         => ['module' => 'guestbook:js/jasny-bootstrap.min.js'],
        'loadingoverlay.min.js'          => ['module' => 'guestbook:js/loadingoverlay.min.js'],
        'loadingoverlay_progress.min.js' => ['module' => 'guestbook:js/loadingoverlay_progress.min.js'],
        'guestbook.js'                   => ['module' => 'guestbook:js/guestbook.js']
    ],

    /*
    |--------------------------------------------------------------------------
    | Define which default assets will always be included in your pages
    | through the asset pipeline
    |--------------------------------------------------------------------------
    */
    'media-partial-required-assets' => [
        'css' => [
            'jasny-bootstrap.min.css'
        ],
        'js' => [
            'vue.min.js',
            'vue-resource.min.js',
            'jasny-bootstrap.min.js',
            'loadingoverlay.min.js',
            'loadingoverlay_progress.min.js',
            'guestbook.js'
        ],
    ],
];
