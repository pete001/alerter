<?php namespace Pete001\Alerter\Services\Service;

use Pete001\Alerter\Services\Sms\SmsAlertInterface;
use Pete001\Alerter\AlertInterface;

class Twilio implements ServiceInterface
{
    protected $sms;

    public function __construct(\Services_Twilio $sms)
    {
        $this->sms = $sms;
    }

    public function service(AlertInterface $alert)
    {
        return $this->sms->account->messages->sendMessage(
            $alert->getSmsFromNumber(),
            $alert->getSmsToNumber(),
            $alert->getPayload()
        );
    }

    public function shouldService(AlertInterface $alert)
    {
        return $alert instanceof SmsAlertInterface;
    }

    public function getSms()
    {
        return $this->sms;
    }
}
