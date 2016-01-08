<?php namespace Pete001\Alerter\Persistence\Laravel\Repository;

use Pete001\Alerter\Domain\Repository\AlertRepositoryInterface;

class AlertRepository extends AbstractRepository implements AlertRepositoryInterface
{
	public function getAlertRequirement()
	{
		return $this->model->alertRequirement();
	}
}
