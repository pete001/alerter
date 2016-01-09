<?php namespace Pete001\Alerter\Persistence\Laravel\Model;

class AlertDetailModel extends AbstractModel
{
	protected $table = 'alert_detail';

	protected $fillable = ['value'];

	public function alertRequirement()
	{
		return $this->belongsTo('Pete001\Alerter\Persistence\Laravel\Model\AlertRequirementModel');
	}
}
