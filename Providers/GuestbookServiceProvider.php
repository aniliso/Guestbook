<?php

namespace Modules\Guestbook\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Guestbook\Repositories\CommentRepository;

class GuestbookServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    public function boot()
    {
        $this->publishConfig('guestbook', 'permissions');
        $this->publishConfig('guestbook', 'assets');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Guestbook\Repositories\CommentRepository',
            function () {
                $repository = new \Modules\Guestbook\Repositories\Eloquent\EloquentCommentRepository(new \Modules\Guestbook\Entities\Comment());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Guestbook\Repositories\Cache\CacheCommentDecorator($repository);
            }
        );
// add bindings

    }
}
