<?php namespace Pete001\Alerter\Domain\Entity;

/**
 * Specific details to faciliate an alert
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class AlertDetail extends AbstractEntity
{
    protected $value;
    protected $alert_registry_id;
    protected $alert_requirement_id;

    private $alert_requirement;

    public function getAlertRequirement()
    {
        return $this->alert_requirement;
    }

    public function setAlertRequirement(AlertRequirement $alertRequirement)
    {
        return $this->alert_requirement = $alertRequirement;
    }
}
