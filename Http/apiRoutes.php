<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => 'v1/guestbook'], function (Router $router) {
    $router->get('/form', [
        'uses'       => 'V1\PublicController@commentForm',
        'as'         => 'api.guestbook.comment.form',
        'middleware' => ['web']
    ]);
    $router->post('/add', [
        'uses'       => 'V1\PublicController@addComment',
        'as'         => 'api.guestbook.comment.add',
    ]);
});