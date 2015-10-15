<?php namespace Pete001\Alerter\Services\Slack;

use Pete001\Alerter\AlertInterface;

interface SlackAlertInterface extends AlertInterface
{
    public function getSlackUser();

    public function getSlackChannel();
}
