<?php namespace Pete001\Alerter\Domain\Entity;

/**
 * The available hooks that alerts can be triggered against
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class AlertHook extends AbstractEntity
{
    protected $title;
    protected $short_description;
}
