<?php namespace Pete001\Alerter\Persistence\Laravel\Model;

class AlertDetailModel extends AbstractModel
{
	protected $table = 'alert_detail';

	protected $fillable = ['value'];
}
