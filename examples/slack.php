<?php require dirname(__DIR__) . '/vendor/autoload.php';

use Pete001\Alerter\EventManager;
use Pete001\Alerter\Services\Service\Slack;
use Pete001\Alerter\Services\Chat\ChatAlert;
use Maknz\Slack\Client;

// Initialise the service and register into the event manager
$manager = new EventManager();
$manager->addService(
    new Slack(
        new Maknz\Slack\Client('https://hooks.slack.com/services/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')
    )
);

// Required param of the recipient
$manager->launch(new ChatAlert('testing', 'pete.cheyne', '#hubot-dev'));
