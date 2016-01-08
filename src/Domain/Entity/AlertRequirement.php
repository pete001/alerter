<?php namespace Pete001\Alerter\Domain\Entity;

/**
 * The alert entity defines all the valid alert apps that exist
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class AlertRequirement extends AbstractEntity
{
    protected $title;
    protected $short_description;
    protected $required;
    protected $alert_id;

    private $alert_group;

    public function getAlert()
    {
        return $this->alert;
    }

    public function setAlert(Alert $alert)
    {
        return $this->alert = $alert;
    }
}
