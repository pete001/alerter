<?php require dirname(__DIR__) . '/vendor/autoload.php';

use Pete001\Alerter\EventManager;
use Pete001\Alerter\Services\Service\Twilio;
use Pete001\Alerter\Services\Sms\SmsAlert;

// Initialise the service and register into the event manager
$manager = new EventManager();
$manager->addService(
    new Twilio(
        new Services_Twilio('ACb749a35779ff0146f420d8380cf73979', 'a3d45e56dfa14dd8c7c5617db278459d')
    )
);

// Required param of the recipient
$manager->launch(new SmsAlert('testing', '441325952018', '447752513731'));
