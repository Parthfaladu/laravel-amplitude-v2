<?php

namespace Faladu\Amplitude\Providers;

use Illuminate\Console\Events\CommandFinished;
use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Support\ServiceProvider;
use Faladu\Amplitude\Amplitude;
use Faladu\Amplitude\AmplitudeFactory;
use Faladu\Amplitude\Drivers\AmplitudeDriver;
use Faladu\Amplitude\Drivers\LogDriver;
use Faladu\Amplitude\Events\SendQueuedEvents;
use Faladu\Amplitude\Services\AmplitudeService;

class LaravelAmplitudeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/amplitude.php' => config_path('amplitude.php'),
        ]);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(Amplitude::class, function () {
            $amplitudeDriver = new AmplitudeDriver(AmplitudeService::getInstance());
            $amplitudeDriver->init(config('amplitude.api_key'));

            $factory = new AmplitudeFactory([
                $amplitudeDriver,
                $this->app->make(LogDriver::class)
            ]);

            return $factory->makeFor(config('amplitude.driver', 'amplitude'));
        });

        /** @var Dispatcher $eventDispatcher */
        $eventDispatcher = app()->make(Dispatcher::class);
        $eventDispatcher->listen(SendQueuedEvents::class, function () {
            /** @var Amplitude $amplitude */
            $amplitude = app()->make(Amplitude::class);
            $amplitude->sendQueuedEvents();
        });

        $eventDispatcher->listen([RequestHandled::class, CommandFinished::class], function () {
            event(new SendQueuedEvents());
        });
    }
}
