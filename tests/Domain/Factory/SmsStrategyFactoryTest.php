<?php namespace Pete001\Alerter;

use Pete001\Alerter\Domain\Factory\SmsStrategyFactory;
use Pete001\Alerter\Domain\Factory\StrategyFactory;
use Pete001\Alerter\Domain\Entity\Alert;
use Pete001\Alerter\Domain\Entity\AlertGroup;

class SmsStrategyFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Ensure that an sms alert group returns the correct factory
     */
    public function testTwilioSmsStrategyFactory()
    {
        $strategy = new StrategyFactory();
        $group = $strategy->initialise(new AlertGroup(['title' => 'sms']));
        $service = $group->create(new Alert(['title' => 'twilio']));
        $this->isTrue($service instanceof TwilioStrategy);
    }

    /**
     * Ensure that an invalid alert group returns an exception
     */
    public function testInvalidStrategyFactory()
    {
        $this->setExpectedException('ErrorException');

        $strategy = new StrategyFactory();
        $group = $strategy->initialise(new AlertGroup(['title' => 'sms']));
        $service = $group->create(new Alert(['title' => 'invalid']));
    }
}
