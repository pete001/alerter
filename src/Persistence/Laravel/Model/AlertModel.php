<?php namespace Pete001\Alerter\Persistence\Laravel\Model;

class AlertModel extends AbstractModel
{
	protected $table = 'alert';

	protected $fillable = ['title', 'short_description', 'full_description'];

	public function alertGroup()
	{
		return $this->belongsTo('Pete001\Alerter\Persistence\Laravel\Model\AlertGroupModel');
	}
}
