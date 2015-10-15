<?php namespace Pete001\Alerter;

class Alert implements AlertInterface
{
    protected $config = [];
    protected $payload;

    public function __construct($payload, array $config = [])
    {
        $this->payload = $payload;
        $this->config = $config;
    }

    public function getPayload()
    {
        return $this->payload;
    }

    public function setPayload($payload)
    {
        $this->payload = $payload;
    }

    public function getConfig()
    {
        return $this->config;
    }
}
