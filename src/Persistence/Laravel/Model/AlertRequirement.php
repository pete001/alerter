<?php namespace Pete001\Alerter\Persistence\Laravel\Model;

class AlertRequirementModel extends AbstractModel
{
	protected $table = 'alert_requirement';

	protected $fillable = ['title', 'short_description', 'required'];
}
