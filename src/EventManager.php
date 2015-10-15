<?php namespace Pete001\Alerter;

use Pete001\Alerter\Services\Service\ServiceInterface;

/**
 * The event manager will send an alert to all relevant services
 */
class EventManager implements EventManagerInterface
{
    protected $services = [];

    public function __construct(array $services = [])
    {
        $this->services = $services;
    }

    public function launch(AlertInterface $alert)
    {
        foreach ($this->getServices() as $service) {
            if ($service->shouldService($alert)) {
                return false === $service->service($alert);
            }
        }

        return true;
    }

    public function getServices()
    {
        return $this->services;
    }

    public function addService(ServiceInterface $service)
    {
        $this->services[] = $service;
    }
}
