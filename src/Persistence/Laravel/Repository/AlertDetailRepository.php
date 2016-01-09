<?php namespace Pete001\Alerter\Persistence\Laravel\Repository;

use Pete001\Alerter\Domain\Repository\AlertDetailRepositoryInterface;
use Pete001\Alerter\Domain\Entity\AlertRequirement;

class AlertDetailRepository extends AbstractRepository implements AlertDetailRepositoryInterface
{
	public function getAlertRequirement()
	{
		return $this->model->alertRequirement();
	}

	public function setAlertRequirement(AlertRequirement $alertRequirement)
	{
		$this->model->alert_requirement_id = $alertRequirement->id;
		return $this;
	}
}
