<?php namespace Pete001\Alerter;

use Pete001\Alerter\Domain\Entity\AbstractMotherEntity;
use Pete001\Alerter\Domain\Entity\AlertRequirement;

class AlertRequirementTest extends \PHPUnit_Framework_TestCase
{
    public function testAlertRequirementSetGet()
    {
        $set = [
            'title' => 'API Key',
            'short_description' => 'The Slack API Key for your channel',
            'required' => 1
        ];

        $alertRequirementEntity = new AlertRequirement($set);
        foreach ($set as $key => $value) {
            $this->assertEquals($value, $alertRequirementEntity->$key);
        }
    }
}
