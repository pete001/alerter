<?php namespace Pete001\Alerter;

use Pete001\Alerter\Domain\Factory\ChatStrategyFactory;
use Pete001\Alerter\Domain\Factory\StrategyFactory;
use Pete001\Alerter\Domain\Entity\Alert;
use Pete001\Alerter\Domain\Entity\AlertGroup;

class ChatStrategyFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Ensure that a chat alert group returns the correct factory
     */
    public function testSlackChatStrategyFactory()
    {
        $strategy = new StrategyFactory();
        $group = $strategy->initialise(new AlertGroup(['title' => 'chat']));
        $service = $group->create(new Alert(['title' => 'slack']));
        $this->isTrue($service instanceof SlackStrategy);
    }

    /**
     * Ensure that an invalid alert group returns an exception
     */
    public function testInvalidStrategyFactory()
    {
        $this->setExpectedException('ErrorException');

        $strategy = new StrategyFactory();
        $group = $strategy->initialise(new AlertGroup(['title' => 'chat']));
        $service = $group->create(new Alert(['title' => 'invalid']));
    }
}
