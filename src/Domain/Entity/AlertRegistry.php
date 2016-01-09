<?php namespace Pete001\Alerter\Domain\Entity;

/**
 * The registry that associates an alert with a hook and user
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class AlertRegistry extends AbstractEntity
{
    protected $alert_id;
    protected $alert_hook_id;
    protected $users_id;
}
