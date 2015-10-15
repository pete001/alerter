<?php namespace Pete001\Alerter\Services\Service;

use Pete001\Alerter\Services\Email\SwiftMailer\SwiftMailerAlertInterface;
use Pete001\Alerter\Services\Email\SwiftMailerAlert;
use Pete001\Alerter\AlertInterface;

class SwiftMailer extends Email
{
    protected $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function service(AlertInterface $alert)
    {
        $this->getMailer()->send($alert->getPayload());
        return true;
    }

    public function shouldService(AlertInterface $alert)
    {
        return $alert instanceof SwiftMailerAlertInterface;
    }

    public function getMailer()
    {
        return $this->mailer;
    }
}
