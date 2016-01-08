<?php namespace Pete001\Alerter\Persistence\Laravel\Repository;

use Pete001\Alerter\Domain\Repository\AlertRequirementRepositoryInterface;
use Pete001\Alerter\Domain\Entity\Alert;

class AlertRequirementRepository extends AbstractRepository implements AlertRequirementRepositoryInterface
{
	public function getAlert()
	{
		return $this->model->alert();
	}

	public function setAlert(Alert $alert)
	{
		$this->model->alert_id = $alert->id;
		return $this;
	}
}
