<?php namespace Pete001\Alerter\Domain\Entity;

/**
 * The alert entity defines all the valid alert apps that exist
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class AlertRequirements extends AbstractEntity
{
    protected $title;
    protected $short_description;
    protected $required;
    protected $alert_id;
}
