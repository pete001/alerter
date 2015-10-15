<?php namespace Pete001\Alerter\Services\Sms;

use Pete001\Alerter\Alert;

class SmsAlert extends Alert implements SmsAlertInterface
{
    protected $from;
    protected $to;

    public function __construct($message, $from, $to, array $config = [])
    {
        parent::__construct($message, $config);

        $this->from = $from;
        $this->to = $to;
    }

    public function getSmsFromNumber()
    {
        return $this->from;
    }

    public function getSmsToNumber()
    {
        return $this->to;
    }
}
