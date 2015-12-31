<?php namespace Pete001\Alerter\Domain\Service;

use Pete001\Alerter\Domain\Entity\Alert;

/**
 * Top level alert strategry interface
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
interface AlertStrategyInterface
{
	public function send();
}
