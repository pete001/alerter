<?php namespace Pete001\Alerter\Services\Chat;

use Pete001\Alerter\AlertInterface;

interface ChatAlertInterface extends AlertInterface
{
    public function getUser();

    public function getChannel();
}
