<?php namespace Pete001\Alerter;

use Pete001\Alerter\Domain\Entity\AbstractMotherEntity;
use Pete001\Alerter\Domain\Entity\Alert;

class AlertTest extends \PHPUnit_Framework_TestCase
{
    public function testAlertSetGet()
    {
        $set = [
            'title' => 'Slack',
            'short_description' => 'Slack is an instant messaging app'
        ];

        $alertEntity = new Alert($set);
        foreach ($set as $key => $value) {
            $this->assertEquals($value, $alertEntity->$key);
        }
    }
}
