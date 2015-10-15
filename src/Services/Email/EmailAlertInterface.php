<?php namespace Pete001\Alerter\Services\Email;

use Pete001\Alerter\AlertInterface;

interface EmailAlertInterface extends AlertInterface
{
    public function getRecipientAddresses();
}
