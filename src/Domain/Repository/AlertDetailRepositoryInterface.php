<?php namespace Pete001\Alerter\Domain\Repository;

use Pete001\alerter\Domain\Entity\AlertRequirement;

/**
 * Interface extension for entity
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
interface AlertDetailRepositoryInterface extends RepositoryInterface
{
	public function getAlertRequirement();

	public function setAlertRequirement(AlertRequirement $alertRequirement);
}
