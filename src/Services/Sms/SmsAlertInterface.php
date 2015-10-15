<?php namespace Pete001\Alerter\Services\Sms;

use Pete001\Alerter\AlertInterface;

interface SmsAlertInterface extends AlertInterface
{
    public function getSmsFromNumber();

    public function getSmsToNumber();
}
