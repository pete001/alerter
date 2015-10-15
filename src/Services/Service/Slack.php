<?php namespace Pete001\Alerter\Services\Service;

use Pete001\Alerter\Services\Slack\SlackAlertInterface;
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
            ->from($alert->getSlackUser())
            ->to($alert->getSlackChannel())
            ->send($alert->getPayload());
    }

    public function shouldService(AlertInterface $alert)
    {
        return $alert instanceof SlackAlertInterface;
    }

    public function getSlack()
    {
        return $this->slack;
    }
}
