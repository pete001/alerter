<?php namespace Pete001\Alerter\Services\Email;

use Pete001\Alerter\Alert;

class EmailAlert extends Alert implements EmailAlertInterface
{
    protected $recipientAddresses = [];

    public function __construct($recipientAddresses, array $config = [])
    {
        $this->recipientAddresses = is_array($recipientAddresses) ? $recipientAddresses : [$recipientAddresses];
        $this->config = $config;
    }

    public function getRecipientAddresses()
    {
        return $this->recipientAddresses;
    }
}
