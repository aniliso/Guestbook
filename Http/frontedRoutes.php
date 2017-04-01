<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>''], function (Router $router) {
    $router->get(LaravelLocalization::transRoute('guestbook::routes.comment.index'), [
        'uses' => 'PublicController@index',
        'as'   => 'guestbook.comment.index'
    ]);
    $router->get(LaravelLocalization::transRoute('guestbook::routes.comment.form'), [
        'uses' => 'PublicController@form',
        'as'   => 'guestbook.comment.form'
    ]);
    $router->post(LaravelLocalization::transRoute('guestbook::routes.comment.add'), [
        'uses' => 'PublicController@addComment',
        'as'   => 'guestbook.comment.add'
    ]);
    $router->get('guestbook/comment/approve/{code}', [
        'uses' => 'PublicController@approve',
        'as'   => 'guestbook.comment.approve'
    ]);
});