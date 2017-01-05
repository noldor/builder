<?php


namespace Noldors\Builder\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Session\Store;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Event;
use Noldors\Builder\Elements\Elements;

/**
 * If your input fields have specific css classes in error state you should include this provider in your config app.php and make changes in config builder.php
 *
 * @package Noldors\Builder\Providers
 * @author  Dmitriy Romanov <romanov@noldor.pro>
 */
class BuilderEventsServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Noldors\Builder\Events\Validation' => [
            'Noldors\Builder\Listeners\ValidationCheck',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Container::getInstance()->make(Dispatcher::class)->listen('admin.form.validate', function (Store $session, Elements $fields) {
            foreach ($session->get('errors')->getBag('default')->keys() as $error) {
                $fields->get($error)->setHtmlAttributes(config('builder.field_error_place'),
                    config('builder.field_with_errors'));
            }
        });
    }
}