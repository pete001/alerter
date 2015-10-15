<?php namespace Pete001\Alerter\Services\Email\SwiftMailer;

use Pete001\Alerter\Alert;
use Pete001\Alerter\AlertInterface;
use Pete001\Alerter\Services\Email\EmailAlert;

class SwiftMailerAlert extends EmailAlert implements AlertInterface, SwiftMailerAlertInterface
{
}
