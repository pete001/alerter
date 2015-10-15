<?php namespace Pete001\Alerter;

interface EventManagerInterface
{
    public function launch(AlertInterface $alert);
}
