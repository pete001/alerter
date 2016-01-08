<?php namespace Pete001\Alerter\Persistence\Laravel\Model;

class AlertHookModel extends AbstractModel
{
	protected $table = 'alert_hook';

	protected $fillable = ['title', 'short_description'];

	public function alert()
	{
		return $this->belongsToMany('Pete001\Alerter\Persistence\Laravel\Model\Alert', 'alert_alert_hook_user', 'alert_hook_id');
	}
}
