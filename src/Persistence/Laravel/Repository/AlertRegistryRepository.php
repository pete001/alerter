<?php namespace Pete001\Alerter\Persistence\Laravel\Repository;

use Pete001\Alerter\Domain\Repository\AlertRegistryRepositoryInterface;
use Pete001\Alerter\Domain\Entity\Alert;
use Pete001\Alerter\Domain\Entity\AlertHook;

class AlertRegistryRepository extends AbstractRepository implements AlertRegistryRepositoryInterface
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

	public function getAlertHook()
	{
		return $this->model->alertHook();
	}

	public function setAlertHook(AlertHook $alertHook)
	{
		$this->model->alert_hook_id = $alertHook->id;
		return $this;
	}

	public function setUser($id)
	{
		$this->model->users_id = $id;
		return $this;
	}
}
