<?php namespace Pete001\Alerter\Domain\Repository;

use Pete001\alerter\Domain\Entity\Alert;
use Pete001\alerter\Domain\Entity\AlertHook;

/**
 * Interface extension for entity
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
interface AlertRegistryRepositoryInterface extends RepositoryInterface
{
	public function getAlert();

	public function setAlert(Alert $alert);

	public function getAlertHook();

	public function setAlertHook(AlertHook $alertHook);

	public function setUser($id);
}
