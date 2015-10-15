<?php namespace Pete001\Alerter\Services\Chat;

use Pete001\Alerter\Alert;

class ChatAlert extends Alert implements ChatAlertInterface
{
    protected $user;
    protected $channel;

    public function __construct($message, $user, $channel, array $config = [])
    {
        parent::__construct($message, $config);

        $this->user = $user;
        $this->channel = $channel;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getChannel()
    {
        return $this->channel;
    }
}
