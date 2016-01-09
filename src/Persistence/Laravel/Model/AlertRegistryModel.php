<?php namespace Pete001\Alerter\Persistence\Laravel\Model;

class AlertRegistryModel extends AbstractModel
{
	protected $table = 'alert_registry';

	public function alert()
	{
		return $this->belongsTo('Pete001\Alerter\Persistence\Laravel\Model\AlertModel');
	}

	public function alert_hook()
	{
		return $this->belongsTo('Pete001\Alerter\Persistence\Laravel\Model\AlertHookModel');
	}
}
