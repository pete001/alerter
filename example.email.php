<?php require __DIR__ . '/vendor/autoload.php';

use Pete001\Alerter\EventManager;
use Pete001\Alerter\Services\Service\SwiftMailer as SwiftMailerService;
use Pete001\Alerter\Services\Email\SwiftMailer\SwiftMailerAlert;

// Set up swift
$instance = Swift_SmtpTransport::newInstance('smtp.gmail.com', '465', 'ssl');
$instance->setUsername('pete.cheyne@gmail.com');
$instance->setPassword('');

$swift = Swift_Mailer::newInstance($instance);

// Generate the payload
$payload = new Swift_Message();
$payload->setTo('pete.cheyne@gmail.com');
$payload->setFrom('pete.cheyne@gmail.com');
$payload->setSubject('DDD Email');
$payload->setBody('Hello, isnt this fancy?!');

// Required param of the recipient
$alert = new SwiftMailerAlert(['pete.cheyne@gmail.com']);
$alert->setPayload($payload);

// Initialise the service and register into the event manager
$manager = new EventManager();
$manager->addService(new SwiftMailerService($swift));

// Launch the alert
$manager->launch($alert);
