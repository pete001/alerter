<?php namespace Pete001\Alerter\Services\Service;

use Pete001\Alerter\Services\Chat\ChatAlertInterface;
use Pete001\Alerter\Services\ServiceInterface;
use Pete001\Alerter\AlertInterface;
use Maknz\Slack\Client as SlackClient;

class Slack implements ServiceInterface
{
    protected $slack;

    public function __construct(SlackClient $slack)
    {
        $this->slack = $slack;
    }

    public function service(AlertInterface $alert)
    {
        return $this->slack
            ->from($alert->getUser())
            ->to($alert->getChannel())
            ->send($alert->getPayload());
    }

    public function shouldService(AlertInterface $alert)
    {
        return $alert instanceof ChatAlertInterface;
    }

    public function getSlack()
    {
        return $this->slack;
    }
}
