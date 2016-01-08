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

    private $alert_requirement;

    public function getAlertRequirement()
    {
        return $this->alert_requirement;
    }
}
