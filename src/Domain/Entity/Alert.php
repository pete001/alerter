<?php namespace Pete001\Alerter\Domain\Entity;

/**
 * The alert entity defines all the valid alert apps that exist
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class Alert extends AbstractEntity
{
    protected $title;
    protected $short_description;
    protected $full_description;
    protected $alert_group_id;

    private $alert_group;

    public function getAlertGroup()
    {
        return $this->alert_group;
    }

    public function setAlertGroup(AlertGroup $alertGroup)
    {
        return $this->alert_group = $alertGroup;
    }
}
