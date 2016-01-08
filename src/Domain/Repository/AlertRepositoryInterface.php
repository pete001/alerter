<?php namespace Pete001\Alerter\Domain\Repository;

/**
 * Interface extension for entity
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
interface AlertRepositoryInterface extends RepositoryInterface
{
	public function getAlertGroup();
}
