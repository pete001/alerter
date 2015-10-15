<?php namespace Pete001\Alerter\Services\Service;

use Pete001\Alerter\AlertInterface;
use Pete001\Alerter\Services\Email\EmailAlertInterface;

abstract class Email implements ServiceInterface
{
    public function shouldService(AlertInterface $alert)
    {
        return $alert instanceof EmailAlertInterface;
    }
}
