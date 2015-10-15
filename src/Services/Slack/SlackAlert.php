<?php namespace Pete001\Alerter\Services\Slack;

use Pete001\Alerter\Alert;

class SlackAlert extends Alert implements SlackAlertInterface
{
    protected $user;
    protected $channel;

    public function __construct($message, $user, $channel, array $config = [])
    {
        parent::__construct($message, $config);

        $this->user = $user;
        $this->channel = $channel;
    }

    public function getSlackUser()
    {
        return $this->user;
    }

    public function getSlackChannel()
    {
        return $this->channel;
    }
}
