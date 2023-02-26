<?php

namespace Faladu\Amplitude\Drivers;

use Faladu\Amplitude\Services\AmplitudeService;

class AmplitudeDriver implements AmplitudeDriverInterface
{
    /** @var AmplitudeService */
    private $instance;

    /**
     * @param AmplitudeService $instance
     */
    public function __construct(AmplitudeService $instance)
    {
        $this->instance = $instance;
    }

    public function init($apiKey)
    {
        $this->instance->init($apiKey);
    }

    public function setUserId($userId)
    {
        $this->instance->setUserId($userId);
    }

    public function setUserProperties($userProperties)
    {
        $this->instance->setUserProperties($userProperties);
    }

    public function sendEvent($name, $properties)
    {
        $this->instance->logEvent(
            $name,
            $properties
        );
    }

    public function queueEvent($name, $properties)
    {
        $this->instance->queueEvent($name, $properties);
    }

    public function sendQueuedEvents()
    {
        $this->instance->logQueuedEvents();
    }

    public function getDriverName()
    {
        return 'amplitude';
    }
}
