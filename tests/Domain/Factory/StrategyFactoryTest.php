<?php namespace Pete001\Alerter;

use Pete001\Alerter\Domain\Factory\ChatStrategyFactory;
use Pete001\Alerter\Domain\Factory\StrategyFactory;
use Pete001\Alerter\Domain\Entity\Alert;
use Pete001\Alerter\Domain\Entity\AlertGroup;

class StrategyFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Ensure that a chat alert group returns the correct factory
     */
    public function testChatStrategyFactory()
    {
        $strategy = new StrategyFactory();
        $group = $strategy->initialise(new AlertGroup(['title' => 'chat']));
        $this->isTrue($group instanceof ChatStrategyFactory);
    }

    /**
     * Ensure that an sms alert group returns the correct factory
     */
    public function testSmsStrategyFactory()
    {
        $strategy = new StrategyFactory();
        $group = $strategy->initialise(new AlertGroup(['title' => 'sms']));
        $this->isTrue($group instanceof SmsStrategyFactory);
    }

    /**
     * Ensure that an email alert group returns the correct factory
     */
    public function testEmailStrategyFactory()
    {
        $strategy = new StrategyFactory();
        $group = $strategy->initialise(new AlertGroup(['title' => 'email']));
        $this->isTrue($group instanceof EmailStrategyFactory);
    }

    /**
     * Ensure that an invalid alert group returns an exception
     */
    public function testInvalidStrategyFactory()
    {
        $this->setExpectedException('ErrorException');

        $strategy = new StrategyFactory();
        $group = $strategy->initialise(new AlertGroup(['title' => 'invalid']));
    }
}
