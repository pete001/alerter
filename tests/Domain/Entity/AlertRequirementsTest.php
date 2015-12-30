<?php namespace Pete001\Alerter;

use Pete001\Alerter\Domain\Entity\AbstractMotherEntity;
use Pete001\Alerter\Domain\Entity\AlertRequirements;

class AlertRequirementsTest extends \PHPUnit_Framework_TestCase
{
    public function testAlertRequirementsSetGet()
    {
        $set = [
            'title' => 'API Key',
            'short_description' => 'The Slack API Key for your channel',
            'required' => 1
        ];

        $alertRequirementsEntity = new AlertRequirements($set);
        foreach ($set as $key => $value) {
            $this->assertEquals($value, $alertRequirementsEntity->$key);
        }
    }
}
