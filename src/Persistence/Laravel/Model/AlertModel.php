<?php namespace Pete001\Alerter\Persistence\Laravel\Model;

class AlertModel extends AbstractModel
{
	protected $table = 'alert';

	protected $fillable = ['title', 'short_description', 'full_description'];

	public function alert_requirement()
	{
		return $this->belongsToMany('Pete001\Alerter\Persistence\Laravel\Model\AlertRequirement');
	}

	public function alert_photo()
	{
		return $this->belongsTo('Pete001\Alerter\Persistence\Laravel\Model\AlertPhoto');
	}

	public function alert_tag()
	{
		return $this->belongsToMany('Pete001\Alerter\Persistence\Laravel\Model\AlertTag', 'alert_alert_tag', 'alert_id');
	}

	public function alert_hook()
	{
		return $this->belongsToMany('Pete001\Alerter\Persistence\Laravel\Model\AlertHook', 'alert_alert_hook_user', 'alert_id');
	}
}
