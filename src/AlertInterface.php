<?php namespace Pete001\Alerter;

interface AlertInterface
{
    public function getConfig();

    public function getPayload();
}
