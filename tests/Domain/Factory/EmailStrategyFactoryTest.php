<?php namespace Pete001\Alerter;

use Pete001\Alerter\Domain\Factory\EmailStrategyFactory;
use Pete001\Alerter\Domain\Factory\StrategyFactory;
use Pete001\Alerter\Domain\Entity\Alert;
use Pete001\Alerter\Domain\Entity\AlertGroup;

class EmailStrategyFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Ensure that an email alert group returns the correct factory
     */
    public function testSwiftEmailStrategyFactory()
    {
        $strategy = new StrategyFactory();
        $group = $strategy->initialise(new AlertGroup(['title' => 'email']));
        $service = $group->create(new Alert(['title' => 'swift']));
        $this->isTrue($service instanceof SwiftStrategy);
    }

    /**
     * Ensure that an email alert group returns the correct factory
     */
    public function testSendmailEmailStrategyFactory()
    {
        $strategy = new StrategyFactory();
        $group = $strategy->initialise(new AlertGroup(['title' => 'email']));
        $service = $group->create(new Alert(['title' => 'sendmail']));
        $this->isTrue($service instanceof SendmailStrategy);
    }

    /**
     * Ensure that an invalid alert group returns an exception
     */
    public function testInvalidStrategyFactory()
    {
        $this->setExpectedException('ErrorException');

        $strategy = new StrategyFactory();
        $group = $strategy->initialise(new AlertGroup(['title' => 'email']));
        $service = $group->create(new Alert(['title' => 'invalid']));
    }
}
