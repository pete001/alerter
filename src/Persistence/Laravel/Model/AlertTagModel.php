<?php namespace Pete001\Alerter\Persistence\Laravel\Model;

class AlertTagModel extends AbstractModel
{
	protected $table = 'alert_tag';

	protected $fillable = ['title'];

	public function alert()
	{
		return $this->belongsToMany('Pete001\Alerter\Persistence\Laravel\Model\Alert', 'alert_alert_tag', 'alert_tag_id');
	}
}
