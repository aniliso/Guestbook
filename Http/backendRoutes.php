<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/guestbook'], function (Router $router) {
    $router->bind('guestbookComment', function ($id) {
        return app('Modules\Guestbook\Repositories\CommentRepository')->find($id);
    });
    $router->get('comments', [
        'as' => 'admin.guestbook.comment.index',
        'uses' => 'CommentController@index',
        'middleware' => 'can:guestbook.comments.index'
    ]);
    $router->get('comments/create', [
        'as' => 'admin.guestbook.comment.create',
        'uses' => 'CommentController@create',
        'middleware' => 'can:guestbook.comments.create'
    ]);
    $router->post('comments', [
        'as' => 'admin.guestbook.comment.store',
        'uses' => 'CommentController@store',
        'middleware' => 'can:guestbook.comments.create'
    ]);
    $router->get('comments/{guestbookComment}/edit', [
        'as' => 'admin.guestbook.comment.edit',
        'uses' => 'CommentController@edit',
        'middleware' => 'can:guestbook.comments.edit'
    ]);
    $router->put('comments/{guestbookComment}', [
        'as' => 'admin.guestbook.comment.update',
        'uses' => 'CommentController@update',
        'middleware' => 'can:guestbook.comments.edit'
    ]);
    $router->delete('comments/{guestbookComment}', [
        'as' => 'admin.guestbook.comment.destroy',
        'uses' => 'CommentController@destroy',
        'middleware' => 'can:guestbook.comments.destroy'
    ]);
// append

});
