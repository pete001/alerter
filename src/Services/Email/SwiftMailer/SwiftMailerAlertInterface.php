<?php namespace Pete001\Alerter\Services\Email\SwiftMailer;

use Pete001\Alerter\AlertInterface;

interface SwiftMailerAlertInterface extends AlertInterface
{
    public function getPayload();
}
