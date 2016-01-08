<?php namespace Pete001\Alerter\Persistence\Laravel\Model;

class AlertGroupModel extends AbstractModel
{
	protected $table = 'alert_group';

	protected $fillable = ['title', 'short_description'];
}
