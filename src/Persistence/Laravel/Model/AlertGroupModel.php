<?php namespace Pete001\Alerter\Persistence\Laravel\Model;

class AlertGroupModel extends AbstractModel
{
	protected $table = 'alert';

	protected $fillable = ['title', 'short_description'];

	public function alert()
	{
		return $this->belongsTo('Pete001\Alerter\Persistence\Laravel\Model\Alert');
	}
}
