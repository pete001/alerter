<?php require dirname(__DIR__) . '/vendor/autoload.php';

use Pete001\Alerter\Domain\Factory\StrategyFactory;
use Pete001\Alerter\Domain\Entity\Alert;
use Pete001\Alerter\Domain\Entity\AlertGroup;

$strategy = new StrategyFactory();
$group = $strategy->initialise(new AlertGroup(['title' => 'chat']));
$service = $group->create(new Alert(['title' => 'slack']));
$result = $service->send();
