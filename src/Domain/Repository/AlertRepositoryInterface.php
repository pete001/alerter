<?php namespace Pete001\Alerter\Domain\Repository;

use Pete001\alerter\Domain\Entity\AlertGroup;

/**
 * Interface extension for entity
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
interface AlertRepositoryInterface extends RepositoryInterface
{
	public function getAlertGroup();

	public function setAlertGroup(AlertGroup $alertGroup);
}
