<?php namespace Pete001\Alerter\Persistence\Laravel\Repository;

use Pete001\Alerter\Domain\Repository\AlertRepositoryInterface;
use Pete001\Alerter\Domain\Entity\AlertGroup;

class AlertRepository extends AbstractRepository implements AlertRepositoryInterface
{
	public function getAlertGroup()
	{
		return $this->model->alertGroup();
	}

	public function setAlertGroup(AlertGroup $alertGroup)
	{
		$this->model->alert_group_id = $alertGroup->id;
		return $this;
	}
}
