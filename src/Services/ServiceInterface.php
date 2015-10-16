<?php namespace Pete001\Alerter\Services;

use Pete001\Alerter\AlertInterface;

interface ServiceInterface
{
    public function shouldService(AlertInterface $alert);

    public function service(AlertInterface $alert);
}
